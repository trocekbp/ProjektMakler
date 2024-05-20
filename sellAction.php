<?php 
require("db.php");
include("session.php");
//pobieramy daneg
//zmieniamy ilosc akcji w spolce
//zmieniamy ilosc akcji tranzakcji(potrzeba id tranzakcji)
$idUz=$_POST["idUz"];
$idSpl=$_POST["idSpl"];
$idTr=$_POST["idTr"];

$iloscTr=$_POST["iloscTr"];
$iloscSell=$_POST["iloscSell"];
$kurs=$_POST["kurs"];
$stan=$_SESSION["portfel"];
//obliczamy nowy stan portfela
$stanNowy=$stan+($kurs*$iloscSell);
//nowa ilosc w transakcjach
$TrNowa=$iloscTr-$iloscSell;


$zysk = $stanNowy*00.2;
$podatek = $zysk*0.19;


//WAŻNE TRANSAKCJA SPRZEDAŻY 
$sql = "INSERT INTO transakcje (idSpolki, idUzytkownika, typ, ilosc, kurs, zysk_2proc, podatek_19proc) VALUES ('$idSpl', '$idUz', 's', '$iloscTr', '$kurs', '$zysk', '$podatek')";
$result = $conn->query($sql);




//nowa ilosc w spolkach
// $sql = "SELECT iloscAkcji FROM spolki WHERE id=$idSpl";
// $result = $conn->query($sql);

// if ($result !== false) {
//     $row = $result->fetch_object();
//     $iloscSpl = $row->iloscAkcji;
//     $SplNowa = $iloscSpl + $iloscSell; // Poprawka: usunięcie zbędnego znaku ;
    
//     // Tutaj można dalej przetwarzać $SplNowa
    
// } else {
//     header("Location: myActions.php?success=0");
//     exit; // Dodanie exit lub die, aby zakończyć wykonywanie kodu po przekierowaniu
// }



//zmieniamy stan portfela
$sql = "UPDATE uzytkownicy SET portfel=$stanNowy WHERE id=$idUz";
$result = $conn->query($sql);
if ($conn->query($sql) === TRUE) {
    $_SESSION["portfel"] = $stanNowy;
} else {
    header("Location: clearTrans.php?success=0");
    $conn->error;
}

//zmieniamy stan akcji na koncie uzytkownika
$sql = "UPDATE akcjeuz SET ilosc=$TrNowa WHERE id=$idTr";
$result = $conn->query($sql);
if ($conn->query($sql) !== TRUE) {
    header("Location: clearTrans.php?success=0");
    $conn->error;
}

//akcje wracają na spółkę ale to chyba niepotrzebne
// $sql = "UPDATE spolki SET iloscAkcji=$SplNowa WHERE id=$idSpl";
// $result = $conn->query($sql);
// if ($conn->query($sql) !== TRUE) {
//     header("Location: clearTrans.php?success=0");
//     $conn->error;
// }

header("Location: clearTrans.php?success=1&idTr=$idTr");
?>