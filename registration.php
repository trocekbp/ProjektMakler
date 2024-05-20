
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="stylesLogin.css">
</head>
<body>
    <header>Rejestracja</header>
    <?php
 require("db.php");
 if (isset($_POST["login"])) {
 $login = $_POST["login"];
 $haslo = $_POST["haslo"];
 $email = $_POST["email"];
 $pesel = $_POST["pesel"];
 $dataUrodzenia = $_POST["birthdate"];
 $plec = isset($_POST["gender"]) ? $_POST["gender"] : null;
 $nazwaFirmy = isset($_POST["companyName"]) ? $_POST["companyName"] : '';
 $nip = isset($_POST["nip"]) ? $_POST["nip"] : null;
 $kraj = $_POST["country"];
 $miasto = $_POST["city"];
 $adres = $_POST["address"];
 
 //sprawdzamy czy ktoś ze spółki przpyakiem się nie rejestruje, zrobimy to po nipie i adresie
$sql = "SELECT 
                spolki.nip,
                adresy.kraj,
                adresy.miasto,
                adresy.adres
            FROM 
                spolki
            JOIN 
                adresy ON spolki.idAdres = adresy.idAdres;
        ";
$result = $conn->query($sql);
    if($result->num_rows>0){
        while($row = $result->fetch_object()){
                if(($row->kraj == "$kraj" AND $row->miasto == "$miasto" AND $row->adres == "$adres") OR $row->nip == "$nip"){
                    header("Location: login.php?error=1"); //jak jest spolka o tym samym adresie lub ktos podaje ten sam nip to mamy error
                }
            }
    }

    require("insertAdres.php"); //wstawiamy adres i pobieramy jego id
    //$idAdresValue = $row->idAdres;

 $sql = "INSERT INTO uzytkownicy (login, haslo, email, dataUrodzenia, pesel, plec, nazwaFirmy, nip, idAdres) VALUES ('$login', '" . md5($haslo) .
"', '$email', '$pesel', '$dataUrodzenia', '$plec', '$nazwaFirmy', '$nip', $idAdresValue)";

 $result = $conn->query($sql);
 if ($result) {
        echo "<div class='form'>
        <h3>Zostałeś pomyślnie zarejestrowany.</h3><br/>
        <p class='link'>Kliknij tutaj, aby się <a href='login.php'>zalogować</a></p>
        </div>";
        } else {
        echo "<div class='form'>
        <h3>Nie wypełniłeś wymaganych pól.</h3><br/>
        <p class='link'>Kliknij tutaj, aby ponowić próbę <a
        href='registration.php'>rejestracji</a>.</p>
        </div>";
  }
 } 
    else {
?>
 <form class="form" action="" method="post">
 <h1 class="login-title">Rejestracja</h1>
 <input type="text" class="login-input" name="login" placeholder="Login" required/>
 <input type="password" class="login-input" name="haslo" placeholder="Hasło"
required/>
 <input type="text" class="login-input" name="email" placeholder="Adres
email"required/>
<input type="text" class="login-input" name="email" placeholder="Adres
email"required/>
<input type="date" class="login-input" name="birthdate" placeholder="Data urodzenia" required/>

<input type="text" class="login-input" name="pesel" placeholder="Numer PESEL" required pattern="[0-9]{11}" maxlength="11" title="Numer PESEL składa się z 11 cyfr"/>
<p style="color: lightgray">Płeć:</p>
<p style="color: lightgray">
<label><input type="radio" name="gender" value="female" required>Kobieta</label>
<label><input type="radio" name="gender" value="male" required >Mężczyzna</label>
<label><input type="radio" name="gender" value="other"required >Inne</label>
</p>
<input type="text" class="login-input" name="country" placeholder="Kraj" required/>
<input type="text" class="login-input" name="city" placeholder="Miasto" required/>
<input type="text" class="login-input" name="address" placeholder="Adres" required/>

<input type="text" class="login-input" name="companyName" placeholder="Nazwa firmy(oponcjonalnie)"/>
<input type="text" class="login-input" name="nip" placeholder="NIP(oponcjonalnie)" pattern="[A-Za-z]{0,3}[0-9]{0,10}" title="NIP może zawierać do 3 liter i maksymalnie 10 cyfr" maxlength="13"/>



 <input type="submit" name="submit" value="Zarejestruj się" class="login-button">
 <p class="link"><a href="login.php">Zaloguj się</a></p>
 </form>
<?php
 }
?>

</body>
</html>