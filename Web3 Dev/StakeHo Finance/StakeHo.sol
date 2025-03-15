// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

import "@openzeppelin/contracts/token/ERC20/IERC20.sol";
import "@openzeppelin/contracts/access/Ownable.sol";

contract StakeHo is Ownable {
    IERC20 public immutable stakingToken; // The ERC20 token used for staking and rewards
    uint256 public totalStaked;           // Total amount of tokens staked
    uint256 public rewardRate;            // Reward rate in tokens per second
    uint256 public lastUpdateTime;        // Last time rewardPerTokenStored was updated
    uint256 public rewardPerTokenStored;  // Accumulated reward per token
    uint256 public periodFinish;          // Timestamp when the current reward period ends
    uint256 public constant LOCK_PERIOD = 30 days; // Fixed lock period for staked tokens

    // User-specific data
    mapping(address => uint256) public stakedBalance;         // Staked amount per user
    mapping(address => uint256) public unlockTime;            // Unlock timestamp per user
    mapping(address => uint256) public rewards;               // Accumulated rewards per user
    mapping(address => uint256) public userRewardPerTokenPaid; // Reward per token paid to user

    // Events for tracking activities
    event Staked(address indexed user, uint256 amount);
    event Withdrawn(address indexed user, uint256 amount);
    event RewardPaid(address indexed user, uint256 reward);
    event RewardAdded(uint256 reward, uint256 duration);

    constructor(address _stakingToken) {
        require(_stakingToken != address(0), "Invalid token address");
        stakingToken = IERC20(_stakingToken);
    }

    // Modifier to update reward state
    modifier updateReward(address account) {
        rewardPerTokenStored = rewardPerToken();
        lastUpdateTime = lastTimeRewardApplicable();
        if (account != address(0)) {
            rewards[account] = earned(account);
            userRewardPerTokenPaid[account] = rewardPerTokenStored;
        }
        _;
    }

    // Returns the minimum of current timestamp or periodFinish
    function lastTimeRewardApplicable() public view returns (uint256) {
        return block.timestamp < periodFinish ? block.timestamp : periodFinish;
    }

    // Calculates the accumulated reward per token
    function rewardPerToken() public view returns (uint256) {
        if (totalStaked == 0) {
            return rewardPerTokenStored;
        }
        return
            rewardPerTokenStored +
            ((lastTimeRewardApplicable() - lastUpdateTime) * rewardRate * 1e18) /
            totalStaked;
    }

    // Calculates the total rewards earned by an account
    function earned(address account) public view returns (uint256) {
        return
            (stakedBalance[account] *
                (rewardPerToken() - userRewardPerTokenPaid[account])) /
            1e18 +
            rewards[account];
    }

    // Stake tokens (deposit function)
    function stake(uint256 amount) external updateReward(msg.sender) {
        require(amount > 0, "Cannot stake 0");
        stakedBalance[msg.sender] += amount;
        totalStaked += amount;
        unlockTime[msg.sender] = block.timestamp + LOCK_PERIOD;
        require(
            stakingToken.transferFrom(msg.sender, address(this), amount),
            "Transfer failed"
        );
        emit Staked(msg.sender, amount);
    }

    // Withdraw staked tokens
    function withdraw() external updateReward(msg.sender) {
        require(block.timestamp >= unlockTime[msg.sender], "Stake is locked");
        uint256 amount = stakedBalance[msg.sender];
        require(amount > 0, "No stake to withdraw");
        stakedBalance[msg.sender] = 0;
        totalStaked -= amount;
        require(stakingToken.transfer(msg.sender, amount), "Transfer failed");
        emit Withdrawn(msg.sender, amount);
    }

    // Claim accumulated rewards
    function claimRewards() external updateReward(msg.sender) {
        uint256 reward = rewards[msg.sender];
        if (reward > 0) {
            rewards[msg.sender] = 0;
            require(stakingToken.transfer(msg.sender, reward), "Transfer failed");
            emit RewardPaid(msg.sender, reward);
        }
    }

    // Owner adds rewards to be distributed over a duration
    function notifyRewardAmount(uint256 reward, uint256 duration)
        external
        onlyOwner
        updateReward(address(0))
    {
        require(duration > 0, "Duration must be > 0");
        require(reward > 0, "Reward must be > 0");
        rewardRate = reward / duration;
        periodFinish = block.timestamp + duration;
        require(
            stakingToken.transferFrom(msg.sender, address(this), reward),
            "Transfer failed"
        );
        emit RewardAdded(reward, duration);
    }

    // View function to check staked balance
    function stakedBalanceOf(address account) external view returns (uint256) {
        return stakedBalance[account];
    }

    // View function to check unlock time
    function unlockTimeOf(address account) external view returns (uint256) {
        return unlockTime[account];
    }
}
