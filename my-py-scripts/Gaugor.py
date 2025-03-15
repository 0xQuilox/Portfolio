import zxcvbn
import hashlib
import time

def analyze_password(password):
    # Analyze password strength
    result = zxcvbn.zxcvbn(password)
    print(f"Password: {password}")
    print(f"Score: {result['score']}/4")
    print(f"Crack time: {result['crack_times_display']['offline_slow_hashing_1e4_per_second']}")
    
    # Simulate brute-force timing
    start_time = time.time()
    for i in range(1000000):  # 1 million attempts
        hashlib.sha256(str(i).encode()).hexdigest()
    end_time = time.time()
    print(f"Simulated brute-force time: {end_time - start_time:.2f} seconds")

def main():
    password = input("Enter a password to analyze: ")
    analyze_password(password)

if __name__ == "__main__":
    main()
