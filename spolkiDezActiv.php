<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favourites</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>Nieaktywne spółki</header>
<nav><?php 
require("menu.php"); 
?></nav>
<article style="min-height: 600px; height:fit-content";>
    <?php
           $sql = "SELECT s.id, s.nazwa, s.obrazek, s.cenaAkcji FROM spolki s WHERE aktywny = 0";
           $result = $conn->query($sql);
            if($result->num_rows > 0){
           echo"<br>";
            echo"<table>";
                echo"<tr><th>Nazwa</th>
                <th>obraz</th>
                <th><p>Ostatni zapisany</p>
                <p>kurs</p></th>
                <th></th></tr>";
            while($row = $result->fetch_object()){
            /* generujemy zapytanie */
                echo"<tr><td>$row->nazwa</td><td><img src='{$row->obrazek}'></img></td><td>{$row->cenaAkcji}</td><td><a class='super' href='active.php?id=$row->id'>Aktywuj</a></td></tr>";
            }
            echo"</table>";
        }else{
            echo"<p>Brak nieaktywnych spółek</p>";
        }
    ?>
</article>
    
</body>
</html>