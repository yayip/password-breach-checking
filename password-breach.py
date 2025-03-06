import hashlib
import requests

def get_pwned_passwords(prefix):
    url = f"https://api.pwnedpasswords.com/range/{prefix}"
    response = requests.get(url)
    
    if response.status_code != 200:
        raise RuntimeError(f"Error fetching data from HIBP API: {response.status_code}")
    
    return response.text

def check_password(password):
    sha1_hash = hashlib.sha1(password.encode()).hexdigest().upper()
    prefix, suffix = sha1_hash[:5], sha1_hash[5:]

    breached_hashes = get_pwned_passwords(prefix)

    print(prefix)
    print(breached_hashes)

    for line in breached_hashes.splitlines():
        hash_suffix, count = line.split(':')
        if hash_suffix == suffix:
            return int(count)
    
    return 0

if __name__ == "__main__":
    password = input("Entar Password : ")
    count = check_password(password)

    if count:
        print(f"⚠️ Password has been breached {count} times! Please change the password!!!")
    else:
        print("✅ Password is safe, not found in leaked database.")
