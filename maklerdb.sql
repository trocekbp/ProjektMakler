-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 20, 2024 at 04:00 AM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maklerdb`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `akcjeuz`
--

CREATE TABLE `akcjeuz` (
  `id` int(10) UNSIGNED NOT NULL,
  `idSpolki` int(10) UNSIGNED NOT NULL,
  `idUzytkownika` int(10) UNSIGNED NOT NULL,
  `ilosc` int(10) UNSIGNED NOT NULL,
  `kurs` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `akcjeuz`
--

INSERT INTO `akcjeuz` (`id`, `idSpolki`, `idUzytkownika`, `ilosc`, `kurs`) VALUES
(8, 18, 2, 2, 160.305);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(10) UNSIGNED NOT NULL,
  `nazwa` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `opis` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `kategorie`
--

INSERT INTO `kategorie` (`id`, `nazwa`, `opis`) VALUES
(1, 'Paliwa', 'Spółki zajmujące się paliwami '),
(2, 'Gry', 'Spółki zajmujące się produkcją gier');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kursy`
--

CREATE TABLE `kursy` (
  `id` int(10) UNSIGNED NOT NULL,
  `idSpolki` int(10) UNSIGNED NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cena` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `kursy`
--

INSERT INTO `kursy` (`id`, `idSpolki`, `data`, `cena`) VALUES
(14, 18, '2024-01-20 01:02:49', 156.24),
(15, 18, '2024-01-20 01:03:07', 156.305);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `recenzje`
--

CREATE TABLE `recenzje` (
  `id` int(10) UNSIGNED NOT NULL,
  `idSpolki` int(10) UNSIGNED NOT NULL,
  `nick` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `ocena` int(11) NOT NULL,
  `tresc` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `spolki`
--

CREATE TABLE `spolki` (
  `id` int(10) UNSIGNED NOT NULL,
  `aktywny` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Omijamy usuwanie spółki, by zachować jej dane w historii np gdy ktoś o 5 latach odezwie się że chce sprzedać akcje',
  `idkategorii` int(10) UNSIGNED NOT NULL,
  `nazwa` varchar(70) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `obrazek` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `opis` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `iloscAkcji` int(11) NOT NULL,
  `cenaAkcji` float NOT NULL,
  `kraj` varchar(50) NOT NULL,
  `miasto` varchar(60) NOT NULL,
  `adres` varchar(100) NOT NULL,
  `nip` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `spolki`
--

INSERT INTO `spolki` (`id`, `aktywny`, `idkategorii`, `nazwa`, `obrazek`, `opis`, `iloscAkcji`, `cenaAkcji`, `kraj`, `miasto`, `adres`, `nip`) VALUES
(18, 1, 1, 'orlen', 'img/deafult.png', 'tanio', 1978, 160.305, 'Polska', 'Warszaa', 'Łączna 25', 'pl1262737673');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `transakcje`
--

CREATE TABLE `transakcje` (
  `id` int(10) UNSIGNED NOT NULL,
  `idSpolki` int(10) UNSIGNED NOT NULL,
  `idUzytkownika` int(10) UNSIGNED NOT NULL,
  `typ` text NOT NULL COMMENT 'k - kupno, s - sprzedaż',
  `ilosc` int(10) UNSIGNED NOT NULL,
  `kurs` float UNSIGNED NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `zysk_2proc` float NOT NULL,
  `podatek_19proc` float NOT NULL COMMENT 'podatek od zysku'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transakcje`
--

INSERT INTO `transakcje` (`id`, `idSpolki`, `idUzytkownika`, `typ`, `ilosc`, `kurs`, `data`, `zysk_2proc`, `podatek_19proc`) VALUES
(1, 18, 2, 'k', 5, 160.305, '2024-01-20 03:27:56', 16.0305, 3.04579),
(2, 18, 2, 'k', 10, 160.305, '2024-01-20 03:32:22', 32.061, 6.09159),
(3, 18, 2, 'k', 10, 160.305, '2024-01-20 03:33:33', 32.061, 6.09159),
(4, 18, 2, 'k', 10, 160.305, '2024-01-20 03:37:30', 32.061, 6.09159),
(5, 18, 2, 's', 20, 160.305, '2024-01-20 03:43:24', 833.434, 158.352),
(6, 18, 2, 'k', 1, 160.305, '2024-01-20 03:45:24', 3.2061, 0.609159),
(7, 18, 2, 'k', 1, 160.305, '2024-01-20 03:45:40', 3.2061, 0.609159);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ulubione`
--

CREATE TABLE `ulubione` (
  `id` int(10) UNSIGNED NOT NULL,
  `idSpolki` int(10) UNSIGNED NOT NULL,
  `idUzytkownika` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf16 COLLATE utf16_polish_ci NOT NULL,
  `rola` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL DEFAULT 'user',
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `portfel` float UNSIGNED NOT NULL DEFAULT 0,
  `dataUrodzenia` date NOT NULL,
  `pesel` int(11) NOT NULL,
  `plec` varchar(20) DEFAULT NULL,
  `nazwaFirmy` varchar(150) DEFAULT NULL,
  `nip` varchar(13) DEFAULT NULL,
  `kraj` varchar(50) NOT NULL,
  `miasto` varchar(60) NOT NULL,
  `adres` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `login`, `haslo`, `email`, `rola`, `data`, `portfel`, `dataUrodzenia`, `pesel`, `plec`, `nazwaFirmy`, `nip`, `kraj`, `miasto`, `adres`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', '2023-08-03 23:29:42', 0, '0000-00-00', 0, NULL, NULL, NULL, '', '', ''),
(2, 'a', '0cc175b9c0f1b6a831c399e269772661', 'a', 'user', '2024-01-20 02:45:40', 3846.56, '0000-00-00', 0, NULL, NULL, NULL, '', '', ''),
(3, 'kac', '0208a2e72da71f7d17d6d20080990ad0', 'kac', 'user', '2023-11-09 22:28:31', 500000, '0000-00-00', 0, NULL, NULL, NULL, '', '', ''),
(5, 'kacper', '202cb962ac59075b964b07152d234b70', 'trocevicz@gmail.com', 'user', '2024-01-20 00:31:26', 0, '0000-00-00', 2003, 'male', '', '', 'Polska', 'Biała Podlaska', 'Ignacego Krasickiego 1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `waluty`
--

CREATE TABLE `waluty` (
  `idWaluty` int(10) NOT NULL,
  `nazwa` varchar(30) NOT NULL,
  `kurs` float NOT NULL COMMENT 'Kurs przeliczamy przez złotówki'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela do kursów, domyślnie będą wybierane przez użytkownika';

--
-- Dumping data for table `waluty`
--

INSERT INTO `waluty` (`idWaluty`, `nazwa`, `kurs`) VALUES
(1, 'zl', 1),
(2, 'dolar', 4.03),
(3, 'euro', 4.39);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zgloszenia`
--

CREATE TABLE `zgloszenia` (
  `id` int(10) UNSIGNED NOT NULL,
  `idUzytkownika` int(10) UNSIGNED NOT NULL,
  `tresc` text CHARACTER SET utf16 COLLATE utf16_polish_ci NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `zgloszenia`
--

INSERT INTO `zgloszenia` (`id`, `idUzytkownika`, `tresc`, `data`) VALUES
(1, 1, 'fasfaf', '2023-08-15 15:54:10'),
(2, 1, '', '2023-08-15 15:57:10');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `akcjeuz`
--
ALTER TABLE `akcjeuz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idSpolki` (`idSpolki`),
  ADD KEY `idUzytkownika` (`idUzytkownika`);

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `kursy`
--
ALTER TABLE `kursy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idSpolki` (`idSpolki`);

--
-- Indeksy dla tabeli `recenzje`
--
ALTER TABLE `recenzje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idSpolki` (`idSpolki`);

--
-- Indeksy dla tabeli `spolki`
--
ALTER TABLE `spolki`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idkategorii` (`idkategorii`);

--
-- Indeksy dla tabeli `transakcje`
--
ALTER TABLE `transakcje`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `ulubione`
--
ALTER TABLE `ulubione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idSpolki` (`idSpolki`),
  ADD KEY `idUzytkownika` (`idUzytkownika`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `waluty`
--
ALTER TABLE `waluty`
  ADD PRIMARY KEY (`idWaluty`);

--
-- Indeksy dla tabeli `zgloszenia`
--
ALTER TABLE `zgloszenia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUzytkownika` (`idUzytkownika`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akcjeuz`
--
ALTER TABLE `akcjeuz`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kursy`
--
ALTER TABLE `kursy`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `recenzje`
--
ALTER TABLE `recenzje`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `spolki`
--
ALTER TABLE `spolki`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `transakcje`
--
ALTER TABLE `transakcje`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ulubione`
--
ALTER TABLE `ulubione`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `waluty`
--
ALTER TABLE `waluty`
  MODIFY `idWaluty` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `zgloszenia`
--
ALTER TABLE `zgloszenia`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akcjeuz`
--
ALTER TABLE `akcjeuz`
  ADD CONSTRAINT `idSpolki` FOREIGN KEY (`idSpolki`) REFERENCES `spolki` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idUzytkownika` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kursy`
--
ALTER TABLE `kursy`
  ADD CONSTRAINT `kursy_ibfk_1` FOREIGN KEY (`idSpolki`) REFERENCES `spolki` (`id`);

--
-- Constraints for table `recenzje`
--
ALTER TABLE `recenzje`
  ADD CONSTRAINT `recenzja ma jedną spółkę` FOREIGN KEY (`idSpolki`) REFERENCES `spolki` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `spolki`
--
ALTER TABLE `spolki`
  ADD CONSTRAINT `kazda spolka ma kategorie` FOREIGN KEY (`idkategorii`) REFERENCES `kategorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ulubione`
--
ALTER TABLE `ulubione`
  ADD CONSTRAINT `ulubione_ibfk_1` FOREIGN KEY (`idSpolki`) REFERENCES `spolki` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ulubione_ibfk_2` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `zgloszenia`
--
ALTER TABLE `zgloszenia`
  ADD CONSTRAINT `zgloszenia_ibfk_1` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
