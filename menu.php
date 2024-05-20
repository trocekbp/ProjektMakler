<?php
 include("session.php");
 require("db.php");
 $rola = $_SESSION["rola"];
 $portfel = $_SESSION["portfel"];
?>
<!-- <header style="font-size: medium; font-weight: 400; height: 100%;"> -->
<div class = "menu">
<h2>Witaj <?= $_SESSION["login"] ?>!</h2>

    <ul>
    <?php 
    if($rola == 'admin'){
        echo "<li><a class='menu' href='report.php?view=all'>Raport</a></li>";
        echo "<li><a class='menu' href='insertForm.php'>Dodaj spolke</a></li>";
        echo "<li><a class='menu' href='insertKatForm.php'>Dodaj kategorie</a></li>";
        echo "<li><a class='menu' href='spolkiDezActiv.php'>Nieaktywne spółki</a></li>";
        echo "<li><a class='menu' href='zgloszenia.php'>Zgłoszenia Użytkowników</a></li>";
        
        }
        if($rola == 'user'){
            echo "<p class='konto'>Stan konta: $portfel</p>";
            echo "<li><a class='menu' href='addMoneyForm.php'>Doładuj portfel</a></li>";
            echo "<li><a class='menu' href='myActions.php'>Moje Akcje</a></li>";
            echo "<li><a class='menu' href='favourites.php'>Ulubione</a></li>";
            echo "<li><a class='menu' href='myReviews.php'>Moje recenzje</a></li>";
            echo "<li><a class='menu' href='zgloszeniaForm.php'>Zgłoś<a><li>";           
            
            }
    ?>
    <li><br></li>
        <li><a class="menu" href="index.php">Strona główna</a></li>
        <li><a class="menu" style="font-family: Georgia, 'Times New Roman', Times, serif;font-weight:bolder;" href="logout.php">Wyloguj</a></li>
    
    </ul>
</div>
<!-- </header> -->