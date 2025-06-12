# 🐞 Debug Mode Exposure – OWASP A05:2021 – Security Misconfiguration

Ten projekt demonstruje, jak **włączony tryb debugowania** w Symfony może prowadzić do wycieku wrażliwych informacji, takich jak dane logowania, ciasteczka, nagłówki i szczegóły zapytań.

---

## 🧱 Struktura projektu

- Symfony z włączonym trybem `dev`
- Endpoint logowania: `/`
- Dostęp do Symfony Profiler: `/_profiler`
- Dwa warianty:
  - 🔴 Podatny – `APP_ENV=dev`
  - ✅ Zabezpieczony – `APP_ENV=prod`

---

## 🐳 Uruchomienie w Dockerze

1. Otwórz terminal i przejdź do folderu projektu:
```bash
cd Praca-Magisterska-Symfony-A05-DebugMode-example
```

2. Uruchom aplikację:
```bash
docker compose up --build
```

3. Aplikacja dostępna będzie pod adresem:
```
http://localhost:8000
```

---

## 🧪 Testowanie podatności

### 🔓 Wersja podatna (debug on)

1. Otwórz w przeglądarce:
```
http://localhost:8000/
```

2. Zaloguj się:
- Login: `Admin`
- Hasło: `Mitm123`

3. Wejdź w profiler Symfony:
```
http://localhost:8000/_profiler/empty/search/results?limit=10
```

4. Kliknij w odpowiedni request `POST` – zobaczysz:
   - dane logowania w czystym tekście,
   - informacje o sesji i ciasteczkach,
   - szczegóły frameworka i routingu.

---

## ✅ Wersja zabezpieczona (debug off)

1. Zmień środowisko aplikacji:

W pliku `.env` lub `.env.local` ustaw:
```
APP_ENV=prod
```

2. Zrestartuj kontenery:
```bash
docker compose down
docker compose up --build
```

3. Teraz Symfony Profiler nie będzie dostępny – zapytania do `/_profiler` zwrócą `404` lub `Access Denied`.

---

## ❗ Dlaczego to ważne?

Tryb debugowania powinien być **włączony tylko w środowisku deweloperskim**. W środowisku produkcyjnym:

- Ujawnia dane użytkowników i logowania
- Pokazuje pełną ścieżkę stosu błędów
- Może zostać wykorzystany do przygotowania dalszych ataków

---

## 👨‍🎓 Autor

Bartłomiej Filipski
