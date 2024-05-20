<?php 

$sql = "INSERT INTO adresy (kraj, miasto, adres) VALUES ('$kraj', '$miasto', '$adres')";
    $result = $conn->query($sql);
   //  2 pobieramy id nazsego adresu
    $sql = "SELECT idAdres FROM adresy WHERE kraj = '$kraj' AND miasto = '$miasto' AND adres = '$adres'";
    $result = $conn->query($sql);
      if($result->num_rows>0){
         $row = $result->fetch_object();
         $idAdresValue = $row->idAdres;
         } 
?>