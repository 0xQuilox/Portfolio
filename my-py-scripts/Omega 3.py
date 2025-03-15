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
    mail = imaplib.IMAP4_SSL('imap.example.com')
    mail.login('your_email@example.com', 'password')
    mail.select('inbox')
    _, data = mail.search(None, 'ALL')
    for num in data[0].split():
        _, msg_data = mail.fetch(num, '(RFC822)')
        raw_email = msg_data[0][1]
        msg = email.message_from_bytes(raw_email)
        if check_phishing(msg.get_payload()):
            print(f"Potential phishing email: {msg['Subject']}")
    mail.close()
    mail.logout()

if __name__ == "__main__":
    main()
