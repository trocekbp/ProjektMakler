<?php
$id =$_GET["id"];

require("db.php");

$sql = "UPDATE spolki SET aktywny = 1 WHERE id = $id";
$conn->query($sql);

header("location: spolkiDezActiv.php");
//można próbować ajaxem
?>