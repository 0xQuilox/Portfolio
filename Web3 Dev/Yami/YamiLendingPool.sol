// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

import "@openzeppelin/contracts/token/ERC20/IERC20.sol";
import "@openzeppelin/contracts/access/Ownable.sol";
import "./YToken.sol";

contract YamiLendingPool is Ownable {
    // Asset configuration
    struct AssetConfig {
        bool isCollateral;           // Whether the asset can be used as collateral
        uint256 ltv;                 // Loan-to-Value ratio (e.g., 0.75e18 for 75%)
        uint256 liquidationThreshold; // Threshold for liquidation (e.g., 0.8e18 for 80%)
    }

    // Asset data for interest and borrow tracking
    struct AssetData {
        uint256 liquidityIndex;      // Cumulative index for supply interest, starts at 1e18
        uint256 borrowIndex;         // Cumulative index for borrow interest, starts at 1e18
        uint256 lastUpdateTimestamp; // Last time indices were updated
        uint256 totalScaledBorrows;  // Total borrows in scaled units
    }

    // Mappings
    mapping(address => address) public assetToYToken;               // Asset => yToken address
    mapping(address => AssetConfig) public assetConfigs;            // Asset => configuration
    mapping(address => AssetData) public assetData;                 // Asset => data
    mapping(address => mapping(address => uint256)) public userScaledBorrows; // User => Asset => Scaled borrow amount

    // Price oracle
    address public priceOracle;

    // Constants
    uint256 constant SECONDS_PER_YEAR = 31536000; // Seconds in a year
    uint256 constant RAY = 1e18;                  // 10^18 for fixed-point math

    // List of supported assets (for iteration)
    address[] public supportedAssets;

    constructor(address _priceOracle) {
        priceOracle = _priceOracle;
    }

    // Add a new asset to the platform
    function addAsset(
        address asset,
        string memory yTokenName,
        string memory yTokenSymbol,
        bool isCollateral,
        uint256 ltv,
        uint256 liquidationThreshold
    ) external onlyOwner {
        YToken yToken = new YToken(yTokenName, yTokenSymbol, address(this));
        assetToYToken[asset] = address(yToken);
        assetConfigs[asset] = AssetConfig(isCollateral, ltv, liquidationThreshold);
        assetData[asset] = AssetData(RAY, RAY, block.timestamp, 0);
        supportedAssets.push(asset);
    }

    // Update liquidity and borrow indices based on interest rates
    function updateIndices(address asset) internal {
        AssetData storage data = assetData[asset];
        uint256 timeElapsed = block.timestamp - data.lastUpdateTimestamp;
        if (timeElapsed == 0) return;

        // Calculate utilization rate
        uint256 totalDeposits = (IERC20(assetToYToken[asset]).totalSupply() * data.liquidityIndex) / RAY;
        uint256 totalBorrows = (data.totalScaledBorrows * data.borrowIndex) / RAY;
        uint256 utilization = totalDeposits > 0 ? (totalBorrows * RAY) / totalDeposits : 0;

        // Simple interest rate model: borrowRate = 0.25 * utilization
        uint256 borrowRate = (utilization * 25e16) / 100e16; // Max 25% annual rate at 100% utilization
        uint256 supplyRate = (borrowRate * utilization) / RAY; // Supply rate is borrow rate * utilization

        // Update indices (linear approximation)
        uint256 supplyRatePerSecond = supplyRate / SECONDS_PER_YEAR;
        data.liquidityIndex += (data.liquidityIndex * supplyRatePerSecond * timeElapsed) / RAY;

        uint256 borrowRatePerSecond = borrowRate / SECONDS_PER_YEAR;
        data.borrowIndex += (data.borrowIndex * borrowRatePerSecond * timeElapsed) / RAY;

        data.lastUpdateTimestamp = block.timestamp;
    }

    // Deposit assets and receive yTokens
    function deposit(address asset, uint256 amount) external {
        require(assetToYToken[asset] != address(0), "Asset not supported");
        updateIndices(asset);

        IERC20(asset).transferFrom(msg.sender, address(this), amount);
        YToken(assetToYToken[asset]).mint(msg.sender, amount);
    }

    // Borrow assets against collateral
    function borrow(address asset, uint256 amount) external {
        require(assetToYToken[asset] != address(0), "Asset not supported");
        updateIndices(asset);

        uint256 borrowingPower = calculateBorrowingPower(msg.sender);
        uint256 totalBorrowUSD = calculateTotalBorrowUSD(msg.sender);
        uint256 price = IPriceOracle(priceOracle).getAssetPrice(asset);
        uint256 borrowUSD = (amount * price) / RAY;

        require(totalBorrowUSD + borrowUSD <= borrowingPower, "Insufficient collateral");
        require(IERC20(asset).balanceOf(address(this)) >= amount, "Insufficient liquidity");

        uint256 scaledAmount = (amount * RAY) / assetData[asset].borrowIndex;
        userScaledBorrows[msg.sender][asset] += scaledAmount;
        assetData[asset].totalScaledBorrows += scaledAmount;

        IERC20(asset).transfer(msg.sender, amount);
    }

    // Repay borrowed assets
    function repay(address asset, uint256 amount) external {
        require(assetToYToken[asset] != address(0), "Asset not supported");
        updateIndices(asset);

        uint256 borrowBalance = (userScaledBorrows[msg.sender][asset] * assetData[asset].borrowIndex) / RAY;
        if (amount > borrowBalance) amount = borrowBalance;

        uint256 scaledAmount = (amount * RAY) / assetData[asset].borrowIndex;
        userScaledBorrows[msg.sender][asset] -= scaledAmount;
        assetData[asset].totalScaledBorrows -= scaledAmount;

        IERC20(asset).transferFrom(msg.sender, address(this), amount);
    }

    // Withdraw deposited assets
    function withdraw(address asset, uint256 amount) external {
        require(assetToYToken[asset] != address(0), "Asset not supported");
        updateIndices(asset);

        YToken yToken = YToken(assetToYToken[asset]);
        uint256 depositBalance = (yToken.balanceOf(msg.sender) * assetData[asset].liquidityIndex) / RAY;
        if (amount > depositBalance) amount = depositBalance;

        uint256 newDepositBalance = depositBalance - amount;
        uint256 totalBorrowUSD = calculateTotalBorrowUSD(msg.sender);
        uint256 borrowingPower = calculateBorrowingPowerWithOverride(msg.sender, asset, newDepositBalance);
        require(totalBorrowUSD <= borrowingPower, "Insufficient collateral after withdrawal");

        uint256 yTokenAmount = (amount * RAY) / assetData[asset].liquidityIndex;
        yToken.burn(msg.sender, yTokenAmount);
        IERC20(asset).transfer(msg.sender, amount);
    }

    // Liquidate an undercollateralized borrower
    function liquidate(address borrower, address borrowAsset, address collateralAsset, uint256 repayAmount) external {
        require(assetToYToken[borrowAsset] != address(0) && assetToYToken[collateralAsset] != address(0), "Asset not supported");
        updateIndices(borrowAsset);
        updateIndices(collateralAsset);

        uint256 totalBorrowUSD = calculateTotalBorrowUSD(borrower);
        uint256 liquidationThresholdValue = calculateLiquidationThresholdValue(borrower);
        require(totalBorrowUSD > liquidationThresholdValue, "Borrower not liquidatable");

        uint256 borrowBalance = (userScaledBorrows[borrower][borrowAsset] * assetData[borrowAsset].borrowIndex) / RAY;
        if (repayAmount > borrowBalance) repayAmount = borrowBalance;

        uint256 borrowPrice = IPriceOracle(priceOracle).getAssetPrice(borrowAsset);
        uint256 collateralPrice = IPriceOracle(priceOracle).getAssetPrice(collateralAsset);
        uint256 repayUSD = (repayAmount * borrowPrice) / RAY;
        uint256 seizeUSD = (repayUSD * 105) / 100; // 5% liquidation bonus
        uint256 collateralAmount = (seizeUSD * RAY) / collateralPrice;

        YToken yToken = YToken(assetToYToken[collateralAsset]);
        uint256 collateralBalance = (yToken.balanceOf(borrower) * assetData[collateralAsset].liquidityIndex) / RAY;
        require(collateralAmount <= collateralBalance, "Insufficient collateral");

        uint256 scaledRepayAmount = (repayAmount * RAY) / assetData[borrowAsset].borrowIndex;
        userScaledBorrows[borrower][borrowAsset] -= scaledRepayAmount;
        assetData[borrowAsset].totalScaledBorrows -= scaledRepayAmount;

        uint256 yTokenAmount = (collateralAmount * RAY) / assetData[collateralAsset].liquidityIndex;
        yToken.burn(borrower, yTokenAmount);
        IERC20(collateralAsset).transfer(msg.sender, collateralAmount);
        IERC20(borrowAsset).transferFrom(msg.sender, address(this), repayAmount);
    }

    // Calculate user's borrowing power
    function calculateBorrowingPower(address user) internal view returns (uint256) {
        uint256 total = 0;
        for (uint i = 0; i < supportedAssets.length; i++) {
            address asset = supportedAssets[i];
            if (assetConfigs[asset].isCollateral) {
                YToken yToken = YToken(assetToYToken[asset]);
                uint256 depositBalance = (yToken.balanceOf(user) * assetData[asset].liquidityIndex) / RAY;
                uint256 price = IPriceOracle(priceOracle).getAssetPrice(asset);
                uint256 collateralValue = (depositBalance * price) / RAY;
                total += (collateralValue * assetConfigs[asset].ltv) / RAY;
            }
        }
        return total;
    }

    // Calculate borrowing power with an override for withdrawal checks
    function calculateBorrowingPowerWithOverride(address user, address overrideAsset, uint256 overrideDepositBalance) internal view returns (uint256) {
        uint256 total = 0;
        for (uint i = 0; i < supportedAssets.length; i++) {
            address asset = supportedAssets[i];
            if (assetConfigs[asset].isCollateral) {
                uint256 depositBalance;
                if (asset == overrideAsset) {
                    depositBalance = overrideDepositBalance;
                } else {
                    YToken yToken = YToken(assetToYToken[asset]);
                    depositBalance = (yToken.balanceOf(user) * assetData[asset].liquidityIndex) / RAY;
                }
                uint256 price = IPriceOracle(priceOracle).getAssetPrice(asset);
                uint256 collateralValue = (depositBalance * price) / RAY;
                total += (collateralValue * assetConfigs[asset].ltv) / RAY;
            }
        }
        return total;
    }

    // Calculate total borrow value in USD
    function calculateTotalBorrowUSD(address user) internal view returns (uint256) {
        uint256 total = 0;
        for (uint i = 0; i < supportedAssets.length; i++) {
            address asset = supportedAssets[i];
            uint256 borrowBalance = (userScaledBorrows[user][asset] * assetData[asset].borrowIndex) / RAY;
            uint256 price = IPriceOracle(priceOracle).getAssetPrice(asset);
            total += (borrowBalance * price) / RAY;
        }
        return total;
    }

    // Calculate liquidation threshold value
    function calculateLiquidationThresholdValue(address user) internal view returns (uint256) {
        uint256 total = 0;
        for (uint i = 0; i < supportedAssets.length; i++) {
            address asset = supportedAssets[i];
            if (assetConfigs[asset].isCollateral) {
                YToken yToken = YToken(assetToYToken[asset]);
                uint256 depositBalance = (yToken.balanceOf(user) * assetData[asset].liquidityIndex) / RAY;
                uint256 price = IPriceOracle(priceOracle).getAssetPrice(asset);
                uint256 collateralValue = (depositBalance * price) / RAY;
                total += (collateralValue * assetConfigs[asset].liquidationThreshold) / RAY;
            }
        }
        return total;
    }
}
