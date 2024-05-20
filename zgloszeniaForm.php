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
<header>Zgłoszenia</header>
<nav>
   <?php
   require("menu.php");
   ?>
</nav>
<article style="text-align:center">
<h1>Zgłoś problem</h1>
<form action='insertZgloszenie.php' method='post'>
    <p><input style="width: 300px; height: 200px;" type="text" name="tresc" maxlength="200" title="Treść zgłoszenia"></p>
    <p><button type="submit"><a>Zatwierdź</a></button></p>
</form>
    <a class="d" href="index.php">Anuluj</a>
</article>
</section>
</body>
</html>