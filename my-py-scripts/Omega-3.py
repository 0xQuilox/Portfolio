import imaplib
import email
from textblob import TextBlob

def check_phishing(email_content):
    # Analyze sentiment and check for phishing keywords
    blob = TextBlob(email_content)
    if blob.sentiment.polarity < 0 or "urgent" in email_content.lower() or "click here" in email_content.lower():
        return True
    return False

def main():
    # Connect to Gmail's IMAP server
    mail = imaplib.IMAP4_SSL('imap.gmail.com')
    
    # Set UTF-8 encoding explicitly to handle non-ASCII characters
    mail._encoding = 'utf-8'  # Override default ASCII encoding
    
    # Your email and password
    username = 'tajudeenkorede75@gmail.com'
    password = '22Carpét8Diem2001'  # Replace with app password if needed
    
    # Login with error handling
    try:
        mail.login(username, password)
        print("Login successful!")
    except imaplib.IMAP4.error as e:
        print(f"Login failed: {e}")
        return
    
    # Select the inbox folder
    mail.select('inbox')
    
    # Search all emails
    _, data = mail.search(None, 'ALL')
    for num in data[0].split():
        _, msg_data = mail.fetch(num, '(RFC822)')  # Fetch email data
        raw_email = msg_data[0][1]
        msg = email.message_from_bytes(raw_email)
        # Check payload (email body)
        payload = msg.get_payload(decode=True).decode('utf-8', errors='ignore') if msg.get_payload() else ""
        if check_phishing(payload):
            print(f"Potential phishing email: {msg['Subject']}")
    
    mail.close()
    mail.logout()

if __name__ == "__main__":
    main()
