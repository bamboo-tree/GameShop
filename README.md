# Projekt na zaliczenie przedmiotu Programowanie Aplikacji Internetowych - Game Shop

## Podstawowe funkcjonalności

**Użytkownik :**

<<<<<<< HEAD
- Zakładnie konta użytkownika
- Logowanie do systemu
- Dodawanie gier do ulubionych
- Dodawanie gier do koszyka
- Uproszczona wersja składania zamówienia
- Edytowanie zawartości koszyka oraz gier polubionych
=======

- ZARZĄDZANIE PROFILEM UŻYTKOWNIKA
>>>>>>> main

**Administrator**

<<<<<<< HEAD
- Logowanie do systemu
- Panel administratora
- Dodawanie gier
  - nazwa
  - studio
  - rok wydania
  - cena
  - zdjęcie okładki
- Edytowanie informacji o grach (możliwe dla wszystkich wyżej wymienionych kategorii)
- Usuwanie gier
=======

- PANEL ADMINISTRATORA
>>>>>>> main

### Dodatkowe funckcje

**Bezpieczeństwo**

<<<<<<< HEAD
- Blokowanie stron przed osobami o nieodpowiednim statusie
- Automatyczne przekierowania w celu uniknięcia błędów systemu np. strony logowania
- Wyłączenie niektórych funkcji takich jak zapisywanie gier, dla osób niezalogowanych lub administratorów
- Zabezpieczenie przywileju administratora (zmiana statusu tylko bezpośrednio z panelu MySQL)

**Tweaks**

- Strona wstydu dla osób, które próbują wchodzić tam gdzie nie powinny : )
- Statystyki sklepu takie jak ilość kont, osób zalogowanych, dostępnych gier w sklepie

## Uruchomienie na systemie Linux

- Folder z projektem zapisać w `/opt/lampp/htdocs/`
- Włączyć program xampp poleceniem `sudo /opt/lampp/lampp start`
- Zaimportować bazę danych.
  - należy uruchomić przeglądarkę oraz wejść na stronę `http://localhost/phpmyadmin/`
  - następnie wybrać zakładkę import i dodać plik `game_shop.sql` znajdujący się w projekcie
  - przejść przez formularz i upewnić się, że struktura bazy danych jest zachowana
- Włączyć aplikację poprzez link `https://localhost/GameShop/page/test.php`

W celu ułatwienia testowania oraz poruszania się w aplikacji zostały utowrzone 3 konta:

Użytkownik:

- `username = Maciek123` `password = Haslo123`
- `username = Jan123` `password = Haslo123`

Administrator:

- `username = ADMIN` `password = Haslo123`

### Ewentualne problemy

- Zabezpieczenia wyniakające z lokalizacji projektu mogą uniemożliwić zapisywanie miniatur gier. W tym celu należy odnaleźć folder `./images` oraz z terminala wykonać polecenie `sudo chmod 777 games` (nadanie wszelikch uprawnień)
- Odświeżanie strony. Czasami lepiej jest użyć skrótu `CTRL + F5`, w celu odświeżenia strony. Zwykłe `F5` korzysta z pamięci cache z czego mogą wynikać problemy

#### Disclaimer

_Aplikacja była tworzona na systemie operacyjnym `Linux` oraz przeglądarce `Firefox`, monitor `1920x1080 14"`. Nie jestem w stanie zagwarantować takiego samego efektu jaki uzyskałem podczas testowania na własnym urządzeniu. Nie mniej jednak nie wiedzę powodów, dla których coś zaczęłoby zachowywać się w nieoczekiwany sposób._
=======
- zabezpieczenie przed nieatoryzowanym dostępem (nie każdy może wejść na niektóre strony, nawet jeśli wpisze odpowiedni URL)
- statystyki sklepu takie jak ilość kont, osób zalogowanych, dostępnych gier w sklepie

>>>>>>> main
