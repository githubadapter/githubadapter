Projekt Git Adapter nadaj możliwość pobierania krótkich informacji z GitHub o użytkwnikach i repozytoriach.

Przejdź przez kolejne kroki, aby zainstalować aplikacje:

1. Pobierz i zainstaluj:
    * Symfony: https://symfony.com/download
    * Git: https://git-scm.com/book/en/v2/Getting-Started-Installing-Git
 
2. Pobierz projekt:
git clone https://github.com/githubadapter/githubadapter.git

3. Przejdź do katalogu projektu i wykonaj:
composer install

4. Będziesz potrzebowal token API GitHub, żeby korzystać z aplikacji.
Zaloguj się na GitHub i wygeneruj token: https://github.com/settings/tokens
    * Dodaj token do pliku /.env, edytuj parametr GITHUB_API_TOKEN. 
    Bez tego tokenu będziesz miał bardzo ogranuczoną ilość dostępnych zapytań. 
    Więcej szczegółów na https://developer.github.com/v3/#rate-limiting  
    
5. Wykonaj komendę, aby uruchomić web serwer:  
symfony server:start --port=8000

Teraz Twoja aplikacja będzie dostępna pod adresem 127.0.0.1:8000.
Spróbuj otworzyć link
http://127.0.0.1:8000/api/v1.0/repositories/symfony/symfony

W razie pytań skontaktuj się z deweloperem: (tu dodamy rzeczywisty email)

----
Uwagi techniczne:

1. Projekt zrobiony w wersji Symfony 4.4. Korzystamy z bundles: 
    * FOSRestBundle 
    * JMSSerializerBundle 
    * NelmioApiDocBundle

2. Struktura: 
    * service GitHubDataService do komunikacji z GitHub API
    * service GitHubAdapter do potrzeb naszego API
    * controller ApiController, który obsługuje zapytania
    * pomocnicze struktury w /src/Parameters i /src/DTO do walidacji i przekazywania danych
    * komendy do używania w CLI w /src/Command
    
3. Testy end-to-end przygotowane są w Postman i eksportowane do pliku json:
/e2e.postman_collection.json

4. GitHub ma ograniczenia co do ilości zapytań do API (z tokenem 5 tys. na godzinę).
Żeby złagodzić te ograniczenia, musielibyśmy np. zrealizować cachowanie po naszej stronie
z użyciem bazy danych (np. MySQL) lub in-memory (np. Memcached lub Redis).

5. Także potrzebowalibyśmy implementować po naszej stronie rate limits, żeby nie puszczać do GitHub API zapytań więcej, niż on ich akceptuje.
W każdym razie gdy osiągniemy limitu, dostaniemy odpowiedni bład od GitHub i damy o tym znać klientowi (http status 500).

6. Żeby sprawdzić, że aplikacja akceptuje 20 żądań na sekundę, mielibyśmy skorzystać np. z JMeter. Nie zostało to zrealizowane w ramach zadania.

7. W projekcie obecnie brakuje unit testów i jasnej dokumentacji.

8. Więcej informacji na temat przygotowania projektu do wdrażania: https://symfony.com/doc/4.4/deployment.html .
Chciałbym poświęcić trochę więcej czasu kwestiam, wymienionym w artykule, jednak już mamy terminy.
