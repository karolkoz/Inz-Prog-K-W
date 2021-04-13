-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 13 Kwi 2021, 13:51
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

--
-- Zrzut danych tabeli `etap`
--

INSERT INTO `etap` (`id_etap`, `nr_etapu`, `opis`, `zdjecie`, `PRZEPIS_id_przepis`) VALUES
(1, 1, 'Do miski wsyp pełną szklankę mąki pszennej + jeszcze dwie łyżki mąki. ', NULL, 1),
(2, 2, 'Będzie to około 230 gramów mąki. Używam zazwyczaj mąki pszennej tortowej lub mąki uniwersalnej.', NULL, 1),
(3, 3, 'Wbij trzy średniej wielkości jajka i wlej szklankę mleka oraz szklankę wody.', NULL, 1),
(4, 1, 'Przygotuj składniki i podłącz toster do prądu.', NULL, 2),
(5, 2, 'Złóż 4 tosty z podanych skłądników.', NULL, 2),
(6, 3, 'Włóż tosty do nagrzanego tostera.', NULL, 2),
(7, 1, 'Zalej wrzącą wodą przygotowaną uprzednio herbatę w szklance.', NULL, 3),
(8, 1, 'Obierz ziemniaki i pokrój w słupki. Wlej olej do garnka i czekaj aż będzie wrzeć.', NULL, 4),
(9, 2, 'Wrzuć ziemniaki do rozgrzanego oleju i smaż przez 10 min.', NULL, 4),
(10, 1, 'Obierz pomidory ze skóry.', NULL, 5),
(11, 2, 'Zagotuj wywar.', NULL, 5),
(12, 3, 'Ugotuj makaron i dopraw zupę.', NULL, 5),
(13, 4, 'Dodaj łyżkę śmietany i listek bazylii.', NULL, 5),
(14, 1, 'Zagnieć ciasto na pączki.', NULL, 6),
(15, 2, 'Uformuj kulki i nadziej pączki marmoladą.', NULL, 6),
(16, 3, 'Zacznij smażyć.', NULL, 6),
(17, 1, 'Zagnieć ciasto', NULL, 7),
(18, 2, 'Uformuj placek i rozgrzej piegarnik.', NULL, 7),
(19, 3, 'Dodaj skladniki', NULL, 7),
(20, 4, 'wrzuc do piekarnika na 180 stopni i piecz 30min', NULL, 7),
(21, 1, 'Przygotować galaretkę zgodnie z instrukcją na opakowaniu odejmując 50 ml wody. Po przygotowaniu przelać galaretkę do czystej miski w celu szybszego ostudzenia i odstawić.', NULL, 8),
(22, 2, 'Truskawki opłukać i dokładnie osuszyć, oderwać szypułki.', NULL, 8),
(23, 3, 'Na dno tortownicy o średnicy 26 cm położyć papier do pieczenia, zapiąć obręcz wypuszczając papier na zewnątrz. Na spodzie poukładać biszkopty.', NULL, 8),
(24, 4, 'Mleko zagotować, odstawić z ognia, wsypać żelatynę i mieszając rozpuścić.', NULL, 8),
(25, 5, 'Do większej miski włożyć twaróg sernikowy, dodać śmietankę, cukier puder lub ksylitol, cukier wanilinowy i wymieszać łyżką.', NULL, 8),
(26, 6, 'Do jeszcze ciepłej i płynnej żelatyny dodać 1 - 2 łyżki masy serowej i wymieszać rózgą. Dodać kolejne 2 - 3 łyżki masy serowej i znów wymieszać rózgą. Powtórzyć jeszcze z kilkoma łyżkami masy serowej, następnie przełożyć całość do pozostałego sera w misce i wymieszać rózgą na jednolitą masę.', NULL, 8),
(27, 7, 'Dodać 2/3 ilości pokrojonych na połówki truskawek, delikatnie wymieszać łyżką i wyłożyć na spód z biszkoptów, wyrównać powierzchnię i wstawić do lodówki na ok. pół godziny. W tym czasie galaretka wystudzi się a sernik lekko stężeje.', NULL, 8),
(28, 8, 'Wyjąć sernik z lodówki i powciskać w niego resztę truskawek pokrojonych na połówki. Łyżką wylewać galaretkę i wstawić do lodówki do całkowitego stężenia.', NULL, 8),
(29, 1, 'Przygotować galaretkę zgodnie z instrukcją na opakowaniu odejmując 50 ml wody. Po przygotowaniu przelać galaretkę do czystej miski w celu szybszego ostudzenia i odstawić.', NULL, 9),
(30, 2, 'Dodać 2/3 ilości pokrojonych na połówki truskawek, delikatnie wymieszać łyżką i wyłożyć na spód z biszkoptów, wyrównać powierzchnię i wstawić do lodówki na ok. pół godziny. W tym czasie galaretka wystudzi się a sernik lekko stężeje.', NULL, 9),
(31, 3, 'Do jeszcze ciepłej i płynnej żelatyny dodać 1 - 2 łyżki masy serowej i wymieszać rózgą. Dodać kolejne 2 - 3 łyżki masy serowej i znów wymieszać rózgą. Powtórzyć jeszcze z kilkoma łyżkami masy serowej, następnie przełożyć całość do pozostałego sera w misce i wymieszać rózgą na jednolitą masę.', NULL, 9),
(32, 1, 'Jajka ugotować na twardo. Sekretem dobrej pasty jajecznej są poprawnie ugotowane jajka na twardo. Pamiętaj, by jajka wkładać do zimnej wody i od momentu zagotowania się wody, dokładnie odliczać czas, co do minuty. Jeśli użyjesz jajek klasy M, tak jak ja w tym przepisie, to od momentu zagotowania się jajek odmierz 8 minut. Wtedy jajka na twardo będą idealne. Po ugotowaniu się jajek, zdjąć je z palnika i zalać w garnuszku zimną wodą. Następnie lekko obstukać skorupki i pozostawić jajka w wodzie na parę minut (2-3 minutki). Po tym czasie obrać je ze skorupek.', NULL, 10),
(33, 2, 'Ugotowane i obrane jajka pokroić w kosteczkę o boku ok. 3-4 mm. Można także je rozgnieść widelcem lub zetrzeć na tarce. Jeszcze inni ugotowane jajka blendują za pomocą blendera na jednolitą masę.', NULL, 10),
(34, 3, 'Do posiekanych jajek dodać 2 łyżki majonezu, 1 łyżeczkę musztardy oraz sól i świeżo mielony pieprz do smaku. Całość dokładnie wymieszać. Następnie posiekać kilka gałązek świeżego szczypiorku i wmieszać w pastę jajeczną. Pasta jajeczna ze szczypiorkiem gotowa! Można ją już zajadać lub wzbogacić o swoje ulubione dodatki. Idealnie smakuje ze świeżym pieczywem, np. z domowymi bułkami drożdżowymi. Smacznego!', NULL, 10),
(35, 1, 'Ugotować jajka (włożyć do ciepłej wody i gotować 5 i 1/2 minuty od momentu zagotowania wody, następnie szybko zalać zimną wodą i ostudzić). Obrać ze skorupek, posiekać w kosteczkę i włożyć do miseczki. Czosnek zetrzeć, posolić.', NULL, 11),
(36, 2, 'Awokado umyć, obrać, miąższ pokroić w kosteczkę, usunąć pestkę. Awokado skropić sokiem z cytryny i wymieszać razem z czosnkiem. Przełożyć do jajek, wymieszać i doprawić solą oraz świeżo zmielonym pieprzem.', NULL, 11),
(37, 3, 'Dodać oliwę oraz opcjonalnie majonez, kolendrę lub inną zieleninę. Wymieszać (część pasty można rozgnieść widelcem). Podawać od razu na pieczywie lub w salaterce z pieczywem obok. Można udekorować zielonymi listkami.', NULL, 11),
(38, 1, 'Obierz bataty i pokrój w słupki.', NULL, 12),
(39, 2, 'Rozgrzej piekarnik do 180 stopni.', NULL, 12),
(40, 3, 'Piecz do osiągnięcia rumianego koloru. Smacznego!', NULL, 12),
(41, 1, 'Mięso włożyć do większej miski. Ryż ugotować, ostudzić i dodać do mięsa. Cebulę obrać, zetrzeć na tarce, dodać do mięsa z ryżem. Doprawić solą (około pół łyżeczki), pieprzem (1/4 łyżeczki). Wszystko wymieszać i dobrze wyrobić dłonią. Uformować niewielkie podłużne kotlety.', NULL, 13),
(42, 2, 'Wyciąć głąb ze środka kapusty, następnie włożyć ją do dużego garnka z wrzątkiem (wyciętą stroną do dołu), gotować przez około 10 minut na małym ogniu. Przewrócić kapustę na drugą stronę i gotować przez ok. 5 minut. Wyjąć kapustę z wrzątku i po przestudzeniu rozebrać ją z liści, odciąć delikatnie zgrubienia z każdego liścia, następnie nakładać przygotowane porcje mięsa.', NULL, 13),
(43, 3, 'Zawijać jak krokiety (najpierw założyć liść na mięso z jednej strony, później złożyć boki do środka, następnie zwinąć jak najciaśniej do końca pozostałą część liścia). Nie cała kapusta musi być wykorzystana.', NULL, 13),
(44, 4, 'Dno dużego i najlepiej szerokiego garnka wyłożyć kilkoma liśćmi kapusty (np. takimi, które się porwały). Na wierzchu ułożyć gołąbki łączeniem do dołu. Zagotować bulion w innym garnku i zalać nim gołąbki. Postawić na gazie, przykryć i gotować przez około 45 - 60 minut aż kapusta będzie miękka. W czasie gotowania nie mieszać gołąbków, ewentualnie delikatnie potrząsnąć garnkiem.', NULL, 13),
(45, 5, 'Wywar z gołąbków przelać do innego garnka. Dodać przecier pomidorowy oraz mąkę rozmieszaną wcześniej z kilkoma łyżkami zimnej wody. Zagotować, doprawić solą, pieprzem, suszonym oregano, tymiankiem i papryką. Gotować przez 10 minut bez przykrycia.', NULL, 13),
(46, 6, 'Jeśli dodajemy śmietanę należy rozprowadzać ją stopniowo z sosem, dodając go po łyżce do śmietany jednocześnie mieszając. Przelać do garnka z gołąbkami i gotować całość przez kilka minut na małym ogniu, od czasu do czasu potrząsnąć garnkiem aby sos równomiernie się rozprowadził.', NULL, 13),
(47, 1, 'Bułkę zalać mlekiem lub wodą, odstawić do namoczenia na około 10 - 15 minut. ', NULL, 14),
(48, 2, 'Do większej miski włożyć zmielone mięso, startą na drobnej tarce cebulę, jajko, sól i pieprz oraz odciśniętą bułkę, wszystko dobrze wymieszać.', NULL, 14),
(49, 3, 'W trakcie wyrabiania mięsa należy dodawać po troszku zimnej wody i wyrabiać tak długo aż mięso wchłonie wodę i nie będzie przywierać do dłoni. Im dłużej wyrabiamy, tym lepsze kotlety. Masa mięsna może wydawać się dość luźna, ale dzięki temu kotlety będą delikatniejsze, mniej zbite i twarde.', NULL, 14),
(50, 4, 'Uformować podłużne kotlety, obtoczyć w bułce tartej i kłaść na dobrze rozgrzany olej na patelni. Po obsmażeniu z dwóch stron przełożyć kotlety do garnka lub naczynia żaroodpornego (bez przykrycia) i wstawić do rozgrzanego do 150 stopni C piekarnika, na około 15 minut. Unikniemy długiego smażenia, a kotlety będą w środku idealnie miękkie.', NULL, 14);

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

