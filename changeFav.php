<?php
require("session.php");
 require("db.php");
 $idSpolki = $_REQUEST["idSpolki"];
 $idUzytkownika = $_SESSION["id"];
 $sql = "SELECT id FROM ulubione WHERE idSpolki = $idSpolki AND idUzytkownika = $idUzytkownika";
 $result = $conn->query($sql);;
 if ($result->num_rows == 1) {
 $id = $result->fetch_object()->id;
 $sql = "DELETE FROM ulubione WHERE id = $id";
 } else {
 $sql = "INSERT INTO ulubione (idSpolki,idUzytkownika) VALUES ($idSpolki,
$idUzytkownika)";
 }
 if ($conn->query($sql) !== TRUE) {
 echo "Error: " . $sql . "<br>" . $conn->error;
 } else {
 echo "sukces";
 }
 $conn->close();
?>

<!-- Dodaj do projektu skrypt changeFav.php. Skrypt ten będzie wywoływany poprzez wysłanie
asynchronicznego żądania od klienta (oczywiście może on być wywołany również przez proste
wpisanie jego nazwy i dodanie parametru w pasku adresu – dobry sposób na testowanie).
Skrypt rozpoczynamy załączeniem plików odpowiadających za zainicjalizowanie sesji
i sprawdzenie zalogowania, oraz nawiązanie połączenia z serwerem bazodanowym.
Następnie definiujemy pomocnicze zmienne: identyfikator użytkownika pobieramy z sesji,
identyfikator dzbana pobieramy z super słownika $_REQUEST (dzięki temu jesteśmy niezależni
od metody przesłania tego parametru).
Piszemy zapytanie, które zwróci nam identyfikator polubienia danego dzbana przez danego
użytkownika (o ile on go polubił). Wybieramy sam identyfikator, ponieważ pozostałe informacje
mamy już w postaci zmiennych. Moglibyśmy obejść się bez niego, ale z jego pomocą będzie nam
wygodniej napisać polecenie usuwające informację o polubieniu. Wysyłamy polecenie do
serwera bazodanowego.
3
Sprawdzamy, czy dany użytkownik polubił dany dzban poprzez sprawdzenie liczby wierszy
w rezultacie wykonania polecenia. Jeżeli wiersz z polubieniem istnieje, oznacza to, że użytkownik
chce się z tego polubienia wycofać. W tym przypadku piszemy polecenie usunięcia wyszukanego
polubienia. W przeciwnym razie, do serwera bazodanowego, wysyłamy polecenie wstawienia
informacji o polubieniu. Dzięki takiemu podejściu, do obsługi obu czynności, wystarczy nam
jeden skrypt.
Wysyłamy polecenie, a do generowanej odpowiedzi wstawiamy, albo komunikat o błędzie, albo
komunikat o sukcesie.
 -->
