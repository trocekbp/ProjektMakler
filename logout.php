<!-- . Do projektu dodaj plik logout.php. Do pliku wstaw poniższy skrypt.
DO naszej aplikacji dodajemy mechanizm pozwalający na proste i pewne zakończenie sesji
w momencie wybranym przez użytkownika poprzez obsłużenie funkcji wylogowania. W tym
prostym skrypcie wznawiamy aktualną sesję i ją niszczymy. Zniszczenie sesji spowoduje
usunięcie ciasteczka z identyfikatorem sesji po stronie klienta (poprzez wysłanie w odpowiedzi
do klienta ciasteczka o tej samej nazwie ale z wsteczną datą jego wygaśnięcia). W przypadku
pomyślnego zniszczenia sesji, do odpowiedzi dodajemy nagłówek z przekierowaniem do skryptu
z formularzem logowania. -->
<?php
 session_start();
 if(session_destroy()) {
 header("Location: login.php");
 }
?>