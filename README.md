
# 🔐 Password in Log Example – OWASP A09:2021 – Security Logging and Monitoring Failures

Ten projekt demonstruje podatność typu **Password in Log** w Symfony, gdzie aplikacja loguje dane uwierzytelniające (np. hasło) w postaci jawnej do plików logów.

---

## 📂 Zawartość projektu

- Symfony + Docker
- Endpoint `/login-insecure` – wersja podatna (loguje pełne dane logowania)
- Endpoint `/login-secure` – wersja zabezpieczona (hasło nie jest logowane)

---

## 🐳 Uruchomienie aplikacji

1. Uruchom Docker Desktop.
2. Wejdź do katalogu projektu:

```bash
cd Praca-Magisterska-Symfony-A09-PasswordInLog-example
```

3. Zbuduj i uruchom kontenery:

```bash
docker compose up --build
```

4. Aplikacja będzie dostępna pod adresem:

```
http://localhost:8000
```

---

## 🧪 Testowanie podatności

### 🔴 Wersja podatna

1. Otwórz Postman i wyślij żądanie POST na adres:
```
http://localhost:8000/login-insecure
```
2. Body (JSON):
```json
{
  "login": "test",
  "password": "test"
}
```

3. Przejdź do plików w kontenerze z aplikacją i otwórz logi:
```
/var/log/insecure.log
```

Zobaczysz, że pełne dane logowania – łącznie z hasłem – zostały zapisane.

### 🛡️ Wersja zabezpieczona

1. W Postmanie wyślij żądanie POST na adres:
```
http://localhost:8000/login-secure
```
2. Użyj tych samych danych logowania.
3. Otwórz plik:
```
/var/log/secure.log
```
Log nie zawiera hasła – zostało zamaskowane lub pominięte.

---

## 🎯 Cel demonstracji

Projekt pokazuje, jak nieodpowiedzialne logowanie wrażliwych danych (np. haseł) może prowadzić do poważnych wycieków informacji i naruszeń prywatności.

---

## 👨‍🎓 Autor

Bartłomiej Filipski
