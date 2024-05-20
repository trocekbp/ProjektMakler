<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>Dodawanie kategorii</header>
    <article>
    <h3>Wprowadź nazwę nowej kategorii</h3>
        <form action='insertKat.php' method='post' enctype='multipart/form-data'>
            <p>Nazwa:<input type='text' name='nazwa' placeholder='nazwa' id='' value=''></p>
            <p>Opis:<input type='text' name='opis' placeholder='opis' id='' value=''></p>
            <p><button type="submit">Wyślij!</button></p>
        </form>
    <a href="index.php">Powrót</a>
    </article>
</body>
</html>