# StakeHo Staking Contract

## Overview

`StakeHo` is a gas-optimized Solidity smart contract designed for staking ERC20 tokens. Users can stake tokens, which are locked for a fixed 30-day period, earning rewards proportional to their staked amount and staking duration. Rewards are distributed over time by the contract owner, and users can claim them at any time or withdraw their stake after the lock period ends.

## Features

- **Staking**: Deposit tokens to stake, extending the lock period with each stake.
- **Withdrawal**: Withdraw staked tokens after the 30-day lock period.
- **Vesting**: Staked tokens are locked for 30 days, acting as a vesting mechanism.
- **Rewards**: Earn rewards based on staked amount and time, claimable anytime.
- **Gas Optimization**: Efficient reward calculations and minimal storage usage.

## Contract Details

- **Staking Token**: An ERC20 token used for both staking and rewards.
- **Lock Period**: Fixed at 30 days (`30 days` in seconds).
- **Reward Distribution**: Set by the owner via `notifyRewardAmount`, distributing rewards over a specified duration.
- **Solidity Version**: `^0.8.0`, leveraging modern safety and optimization features.

## Functions

### `stake(uint256 amount)` (external)

- **Description**: Stakes `amount` tokens, extending the lock period to 30 days from the current block timestamp.
- **Requirements**: 
  - `amount > 0`
  - User must approve the contract to spend `amount` tokens.
- **Events**: Emits `Staked(address user, uint256 amount)`.

### `withdraw()` (external)

- **Description**: Withdraws the entire staked balance if the lock period has ended.
- **Requirements**: 
  - Current timestamp ≥ user’s `unlockTime`.
  - User has a non-zero staked balance.
- **Events**: Emits `Withdrawn(address user, uint256 amount)`.

### `claimRewards()` (external)

- **Description**: Claims all accumulated rewards for the caller.
- **Requirements**: None (can be called anytime, even if rewards are 0).
- **Events**: Emits `RewardPaid(address user, uint256 reward)` if rewards are claimed.

### `notifyRewardAmount(uint256 reward, uint256 duration)` (external, onlyOwner)

- **Description**: Sets the reward distribution, distributing `reward` tokens over `duration` seconds.
- **Requirements**: 
  - `duration > 0`
  - `reward > 0`
  - Caller must approve the contract to spend `reward` tokens.
- **Events**: Emits `RewardAdded(uint256 reward, uint256 duration)`.

### `earned(address account)` (public view)

- **Description**: Returns the total rewards earned by `account`, including accumulated and pending rewards.

### `stakedBalanceOf(address account)` (external view)

- **Description**: Returns the staked balance of `account`.

### `unlockTimeOf(address account)` (external view)

- **Description**: Returns the timestamp when `account`’s stake unlocks.

## Deployment

1. **Prerequisites**:
   - Install OpenZeppelin contracts: `npm install @openzeppelin/contracts`.
   - Use a Solidity compiler ≥ 0.8.0.

2. **Steps**:
   - Deploy the contract with the ERC20 token address as the constructor argument:
     ```solidity
     StakeHo stakeHo = new StakeHo(address(stakingToken));
     ```
   - Transfer ownership if needed using `transferOwnership(address)`.

## Usage

1. **Owner Setup**:
   - Approve the contract to spend reward tokens.
   - Call `notifyRewardAmount(reward, duration)` to fund and start reward distribution.

2. **User Interaction**:
   - Approve the contract to spend staking tokens: `stakingToken.approve(stakeHoAddress, amount)`.
   - Stake tokens: `stake(amount)`.
   - Check rewards: `earned(userAddress)`.
   - Claim rewards: `claimRewards()`.
   - After 30 days, withdraw stake: `withdraw()`.

## Notes

- **Lock Period**: Each `stake` call resets the lock period to 30 days from the current timestamp, encouraging prolonged staking.
- **Reward Calculation**: Uses a gas-efficient mechanism inspired by Synthetix, updating rewards only on user interaction.
- **Security**: Assumes the owner funds the contract adequately; no balance checks are enforced to save gas.
- **Dependencies**: Requires OpenZeppelin’s `IERC20` and `Ownable` contracts.

## Example

- Deploy with token at `0x...`.
- Owner calls `notifyRewardAmount(1000e18, 86400)` (1000 tokens over 1 day).
- User stakes 100 tokens, waits 15 days, claims rewards, then withdraws after 30 days.

---

This contract and README fulfill the requirements for `StakeHo` with deposit (`stake`), withdraw (`withdraw`), vesting (via the 30-day lock period), and reward (`claimRewards`) functionalities, optimized for gas efficiency.
