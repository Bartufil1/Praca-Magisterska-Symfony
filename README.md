# 🔓 IDOR Example – OWASP A01:2021 – Broken Access Control

Ten projekt demonstruje podatność **IDOR (Insecure Direct Object References)** w Symfony w ramach kategorii **A01:2021 – Broken Access Control**.

Przykład zawiera dwie wersje:
- 🔴 `UserController` – podatna, bez kontroli dostępu,
- 🟢 `UserControllerSecurity` – bezpieczna, z walidacją uprawnień.

---

## 📦 Zawartość projektu

- `src/Controller/UserController.php` – wersja podatna,
- `src/Controller/UserControllerSecurity.php` – wersja bezpieczna,
- `templates/user/profile.html.twig` – szablon do wyświetlania profilu (w wersji podatnej),
- `docker-compose.yml`, `Dockerfile` – uruchamianie aplikacji w kontenerze.

---

## 🐳 Uruchomienie w Dockerze

1. Sklonuj repozytorium:
```bash
git clone https://github.com/Bartufil1/Praca-Magisterska-Symfony.git
cd Praca-Magisterska-Symfony-A01-IDOR-example
```

2. Uruchom kontenery:
```bash
docker compose up --build
```

3. Aplikacja będzie dostępna pod adresem:
```
http://localhost:8000
```

---

## 🧪 Testowanie podatności IDOR

### 🔴 1. Wersja podatna

Odwiedź:
```
http://localhost:8000/user/profile/123
```

Zmień ID w adresie URL, np. na:
```
http://localhost:8000/user/profile/2
```

➡️ Jeśli możesz zobaczyć dane innego użytkownika – aplikacja jest podatna.

---

### 🟢 2. Wersja zabezpieczona

Odwiedź:
```
http://localhost:8000/userSecurity/profile/123
```

Następnie spróbuj wejść na:
```
http://localhost:8000/userSecurity/profile/2
```

➡️ Aplikacja powinna zwrócić:
```
Access Denied!
```

---

## 🔐 Jak działa zabezpieczenie?

- Aplikacja symuluje, że zalogowany użytkownik ma ID `123`.
- Jeśli próbujesz podejrzeć inny profil – otrzymujesz komunikat o braku dostępu.
- W praktyce takie sprawdzanie powinno bazować na sesji, tokenie JWT lub `Security` komponentach Symfony.

---

## 👨‍🎓 Autor

Bartłomiej Filipski  
