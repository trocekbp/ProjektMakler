<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zgłoszenia</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <nav>
        <?php 
        require("menu.php");
        ?>
    </nav>
    <section>
    <header>Zgłoszenia!</header>
    <article>
<?php
//include("session.php");
require("db.php");

$nick = $_SESSION["login"];


$sql = "SELECT id,idUzytkownika, tresc, data FROM zgloszenia";
$result=$conn->query($sql);
echo"<table>";
echo"<tr><th>Id</th><th>IdUzytkownika</th><th>Treść</th><th>Data</th></tr>";
while($row = $result->fetch_object()) {
    echo"<tr><td>{$row->id}</td><td>{$row->idUzytkownika}</td><td>{$row->tresc}</td><td>{$row->data}</td></tr>";
   
} 
echo"</table>";
echo"<br>";
echo"<a class='super' href='index.php'>Powrot</a>";
?>
</article>
</section>
</body>
</html>