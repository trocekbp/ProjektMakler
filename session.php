<!-- Do projektu dodaj plik session.php, w którym rozpoczynamy sesję i sprawdzamy, czy w super
globalnej tablicy asocjacyjnej $_SESSION istnieje wpis o nazwie login. Jeżeli nie, oznacza to,
że aktualny użytkownik nie jest zalogowany. W takim przypadku dodajemy przekierowanie
do skryptu z logowaniem. Login do sesji dodamy dopiero po poprawnym zalogowaniu się
użytkownika.
Funkcja session_start() tworzy nową sesję albo wznawia istniejącą na podstawie
identyfikatora sesji przekazywanego między klientem a serwerem, w naszym przypadku,
poprzez mechanizm ciasteczek.
Konstrukcja exit powoduje zakończenie interpretowania skryptu i zwrócenie wyniku do
serwera WWW. Konstrukcję tą możemy również wywołać jak funkcję i przekazać komunikat,
który ma być dodany do odpowiedzi. Konstrukcja exit jest równoważna konstrukcji die
(osobiście preferuję exit, bo polecenie „umrzyj” tak średnio przypadło mi do gustu ). -->
<?php
 session_start();
 if (!isset($_SESSION["login"])) {
 header("Location: login.php");
 exit;
 }
?>
<!-- id sesji jest zapisane po stronie klienta
dane sesji gdzie są przechowywane po stronie klienta
-->
