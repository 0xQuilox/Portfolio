const express = require('express');
const { Stockfish } = require('stockfish.wasm'); // Stockfish WebAssembly wrapper
const { Connection, Keypair, PublicKey, Transaction, sendAndConfirmTransaction } = require('@solana/web3.js');
const { AnchorProvider, Program } = require('@project-serum/anchor');
const fs = require('fs');
const path = require('path');

const app = express();
app.use(express.json());

// Solana configuration
const SOLANA_RPC_URL = 'https://api.devnet.solana.com'; // Use Devnet or Mainnet as needed
const connection = new Connection(SOLANA_RPC_URL, 'confirmed');
const walletKeypair = Keypair.fromSecretKey(/* Your wallet secret key array here */); // Replace with your key
const provider = new AnchorProvider(connection, walletKeypair, { preflightCommitment: 'confirmed' });

// Load the IDL and program ID for Equinox (adjust paths and IDs)
const idl = JSON.parse(fs.readFileSync(path.join(__dirname, 'equinox.json'), 'utf8'));
const programId = new PublicKey('YourProgramIdHere'); // Replace with your program ID
const program = new Program(idl, programId, provider);

// Stockfish configuration
let stockfish;
(async () => {
    stockfish = await Stockfish();
    stockfish.addMessageListener((message) => {
        console.log('Stockfish:', message);
    });
})();

// Difficulty settings for Stockfish
const DIFFICULTY_SETTINGS = {
    easy: { skillLevel: 2, depth: 3 },   // Weak AI, shallow search
    medium: { skillLevel: 10, depth: 5 }, // Moderate strength
    hard: { skillLevel: 20, depth: 10 }   // Strong AI, deeper search
};

// **API Endpoint: /get-ai-move**
// Receives game state (FEN) and difficulty, returns AI’s move
app.post('/get-ai-move', async (req, res) => {
    const { fen, difficulty } = req.body;

    // Validate request
    if (!fen || !difficulty || !['easy', 'medium', 'hard'].includes(difficulty)) {
        return res.status(400).json({ error: 'Invalid request: fen and difficulty (easy, medium, hard) are required.' });
    }

    try {
        // Configure Stockfish difficulty
        const settings = DIFFICULTY_SETTINGS[difficulty];
        await stockfish.setOption('Skill Level', settings.skillLevel);
        await stockfish.setOption('Depth', settings.depth);

        // Generate AI move
        const aiMove = await getStockfishMove(fen);
        console.log(`AI Move for ${difficulty}: ${aiMove}`);

        // Optionally submit move to smart contract (uncomment and configure as needed)
        // await submitMoveToContract(gameAccountPubkey, aiMove);

        res.json({ move: aiMove });
    } catch (error) {
        console.error('Error generating AI move:', error);
        res.status(500).json({ error: 'Failed to generate AI move.' });
    }
});

// **Helper: Get Stockfish move**
async function getStockfishMove(fen) {
    return new Promise((resolve, reject) => {
        stockfish.postMessage(`position fen ${fen}`);
        stockfish.postMessage('go');
        stockfish.addMessageListener((message) => {
            if (message.startsWith('bestmove')) {
                const move = message.split(' ')[1];
                resolve(move);
            }
        });
        setTimeout(() => reject('Stockfish timed out'), 10000); // 10s timeout
    });
}

// **Helper: Submit move to smart contract**
async function submitMoveToContract(gameAccountPubkey, move) {
    const instruction = await program.methods
        .makeMove(move)
        .accounts({
            gameAccount: gameAccountPubkey,         // Replace with actual game account public key
            player: walletKeypair.publicKey,        // AI’s "player" account
            escrow: /* Escrow account public key */, // Replace as needed
            treasury: /* Treasury account public key */ // Replace as needed
        })
        .instruction();

    const transaction = new Transaction().add(instruction);
    const signature = await sendAndConfirmTransaction(connection, transaction, [walletKeypair]);
    console.log(`AI move submitted: ${signature}`);
    return signature;
}

// Start the server
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Backend server running on port ${PORT}`);
});
