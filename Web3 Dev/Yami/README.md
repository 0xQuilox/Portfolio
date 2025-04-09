# Yami - Decentralized Lending and Borrowing Platform

Yami is a decentralized finance (DeFi) lending and borrowing platform built on the Ethereum blockchain. Inspired by protocols like Aave, Yami allows users to deposit assets to earn interest, borrow assets against collateral, and repay loans with dynamically calculated interest. The platform ensures security and stability through robust collateral management and liquidation mechanisms.

## Table of Contents

Overview (#overview)

Features (#features)

Architecture (#architecture)

Smart Contracts (#smart-contracts)

Deployment (#deployment)

Usage (#usage)

Interest Rate Model (#interest-rate-model)

Collateral and Liquidation (#collateral-and-liquidation)

Security Considerations (#security-considerations)

Future Enhancements (#future-enhancements)

License (#license)

### Overview

Yami is designed to empower users in the DeFi ecosystem by providing the following capabilities:

Deposit Assets: Users can deposit ERC20 tokens (e.g., WETH, DAI, USDC) and earn interest through yTokens.

Borrow Assets: Users can borrow assets by locking collateral, with borrowing limits determined by loan-to-value (LTV) ratios.

Repay Loans: Loans can be repaid with interest, calculated dynamically based on asset utilization rates.

Collateral Management: Deposited assets can serve as collateral, with automatic liquidation if their value falls below a set threshold.

The platform integrates with a price oracle (e.g., Chainlink) for real-time asset pricing and employs a utilization-based interest rate model to balance supply and demand efficiently.

### Features

Deposit and Earn: Users deposit assets and receive yTokens, which increase in value as interest accrues.

Borrowing: Borrow assets by providing collateral, with limits based on LTV ratios.

Dynamic Interest Rates: Rates adjust automatically based on asset utilization, benefiting both lenders and borrowers.

Collateral Monitoring: Real-time tracking of collateral health ensures loan security.

Liquidation System: Undercollateralized positions are liquidated to protect the protocol.

Multi-Asset Support: Compatible with various ERC20 tokens for flexibility.


### Architecture

Yami’s architecture comprises the following key components:

YToken Contract: An ERC20 token representing deposited assets, which appreciates as interest accumulates.

Price Oracle: An external contract (e.g., Chainlink) providing real-time USD prices for assets.

YamiLendingPool Contract: The central contract handling deposits, borrowing, repayments, withdrawals, and liquidations.


Key Design Choices

yTokens: Modeled after Aave’s aTokens, yTokens are minted 1:1 with deposits and grow in value via a liquidityIndex.

Interest Rates: Calculated using a utilization-based model where borrow rates rise with demand, and supply rates follow accordingly.

Collateral System: Tracks collateral value with LTV and liquidation thresholds, triggering liquidations when necessary.


### Smart Contracts

YToken.sol

Purpose: Represents deposited assets and tracks interest accrual.


Key Functions:

mint(address to, uint256 amount): Issues yTokens to users upon deposit.

burn(address from, uint256 amount): Destroys yTokens during withdrawals or liquidations.


YamiLendingPool.sol

Purpose: Manages the core lending and borrowing operations.

Key Functions:

addAsset(...): Configures a new asset for the platform.

deposit(address asset, uint256 amount): Accepts deposits and mints yTokens.

borrow(address asset, uint256 amount): Facilitates borrowing against collateral.

repay(address asset, uint256 amount): Processes loan repayments.

withdraw(address asset, uint256 amount): Allows asset withdrawals.

liquidate(address borrower, address borrowAsset, address collateralAsset, uint256 repayAmount): Handles liquidation of undercollateralized positions.











