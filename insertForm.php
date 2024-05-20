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
    <header>Dodawanie spółki akcyjnej</header>
    <article>
    <h3>Wprowadź dane nowej spółki</h3>
    <form action='insert.php' method='post'  enctype='multipart/form-data'>
        <p>Nazwa:<input type='text' name='nazwa' placeholder='nazwa' id='' value='' required></p>
        <p>Opis:<input type='text' name='opis' placeholder='opis' id='' value='' required></p>
        <p>Ilość akcji:<input type='number' name='iloscAkcji' step="50" placeholder='ilosc Akcji' id='' value='' min='1' required></p>
        <p>Cena akcji: <input type="number" name="cenaAkcji" id="cenaAkcji" step="0.01" placeholder="cena Akcji" value="" min='0.01' required></p>
        <p>Obrazek:<input type='file' name='obrazek'></p>
        <p>Kategoria:<select name='idkategorii'>
            <?php
            $conn = new mysqli("localhost", "root", "", "maklerdb");
            // połączenie z serwerem bazodanowym
            $sql = "SELECT id, nazwa FROM kategorie";
            // zdefiniowanie zapytania SQL
            $result = $conn->query($sql);
            // wysłanie zapytania do serwera bazodanowego
            while($row = $result->fetch_object()) {
            echo "<option value='{$row->id}'>{$row->nazwa}</option>";
            }
            // zamknięcie połączenia z serwerem bazodanowym
            $conn->close();
            ?>
        </select>
        </p>
        <p>Kraj: <input type="text" name="kraj" id="kraj" placeholder="Kraj" required></p>
        <p>Miasto: <input type="text" name="miasto" id="miasto" placeholder="Miasto" required></p>
        <p>Adres: <input type="text" name="adres" id="adres" placeholder="Adres" required></p>
        <p>NIP: <input type="text" class="login-input" name="nip" placeholder="NIP" pattern="[A-Za-z]{0,3}[0-9]{0,10}" title="NIP może zawierać do 3 liter i maksymalnie 10 cyfr" maxlength="13"/></p>

        <p><button type="submit">Wyślij!</button></p>
        </form>
    <a href="index.php">Powrót</a>
    </article>
</body>
</html>
