# 🧨 XSS Example – OWASP A03:2021 – Cross-Site Scripting

Ten projekt demonstruje podatność typu **XSS (Cross-Site Scripting)** w Symfony, która umożliwia atakującemu wykonanie złośliwego kodu JavaScript po stronie przeglądarki użytkownika.

---

## 📂 Zawartość projektu

- Symfony 6/7 + Docker
- Dwa widoki:
  - 🔴 `/message-unsecure` – wersja podatna
  - ✅ `/message-secure` – wersja zabezpieczona

---

## 🐳 Uruchomienie aplikacji w Dockerze

1. Przejdź do katalogu projektu:

```bash
cd Praca-Magisterska-Symfony-A03-XSS-example
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

## 🧪 Testowanie XSS

### 🔴 Wersja podatna – `message-unsecure`

1. Otwórz w przeglądarce:
```
http://localhost:8000/message-unsecure
```

2. W polu **Add Comment** wpisz:
```html
<script>alert('Test')</script>
```

3. Kliknij przycisk **Add a comment**.

✅ Jeśli aplikacja jest podatna, zobaczysz alert JavaScript – oznacza to, że aplikacja **renderuje dane użytkownika bez filtrowania lub encji HTML** (`|raw` w Twig).

---

### ✅ Wersja zabezpieczona – `message-secure`

1. Otwórz:
```
http://localhost:8000/message-secure
```

2. Wprowadź ponownie:
```html
<script>alert('Test')</script>
```

3. Kliknij **Add a comment**.

🚫 Zamiast alertu, zobaczysz nieszkodliwy tekst – kod nie zostanie wykonany.  
To oznacza, że aplikacja poprawnie filtruje dane użytkownika, np. przez:

- brak użycia `|raw` w Twig,
- użycie `htmlspecialchars`,
- zastosowanie Symfony HTML Sanitizer (opcjonalnie).

---

## 🎯 Cel projektu

Pokazanie jak łatwo zainfekować aplikację klienta poprzez niebezpieczne wyświetlanie danych wejściowych.  
XSS może prowadzić do:
- kradzieży sesji,
- przekierowań,
- wstrzykiwania keyloggerów,
- ataków phishingowych.

---

## 👨‍🎓 Autor

Barttłomiej Filipski
