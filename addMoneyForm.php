<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
<!-- Na samym początku pliku wstaw dołączanie naszych wspólnych skryptów (session.php
i db.php). Z dalszej części kodu usuń nadmiarową w tym momencie instrukcję z otwarciem
połączenia z serwerem bazodanowym.
-->
<section>
<header>Mobilny makler</header>
<nav>
   <?php
   require("menu.php");
   ?>
</nav>
<article style="text-align:center">
<h1>Doładowanie konta</h1>
<form action='addMoney.php' method='post'>
    <p>Wprowadź kwotę: <input type="number" name="kwota" min='10' step="10" required></p>
    <p>Wprowadź kod blik: 
        <input type="tel" name="blik" required  pattern="\d{6}" title="Kod Blik składa się z 6 cyrf" maxlength="6">
    </p>
    <p><button type="submit"><a>Zatwierdź</a></button></p>
</form>
    <a class="d" href="index.php">Anuluj</a>
</article>
</section>
</body>
</html>