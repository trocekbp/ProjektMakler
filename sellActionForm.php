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
<section>
<header>Sprzedaż</header>
<nav>
   <?php
   require("menu.php");
   ?>
</nav>
<article>
<?php 
$idUz=$_GET["idUz"];
$idSpl=$_GET["idSpl"];
$idTr=$_GET["idTr"];

$nazwa=$_GET["nazwaS"];
$obrazek=$_GET["obrazek"];
$ilosc=$_GET["ilosc"];
$wartoscK=$_GET["wartoscK"];
$kurs=$_GET["cenaAkcji"];

//ilosc zysku
$zysk = ($kurs-$wartoscK)*$ilosc;


echo"<table><tr>
<th>Nazwa</th> 
<th>Logo</th>
<th>Ilość Akcji</th>
<th>Kurs w chwili kupna</th>
<th>Obecny kurs</th>
<th>Zysk</th>
</tr>"; //5
     echo"<tr>";
     echo"<td>$nazwa</td>";
     echo"<td><img class=small-image src='$obrazek'></td>";
     echo"<td>$ilosc</td>";
     echo"<td>$wartoscK</td>";
     echo"<td>$kurs</td>";
     echo"<td>$zysk</td>";
     echo"</tr>";
echo"</table>";
     echo"
     <form action='sellAction.php' method='post'>
     <input type='hidden' name='idUz' value='$idUz'>
     <input type='hidden' name='idSpl' value='$idSpl'>
     <input type='hidden' name='idTr' value='$idTr'>
     <input type='hidden' name='kurs' value='$kurs'>
     <input type='hidden' name='iloscTr' value='$ilosc'>
     <p style='color:lime'>Ilość akcji:<input type='number' min='1' max=$ilosc name='iloscSell'>*$kurs</p>
     <p><button type='submit'>Zatwierdź</button></p>
     </form>";
?>

</article> 
</section>
<script src="scriptSell.js"></script>
</body>
</html>