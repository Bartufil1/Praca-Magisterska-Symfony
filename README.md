
# 🛡️ CSRF Example – OWASP A03:2021 – Cross-Site Request Forgery

Ten projekt demonstruje podatność typu **CSRF (Cross-Site Request Forgery)** w Symfony, gdy operacje stanu (POST/PUT/DELETE) nie są chronione tokenem CSRF.

---

## 📂 Zawartość projektu

- Symfony 6/7 z konfiguracją Docker
- Formularz podatny na CSRF
- Plik `example.html` – zewnętrzna strona atakująca (symulacja ataku)

---

## 🐳 Uruchomienie aplikacji w Dockerze

1. Wejdź do katalogu projektu:
```bash
cd Praca-Magisterska-Symfony-A03-CSRF-example
```

2. Uruchom kontenery:
```bash
docker compose up --build
```

3. Aplikacja dostępna będzie pod adresem:
```
http://localhost:8000
```

---

## 🧪 Testowanie podatności CSRF

### 🔴 Wersja podatna

1. Wypełnij formularz w aplikacji Symfony (np. formularz zmiany danych).
2. Otwórz plik `example.html` w przeglądarce jako plik lokalny:
```
file:///C:/ścieżka/do/example.html
```
lub
```
file:///home/user/Praca-Magisterska-Symfony-A03-CSRF-example/example.html
```

3. Zobaczysz, że atakująca strona automatycznie wyśle formularz POST do `http://localhost:8000`.

---

## ✅ Wersja zabezpieczona

Aby uruchomić wersję zabezpieczoną:

1. Otwórz plik `config/packages/security.yaml`.
2. Odkomentuj sekcję `main:` oraz cały blok, który ją zawiera – w tym konfigurację logowania i wylogowania.
3. Zapisz plik.
4. Uruchom ponownie aplikację poleceniem:
```bash
docker compose up --build
```
5. Otwórz plik `example.html` i spróbuj wykonać atak ponownie – powinien pojawić się błąd **Invalid CSRF token**.

Dodatkowo:

- dodaj token CSRF do formularza:
```twig
<input type="hidden" name="_token" value="{{ csrf_token('nazwa_operacji') }}">
```

- zweryfikuj token w kontrolerze:
```php
if (!$csrfTokenManager->isTokenValid(new CsrfToken('nazwa_operacji', $token))) {
    throw new AccessDeniedHttpException();
}
```

---

## 🎯 Cel demonstracji

CSRF wykorzystuje fakt, że przeglądarka automatycznie wysyła ciasteczka (cookies) z każdym żądaniem – nawet jeśli pochodzi ono ze złośliwej strony.  
Dlatego istotne jest zabezpieczenie każdej operacji zmieniającej stan (POST, PUT, DELETE) za pomocą unikalnego tokena CSRF.

---

## 👨‍🎓 Autor

Bartlomiej Filipski
