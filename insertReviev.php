<?php
include("session.php");
require("db.php");

 $id = $_POST["id"];
 $nick = $_SESSION["login"]; //wstawienie nicku Zalogowanego użytkownika
 $ocena = $_POST["ocena"];
 $tresc = $_POST["tresc"];

 $conn = new mysqli("localhost", "root", "", "maklerdb");
 $sql = "INSERT INTO recenzje (idSpolki, nick, ocena, tresc) VALUES ('$id','$nick','$ocena','$tresc')";
 $result = $conn->query($sql);
 $conn->close();
 header('location: details.php?id='.$id);
?>
