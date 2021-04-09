-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Kwi 2021, 16:10
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
  `id_etap` int(11) NOT NULL,
  `nr_etapu` int(11) NOT NULL,
  `opis` varchar(10000) COLLATE utf8_polish_ci NOT NULL,
  `zdjecie` blob DEFAULT NULL,
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

--
-- Zrzut danych tabeli `kategoria`
--

INSERT INTO `kategoria` (`nazwa`, `opis`) VALUES
('Fit', 'Kategoria dla osób, które chcą dbać o sylwetkę ale jednocześnie nie chcą rezygnować z pysznych potraw. Sprawdź pomysły na zdrowe dania i wybierz swoje ulubione!'),
('Kolacja ', 'Najlepsze propozycje kolacji na każdą okazję. Spróbuj sam, bo warto! '),
('Obiad', 'Obiady błyskawiczne dla zapracowanych. Obiady wymyślne dla ciągłych poszukiwaczy smaków. Obiady lekkie dla osób na redukcji. Obiady syte dla tych, co lubią zjeść. Jest cały wachlarz możliwości do przetestowania!'),
('Przekąski', 'Wiele propozycji szybkich przekąsek na każdą imprezę i nie tylko! - Czyli pomysły jak zrobić coś pysznego bez dużego nakładu pracy.'),
('Sałatki', 'Znudzony robieniem ciągle tych samych sałatek? Już czas spróbować czegoś nowego! W tej kategorii znajdziesz wiele ciekawych propozycji na pyszne sałatki. '),
('Śniadanie', 'Propozycje śniadań dla każdego - od lekkich i tradycyjnych (np. owsianki, amerykańskie placki pancake, omlety) po wyszukane, które zaskoczą niejednego fana nowych smaków!'),
('Tradycyjne', 'Tradycyjne dania \'jak u Mamy\'. Jeśli szukasz tradycyjnych smaków, marzy Ci się danie \'jak dawniej\' - ta kategoria jest dla Ciebie.'),
('Vege', 'To specjalna kategoria dla każdego, kto poszukuje alternatywy dla mięsa. Zobacz przepisy i daj się zaskoczyć możliwościami jakie są na wyciągnięcie ręki.'),
('Wegańskie ', 'Kategoria dla osób, które wiedzą czego szukają. Tu znajdziesz propozycje potraw nie tylko bezmięsnych, ale również bez innych składników pochodzenia zwierzęcego. Sprawdź!'),
('Wegetariańskie', 'To specjalna kategoria dla każdego, kto poszukuje alternatywy dla mięsa. Zobacz przepisy i daj się zaskoczyć możliwościami jakie są na wyciągnięcie ręki.'),
('Wypieki', 'Kategoria dla łasuchów. Masz ochotę upiec coś pysznego? Sprawdź dostępne przepisy!'),
('Wytrawne', 'Kategoria z daniami wytrawnymi. Przekonaj się, ile jest możliwości aby przygotować wytrawny posiłek.');

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
  `zdjecie_ogolne` blob DEFAULT NULL,
  `UZYTKOWNIK_login` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `skladniki`
--

CREATE TABLE `skladniki` (
  `id_skladnik` int(11) NOT NULL,
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
  `rodzaj_konta` int(11) NOT NULL,
  `status_konta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownik`
--

INSERT INTO `uzytkownik` (`login`, `nazwa`, `haslo`, `rodzaj_konta`, `status_konta`) VALUES
('dummy123', 'dummy', 'dummy', 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zawiera`
--

CREATE TABLE `zawiera` (
  `PRZEPIS_id_przepis` int(11) NOT NULL,
  `SKLADNIKI_id_skladnik` int(11) NOT NULL,
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
  ADD KEY `etap_fi_1dec01` (`PRZEPIS_id_przepis`);

--
-- Indeksy dla tabeli `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`nazwa`);

--
-- Indeksy dla tabeli `lubie_to`
--
ALTER TABLE `lubie_to`
  ADD PRIMARY KEY (`UZYTKOWNIK_login`,`PRZEPIS_id_przepis`),
  ADD KEY `lubie_to_fi_1dec01` (`PRZEPIS_id_przepis`);

--
-- Indeksy dla tabeli `nalezy`
--
ALTER TABLE `nalezy`
  ADD PRIMARY KEY (`PRZEPIS_id_przepis`,`KATEGORIA_nazwa`),
  ADD KEY `nalezy_fi_eee2d7` (`KATEGORIA_nazwa`);

--
-- Indeksy dla tabeli `przepis`
--
ALTER TABLE `przepis`
  ADD PRIMARY KEY (`id_przepis`),
  ADD KEY `przepis_fi_0ae17c` (`UZYTKOWNIK_login`);

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
  ADD KEY `ulubione_fi_1dec01` (`PRZEPIS_id_przepis`);

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
  ADD KEY `zawiera_fi_159e2f` (`SKLADNIKI_id_skladnik`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `etap`
--
ALTER TABLE `etap`
  MODIFY `id_etap` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `przepis`
--
ALTER TABLE `przepis`
  MODIFY `id_przepis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `skladniki`
--
ALTER TABLE `skladniki`
  MODIFY `id_skladnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `etap`
--
ALTER TABLE `etap`
  ADD CONSTRAINT `etap_fk_1dec01` FOREIGN KEY (`PRZEPIS_id_przepis`) REFERENCES `przepis` (`id_przepis`);

--
-- Ograniczenia dla tabeli `lubie_to`
--
ALTER TABLE `lubie_to`
  ADD CONSTRAINT `lubie_to_fk_0ae17c` FOREIGN KEY (`UZYTKOWNIK_login`) REFERENCES `uzytkownik` (`login`),
  ADD CONSTRAINT `lubie_to_fk_1dec01` FOREIGN KEY (`PRZEPIS_id_przepis`) REFERENCES `przepis` (`id_przepis`);

--
-- Ograniczenia dla tabeli `nalezy`
--
ALTER TABLE `nalezy`
  ADD CONSTRAINT `nalezy_fk_1dec01` FOREIGN KEY (`PRZEPIS_id_przepis`) REFERENCES `przepis` (`id_przepis`),
  ADD CONSTRAINT `nalezy_fk_eee2d7` FOREIGN KEY (`KATEGORIA_nazwa`) REFERENCES `kategoria` (`nazwa`);

--
-- Ograniczenia dla tabeli `przepis`
--
ALTER TABLE `przepis`
  ADD CONSTRAINT `przepis_fk_0ae17c` FOREIGN KEY (`UZYTKOWNIK_login`) REFERENCES `uzytkownik` (`login`);

--
-- Ograniczenia dla tabeli `ulubione`
--
ALTER TABLE `ulubione`
  ADD CONSTRAINT `ulubione_fk_0ae17c` FOREIGN KEY (`UZYTKOWNIK_login`) REFERENCES `uzytkownik` (`login`),
  ADD CONSTRAINT `ulubione_fk_1dec01` FOREIGN KEY (`PRZEPIS_id_przepis`) REFERENCES `przepis` (`id_przepis`);

--
-- Ograniczenia dla tabeli `zawiera`
--
ALTER TABLE `zawiera`
  ADD CONSTRAINT `zawiera_fk_159e2f` FOREIGN KEY (`SKLADNIKI_id_skladnik`) REFERENCES `skladniki` (`id_skladnik`),
  ADD CONSTRAINT `zawiera_fk_1dec01` FOREIGN KEY (`PRZEPIS_id_przepis`) REFERENCES `przepis` (`id_przepis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
