<?php
include("session.php");
require("db.php");

$idSpl = $_POST["id"];
$idUz = $_SESSION["id"];
$portfel = $_SESSION["portfel"];
//ile akcji chce kupic
$iloscKupna = $_POST["iloscK"];
$ilosc = $_POST["ilosc"];
// ile akcji jeszcze zostalo

//jaka jest cena jednej akcji
$kurs = $_POST["cenaAkcji"];

(float)$sumaTranz = $iloscKupna*$kurs;
//warunek sprawdzający czy uz stać na zakup
if($sumaTranz>$portfel){
    header("location: details.php?id=$idSpl&error=1");
    exit; // Dodajemy exit, aby zakończyć wykonywanie kodu w tym punkcie
    //tu podajemy błąd
}else{
    //cała logika tworzenia transakcji
$sumaTranz = $iloscKupna*$kurs;
$zysk = $sumaTranz * 0.02;
$podatek = $zysk * 0.19;






$sql = "INSERT INTO transakcje (idSpolki, idUzytkownika, typ, ilosc, kurs, zysk_2proc, podatek_19proc) VALUES ('$idSpl', '$idUz', 'k', '$iloscKupna', '$kurs', '$zysk', '$podatek')";
$result = $conn->query($sql);







//cała logika dodawania akcji to konta użytkownika
// //szukamy czy już była podobna transakcja i wykorzystamy ją żeby nie tworzyć nowej i nie zaśmiecać bazy danych
$sql = "SELECT * FROM akcjeuz WHERE idSpolki = $idSpl AND idUzytkownika = $idUz";
$result = $conn->query($sql);
if ($result->num_rows > 0){
    while($row = $result->fetch_object()){ //zrobiłem porównanie obiektów sql ponieważ inaczej były generowane błędy
    $wartosc=$row->kurs;
    if($wartosc==$kurs){
        $success = 1; //ważna zmienna
        $idAkcUz = $row->id;    //id Akcje Uzytkownika
        $iloscTr = $row->ilosc;
        $newIloscTr = $iloscKupna+$iloscTr;
        $sql1 = "UPDATE akcjeuz SET ilosc=$newIloscTr WHERE id=$idAkcUz";
        $result1 = $conn->query($sql1);
        }
    }
    if($success!==1){
            //utworzenie transakcji kupna
         $sql = "INSERT INTO akcjeuz (idSpolki,idUzytkownika,ilosc,kurs) VALUES ('$idSpl','$idUz','$iloscKupna','$kurs')";
         $result = $conn->query($sql);
    }
} else{
    $sql = "INSERT INTO akcjeuz (idSpolki,idUzytkownika,ilosc,kurs) VALUES ('$idSpl','$idUz','$iloscKupna','$kurs')";
    $result = $conn->query($sql);
}

//ustawienie licznika ilosci akcji spolki
    $nowaIlosc =  $ilosc-$iloscKupna;

    $sql = "UPDATE spolki SET iloscAkcji = '$nowaIlosc' WHERE id=$idSpl";
    $result = $conn->query($sql);
   


//odjęcie z portfela uzytkownika
    $nowyStan = $portfel-$sumaTranz;
    $sql = "UPDATE uzytkownicy SET portfel = '$nowyStan' WHERE id=$idUz";
    $result = $conn->query($sql);
    $_SESSION["portfel"] = $nowyStan; //ponieważ korzystamy z sesji do pobierania i wyświetlania wartości portfela
     $conn->close();
header("location: details.php?id=$idSpl&error=0");
}
?>