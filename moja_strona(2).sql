-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 08 Sty 2025, 15:20
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `moja_strona`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL,
  `matka` int(11) NOT NULL DEFAULT 0,
  `nazwa` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `kategorie`
--

INSERT INTO `kategorie` (`id`, `matka`, `nazwa`) VALUES
(3, 0, 'akcesoria'),
(4, 3, 'kubki'),
(5, 3, 'koszulki');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `page_list`
--

CREATE TABLE `page_list` (
  `id` int(255) NOT NULL,
  `page_title` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `page_content` text COLLATE utf8mb4_polish_ci NOT NULL,
  `status` int(255) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `page_list`
--

INSERT INTO `page_list` (`id`, `page_title`, `page_content`, `status`) VALUES
(1, 'calc_html', '<div class=\"main_glowna\">\r\n    <div class=\"kalkulator\">\r\n        <h2>Sprawdź ile byś ważył na innych planetach naszego układu słonecznego</h2>\r\n        <input type=\"number\" id=\"weight\" required>\r\n        <label>Wpisz swoją wage</label>\r\n        <br>\r\n        <select id=\"planet\" required>\r\n        <option value=\"Merkury\">Merkury</option>\r\n        <option value=\"Venus\">Venus</option>\r\n        <option value=\"Mars\">Mars</option>\r\n        <option value=\"Jowisz\">Jowisz</option>\r\n        <option value=\"Saturn\">Saturn</option>\r\n        <option value=\"Uran\">Uran</option>\r\n        <option value=\"Neptun\">Neptun</option>\r\n    </select>\r\n        <br>\r\n        <button onclick=\"calculateWeight()\">Oblicz wagę</button>\r\n        <h3 id=\"result\"></h3>\r\n    </div>\r\n    <h3 id=\"data\">Data</h3>\r\n</div>\r\n<div class=\"forward\">\r\n    <a href=\"index.php?idp=filmy\">Zobacz filmy➔ </a>\r\n</div>', 1),
(2, 'menu.html', '<nav class=\"menu\">\r\n    <div class=\"dropdown\">\r\n        <a href=\"index.php?idp=start\">Historia lotów kosmicznych</a>\r\n        <ul>\r\n            <li><a href=\"index.php?idp=start\">Jak się zaczęło?</a></li>\r\n            <li><a href=\"index.php?idp=kontynuacja\">Kontynuacja podboju kosmosu</a></li>\r\n            <li><a href=\"index.php?idp=coprzed\">Co przed nami?</a></li>\r\n        </ul>\r\n    </div>\r\n    <div class=\"dropdown\">\r\n        <a href=\"index.php?idp=sklep\">Sklep</a>\r\n        <ul><li><a href=\"index.php?idp=koszyk\">Koszyk</a></li></ul>\r\n    </div>\r\n    <a href=\"index.php?idp=kontakt\">Kontakt</a>\r\n</nav>', 1),
(3, 'start_html', '<div class=\"main\">\r\n    <div class=\"text-box\">\r\n        <h1>Jak się zaczęło?</h1>\r\n        <p>Historia lotów kosmicznych zaczyna się w połowie XX wieku, kiedy naukowcy i inżynierowie, napędzani\r\n            technologicznymi innowacjami oraz rywalizacją zimnowojenną między USA a ZSRR, rozpoczęli wyścig kosmiczny.\r\n            Kluczowym momentem był wystrzelenie\r\n            przez Związek Radziecki pierwszego sztucznego satelity – Sputnika 1 – 4 października 1957 roku. Był to mały\r\n            metalowy obiekt, który orbitował Ziemię, wysyłając sygnał radiowy, co stanowiło pierwszy krok w eksploracji\r\n            kosmosu.\r\n        </p>\r\n        <figure>\r\n            <img src=\"img/sputnik.jpg\">\r\n            <figcaption>Sputnik 1</figcaption>\r\n        </figure>\r\n        <p>Sukces Sputnika zapoczątkował erę badań kosmicznych, a wkrótce potem nadeszły kolejne przełomowe wydarzenia.\r\n            W 1961 roku radziecki kosmonauta Jurij Gagarin stał się pierwszym człowiekiem w kosmosie, dokonując pełnej\r\n            orbity wokół Ziemi na pokładzie\r\n            statku Wostok 1. Był to gigantyczny sukces ZSRR, który wzbudził ogromne zainteresowanie i wyzwanie dla\r\n            Stanów Zjednoczonych. W odpowiedzi na postępy Związku Radzieckiego, USA zintensyfikowało swoje wysiłki,\r\n            tworząc program Apollo, który\r\n            miał na celu wysłanie człowieka na Księżyc. W 1969 roku lądownik Apollo 11 z amerykańskimi astronautami\r\n            Neilem Armstrongiem i Buzzem Aldrinem na pokładzie wylądował na powierzchni Księżyca, a Armstrong wygłosił\r\n            słynne słowa: „To jest mały\r\n            krok człowieka, ale wielki skok dla ludzkości.” Te wydarzenia stanowiły fundamenty współczesnej eksploracji\r\n            kosmosu i otworzyły drzwi do dalszych misji – zarówno bezzałogowych, jak i załogowych. Rozpoczęły również\r\n            wieloletnią rywalizację\r\n            technologiczną i naukową, która doprowadziła do powstania takich projektów, jak Międzynarodowa Stacja\r\n            Kosmiczna (ISS) oraz współczesne misje marsjańskie. Podróż w kosmos, która zaczęła się od wysłania prostego\r\n            satelity, zmieniła sposób,\r\n            w jaki postrzegamy naszą planetę i wszechświat.\r\n        </p>\r\n        <p>Po wystrzeleniu Sputnika 1 przez ZSRR w 1957 roku, nastąpił wyścig kosmiczny, który zmienił oblicze\r\n            technologii i nauki. W odpowiedzi na wyzwanie rzucone przez Związek Radziecki, Stany Zjednoczone rozpoczęły\r\n            intensywne prace nad własnym programem\r\n            kosmicznym, co zaowocowało wieloma przełomowymi osiągnięciami. Program Mercury i Gemini W 1961 roku\r\n            amerykański astronauta Alan Shepard stał się pierwszym człowiekiem w kosmosie, w ramach programu Mercury.\r\n            Mimo że jego lot trwał zaledwie\r\n            15 minut, był to znaczący krok w kierunku załogowych misji kosmicznych. Program Mercury skoncentrował się na\r\n            rozwoju technologii umożliwiającej bezpieczne loty załogowe i badania nad wpływem przestrzeni kosmicznej na\r\n            ludzki organizm.\r\n        </p>\r\n        <figure>\r\n            <img src=\"img/gemini.jpg\">\r\n            <figcaption>Statek Gemini 6</figcaption>\r\n        </figure>\r\n        <p>Kolejnym etapem był program Gemini, który trwał od 1965 do 1966 roku. Umożliwił on astronautom przebywanie w\r\n            kosmosie przez dłuższy czas, a także przeprowadzenie skomplikowanych manewrów, takich jak dokowanie i spacer\r\n            kosmiczny. Program ten\r\n            był kluczowym krokiem w przygotowaniach do lądowania na Księżycu.</p>\r\n    </div>\r\n</div>\r\n<div class=\"forward\">\r\n    <a href=\"index.php?idp=kontynuacja\">Podbój kosmosu - Kontynuacja ➔ </a>\r\n</div>', 1),
(4, 'coprzed.html', '<div class=\"main\">\r\n    <div class=\"text-box\">\r\n        <h1>Co przed nami?</h1>\r\n        <p>Eksploracja Marsa i inne planety Po podboju Księżyca, agencje kosmiczne na całym świecie zwróciły swoją uwagę\r\n            na Marsa oraz inne ciała niebieskie w Układzie Słonecznym. Programy takie jak Mars Rovers (Spirit,\r\n            Opportunity, Curiosity) dostarczyły\r\n            niezrównanych informacji na temat geologii i klimatu Marsa, a także poszukiwań śladów życia. W 2015 roku,\r\n            misja New Horizons zbliżyła się do Plutona, dostarczając niespotykane dotąd zdjęcia i dane o tym odległym\r\n            ciele niebieskim. To wydarzenie\r\n            otworzyło nowy rozdział w badaniach Kuipera i obiektów transneptunowych.\r\n        <figure>\r\n            <img\r\n                src=\"https://v.wpimg.pl/ZTk0NTZhdTUKUjhndRN4IEkKbD0zSnZ2HhJ0dnVeaGATHyg9Ng0oMRtfYDMoHSo1HEBgJDZHOyQCHzhldQwzJxtcLy11DTc2DlRhYGNQaGBbBXp5OQ5jNUYEfjJpRWMyWAZjbWJaYzFSBHtiOw1odhY\">\r\n            <figcaption>Lot kosmiczny</figcaption>\r\n        </figure>\r\n        <p>Ostatnie lata przyniosły nową erę eksploracji kosmosu, zwaną erą komercyjnych lotów kosmicznych. Firmy takie\r\n            jak SpaceX, Blue Origin i Virgin Galactic zrewolucjonizowały przemysł kosmiczny, wprowadzając prywatne loty\r\n            kosmiczne i transport\r\n            ładunków na Międzynarodową Stację Kosmiczną (ISS). W 2021 roku SpaceX zrealizował misję Inspiration4, która\r\n            była pierwszą całkowicie cywilną misją na orbitę. Pokazało to, że eksploracja kosmosu staje się dostępna dla\r\n            szerszej grupy\r\n            ludzi, a nie tylko dla astronautów wybranych przez agencje rządowe.\r\n        </p>\r\n        <p>Przyszłość eksploracji kosmosu zapowiada się niezwykle ekscytująco, z wieloma nowymi misjami i projektami,\r\n            które mają na celu przekroczenie dotychczasowych granic ludzkiej wiedzy i możliwości technologicznych. Po\r\n            ponad 50 latach od ostatniej\r\n            misji Apollo, NASA planuje powrót człowieka na Księżyc w ramach programu Artemis. Celem programu,\r\n            realizowanego we współpracy z międzynarodowymi partnerami, jest nie tylko powrót na powierzchnię Księżyca,\r\n            ale także ustanowienie tam\r\n            stałej bazy, która będzie służyła jako punkt wypadowy do dalszej eksploracji, w tym przyszłych misji na\r\n            Marsa. Artemis I (bezzałogowy test rakiety SLS) odbył się w 2022 roku, a Artemis II (załogowy lot wokół\r\n            Księżyca) planowany jest\r\n            na 2024 rok. Artemis III, zaplanowany na około 2025 rok, przewiduje lądowanie astronautów na powierzchni\r\n            Księżyca, w tym pierwszej kobiety i osoby o innym kolorze skóry. Baza księżycowa może powstać na biegunie\r\n            południowym Księżyca,\r\n            gdzie znajdują się zasoby lodu wodnego.\r\n        </p>\r\n        <figure>\r\n            <img\r\n                src=\"https://v.wpimg.pl/OTVmOTY0YDU3DzlndkttIHRXbT0wEmN2I091dnYHd2AuQik9NVU9MSYCYTMrRT81IR1hJDUfLiQ_QjlldlQmJyYBLi12VSI2MwlgNTsCfGFmWXx5a1V6ZHtZLDFgHS4xM11iN24FeG1jC3ZibQcqdis\">\r\n            <figcaption>Elon Musk</figcaption>\r\n        </figure>\r\n        <p>Mars to kolejny wielki cel ludzkości w kosmosie. NASA, SpaceX, oraz inne organizacje planują załogowe misje\r\n            na Czerwoną Planetę w ciągu najbliższych dekad. NASA rozwija technologie potrzebne do bezpiecznego lądowania\r\n            i przetrwania na Marsie,\r\n            w tym systemy podtrzymywania życia i transportu. SpaceX, firma Elona Muska, pracuje nad rakietą Starship,\r\n            która ma umożliwić przewożenie ludzi i ładunków na Marsa. Elon Musk planuje pierwsze załogowe misje na Marsa\r\n            na lata 30. XXI\r\n            wieku, a jego ostatecznym celem jest stworzenie samowystarczalnej kolonii marsjańskiej. Długoterminowy plan\r\n            zakłada zbadanie możliwości terraformacji Marsa, co mogłoby w przyszłości umożliwić życie ludzkie w bardziej\r\n            przyjaznych warunkach.</p>\r\n    </div>\r\n</div>\r\n<div class=\"forward\">\r\n    <a href=\"index.php?idp=sklep\">Sklep z akcesoriami ➔ </a>\r\n</div>', 1),
(5, 'kontynuacja.html', '<div class=\"main\">\r\n    <div class=\"text-box\">\r\n        <h1>Kontynuacja podboju kosmosu</h1>\r\n        <p>Po zakończeniu programu Gemini, który był kluczowym etapem przygotowującym Stany Zjednoczone do załogowych\r\n            lotów na Księżyc, amerykańska agencja NASA rozpoczęła swój najbardziej ambitny projekt w historii – program\r\n            Apollo. To właśnie program\r\n            Apollo zdefiniował kolejne kroki ludzkości w podboju kosmosu, otwierając nową erę eksploracji kosmicznej.\r\n        </p>\r\n        <figure>\r\n            <img src=\"img/saturn.jpg\">\r\n            <figcaption>Saturn 1</figcaption>\r\n        </figure>\r\n        <p>Program został opracowany w 1961 roku na zlecenie NASA. Zakładał, że pierwsze lądowanie człowieka na Księżycu\r\n            powinno nastąpić w latach 1968–1970. Przed przystąpieniem do jego realizacji przeprowadzono szerokie badania\r\n            powierzchni Księżyca\r\n            i jego otoczenia za pomocą sond księżycowych: Ranger, Surveyor i satelitów Księżyca – Lunar Orbiter. Program\r\n            Apollo był trzecim (po programie Mercury oraz programie Gemini) programem amerykańskich lotów kosmicznych z\r\n            udziałem ludzi. Apollo\r\n            został zlecony przez administrację prezydenta Eisenhowera w celu rozszerzenia załogowych lotów kosmicznych\r\n            rozpoczętych przez program Mercury. Następnie został przeobrażony przez prezydenta Kennedy’ego w program\r\n            lotów i lądowania na Księżycu.\r\n            Jest znamienne, że NASA umieściła w przestrzeni kosmicznej pierwszy prototyp statku Apollo już w 36 miesięcy\r\n            po prezydenckim przemówieniu, które miało miejsce w maju 1961 roku. Intensywny program lotów\r\n            doświadczalnych, prowadzący do lądowania\r\n            astronautów na powierzchni Księżyca, trwał od sierpnia 1963 do lipca 1969 roku. Całość, określoną jako\r\n            Apollo-Saturn, rozpoczął lot Little Joe II QTV, kiedy po raz pierwszy przetestowano kapsułę o kształcie\r\n            przypominającym statek Apollo.\r\n            Zakończenie projektu to lot Apollo 10, w trakcie którego selenonauci mieli okazję spojrzeć na Księżyc z\r\n            odległości około 15 km. Loty statku Apollo były poprzedzone testami rakiet Saturn. Pierwsza wersja rakiety\r\n            nośnej, stworzonej przez\r\n            Wernhera von Brauna, nosiła nazwę Saturn I. Rakieta miała wysokość 49 metrów i wytwarzała ciąg 600 ton. 27\r\n            października 1961 SA-1 zatoczyła łuk nad Atlantykiem. Lot suborbitalny wyniósł rakietę na wysokość 136\r\n            kilometrów i odległość 330\r\n            kilometrów od miejsca startu. Ładunkiem rakiety była tym razem aerodynamiczna osłona, która niczego nie\r\n            osłaniała\r\n        </p>\r\n        <p>Apollo 11, misja NASA, która miała miejsce w lipcu 1969 roku, była zwieńczeniem wysiłków w ramach\r\n            amerykańskiego programu Apollo. Neil Armstrong i Edwin \"Buzz\" Aldrin jako pierwsi ludzie postawili stopę na\r\n            Księżycu, podczas gdy Michael Collins\r\n            krążył wokół niego w module dowodzenia. Słynne słowa Armstronga „To mały krok dla człowieka, ale ogromny\r\n            skok dla ludzkości” podsumowały nie tylko ten moment, ale i całą erę odkryć kosmicznych. Misja Apollo 11\r\n            była monumentalnym osiągnięciem,\r\n            które zainspirowało kolejne pokolenia. Po tym wydarzeniu nastąpiły kolejne misje Apollo, które zbadały\r\n            Księżyc i przyniosły na Ziemię cenne próbki, przyczyniając się do naszego zrozumienia tego ciała\r\n            niebieskiego.\r\n        </p>\r\n        <figure>\r\n            <img src=\"img/czl.jpg\">\r\n            <figcaption>Członkowie załogi Apollo 11</figcaption>\r\n        </figure>\r\n        <p>Po starcie rakieta Saturn V ze statkiem Apollo wynosi astronautów na niską orbitę okołoziemską (LEO).\r\n            Pierwszy i drugi stopień po wykonaniu zadania spadają na Ziemię (spalają się w atmosferze). Trzeci stopień\r\n            wprowadza zestaw na kołową orbitę\r\n            na wysokości około 184 kilometrów. Na tej orbicie Apollo pozostaje na jedno lub dwa okrążenia. Czas ten\r\n            zostaje wykorzystany dla dokładnego wyznaczenia parametrów ruchu i w oparciu o nie, danych do powtórnego\r\n            jego zapłonu, mającego na\r\n            celu skierowanie statku ku Księżycowi. Powtórne działanie silnika trwa około 350 sekund i zwiększa prędkość\r\n            do około 10,9 km/s. Taki dwustopniowy odlot od Ziemi, powszechnie dziś stosowany w astronautyce, pozwala na\r\n            uzyskanie zaplanowanej\r\n            prędkości i kierunku lotu z dużo większą precyzją niż byłoby to możliwe w przypadku odlotu jednoetapowego.\r\n            Astronauci obracają statek Apollo i po połączeniu z modułem księżycowym odrzucają trzeci człon (S-IVB)\r\n            rakiety nośnej, który zostaje\r\n            wprowadzony na orbitę okołosłoneczną lub skierowany w stronę Księżyca – rozbija się o jego powierzchnię. Od\r\n            tej chwili rozpoczyna się samodzielny lot zespołu Apollo LM w kierunku Księżyca. W czasie trwania tego lotu,\r\n            zarówno obsługa naziemna\r\n            jak i selenonauci kontrolują parametry ruchu. W razie konieczności astronauci wykonują korekty przy pomocy\r\n            głównego silnika członu serwisowego lub przy pomocy 16 silniczków orientacyjno-korekcyjnych. Kierunek lotu\r\n            jest regulowany w ten\r\n            sposób, aby statek przeleciał obok Księżyca. W trakcie oddalania się od Ziemi prędkość statku maleje. Po\r\n            wlocie statku w obszar oddziaływania Księżyca (z prędkością około 1 km/s) prędkość zaczyna wzrastać pod\r\n            wpływem przeważającej obecnie\r\n            siły ciążenia Księżyca</p>\r\n    </div>\r\n</div>\r\n<div class=\"forward\">\r\n    <a href=\"index.php?idp=coprzed\">Co przed nami? ➔ </a>\r\n</div>', 1),
(6, 'sklep.html', '<div class=\"main_shop\">\r\n<h1>Sklep z akcesoriami</h1>\r\n\r\n', 1),
(7, 'kontakt.html', '<!DOCTYPE html>\r\n<html lang=\"pl\">\r\n<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <title>Formularz kontaktowy</title>\r\n</head>\r\n<body>\r\n    <div class=\"main_form\">\r\n        <h1>Skontaktuj się z nami</h1>\r\n        <div class=\"formularz\">\r\n            <form action=\"contact.php\" method=\"POST\">\r\n                <input type=\"email\" name=\"email\" placeholder=\"Adres E-mail\" required><br>\r\n                <input type=\"text\" name=\"subject\" placeholder=\"Temat\" required><br>\r\n                <textarea name=\"message\" rows=\"5\" placeholder=\"Wiadomość\" required></textarea><br>\r\n                <input type=\"submit\" name=\"submitContact\" value=\"Wyślij\">\r\n            </form>\r\n            <form action=\"contact.php\" method=\"POST\">\r\n                <label for \"password_email\">Zapomniales hasla? Wyslemy je na tego maila.</label>\r\n                <input type=\"email\" id=\"password_email\" name=\"password_email\" placeholder=\"Adres E-mail\" required><br>\r\n                <input type=\"submit\" name=\"sendPassword\" value=\"Wyślij\">\r\n             </form>\r\n        </div>\r\n    </div>\r\n</body>\r\n</html>\r\n\r\n\r\n', 1),
(8, 'filmy.html', '<div class=\"filmy\">\r\n    <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/OnoNITE-CLc?si=D2lgf3fr-JMyYbKZ\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>\r\n    <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/b28zbsnk-48?si=TJC02-oUn_9MrWhf\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>\r\n    <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/7_SNFrTr_oo?si=wJjSKBT313qeVBAy\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>\r\n</div>\r\n', 1),
(9, 'admin', '<body>\r\n<h1>SDD</h1>\r\n</body>', 1),
(12, 'test', 'test', 1),
(13, 'koszyk.html', '<div class=\"main_shop\">\r\n<h1>Koszyk</h1>\r\n\r\n', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `tytul` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `opis` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `data_utworzenia` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_modyfikacji` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `data_wygasniecia` timestamp NULL DEFAULT NULL,
  `cena_netto` float NOT NULL,
  `podatek_vat` float NOT NULL,
  `ilosc` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `kategoria_id` int(11) NOT NULL,
  `gabaryt` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `zdjecie` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`id`, `tytul`, `opis`, `data_utworzenia`, `data_modyfikacji`, `data_wygasniecia`, `cena_netto`, `podatek_vat`, `ilosc`, `status`, `kategoria_id`, `gabaryt`, `zdjecie`) VALUES
(6, 'kubek kosmos', 'fajny kubek', '2024-12-27 19:27:47', '2024-12-27 20:22:32', '2030-02-25 23:00:00', 45, 8, 55, 1, 4, '5x5cm, 200gram', 'kubek.jpg'),
(8, 'koszulka kosmiczna', 'fajna ni', '2024-12-27 20:24:50', '2024-12-27 20:24:50', '2030-02-24 23:00:00', 100, 23, 55, 1, 5, 'XL', 'koszulka.jpg'),
(10, 'kubek2', 'tes', '2024-12-27 20:34:14', '2024-12-27 20:34:14', '2030-02-24 23:00:00', 45, 23, 24, 1, 5, '22', 'koszulka.jpg'),
(11, 'kubek2', 'tes', '2024-12-27 20:34:17', '2024-12-27 20:34:17', '2030-02-24 23:00:00', 45, 23, 24, 1, 5, '22', 'koszulka.jpg'),
(12, 'kubek2', 'tes', '2024-12-27 20:34:19', '2024-12-27 20:34:19', '2030-02-24 23:00:00', 45, 23, 24, 1, 5, '22', 'koszulka.jpg'),
(13, 'kubek2', 'tes', '2024-12-27 20:34:20', '2024-12-27 20:34:20', '2030-02-24 23:00:00', 45, 23, 24, 1, 5, '22', 'koszulka.jpg'),
(14, 'kubek2', 'tes', '2024-12-27 20:34:21', '2024-12-27 20:34:21', '2030-02-24 23:00:00', 45, 23, 24, 1, 5, '22', 'koszulka.jpg');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `page_list`
--
ALTER TABLE `page_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kategoria` (`kategoria_id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `page_list`
--
ALTER TABLE `page_list`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD CONSTRAINT `fk_kategoria` FOREIGN KEY (`kategoria_id`) REFERENCES `kategorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
