-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 13, 2023 at 06:57 PM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int NOT NULL,
  `admin_jmeno` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `admin_email` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `admin_heslo` varchar(60) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_jmeno`, `admin_email`, `admin_heslo`) VALUES
(2, 'Honza Pliska', 'janpliska@outlook.cz', '$2y$10$RbJ/vNiKvipGhzcldenTj.qP.nT3pNp/kUNBaxKuXzX2ctgJUBZum');

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
  `produkt_cena` decimal(8,2) NOT NULL,
  `produkt_pocet` int NOT NULL,
  `uziv_id` int NOT NULL,
  `obj_datum` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `objednavky`
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

-- --------------------------------------------------------

--
-- Table structure for table `platby`
--

CREATE TABLE `platby` (
  `platba_id` int NOT NULL,
  `obj_id` int NOT NULL,
  `uziv_id` int NOT NULL,
  `transakce_id` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `platba_datum` datetime NOT NULL
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
  `produkt_cena` decimal(10,2) NOT NULL,
  `produkt_spec_nab` int NOT NULL,
  `produkt_barva` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `objednavkaprod`
--
ALTER TABLE `objednavkaprod`
  MODIFY `polozka_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `objednavky`
--
ALTER TABLE `objednavky`
  MODIFY `obj_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `platby`
--
ALTER TABLE `platby`
  MODIFY `platba_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produkty`
--
ALTER TABLE `produkty`
  MODIFY `produkt_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `uzivatele`
--
ALTER TABLE `uzivatele`
  MODIFY `uziv_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
