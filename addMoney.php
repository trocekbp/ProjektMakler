<?php
echo "<script src = 'script.js'></script>";
include("session.php");
require("db.php");

$login = $_SESSION["login"];
$stan = $_SESSION["portfel"];
$wplata = $_POST["kwota"];
$stanNowy = $stan + $wplata;
 // ew można sprawdzić kod blik czy ma 6 znaków

//if (strlen($kod) == 6) {
    $sql = "UPDATE uzytkownicy SET portfel = '$stanNowy' WHERE login = '$login'";
    $result = $conn->query($sql);
    if ($conn->query($sql) === TRUE) {
        $_SESSION["portfel"] = $stanNowy;
        echo '<script>
        var blikInput = document.getElementById("blik");
        blikInput.value="";
        </script>';
        header("Location: addMoneyForm.php?success=true");
    } else {
        echo '<script>alert("Błąd podczas aktualizacji stanu portfela: ");</script>';
        $conn->error;
    }
//} else {
    //echo '<script>alert("Błędny kod blik - nieodpowiednia ilość znaków");</script>';
  //  header('Location: addMoneyForm.php');
//}
$conn->close();
header("location: index.php");
?>
