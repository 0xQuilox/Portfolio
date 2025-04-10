#!/bin/bash

# Script to build the Equinox Solana program
# Requirements: Rust, Solana CLI, and Anchor must be installed

# Exit on any error
set -e

# Define colors for output
GREEN='\033[0;32m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Program name and directory
PROGRAM_NAME="equinox"
CONTRACT_DIR="$(pwd)/contract"

# Check for required tools
check_dependencies() {
    echo -e "${GREEN}Checking dependencies...${NC}"
    for cmd in rustc cargo solana anchor; do
        if ! command -v "$cmd" &> /dev/null; then
            echo -e "${RED}Error: $cmd is not installed.${NC}"
            exit 1
        fi
    done
    echo "All dependencies are installed."
}

# Install Rust dependencies
install_dependencies() {
    echo -e "${GREEN}Installing Rust dependencies...${NC}"
    cd "$CONTRACT_DIR"
    cargo update
    cargo build
}

# Build the Solana program
build_program() {
    echo -e "${GREEN}Building the Solana program...${NC}"
    cd "$CONTRACT_DIR"
    # Compile to BPF (Berkeley Packet Filter) for Solana
    cargo build-bpf --release
    if [ $? -eq 0 ]; then
        echo -e "${GREEN}Build successful! Output: target/deploy/${PROGRAM_NAME}.so${NC}"
    else
        echo -e "${RED}Build failed.${NC}"
        exit 1
    fi
}

# Generate program keypair (optional, uncomment if needed)
generate_keypair() {
    echo -e "${GREEN}Generating program keypair...${NC}"
    solana-keygen new --no-passphrase -o "$CONTRACT_DIR/target/deploy/${PROGRAM_NAME}-keypair.json"
    echo "Keypair generated at: $CONTRACT_DIR/target/deploy/${PROGRAM_NAME}-keypair.json"
}

# Generate IDL (optional, for Anchor programs)
generate_idl() {
    echo -e "${GREEN}Generating IDL...${NC}"
    cd "$CONTRACT_DIR"
    anchor idl init -f target/idl/${PROGRAM_NAME}.json -o target/idl/${PROGRAM_NAME}.json
    echo "IDL generated at: $CONTRACT_DIR/target/idl/${PROGRAM_NAME}.json"
}

# Main execution
main() {
    echo -e "${GREEN}Starting build process for Equinox...${NC}"
    check_dependencies
    install_dependencies
    build_program
    # Uncomment the following lines if you need a keypair or IDL
    # generate_keypair
    # generate_idl
    echo -e "${GREEN}Build process completed successfully!${NC}"
}

# Run the script
main
