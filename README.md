# 🛡️ LFI Example – OWASP A01:2021 – Broken Access Control (Symfony)

Ten projekt demonstruje podatność **Local File Inclusion (LFI)** w aplikacji Symfony jako przykład podatności z kategorii **A01:2021 – Broken Access Control**. Zawiera dwie wersje aplikacji:
- `lfi-vulnerable`: wersja podatna
- `lfi-secure`: wersja bezpieczna


## 🐳 Uruchomienie aplikacji

Aby uruchomić obie wersje aplikacji w środowisku Docker:

```bash
git clone https://github.com/Bartufil1/Praca-Magisterska-Symfony.git
cd Praca-Magisterska-Symfony
docker compose up --build
```

Po uruchomieniu, aplikacje będą dostępne pod następującymi adresami:

- 📂 **Wersja podatna**: [http://localhost:8000/lfi?file=../test.txt](http://localhost:8000/lfi?file=../test.txt)
- 🔒 **Wersja bezpieczna**: [http://localhost:8000/lfi-secure?file=../test.txt](http://localhost:8000/lfi-secure?file=../test.txt)

## 🧪 Testowanie podatności

Po uruchomieniu aplikacji:

### 🔍 1. Test podstawowy (poprawny plik)

Wejdź w przeglądarce na adres:
```
http://localhost:8000/lfi?file=test.txt
```
Jeśli plik `test.txt` znajduje się w katalogu `/files`, jego zawartość zostanie wyświetlona. Tego typu operacja jest dozwolona i symuluje dostęp do dozwolonych danych.

### ❌ 2. Atak LFI – próba obejścia ścieżki

Spróbuj wykonać żądanie z sekwencją `../`:
```
http://localhost:8000/lfi?file=../../../.env
```

Jeśli aplikacja jest **podatna**, serwer zwróci zawartość pliku `.env`, co jest niebezpieczne – atakujący może odczytać hasła, klucze API itp.

W **wersji bezpiecznej** to samo żądanie:
```
http://localhost:8000/lfi-secure?file=../../../.env
```
zostanie zablokowane – otrzymasz komunikat `File not found or invalid`.

### 🔁 3. Testowanie z Postmanem lub curl

Możesz również testować aplikację wysyłając żądania `GET`:

#### Postman
- Metoda: `GET`
- URL: `http://localhost:8000/lfi?file=../../../.env`
- Sprawdź odpowiedź serwera

#### curl
```bash
curl "http://localhost:8000/lfi?file=../../../.env"
```

---

## ✅ Zabezpieczenia zastosowane w wersji bezpiecznej

- Ograniczenie ścieżki tylko do katalogu `/files`
- Blokowanie sekwencji `../`
- Sprawdzenie poprawności nazwy pliku

---

## ℹ️ Informacje dodatkowe

Ta demonstracja jest częścią pracy magisterskiej opartej na OWASP TOP 10 w Symfony. 

---

🧑‍🎓 Autor: Bartłomiej Filipski  
👉 https://github.com/Bartufil1
