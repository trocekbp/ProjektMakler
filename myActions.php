<?php
 require("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyActions</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
<nav>
<?php
 require("menu.php");
?>
</nav>
<header>Moje Akcje</header>
<article>
<?php 
$idUz=$_SESSION["id"];
$sql = "SELECT z.id, z.idSpolki AS idSpolki, z.ilosc, z.kurs, s.cenaAkcji, s.nazwa, s.obrazek FROM akcjeuz z, spolki s WHERE z.idUzytkownika=$idUz AND s.id=z.idSpolki AND z.ilosc > 0";
$result = $conn->query($sql);

echo"<table><tr>
<th>Nazwa</th> 
<th>Logo</th>
<th>Ilość Akcji</th>
<th>Kurs w chwili kupna</th>
<th>Obecny kurs</th>
</tr>"; //5
if($result->num_rows>0){
 while($row = $result->fetch_object()){
//potrzebne zmienne:
$kupno=$row->kurs;
$obecny=$row->cenaAkcji;

     echo"<tr>";
     echo"<td>$row->nazwa</td>";
     echo"<td><img class=small-image src='$row->obrazek'></td>";
     echo"<td>$row->ilosc</td>";

     //algorytm  podświetlania kursu
    if($kupno == $obecny){
        //bez strat
        echo"<td>$kupno</td>";
    }elseif($kupno>$obecny){
        //STRATY
        echo"<td><div class='nieWarto'>$kupno</div></td>";
    }elseif($kupno<$obecny){
        //SPRZEDAWAJ WILKU
        echo"<td><div class='warto'>$kupno</div></td>";
    }
     echo"<td>$obecny</td>";
     echo"<td><a href='sellActionForm.php?idUz=$idUz
     &idSpl=$row->idSpolki
     &idTr=$row->id
     &nazwaS=$row->nazwa
     &obrazek=$row->obrazek
     &ilosc=$row->ilosc
     &kursK=$row->kurs
     &cenaAkcji=$row->cenaAkcji'
      class='sell'>SprzedajAkcje</a></td>";
     echo"</tr>";
 }
 echo"</table>";
}else{
 echo"</table>";
 echo"<p>Brak zakupionych akcji</p>";
}
?>
<?php
//sprawdzanie błędów
if(isset($_GET["success"])){
    $success=$_GET["success"];
        if($success==1){
            echo"<script>alert('Pomyślnie sprzedano towoje akcje !');</script>";
        }else if($success==0){
         echo"<script>alert('Coś poszło nie tak :(');</script>";
     }
}
?>
</article> 
<?php 
include("footer.php");
?>
<script src="scriptSell.js"></script>
</body>
</html>