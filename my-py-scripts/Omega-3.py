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
    # Connect to email server (update with your details)
    mail = imaplib.IMAP4_SSL('imap.gmail.com')  # Replace with your IMAP server
    mail.login('tajudeenkorede75@gmail.com', 'abcd efgh ijkl mnop')  # Replace with your email and password
    mail.select('inbox')  # Select the inbox folder
    _, data = mail.search(None, 'ALL')  # Search all emails
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
