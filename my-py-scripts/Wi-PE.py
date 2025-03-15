import subprocess
import re

def get_wifi_passwords():
    # Run the command to get all Wi-Fi profiles
    profiles = subprocess.check_output("netsh wlan show profiles", shell=True).decode()
    # Extract profile names using regex
    wifi_list = re.findall(r"All User Profile\s*:\s*(.*)", profiles)
    
    passwords = {}
    for wifi in wifi_list:
        # Get password details for each profile
        details = subprocess.check_output(f"netsh wlan show profile \"{wifi}\" key=clear", shell=True).decode()
        # Extract password using regex
        password = re.search(r"Key Content\s*:\s*(.*)", details)
        passwords[wifi] = password.group(1) if password else "No password"
    
    return passwords

def main():
    # Print Wi-Fi names and passwords
    for wifi, pwd in get_wifi_passwords().items():
        print(f"Wi-Fi: {wifi} | Password: {pwd}")

if __name__ == "__main__":
    main()
