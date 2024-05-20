
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
    <link rel="stylesheet" href="styles.css" />
    <style>
        td {
              padding: 20px 0;
        }
    </style>
</head>
<body>
<section>
<header>Raport</header>
<nav>
   <?php
   require("menu.php");
   ?>
</nav>
<article>
<h2>Wybierz transakcje:</h1>
    <a class="kat" href="report.php?view=all">Wszystkie</a>
    <a class="kat" href="report.php?view=quarter">Kwartał</a>
    <a class="kat" href="report.php?view=month">Miesiąc</a>
    <a class="kat" href="report.php?view=day">Dzień</a>
<?php 
 require("db.php");

    if(isset($_GET["view"])){
        $choice = $_GET["view"];
        switch ($choice){
            case 'day':
                $sql = "SELECT 
                        t.*, 
                        s.nazwa AS nazwa_spolki,
                        u.login AS nazwa_uzytkownika
                    FROM 
                        transakcje t
                    JOIN 
                        spolki s ON t.idSpolki = s.id
                    JOIN 
                        uzytkownicy u ON t.idUzytkownika = u.id
                    WHERE
                        DATE(t.data) = CURDATE()
                    ORDER BY
                        t.data DESC;
         
            ";
                break;

            case 'month':
                $sql = "SELECT 
                            t.*, 
                            s.nazwa AS nazwa_spolki,
                            u.login AS nazwa_uzytkownika
                        FROM 
                            transakcje t
                        JOIN 
                            spolki s ON t.idSpolki = s.id
                        JOIN 
                            uzytkownicy u ON t.idUzytkownika = u.id
                        WHERE
                            MONTH(t.data) = MONTH(CURDATE()) AND YEAR(t.data) = YEAR(CURDATE())
                        ORDER BY
                            t.data DESC;
         
            ";
                
                break;

            case 'quarter':
                $sql = "SELECT 
                            t.*, 
                            s.nazwa AS nazwa_spolki,
                            u.login AS nazwa_uzytkownika
                        FROM 
                            transakcje t
                        JOIN 
                            spolki s ON t.idSpolki = s.id
                        JOIN 
                            uzytkownicy u ON t.idUzytkownika = u.id
                        WHERE
                            QUARTER(t.data) = QUARTER(CURDATE()) AND YEAR(t.data) = YEAR(CURDATE())
                        ORDER BY
                            t.data DESC;
                ";
                break;

            default:
            $sql = "SELECT 
                        t.*, 
                        s.nazwa AS nazwa_spolki,
                        u.login AS nazwa_uzytkownika
                    FROM 
                        transakcje t
                    JOIN 
                        spolki s ON t.idSpolki = s.id
                    JOIN 
                        uzytkownicy u ON t.idUzytkownika = u.id
                    ORDER BY
                        t.data DESC;
                    ";
                break;
        }
    }
    
 echo"<table>";
    echo"<tr><th>Typ</th><th>Nazwa Użytkownika</th><th>Nazwa spółki</th><th>Data</th><th>Ilość</th><th>Kurs</th><th>Wartość</th><th>Zysk 2%</th><th>Podatek 19%</th></tr>";
   $result = $conn->query($sql);
    if($result->num_rows>0){
            while($row = $result->fetch_object()){
                $wartosc = $row->kurs * $row->ilosc;
                if($row->typ == 'k'){
                    $typ = "Kupno";
                }
                else if($row->typ == 's'){
                    $typ = "Sprzedaż";
                }
                    echo"
                        <tr>
                            <td>$typ</td>
                            <td>{$row->nazwa_uzytkownika}</td>
                            <td>{$row->nazwa_spolki}</td>
                            <td>{$row->data}</td>
                            <td>{$row->ilosc}</td>
                            <td>{$row->kurs}</td>
                            <td> $wartosc zł</td>
                            <td>{$row->zysk_2proc} zł</td>
                            <td>{$row->podatek_19proc} zł</td>
                        </tr>
                    ";
            }
}
 else{
    echo"</table>";
    echo"<p>Brak transakcji</p>";
 }
?>
</article> 
</section>
</body>
</html>