<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favourites</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>Opis aplikacji</header>
    <nav>
    <?php 
    require("menu.php"); 
    ?>
    </nav>
<article style="text-align:center">
    <p style="padding: 20%; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif  ; ">Aplikacja mobliny makler została sotworzona aby ułatwić kupno oraz sprzedaż akcji przeróżnych spółek na giełdzie. Stylistyka wzorowana jest na filmie "The wolf of wallstreet", gdzie na wallstreet komputery posiadały tylko czanre tło i zielone liczby, które zmieniały się w mgnieniu oka. Mobilny makler rozwiązuje trudności ówczesnych czasów świetności wallstreet z filmy, czyli wszelkie faktury na kartkach, transakcje prowadzone przez telefon i wiele innych problemów. Dzięki naszej aplikacji każdy może z łatwością wzbogadzać się na giełdzie.</p>
    <a class="d" href="index.php">Powrót</a>
</article>
<?php 
include("footer.php");
?>
</body>
</html>