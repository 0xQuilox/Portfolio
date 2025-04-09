// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

import "@openzeppelin/contracts/token/ERC20/ERC20.sol";
import "@openzeppelin/contracts/access/Ownable.sol";

contract YToken is ERC20 {
    address public lendingPool;

    constructor(string memory name, string memory symbol, address _lendingPool) ERC20(name, symbol) {
        lendingPool = _lendingPool;
    }

    modifier onlyLendingPool() {
        require(msg.sender == lendingPool, "Only lending pool allowed");
        _;
    }

    function mint(address to, uint256 amount) external onlyLendingPool {
        _mint(to, amount);
    }

    function burn(address from, uint256 amount) external onlyLendingPool {
        _burn(from, amount);
    }
}
