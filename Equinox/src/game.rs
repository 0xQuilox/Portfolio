use anchor_lang::prelude::*;
use anchor_lang::solana_program::system_instruction;
use anchor_lang::solana_program::program::invoke;
use chess::ChessGame; // Hypothetical chess library for validation

declare_id!("YourProgramIdHere");

#[program]
pub mod equinox {
    use super::*;

    // Difficulty levels
    const EASY: u8 = 0;
    const MEDIUM: u8 = 1;
    const HARD: u8 = 2;

    // Base returns (in percentage)
    const BASE_RETURN_EASY: u64 = 100; // 100% return
    const BASE_RETURN_MEDIUM: u64 = 400; // 400% return
    const BASE_RETURN_HARD: u64 = 900; // 900% return

    // Optimal move counts for each difficulty
    const OPTIMAL_MOVES_EASY: u64 = 20;
    const OPTIMAL_MOVES_MEDIUM: u64 = 30;
    const OPTIMAL_MOVES_HARD: u64 = 40;

    // Maximum moves before return drops to 0%
    const MAX_MOVES_EASY: u64 = 60;
    const MAX_MOVES_MEDIUM: u64 = 70;
    const MAX_MOVES_HARD: u64 = 80;

    // **Staking Mechanism and Game Initialization**
    /// Starts a new game by staking SOL and initializing the game state.
    pub fn start_game(ctx: Context<StartGame>, difficulty: u8, stake: u64) -> Result<()> {
        let game_account = &mut ctx.accounts.game_account;
        let player = &ctx.accounts.player;
        let escrow = &ctx.accounts.escrow;

        // Validate difficulty
        if difficulty > HARD {
            return Err(ProgramError::InvalidArgument.into());
        }

        // Ensure stake is non-zero
        if stake == 0 {
            return Err(ProgramError::InvalidArgument.into());
        }

        // Transfer stake to escrow
        let transfer_instruction = system_instruction::transfer(
            &player.key(),
            &escrow.key(),
            stake,
        );
        invoke(
            &transfer_instruction,
            &[
                player.to_account_info(),
                escrow.to_account_info(),
            ],
        )?;

        // Initialize game state
        game_account.player = player.key();
        game_account.difficulty = difficulty;
        game_account.stake = stake;
        game_account.move_count = 0;
        game_account.board = ChessGame::new(); // Initialize chessboard
        game_account.is_active = true;

        Ok(())
    }

    // **Move Validation and Game State Management**
    /// Processes a player's move, validates it, and updates the game state.
    pub fn make_move(ctx: Context<MakeMove>, move_str: String) -> Result<()> {
        let game_account = &mut ctx.accounts.game_account;

        // Ensure game is active
        if !game_account.is_active {
            return Err(ProgramError::InvalidAccountData.into());
        }

        // Validate and apply move (using hypothetical chess library)
        if !game_account.board.make_move(&move_str) {
            return Err(ProgramError::InvalidInstructionData.into());
        }

        // Increment move count
        game_account.move_count += 1;

        // Check for game end conditions
        if game_account.board.is_checkmate() {
            // Player wins, calculate and transfer payout
            let payout = calculate_payout(game_account);
            **ctx.accounts.escrow.try_borrow_mut_lamports()? -= payout;
            **ctx.accounts.player.try_borrow_mut_lamports()? += payout;
            game_account.is_active = false;
        } else if game_account.board.is_stalemate() || game_account.board.is_insufficient_material() {
            // Draw or stalemate, forfeit stake to treasury
            **ctx.accounts.escrow.try_borrow_mut_lamports()? -= game_account.stake;
            **ctx.accounts.treasury.try_borrow_mut_lamports()? += game_account.stake;
            game_account.is_active = false;
        }

        Ok(())
    }

    // **Dynamic Return Calculation**
    /// Calculates the payout based on move efficiency and difficulty.
    fn calculate_payout(game_account: &GameAccount) -> u64 {
        let base_return = match game_account.difficulty {
            EASY => BASE_RETURN_EASY,
            MEDIUM => BASE_RETURN_MEDIUM,
            HARD => BASE_RETURN_HARD,
            _ => 0,
        };

        let optimal_moves = match game_account.difficulty {
            EASY => OPTIMAL_MOVES_EASY,
            MEDIUM => OPTIMAL_MOVES_MEDIUM,
            HARD => OPTIMAL_MOVES_HARD,
            _ => 0,
        };

        let max_moves = match game_account.difficulty {
            EASY => MAX_MOVES_EASY,
            MEDIUM => MAX_MOVES_MEDIUM,
            HARD => MAX_MOVES_HARD,
            _ => 0,
        };

        let moves = game_account.move_count;

        // Calculate return percentage based on move count
        let return_percentage = if moves <= optimal_moves {
            base_return // Full return if within optimal moves
        } else if moves <= max_moves {
            // Linear decrease from base_return to 0%
            base_return - (base_return * (moves - optimal_moves) / (max_moves - optimal_moves))
        } else {
            0 // No profit if exceeding max moves
        };

        // Payout = stake + (stake * return_percentage / 100)
        game_account.stake + (game_account.stake * return_percentage / 100)
    }
}

// **Account Structures**
#[account]
pub struct GameAccount {
    pub player: Pubkey,         // Player's public key
    pub difficulty: u8,         // Game difficulty (0 = Easy, 1 = Medium, 2 = Hard)
    pub stake: u64,             // Amount staked in lamports
    pub move_count: u64,        // Number of moves made
    pub board: ChessGame,       // Chess board state (hypothetical)
    pub is_active: bool,        // Whether the game is ongoing
}

// **Instruction Contexts**
#[derive(Accounts)]
pub struct StartGame<'info> {
    #[account(init, payer = player, space = 8 + 32 + 1 + 8 + 8 + 1024 + 1)] // Adjust space as needed
    pub game_account: Account<'info, GameAccount>,
    #[account(mut)]
    pub player: Signer<'info>,
    #[account(mut)]
    pub escrow: AccountInfo<'info>,
    pub system_program: Program<'info, System>,
}

#[derive(Accounts)]
pub struct MakeMove<'info> {
    #[account(mut)]
    pub game_account: Account<'info, GameAccount>,
    #[account(mut)]
    pub player: Signer<'info>,
    #[account(mut)]
    pub escrow: AccountInfo<'info>,
    #[account(mut)]
    pub treasury: AccountInfo<'info>,
                      }
