-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 17, 2023 at 05:26 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kytarypliska`
--

-- --------------------------------------------------------

--
-- Table structure for table `objednavkaprod`
--

CREATE TABLE `objednavkaprod` (
  `polozka_id` int NOT NULL,
  `obj_id` int NOT NULL,
  `produkt_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `produkt_jmeno` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `produkt_fotka` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `uziv_id` int NOT NULL,
  `obj_datum` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `objednavky`
--

CREATE TABLE `objednavky` (
  `obj_id` int NOT NULL,
  `obj_cena` decimal(6,2) NOT NULL,
  `obj_status` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pozastaveno',
  `uziv_id` int NOT NULL,
  `uziv_tel` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `uziv_mesto` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `uziv_adresa` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `obj_datum` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `objednavky`
--

INSERT INTO `objednavky` (`obj_id`, `obj_cena`, `obj_status`, `uziv_id`, `uziv_tel`, `uziv_mesto`, `uziv_adresa`, `obj_datum`) VALUES
(1, '3000.00', 'Ve zpracovani', 1, '420727911844', 'Ústí nad Labem', 'Olšinky 510', '2023-01-17 15:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `platby`
--

CREATE TABLE `platby` (
  `platba_id` int NOT NULL,
  `obj_id` int NOT NULL,
  `uziv_id` int NOT NULL,
  `transakce_id` varchar(250) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produkty`
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
-- Dumping data for table `produkty`
--

INSERT INTO `produkty` (`produkt_id`, `produkt_jmeno`, `produkt_kateg`, `produkt_popis`, `produkt_fotka`, `produkt_fotka2`, `produkt_fotka3`, `produkt_fotka4`, `produkt_cena`, `produkt_spec_nab`, `produkt_barva`) VALUES
(2, 'Yamaha 103H', 'akustika', 'Akustická kytara značky Yamaha 103H', 'yam1.jpg', 'yam2.jpg', 'yam3.jpg', 'yam4.jpg', '3000.00', 0, 'Hnědá]'),
(3, 'Marti 8xC', 'poloakustika', 'Elektroakustická kytara od Martin', 'martin1.jpg', 'martin1.jpg', 'martin2.jpg', 'martin3.jpg', '6000.00', 0, 'světle modrá'),
(4, 'Fender Quos', 'basa-elektrika', '4 struná elektrická basa', 'Fender1.jpg', 'Fender2.jpg', 'Fender3.jpg', 'Fender4.jpg', '9000.00', 0, 'Modrá'),
(100, 'Washburn 3OK1]', 'akustika', 'Kytara značky Washburn s označením 3OK1', 'wsh1.jpg', 'wsh2.jpg', 'wsh3.jpg', 'wsh4.jpg', '155.00', 0, 'hnědá');

-- --------------------------------------------------------

--
-- Table structure for table `uzivatele`
--

CREATE TABLE `uzivatele` (
  `uziv_id` int NOT NULL,
  `uziv_jmeno` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `uziv_email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `uziv_heslo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `objednavkaprod`
--
ALTER TABLE `objednavkaprod`
  ADD PRIMARY KEY (`polozka_id`);

--
-- Indexes for table `objednavky`
--
ALTER TABLE `objednavky`
  ADD PRIMARY KEY (`obj_id`);

--
-- Indexes for table `platby`
--
ALTER TABLE `platby`
  ADD PRIMARY KEY (`platba_id`);

--
-- Indexes for table `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`produkt_id`);

--
-- Indexes for table `uzivatele`
--
ALTER TABLE `uzivatele`
  ADD PRIMARY KEY (`uziv_id`),
  ADD UNIQUE KEY `UX_Constraint` (`uziv_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `objednavkaprod`
--
ALTER TABLE `objednavkaprod`
  MODIFY `polozka_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `objednavky`
--
ALTER TABLE `objednavky`
  MODIFY `obj_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `platby`
--
ALTER TABLE `platby`
  MODIFY `platba_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produkty`
--
ALTER TABLE `produkty`
  MODIFY `produkt_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `uzivatele`
--
ALTER TABLE `uzivatele`
  MODIFY `uziv_id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
