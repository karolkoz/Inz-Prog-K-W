-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 31 Mar 2021, 21:02
-- Wersja serwera: 10.4.18-MariaDB
-- Wersja PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `kulinaria`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `etap`
--

CREATE TABLE `etap` (
  `id_etap` int(10) UNSIGNED NOT NULL,
  `nr_etapu` int(10) UNSIGNED NOT NULL,
  `opis` varchar(10000) COLLATE utf8_polish_ci NOT NULL,
  `zdjecie` longblob DEFAULT NULL,
  `PRZEPIS_id_przepis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategoria`
--

CREATE TABLE `kategoria` (
  `nazwa` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `opis` varchar(1000) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lubie_to`
--

CREATE TABLE `lubie_to` (
  `UZYTKOWNIK_login` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `PRZEPIS_id_przepis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nalezy`
--

CREATE TABLE `nalezy` (
  `PRZEPIS_id_przepis` int(11) NOT NULL,
  `KATEGORIA_nazwa` varchar(40) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przepis`
--

CREATE TABLE `przepis` (
  `id_przepis` int(11) NOT NULL,
  `nazwa` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `stopien_trudnosci` int(11) NOT NULL,
  `czas_przygotowania` int(11) NOT NULL,
  `dla_ilu_osob` int(11) NOT NULL,
  `opis` varchar(10000) COLLATE utf8_polish_ci NOT NULL,
  `data_dodania` date NOT NULL,
  `status` int(11) NOT NULL,
  `zdjecie_ogolne` longblob DEFAULT NULL,
  `UZYTKOWNIK_login` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `skladniki`
--

CREATE TABLE `skladniki` (
  `id_skladnik` int(10) UNSIGNED NOT NULL,
  `nazwa` varchar(40) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ulubione`
--

CREATE TABLE `ulubione` (
  `UZYTKOWNIK_login` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `PRZEPIS_id_przepis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `login` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `nazwa` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `rodzaj_konta` int(11) UNSIGNED NOT NULL,
  `status_konta` int(11) UNSIGNED NOT NULL
) ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zawiera`
--

CREATE TABLE `zawiera` (
  `PRZEPIS_id_przepis` int(11) NOT NULL,
  `SKLADNIKI_id_skladnik` int(11) UNSIGNED NOT NULL,
  `ilosc` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `etap`
--
ALTER TABLE `etap`
  ADD PRIMARY KEY (`id_etap`),
  ADD KEY `PRZEPIS_id_przepis` (`PRZEPIS_id_przepis`);

--
-- Indeksy dla tabeli `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`nazwa`);

--
-- Indeksy dla tabeli `lubie_to`
--
ALTER TABLE `lubie_to`
  ADD PRIMARY KEY (`PRZEPIS_id_przepis`,`UZYTKOWNIK_login`),
  ADD KEY `UZYTKOWNIK_login` (`UZYTKOWNIK_login`);

--
-- Indeksy dla tabeli `nalezy`
--
ALTER TABLE `nalezy`
  ADD PRIMARY KEY (`PRZEPIS_id_przepis`,`KATEGORIA_nazwa`),
  ADD KEY `KATEGORIA_nazwa` (`KATEGORIA_nazwa`);

--
-- Indeksy dla tabeli `przepis`
--
ALTER TABLE `przepis`
  ADD PRIMARY KEY (`id_przepis`),
  ADD KEY `UZYTKOWNIK_login` (`UZYTKOWNIK_login`);

--
-- Indeksy dla tabeli `skladniki`
--
ALTER TABLE `skladniki`
  ADD PRIMARY KEY (`id_skladnik`);

--
-- Indeksy dla tabeli `ulubione`
--
ALTER TABLE `ulubione`
  ADD PRIMARY KEY (`UZYTKOWNIK_login`,`PRZEPIS_id_przepis`),
  ADD KEY `PRZEPIS_id_przepis` (`PRZEPIS_id_przepis`);

--
-- Indeksy dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`login`);

--
-- Indeksy dla tabeli `zawiera`
--
ALTER TABLE `zawiera`
  ADD PRIMARY KEY (`PRZEPIS_id_przepis`,`SKLADNIKI_id_skladnik`),
  ADD KEY `SKLADNIKI_id_skladnik` (`SKLADNIKI_id_skladnik`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `etap`
--
ALTER TABLE `etap`
  MODIFY `id_etap` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `przepis`
--
ALTER TABLE `przepis`
  MODIFY `id_przepis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `skladniki`
--
ALTER TABLE `skladniki`
  MODIFY `id_skladnik` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `etap`
--
ALTER TABLE `etap`
  ADD CONSTRAINT `etap_ibfk_1` FOREIGN KEY (`PRZEPIS_id_przepis`) REFERENCES `przepis` (`id_przepis`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `lubie_to`
--
ALTER TABLE `lubie_to`
  ADD CONSTRAINT `lubie_to_ibfk_1` FOREIGN KEY (`UZYTKOWNIK_login`) REFERENCES `uzytkownik` (`login`) ON DELETE CASCADE,
  ADD CONSTRAINT `lubie_to_ibfk_2` FOREIGN KEY (`PRZEPIS_id_przepis`) REFERENCES `przepis` (`id_przepis`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `nalezy`
--
ALTER TABLE `nalezy`
  ADD CONSTRAINT `nalezy_ibfk_1` FOREIGN KEY (`KATEGORIA_nazwa`) REFERENCES `kategoria` (`nazwa`) ON DELETE CASCADE,
  ADD CONSTRAINT `nalezy_ibfk_2` FOREIGN KEY (`PRZEPIS_id_przepis`) REFERENCES `przepis` (`id_przepis`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `przepis`
--
ALTER TABLE `przepis`
  ADD CONSTRAINT `przepis_ibfk_1` FOREIGN KEY (`UZYTKOWNIK_login`) REFERENCES `uzytkownik` (`login`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `ulubione`
--
ALTER TABLE `ulubione`
  ADD CONSTRAINT `ulubione_ibfk_1` FOREIGN KEY (`UZYTKOWNIK_login`) REFERENCES `uzytkownik` (`login`) ON DELETE CASCADE,
  ADD CONSTRAINT `ulubione_ibfk_2` FOREIGN KEY (`PRZEPIS_id_przepis`) REFERENCES `przepis` (`id_przepis`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `zawiera`
--
ALTER TABLE `zawiera`
  ADD CONSTRAINT `zawiera_ibfk_1` FOREIGN KEY (`SKLADNIKI_id_skladnik`) REFERENCES `skladniki` (`id_skladnik`) ON DELETE CASCADE,
  ADD CONSTRAINT `zawiera_ibfk_2` FOREIGN KEY (`PRZEPIS_id_przepis`) REFERENCES `przepis` (`id_przepis`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
