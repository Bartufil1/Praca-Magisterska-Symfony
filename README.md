
# 🕵️ MITM Example – OWASP A02:2021 – Cryptographic Failures (Man-In-The-Middle)

Projekt demonstracyjny przedstawiający podatność typu **Man-in-the-Middle (MITM)**, wynikającą z przesyłania danych przez nieszyfrowane połączenie HTTP w aplikacji Symfony.

---

## 📦 Struktura projektu

Projekt zawiera:

- 🔴 **Wersję podatną** – dostępna pod adresem `http://localhost:8000` (brak HTTPS),
- 🛡️ **Wersję zabezpieczoną** – dostępna pod adresem `https://localhost:8443/secure` (szyfrowanie TLS).

---

## 🐳 Uruchomienie aplikacji z Docker Compose

### 1. Klonowanie repozytorium

```bash
git clone https://github.com/Bartufil1/Praca-Magisterska-Symfony.git
cd Praca-Magisterska-Symfony-A02-MITM-example
```

lub pobierz paczkę `.zip` i rozpakuj ją na dysku.

### 2. Uruchomienie aplikacji

W terminalu, w głównym folderze projektu, uruchom:

```bash
docker compose up --build
```

Po zbudowaniu kontenerów aplikacja będzie dostępna na dwóch portach:

- `http://localhost:8000` – wersja **podatna** (brak HTTPS),
- `https://localhost:8443/secure` – wersja **zabezpieczona** (HTTPS z TLS).

---

## 🧪 Testowanie podatności MITM

### 🔴 Wersja podatna – `http://localhost:8000`

1. Otwórz przeglądarkę i przejdź na `http://localhost:8000`.
2. Wprowadź dane użytkownika (np. `Admin` / `Mitm123`) i kliknij przycisk logowania.
3. Równolegle uruchom program **Wireshark**.
4. Wybierz interfejs `Loopback (lo)` i rozpocznij nasłuchiwanie.
5. Wprowadź filtr:
   ```
   http
   ```
6. Zidentyfikuj pakiet z żądaniem `POST`, zawierający dane logowania.
7. W panelu dolnym sprawdź, że dane są przesyłane **jawnym tekstem** – bez szyfrowania.

---

### 🛡️ Wersja zabezpieczona – `https://localhost:8443/secure`

1. W przeglądarce przejdź na `https://localhost:8443/secure`.
2. Wprowadź dane logowania w formularzu.
3. W Wiresharku ustaw filtr:
   ```
   tcp.port == 8443
   ```
4. Rozpocznij nasłuch na interfejsie `Loopback`.
5. Po wysłaniu formularza sprawdź, że przesyłane dane są **niewidoczne** – sesja jest szyfrowana (TLSv1.3, Client Hello).

---

## 🛡️ Zalecenia bezpieczeństwa

- Wymusić HTTPS w całej aplikacji (przekierowanie z HTTP).
- Użyć certyfikatu SSL (Let's Encrypt lub self-signed).
- Wyłączyć dostęp do wersji HTTP w środowisku produkcyjnym.

---

## 🎯 Cel projektu

Celem projektu jest ukazanie zagrożeń wynikających z błędnej konfiguracji transmisji danych w aplikacji webowej, w szczególności braku szyfrowania, co może skutkować przejęciem danych logowania przez osobę podsłuchującą ruch.

---

## 👨‍🎓 Autor

Bartłomiej Filipski