--
-- Zrzut danych tabeli `nalezy`
--

INSERT INTO `nalezy` (`PRZEPIS_id_przepis`, `KATEGORIA_nazwa`) VALUES
(5, 'Obiad'),
(6, 'Przekąski'),
(6, 'Wypieki'),
(7, 'Obiad'),
(7, 'Wytrawne'),
(8, 'Fit'),
(8, 'Przekąski'),
(8, 'Wypieki'),
(9, 'Przekąski'),
(9, 'Vege'),
(9, 'Wypieki'),
(10, 'Fit'),
(10, 'Przekąski'),
(11, 'Fit'),
(11, 'Przekąski'),
(12, 'Fit'),
(12, 'Przekąski'),
(13, 'Obiad'),
(13, 'Tradycyjne'),
(14, 'Obiad'),
(14, 'Tradycyjne');

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

--
-- Zrzut danych tabeli `przepis`
--

INSERT INTO `przepis` (`id_przepis`, `nazwa`, `stopien_trudnosci`, `czas_przygotowania`, `dla_ilu_osob`, `opis`, `data_dodania`, `status`, `zdjecie_ogolne`, `UZYTKOWNIK_login`) VALUES
(1, 'Naleśniki', 3, 15, 2, 'Naleśniki z twarogiem na słodko.', '2021-04-10', 1, NULL, 'dummy123'),
(2, 'Tosty', 2, 5, 2, 'Tosty tradycyjne z szynką i żółtym serem.', '2021-04-10', 1, NULL, 'dummy123'),
(3, 'Herbata', 1, 3, 1, 'Herbata owocowa.', '2021-04-10', 1, NULL, 'dummy123'),
(4, 'Frytki', 4, 15, 2, 'Frytki domowej roboty ze świeżych ziemniaków.', '2021-04-10', 1, NULL, 'dummy123'),
(5, 'Zupa pomidorowa', 5, 35, 4, 'Zupa pomidorowa ze świeżych pomidorów sezonowych.', '2021-04-11', 1, NULL, 'dummy123'),
(6, 'Pączki', 6, 45, 8, 'Pączki idealne na Tłusty Czwartek, bardzo tłuste :)', '2021-04-11', 1, NULL, 'dummy123'),
(7, 'Pizza Italiana', 4, 25, 4, 'Pizza Italiana - prawdziwa włoska pizza', '2021-04-11', 1, NULL, 'dummy123'),
(8, 'Sernik na zimno', 4, 20, 4, 'Pyszny sernik na zimno z sezonowymi owocami.', '2021-04-11', 1, NULL, 'dummy123'),
(9, 'Sernik na zimno', 4, 24, 4, 'Pyszny sernik na zimno z sezonowymi owocami.', '2021-04-11', 1, NULL, 'dummy123'),
(10, 'Pasta jajeczna', 2, 15, 3, 'Taka pasta z jajek, bez dodatków często pojawia się u nas na śniadanie lub kolację. Podajemy ją na kanapki, a potem już każdy dobiera na wierzch swoje ulubione dodatki. Na przykład mój mąż nakłada plasterki dojrzałego pomidora i całość obficie posypuje szczypiorkiem lub posiekaną drobno cebulką, a ja zaś chętnie zajadam taką pastę jajeczną z dodatkiem ogórka konserwowego.\r\nPasta jajeczna pojawia się u nas także obowiązkowo jako element śniadania wielkanocnego.', '2021-04-12', 1, NULL, 'dummy123'),
(11, 'Pasta z awokado', 3, 15, 2, 'To moja najlepsza pasta z awokado. Jest szybka do zrobienia a do tego bardzo prosta. Pasta z awokado i jajka składa się u mnie tylko z niezbędnych składników. Przepis jest sprawdzony i dopracowany. Zapraszam!', '2021-04-12', 1, NULL, 'dummy123'),
(12, 'Chipsy z batatów', 4, 35, 2, 'Chipsy z batatów jako forma zdrowej przekąski. Polecane dla każdego, kto lubi słone przekąski ale równocześnie chce prowadzić zdrowy tryb życia.', '2021-04-13', 1, NULL, 'dummy123'),
(13, 'Gołąbki', 7, 55, 4, 'Potrawa półmięsna z farszu zawiniętego w rolki z liści białej kapusty głowiastej. Tradycyjnymi składnikami farszu są mielone mięso wieprzowe i ryż lub kasza oraz dalsze dodatki, jak np. cebula, grzyby i przyprawy. Istnieją także inne warianty nadzienia np. z mięsem drobiowym, baraniną lub bez mięsa.', '2021-04-13', 1, NULL, 'dummy123'),
(14, 'Kotlety mielone tradycyjne', 7, 45, 4, 'Kotlety mielone z tłuczonymi ziemniakami i smażonymi buraczkami. Klasyka w najlepszym wydaniu!', '2021-04-13', 1, NULL, 'dummy123');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `skladniki`
--

