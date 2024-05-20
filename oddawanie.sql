-- 1) Spolka kurs minimum kiedy kurs maksimum kiedy 
SELECT spolki.nazwa, MAX(cena) as "Maksymalna cena", kursy.data FROM kursy  JOIN spolki ON kursy.idSpolki = spolki.id GROUP BY idSpolki UNION SELECT spolki.nazwa, MIN(cena) as "Minimalna cena", kursy.data FROM kursy  JOIN spolki ON kursy.idSpolki = spolki.id GROUP BY idSpolki;
-- 2) uzytkownicy ktorzy najwiecej zarobili w ubiegłym roku
SELECT uzytkownicy.email, ((SELECT SUM(kurs * ilosc) FROM transakcje WHERE typ = 's' AND transakcje.idUzytkownika = uzytkownicy.id AND transakcje.data BETWEEN "2023-07-01" AND "2023-09-30") - (SELECT SUM(kurs * ilosc) FROM transakcje WHERE typ = 'k' AND transakcje.idUzytkownika = uzytkownicy.id AND transakcje.data BETWEEN "2023-07-01" AND "2023-09-30")) as zysk FROM uzytkownicy ORDER BY zysk DESC LIMIT 1;

-- 3) ludzie ktorzy najwiecej stracili w tym roku w styczniu
SELECT uzytkownicy.email, ((SELECT SUM(kurs * ilosc) FROM transakcje WHERE typ = 's' AND transakcje.idUzytkownika = uzytkownicy.id AND transakcje.data BETWEEN "2024-01-01" AND "2024-01-30") - (SELECT SUM(kurs * ilosc) FROM transakcje WHERE typ = 'k' AND transakcje.idUzytkownika = uzytkownicy.id AND transakcje.data BETWEEN "2024-01-01" AND "2024-01-30")) as strata FROM uzytkownicy ORDER BY strata ASC LIMIT 1;
-- 4) Zestawienie ktore pokaże według kategorii ile w kategorii bylo wykonanych transakcji 3 kwartał ubiegłego roku
SELECT kategorie.nazwa, COUNT(transakcje.id) as Ilość FROM transakcje JOIN spolki ON transakcje.idSpolki = spolki.id JOIN kategorie ON spolki.idkategorii = kategorie.id WHERE transakcje.data BETWEEN "2023-07-01" AND "2023-09-30" GROUP BY kategorie.id;

