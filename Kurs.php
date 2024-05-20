<?php
include("session.php");
require("db.php");

 $id = $_POST["id"];
 $newKurs = $_POST["newKurs"];

 //pobranie starego kursu
 $sql = "SELECT cenaAkcji FROM spolki WHERE id = $id";
 $result = $conn->query($sql);
 if($result->num_rows > 0){
        $row = $result->fetch_object();
        $oldKurs = $row->cenaAkcji;
}else{
    echo "Brak wyników dla zapytania.";
}

 //zapisanie starego kursu

 $sql = "INSERT INTO kursy (idSpolki, cena) VALUES ('$id','$oldKurs')";
 $result = $conn->query($sql);
 

//aktualizacja kursu
 $sql = "UPDATE spolki SET cenaAkcji = $newKurs WHERE id = $id";
 $result = $conn->query($sql);
 $conn->close();

 //przekierowanie
 header("location: details.php?id=$id");
?>