CREATE TABLE `skladniki` (
  `id_skladnik` int(11) NOT NULL,
  `nazwa` varchar(40) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `skladniki`
--

INSERT INTO `skladniki` (`id_skladnik`, `nazwa`) VALUES
(12, 'jajko'),
(13, 'mleko'),
(14, 'mąka'),
(15, 'twaróg chudy'),
(16, 'Ser żółty'),
(17, 'Szynka'),
(18, 'Chleb tostowy'),
(19, 'woda'),
(20, 'herbata'),
(21, 'Ziemniaki'),
(22, 'Olej'),
(23, 'pomidory'),
(24, 'makaron nitki'),
(25, 'woda'),
(26, 'marmolada różana'),
(27, 'mąka'),
(28, 'drożdże'),
(29, 'mąka'),
(30, 'pieczarki'),
(31, 'parmezan'),
(32, 'woda'),
(33, 'Biały ser'),
(34, 'truskawki'),
(35, 'cukier'),
(36, 'galaretka'),
(37, 'Biały ser'),
(38, 'woda'),
(39, 'jajka'),
(40, 'majonez'),
(41, 'szczypiorek '),
(42, 'awokado'),
(43, 'jajka'),
(44, 'czosnek'),
(45, 'majonez'),
(46, 'bataty'),
(47, 'oliwa'),
(48, 'rozmaryn'),
(49, 'ryż'),
(50, 'cebula'),
(51, 'przecier pomidorowy'),
(52, 'kapusta'),
(53, 'bułka kajzerka'),
(54, 'mięso mielone'),
(55, 'jajko');

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
-- Zrzut danych tabeli `zawiera`
--

INSERT INTO `zawiera` (`PRZEPIS_id_przepis`, `SKLADNIKI_id_skladnik`, `ilosc`) VALUES
(1, 12, '3 sztuki'),
(1, 13, '1 szklanka'),
(1, 14, '0,5 szklanki'),
(1, 15, '250g'),
(2, 16, '4 plastry'),
(2, 17, '4 plastry'),
(2, 18, '8 kromek'),
(3, 19, '200ml'),
(3, 20, '1 torebka'),
(4, 21, '1,5kg'),
(4, 22, '2l'),
(5, 23, '1kg'),
(5, 24, '200g'),
(5, 25, '1l'),
(6, 26, '5 łyżek stołowych'),
(6, 27, '0,5 kg'),
(6, 28, '50 g'),
(7, 29, '1kg'),
(7, 30, '50g'),
(7, 31, '100g'),
(7, 32, '0,5 szklanki'),
(8, 33, '500g'),
(8, 34, '0,6kg'),
(8, 35, '2 szklanki'),
(8, 36, '1 opakowanie'),
(9, 37, '500g'),
(9, 38, '2l'),
(10, 39, '4 szt.'),
(10, 40, '2 łyżki stołowe'),
(10, 41, '10 g'),
(11, 42, '1 szt.'),
(11, 43, '3 szt.'),
(11, 44, '1 ząbek'),
(11, 45, '1 łyżka stołowa'),
(12, 46, '1kg'),
(12, 47, '3 łyżki'),
(12, 48, '1 łyżeczka'),
(13, 49, '100g'),
(13, 50, '2 szt.'),
(13, 51, '600g'),
(13, 52, '1 szt.'),
(14, 53, '1 szt.'),
(14, 54, '0,5 kg'),
(14, 55, '1 szt.');

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
  MODIFY `id_etap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT dla tabeli `przepis`
--
ALTER TABLE `przepis`
  MODIFY `id_przepis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `skladniki`
--
ALTER TABLE `skladniki`
  MODIFY `id_skladnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

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
