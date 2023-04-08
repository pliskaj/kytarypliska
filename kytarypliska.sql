-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost:3306
-- Vytvořeno: Sob 08. dub 2023, 10:07
-- Verze serveru: 8.0.30
-- Verze PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `kytarypliska`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `objednavkaprod`
--

CREATE TABLE `objednavkaprod` (
  `polozka_id` int NOT NULL,
  `obj_id` int NOT NULL,
  `produkt_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `produkt_jmeno` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `produkt_fotka` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `produkt_cena` decimal(8,2) NOT NULL,
  `produkt_pocet` int NOT NULL,
  `uziv_id` int NOT NULL,
  `obj_datum` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `objednavkaprod`
--

INSERT INTO `objednavkaprod` (`polozka_id`, `obj_id`, `produkt_id`, `produkt_jmeno`, `produkt_fotka`, `produkt_cena`, `produkt_pocet`, `uziv_id`, `obj_datum`) VALUES
(7, 19, '100', 'Washburn 3OK1]', 'wsh1.jpg', 155.00, 1, 1, '2023-04-07 15:55:26'),
(8, 20, '2', 'Yamaha 103H', 'yam1.jpg', 3000.00, 2, 1, '2023-04-07 16:04:37'),
(9, 21, '4', 'Fender Quos', 'Fender1.jpg', 9000.00, 1, 1, '2023-04-07 17:56:05'),
(10, 22, '3', 'Marti 8xC', 'martin1.jpg', 6000.00, 5, 1, '2023-04-07 20:02:27'),
(11, 23, '3', 'Marti 8xC', 'martin1.jpg', 6000.00, 5, 1, '2023-04-07 20:52:50'),
(12, 24, '4', 'Fender Quos', 'Fender1.jpg', 9000.00, 4, 7, '2023-04-08 07:25:40'),
(13, 24, '2', 'Yamaha 103H', 'yam1.jpg', 3000.00, 1, 7, '2023-04-08 07:25:40');

-- --------------------------------------------------------

--
-- Struktura tabulky `objednavky`
--

CREATE TABLE `objednavky` (
  `obj_id` int NOT NULL,
  `obj_cena` decimal(8,2) NOT NULL,
  `obj_status` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pozastaveno',
  `uziv_id` int NOT NULL,
  `uziv_tel` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `uziv_mesto` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `uziv_adresa` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `obj_datum` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `objednavky`
--

INSERT INTO `objednavky` (`obj_id`, `obj_cena`, `obj_status`, `uziv_id`, `uziv_tel`, `uziv_mesto`, `uziv_adresa`, `obj_datum`) VALUES
(19, 155.00, 'Zaplaceno', 1, '745958945', 'Ústí nad Labem', 'Nymburk, Postelova 12', '2023-04-07 15:55:26'),
(20, 6000.00, 'Zaplaceno', 1, '745958945', 'Ústí nad Labem', 'Nymburk, Postelova 12', '2023-04-07 16:04:37'),
(21, 9000.00, 'Nezaplaceno', 1, '745958945', 'Ústí nad Labem', 'Nymburk, Postelova 12', '2023-04-07 17:56:05'),
(22, 30000.00, 'Zaplaceno', 1, '745958945', 'Nymburk', 'Nymburk, Postelova 12', '2023-04-07 20:02:27'),
(23, 30000.00, 'Zaplaceno', 1, '745958945', 'Ústí nad Labem', 'Nymburk, Postelova 12', '2023-04-07 20:52:50'),
(24, 39000.00, 'Zaplaceno', 7, '727911844', 'Nurimberk', 'Nurimberk, Poststahl 13', '2023-04-08 07:25:40');

-- --------------------------------------------------------

--
-- Struktura tabulky `platby`
--

CREATE TABLE `platby` (
  `platba_id` int NOT NULL,
  `obj_id` int NOT NULL,
  `uziv_id` int NOT NULL,
  `transakce_id` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `platba_datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `platby`
--

INSERT INTO `platby` (`platba_id`, `obj_id`, `uziv_id`, `transakce_id`, `platba_datum`) VALUES
(1, 24, 7, '5Y495088L4766854E', '2023-04-08 07:43:05');

-- --------------------------------------------------------

--
-- Struktura tabulky `produkty`
--

CREATE TABLE `produkty` (
  `produkt_id` int NOT NULL,
  `produkt_jmeno` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `produkt_kateg` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `produkt_popis` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `produkt_fotka` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `produkt_fotka2` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `produkt_fotka3` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `produkt_fotka4` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `produkt_cena` decimal(6,2) NOT NULL,
  `produkt_spec_nab` int NOT NULL,
  `produkt_barva` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `produkty`
--

INSERT INTO `produkty` (`produkt_id`, `produkt_jmeno`, `produkt_kateg`, `produkt_popis`, `produkt_fotka`, `produkt_fotka2`, `produkt_fotka3`, `produkt_fotka4`, `produkt_cena`, `produkt_spec_nab`, `produkt_barva`) VALUES
(2, 'Yamaha 103H', 'akustika', 'Akustická kytara značky Yamaha 103H', 'yam1.jpg', 'yam2.jpg', 'yam3.jpg', 'yam4.jpg', 3000.00, 0, 'Hnědá]'),
(3, 'Marti 8xC', 'poloakustika', 'Elektroakustická kytara od Martin', 'martin1.jpg', 'martin1.jpg', 'martin2.jpg', 'martin3.jpg', 6000.00, 0, 'světle modrá'),
(4, 'Fender Quos', 'basa-elektrika', '4 struná elektrická basa', 'Fender1.jpg', 'Fender2.jpg', 'Fender3.jpg', 'Fender4.jpg', 9000.00, 0, 'Modrá'),
(100, 'Washburn 3OK1]', 'akustika', 'Kytara značky Washburn s označením 3OK1', 'wsh1.jpg', 'wsh2.jpg', 'wsh3.jpg', 'wsh4.jpg', 155.00, 0, 'hnědá');

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatele`
--

CREATE TABLE `uzivatele` (
  `uziv_id` int NOT NULL,
  `uziv_jmeno` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `uziv_email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `uziv_heslo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `uzivatele`
--

INSERT INTO `uzivatele` (`uziv_id`, `uziv_jmeno`, `uziv_email`, `uziv_heslo`) VALUES
(1, 'Teodor Nykiel', 'teo@teo.cz', '$2y$10$WCfDWB5ts5mHZE7B5f1/qOd3NJi7gglwtO15wY7ttCrtGLSY8TX5a'),
(6, 'Filip Vopat', 'fil.vopat@gmail.com', '$2y$10$ABpeDB/.Za0dSF3tf7uvW.JWUY2Zcg4EiEt43o0HZkzVc0XEkxb/m'),
(7, 'Jan Pliska', 'pliskaj@test.cz', '$2y$10$wE57Y2Qu7ryfJ2SSGVrXw.vSfDIRd.UMEymC19mmVOdYP/FOJ0K4S');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `objednavkaprod`
--
ALTER TABLE `objednavkaprod`
  ADD PRIMARY KEY (`polozka_id`);

--
-- Indexy pro tabulku `objednavky`
--
ALTER TABLE `objednavky`
  ADD PRIMARY KEY (`obj_id`);

--
-- Indexy pro tabulku `platby`
--
ALTER TABLE `platby`
  ADD PRIMARY KEY (`platba_id`);

--
-- Indexy pro tabulku `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`produkt_id`);

--
-- Indexy pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  ADD PRIMARY KEY (`uziv_id`),
  ADD UNIQUE KEY `UX_Constraint` (`uziv_email`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `objednavkaprod`
--
ALTER TABLE `objednavkaprod`
  MODIFY `polozka_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pro tabulku `objednavky`
--
ALTER TABLE `objednavky`
  MODIFY `obj_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pro tabulku `platby`
--
ALTER TABLE `platby`
  MODIFY `platba_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pro tabulku `produkty`
--
ALTER TABLE `produkty`
  MODIFY `produkt_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  MODIFY `uziv_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
