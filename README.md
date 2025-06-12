# 🔓 Login Rate Limit Example – OWASP A07:2021 – Identification and Authentication Failures

Ten projekt demonstruje brak mechanizmu ograniczającego liczbę prób logowania (brute-force attack) w aplikacji Symfony oraz zabezpieczoną wersję z limitem prób.

---

## 📂 Zawartość projektu

- Symfony + PHP + Docker
- Dwa endpointy:
  - `/login-check-non-protected` – podatny (brak limitu prób logowania),
  - `/login-check-protected` – zabezpieczony (limit prób z kodem 429).

---

## 🐳 Uruchomienie w Dockerze

1. Uruchom Docker Desktop.
2. Wejdź do katalogu projektu:

```bash
cd Praca-Magisterska-Symfony-A04-LoginRateLimit-example
```

3. Uruchom kontenery:

```bash
docker compose up --build
```

4. Aplikacja dostępna będzie pod adresem:
```
http://localhost:8000
```

---

## 🧪 Testowanie

### 🔴 Wersja podatna

1. Otwórz Postmana.
2. Wyślij żądanie `POST` na adres:

```
http://localhost:8000/login-check-non-protected
```

z body (raw JSON):
```json
{
  "login": "admin",
  "password": "secret123"
}
```

3. Żądanie można powtarzać wielokrotnie – serwer nie ogranicza liczby prób.

---

### 🛡️ Wersja zabezpieczona

1. Wyślij żądanie `POST` na adres:

```
http://localhost:8000/login-check-protected
```

z tym samym body:
```json
{
  "login": "admin",
  "password": "secret123"
}
```

2. Po jednej udanej próbie, kolejne żądania będą blokowane – pojawi się kod HTTP 429.

---

## 🎯 Cel demonstracji

Pokazanie różnicy między aplikacją bez zabezpieczeń a aplikacją chronioną przed atakiem siłowym (brute-force) przez mechanizm ograniczania liczby prób logowania.

---

## 👨‍🎓 Autor

Bartłomiej Filipski
