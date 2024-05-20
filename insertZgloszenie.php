<?php
include("session.php");
require("db.php");

   $id = $_SESSION['id'];
   $tresc = $_POST["tresc"];

$sql = "INSERT INTO zgloszenia (idUzytkownika,tresc) VALUES ('$id','$tresc')";

if ($conn->query($sql) !== TRUE) {
   echo "Error: " . $sql . "<br>" . $conn->$error;
   } else {
   echo "sukces";
   header("location: index.php");
   }
$conn->close();

?>
<!-- dodac alert do js jesli sukces -->