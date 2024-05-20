<?php
$id = $_GET["id"];
require("db.php");

$sql = "UPDATE spolki SET aktywny = 0 WHERE id = $id";
$conn->query($sql);

header("location: index.php");
?>
