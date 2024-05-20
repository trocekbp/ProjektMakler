<?php
 $nazwa = $_POST["nazwa"];
 $opis = $_POST["opis"];
 $conn = new mysqli("localhost", "root", "", "maklerdb");
 $sql = "INSERT INTO kategorie (nazwa, opis) VALUES
('$nazwa','$opis')";
 $result = $conn->query($sql);
 $conn->close();
 header("location: index.php");
?>