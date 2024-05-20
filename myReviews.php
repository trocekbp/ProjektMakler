<?php
 require("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recenzje użytkownika</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<nav>
   <?php
   require("menu.php");
   ?>
</nav>
<header>  <p>Recenzje użytkownika <?= $_SESSION["login"] ?>!</p>    </header>
 <article>
 <?php 
 $login = $_SESSION["login"];
 $sql = "SELECT ocena, tresc, data, s.id AS idSpolki, nazwa FROM recenzje r, spolki s
 WHERE s.id = idSpolki AND nick = '$login'"; 
 $result = $conn->query($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_object()) {
    echo"<div>";
        echo"<a href='details.php?id=$row->idSpolki'> $row->nazwa </a> <br>";
        echo"Ocena: $row->ocena <br>";
        echo"Tresc: $row->tresc <br>";
        echo"Data: $row->data <br>";
        echo"<br>";
    echo"</div>";
    }

} else {
    echo "Brak recenzji";
}
$conn->close();
?>
<p><a class="d" href="index.php">Powrót</a></p>
 </article>
<?php 
require("footer.php")
 ?>
</body>
</html>