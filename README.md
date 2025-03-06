# 🔒 Pwned Password Checker

A simple PHP script to check if a password has been compromised using the **Have I Been Pwned (HIBP) Pwned Passwords API** with the **k-anonymity model**.  
This script only sends the **first 5 characters of the SHA-1 password hash** to HIBP, ensuring that the original password remains private.

---

## 🚀 Features
- 🔹 Uses **HIBP API** to check for leaked password hashes.
- 🔹 Sends only **the first 5 characters of the hash** for privacy protection.
- 🔹 **JSON output**, making it easy to integrate into other applications.
- 🔹 **Input validation** to prevent invalid requests and security issues.

---

## 📥 Installation
1. **Clone the repository:**
   ```bash
   git clone https://github.com/yayip/pwbreach-checking.git
   cd pwbreach-checking
   ```
2. **Ensure your server has PHP (version 7.4 or later).**
3. **Place the script on a web server (Apache/Nginx/XAMPP/LAMP).**
4. **Access it via a web browser or terminal.**

---

## 🔍 Usage PHP
1. **Using a web browser:**  
   ```
   http://yourserver.com/check_password.php?hash=CBFDA
   ```
2. **Using curl in the terminal:**  
   ```bash
   curl "http://yourserver.com/check_password.php?hash=CBFDA"
   ```
3. **JSON Output Example:**  
   ```json
   [
       {
           "full_hash": "CBFDA6008F9CAB4083784CBD1874F76618D2A97",
           "breach_count": 53123
       },
       {
           "full_hash": "CBFDA90AB64F3DAB8E99EF682A2B7D2759257C0A1",
           "breach_count": 8
       },
       {
           "full_hash": "CBFDAF8F47B0A2AB9F6D97F489B48B8B7606E647D",
           "breach_count": 1203
       }
   ]
   ```

---

## 🛡️ Security
✅ **Does not send the original password to the server** (only the first 5 hash characters).  
✅ **Validates input hash** to prevent exploitation.  
✅ **Can be used in other applications via JSON API**.  

---

## 🛠️ How It Works
1. **User hashes the password using SHA-1.**  
   - Example:  
     ```
     Password: MySecurePass
     SHA-1 Hash: A94A8FE5CCB19BA61C4C0873D391E987982FBBD3
     ```
2. **The first 5 characters of the hash are sent to HIBP API.**  
   - Example:  
     ```
     API Request: https://api.pwnedpasswords.com/range/A94A8
     ```
3. **HIBP returns all hashes starting with those 5 characters.**
4. **The script checks if the full hash exists in the returned data.**
5. **If found, it shows how many times the password has been breached.**

---

## 📜 License
MIT License - Feel free to use and contribute! 🙌

---

## 🤝 Contributing
Pull requests are welcome! If you would like to add new features, please fork the repo and submit a PR.

---

## 📧 Contact
For questions, feel free to reach out via **[GitHub Issues](https://github.com/yayip/pwbreach-checking/issues)**.

---
🔥 **Stay Secure!** 🚀
