<?php 
require("db.php");

$success = $_GET["success"];
$idTr = $_GET["idTr"];

$sql = "SELECT ilosc FROM transakcje WHERE id=$idTr";
$result = $conn->query($sql);
if ($result !== false) {
    $row = $result->fetch_object();
    $ilosc = $row->ilosc;
    if($ilosc==0){
    $sql = "DELETE FROM transakcje WHERE id=$idTr";
    $result = $conn->query($sql);
    }
}
header("Location: myActions.php?success=1");
?>