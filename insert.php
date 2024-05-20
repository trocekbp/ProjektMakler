
 <?php
 $nazwa = $_POST["nazwa"];
 $opis = $_POST["opis"];
 $iloscAkcji = $_POST["iloscAkcji"];
 $cenaAkcji = $_POST["cenaAkcji"];
 $idkategorii = $_POST["idkategorii"];
 $obrazek = basename($_FILES["obrazek"]["name"]);
 $kraj = $_POST["kraj"];
 $miasto = $_POST["miasto"];
 $adres = $_POST["adres"];
 $nip = $_POST["nip"];
 move_uploaded_file($_FILES["obrazek"]["tmp_name"],"img/".$obrazek);  //podwojne img

 if($obrazek == null){
    $obrazek = 'deafult.png';
 }
 require("db.php");
//  1 wstawiamy adres
 $sql = "INSERT INTO adresy (kraj, miasto, adres) VALUES ('$kraj', '$miasto', '$adres')";
 $result = $conn->query($sql);
//  2 pobieramy id nazsego adresu
 $sql = "SELECT idAdres FROM adresy WHERE kraj = '$kraj' AND miasto = '$miasto' AND adres = '$adres'";
 $result = $conn->query($sql);
   if($result->num_rows>0){
      $row = $result->fetch_object();
      $idAdresValue = $row->idAdres;
      }  



 $sql = "INSERT INTO spolki (nazwa, opis, iloscAkcji, cenaAkcji, idkategorii, obrazek, nip, idAdres) VALUES
  ('$nazwa','$opis', $iloscAkcji, $cenaAkcji, $idkategorii, 'img/$obrazek', '$nip', $idAdresValue)";
 $result = $conn->query($sql);
 $conn->close();
 header("location: index.php");
?>

