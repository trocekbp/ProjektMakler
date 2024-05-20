
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
<!-- Na samym początku pliku wstaw dołączanie naszych wspólnych skryptów (session.php
i db.php). Z dalszej części kodu usuń nadmiarową w tym momencie instrukcję z otwarciem
połączenia z serwerem bazodanowym.
-->
<section>
<header>Witamy na Wall Street !</header>
<nav>
   <?php
   require("menu.php");
   ?>
</nav>
<article>
    <!--sortowanie dzbanow kategoriami-->
    <h2>Sortuj według kategorii:</h1>

<?php
 $sql = "SELECT id, nazwa FROM kategorie";
 $result = $conn->query($sql);
 echo "<a class='kat' href='index.php'>Wszyskie</a>";
 
 while($row = $result->fetch_object()) {
 echo " <a class='kat' href='index.php?idKat={$row->id}'>{$row->nazwa}</a>";
 }
 ?>
 <br>

<?php 
 require("db.php");
 $sql = "SELECT id, nazwa, obrazek, cenaAkcji FROM spolki WHERE aktywny = 1";
      if (isset($_GET["idKat"])) {
      $idKat = $_GET["idKat"];
      $sql .= " AND idkategorii = $idKat" ;
      }
   $result = $conn->query($sql);
 echo"<table>";
    echo"<tr><th>Nazwa</th><th>Logo</th><th>Kurs</th><th>Stan</th></tr>";
if($result->num_rows>0){
   while($row = $result->fetch_object()){
      $idSpl = $row->id; 
      $kurs = $row->cenaAkcji;
      echo"<tr><td><a class='nazwa', href='details.php?id=$idSpl'>$row->nazwa</a></td><td><img class='small-image' src='{$row->obrazek}'></img></td><td>$kurs</td><td style='width:25%'>";


//wyświetlanie zdjęcia      
   //pobieramy wartość ostatniego kursu DESC czyli sortuje od najwcześniejszej daty
   $sql2 = "SELECT cena FROM kursy WHERE idSpolki = $idSpl ORDER BY data DESC";
      $result2 = $conn->query($sql2);
   


   if($result2->num_rows>0){               
      $row = $result2->fetch_object();
      $oldKurs = $row->cena;

      //mechanizm wyświetlania zdjęcia
//pierwszy warunek czy są w miare równe
      if(abs($kurs-$oldKurs)<=0.3){ 
      $img = 'img/equals.png';
   }
         elseif($kurs>$oldKurs){ 
            $img = 'img/up.png';
         }
            elseif($kurs<$oldKurs){ 
               $img = 'img/down.png';
            }
      echo"<img style='width:35%; height:35%' src='$img'></img>";
}
else{
   echo"<img style='width:35%; height:35%' src='img/equals.png'></img>";
}
echo"</td></tr>";
}
}
 else{
    echo"</table>";
    echo"<p>Brak spółek akcyjnych</p>";
 }
echo"</table>";
 //while($row = $result->fetch_object()) { // dopoki istnieje kolejny rekord , dopóki funkcja fetch_object() będzie zwracała kolejny wiersz z wyniku.
?>
</article> 
<?php 
require("footer.php");
?> 
</section>
</body>
</html>