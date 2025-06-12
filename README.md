# 💥 RCE Example – OWASP A03:2021 – Injection (Remote Code Execution)

Ten projekt demonstruje podatność typu **RCE (Remote Code Execution)** w Symfony, umożliwiającą atakującemu wykonanie dowolnego kodu po stronie serwera – np. przez użycie niebezpiecznych funkcji PHP z danymi użytkownika.

---

## 📂 Zawartość projektu

- Symfony + PHP 8 + Docker
- Przykład wykorzystujący `_fragment` z parametrami prowadzącymi do wykonania polecenia systemowego

---

## 🐳 Uruchomienie aplikacji w Dockerze

1. Uruchom Docker Desktop.
2. Wejdź do folderu projektu:

```bash
cd Praca-Magisterska-Symfony-A03-RCE-example
```

3. Zbuduj i uruchom aplikację:

```bash
docker compose up --build
```

4. Otwórz przeglądarkę i wejdź pod adres:

```
http://localhost:8000/_fragment?_path=_controller%3Dsystem%26command%3Did%26return_value%3Dnull&_hash=...
```

➡️ Jeśli aplikacja jest podatna, powinien pojawić się ekran z wyjątkiem Symfony, informujący, że kontroler zwrócił string (`uid=0(root) gid=0(root) groups=0(root)`) zamiast obiektu `Response`. To oznacza, że doszło do wykonania polecenia systemowego `id`.

---

## 🛡️ Wersja zabezpieczona – zalecenia

Aby zabezpieczyć aplikację:

- W pliku `config/packages/framework.yaml` zakomentuj lub usuń linię:

```yaml
fragments: true
```

- W pliku `.env` zmień `APP_SECRET` na silniejszy i ustaw go jako zmienną środowiskową.
  Przykład:

```dotenv
APP_SECRET=Zm9vYmFyMTIzIV4kQCMj
```

---

## 🎯 Cel demonstracji

Projekt pokazuje, jak niepozorna konfiguracja może prowadzić do poważnych konsekwencji, takich jak zdalne wykonanie polecenia na serwerze. Celem jest uświadomienie, jak ważna jest walidacja danych oraz bezpieczna konfiguracja Symfony.

---

## 👨‍🎓 Autor

Bartłomiej Filispki 
