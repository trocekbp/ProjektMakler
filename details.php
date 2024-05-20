<?php
 require("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css" />
    <title>Details</title>
    <script src="jquery-3.6.4.min.js"></script>
    <script src="script.js"></script>
</head>
<body>
<nav>
   <?php
   require("menu.php");
   ?>
</nav>
<style>
        #buyDiv {
            display: none; /* Początkowo ukryty */
        }
        #changeDiv {
            display: none; /* Początkowo ukryty */
        }
    </style>
<header>Szczegóły spółki</header>
<article>
<?php 
$id = $_GET["id"];
/* W ramach jednego połączenia możemy realizować wiele zapytań. Pierwszym niech
będzie policzenie średniej ocen dla danego dzbana. Wyliczoną wartość przechowujemy
w pomocniczej zmiennej.
*/
$sql = "SELECT AVG(ocena) AS srednia FROM recenzje WHERE idSpolki=$id";
$result = $conn->query($sql);
$srednia = $result->fetch_object()->srednia;
//$obrazek = $result->fetch_object()->obrazek;
/*) Kolejne zapytanie to wybranie informacji o danym dzbanie i jego kategorii. W tym celu
w zapytaniu wykorzystamy złączenie tabel za pomocą klauzuli WHERE na podstawie
klucza obcego. Dodatkowo wykorzystamy aliasy dla nazw tabel i kolumn. Poprzedzanie
kolumn nazwą tabeli (lub jej aliasem dla skrócenia zapisu) jest niezbędne, ponieważ
w złączonych tabelach pojawiają się kolumny o tych samych nazwach (id, nazwa, opis). */
$sql = "SELECT 
                    s.idkategorii, 
                    k.nazwa AS nazwaKat,
                    s.nazwa,
                    s.obrazek,
                    s.opis,
                    s.iloscAkcji,
                    s.cenaAkcji,
                    s.idAdres,
                    a.kraj,
                    a.miasto,
                    a.adres
        FROM 
            spolki s
        JOIN 
            kategorie k ON s.idkategorii = k.id
        JOIN 
            adresy a ON s.idAdres = a.idAdres
        WHERE 
            s.id = $id
        ";
echo "<h3>Sszczegóły spółki akcyjnej:</h3>";
$result = $conn->query($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_object()) {
        echo "<p>Nazwa: {$row->nazwa} </p>";
        echo "<img src='{$row->obrazek}'>";
        echo "<p>Kategoria: <a href'index.php?idkat={$row->idkategorii}'>{$row->nazwaKat}</a></p>";
        echo "<p>Opis: {$row->opis}</p>";
        echo "<p>Ilosść Akcji: {$row->iloscAkcji}</p>";
        echo "<p>Kurs: {$row->cenaAkcji} zł</p>";
        echo "<p>Siedziba: kraj - {$row->kraj}, miasto -  {$row->miasto}, adres - {$row->adres}</p>";
        echo "<div class='topBot'><p>Aktualizacje kursów:</p>";
        $cenaAkcji = $row->cenaAkcji;
        $iloscAkcji = $row->iloscAkcji;
    }
}
 else {
    echo "Brak podanego rekordu";
}
        

        //tabela z historią kursów
        $sql = "SELECT data, cena FROM kursy k WHERE k.idSpolki = $id";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            echo "<table>";
                        echo "<tr><th>Data</th><th>Wartość</th></tr>";
                    while($row = $result->fetch_object()) {
                        echo "<tr><td>{$row->data}</td><td>{$row->cena}</td></tr>";
                }
            echo"</table>";
        }
        echo "<br></div>";
//zakup akcj
//ilosc mozliwych do kupienia akcji ograniczamy za pomocą  min="" i max=""
        echo"<div class='topBot'>";
        if($iloscAkcji>0){
        echo "<a id='buyButton' class='super'><h3>Zakup akcje</h3></a>";
        }
        echo "<div id='buyDiv'>
        <form action='buyAction.php' method='post'>
        <input type='hidden' name='id' value='$id'>
        <input type='hidden' name='cenaAkcji' value='$cenaAkcji'>
        <input type='hidden' name='ilosc' value='$iloscAkcji'>

        <p>Ilość akcji: <input type='number' min='1' max='$iloscAkcji' name='iloscK'></p>

        <p><button type='submit'>Zatwierdź</button></p>
        </form>
        </div>";
        echo"</div>";
        $rola = $_SESSION["rola"];
        if($rola == 'admin'){
        
//zmiana kursów
        echo "<p><a class='super' id='changeButton'>Zmień kurs</a></p>";
        echo "<div id='changeDiv'>
        <form action='Kurs.php' method='post'>
        <input type='hidden' name='id' value='$id'>
        <p>Nowy kurs: <input type='number' name='newKurs' value='$cenaAkcji' step='0.001'></p>
        <p><button type='submit'>Zatwierdź</button></p>
        </form>
        </div>";
        echo "<p><a class='super' href='dezActiv.php?id=$id'>Dezaktywuj spółkę</a></p>";
        }
//ulubione
    echo "<div class='topBot'>";
    echo"<h3>Dodaj do ulubionych:</h3>";
         $idUzytkownika = $_SESSION["id"];
         $sql = "SELECT id FROM ulubione WHERE idSpolki = $id AND idUzytkownika = $idUzytkownika";
         $added = $conn->query($sql)->num_rows > 0;
         $text = $added ? "img/dislike1.png" : "img/like1.png";
         echo "<img style=width:70px;border-color:blue;border:5px; src=$text class='fav' data-spolka='$id'>";
    echo "</div>";
?><div class="topBot">
<h3>Dodaj recenzję do spółki</h3>
<form action="insertReviev.php" method="post"></p>
<p><input type="hidden" name='id' value="<?php echo $_GET["id"] ?>" > </input> </p>
<p>Ocena: <select name="ocena" id="">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
</select></p>
<p><textarea name="tresc" id="" cols="30" rows="2"></textarea></p>
<button type="submit">Wyślij!</button>
</form>
    </div>
    <div class="topBot">
<?php 
echo"<h3>Recenzje użytkowników:</h3>";
echo "<p>Średnia ocen - $srednia</p>";
$sql = "SELECT nick,ocena,tresc,data FROM recenzje WHERE idSpolki=$id";
$result = $conn->query($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_object()) {
echo"Nick: $row->nick  <br>";
echo"Ocena: $row->ocena <br>";
echo"Tresc: $row->tresc <br>";
echo"Data: $row->data <br>";
echo"<br>";

    }};
    if($result->num_rows == 0){
        echo"Brak recenzji";
    }
        $conn->close();
?>
<br><br>

<a class="d" href="index.php">Powrót</a>
</article>
 <?php
//sprawdzanie błędów
if(isset($_GET["error"])){
    $error=$_GET["error"];
        if($error==1){
            echo"<script>alert('Nie masz wystarczających środków na koncie !');</script>";
        }
}
?>
<?php 
include("footer.php");
?>
<script src="scriptBuy.js"></script>

</body>
</html>