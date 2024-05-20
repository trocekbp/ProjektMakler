<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favourites</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>Ulubione</header>
<nav><?php 
require("menu.php"); 
?></nav>
<article>
    <?php
           $idUzytkownika = $_SESSION["id"];
           $sql = "SELECT s.id, s.nazwa, s.obrazek FROM spolki s, ulubione u WHERE u.idSpolki = s.id
           AND idUzytkownika = $idUzytkownika";

           $result = $conn->query($sql);
           echo"<br>";
            echo"<table>";
                echo"<tr><th>Nazwa</th><th>obraz</th></tr>";
            while($row = $result->fetch_object()){
            /* generujemy zapytanie */
                echo"<tr><td><a class='d' href='details.php?id={$row->id}'>$row->nazwa</a></td><td><img src='{$row->obrazek}'></img></td></tr>";
         
            }
            echo"</table>";
            //while($row = $result->fetch_object()) { // dopoki istnieje kolejny rekord , dopóki funkcja fetch_object() będzie zwracała kolejny wiersz z wyniku.
    ?>
</article>
<?php 
include("footer.php");
?>
</body>
</html>