-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 03, 2025 at 07:17 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zbiorkominfo_db`
--
CREATE DATABASE IF NOT EXISTS `zbiorkominfo_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci;
USE `zbiorkominfo_db`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pojazdy`
--

CREATE TABLE `pojazdy` (
  `line_id` int(11) NOT NULL,
  `line_number` text NOT NULL,
  `line_type` text NOT NULL,
  `vehicle_type` text NOT NULL,
  `vehicle_id` text NOT NULL,
  `vehicle_number` text NOT NULL,
  `vehicle_model` text NOT NULL,
  `vehicle_low_floor` tinyint(1) NOT NULL,
  `vehicle_ticket_machine_cards` tinyint(1) NOT NULL,
  `vehicle_ticket_machine_coins` tinyint(1) NOT NULL,
  `vehicle_operator` text NOT NULL,
  `route_variant_number` int(11) NOT NULL,
  `service` text NOT NULL,
  `direction` text NOT NULL,
  `previous_stop` text NOT NULL,
  `next_stop` text NOT NULL,
  `latitude` float NOT NULL,
  `longtitude` float NOT NULL,
  `bearing` int(11) NOT NULL,
  `velocity` float NOT NULL,
  `punctuality` int(11) NOT NULL,
  `update_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
