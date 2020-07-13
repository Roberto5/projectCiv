-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Lug 13, 2020 alle 12:29
-- Versione del server: 8.0.20-0ubuntu0.20.04.1
-- Versione PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectCiv`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('87nfcg6h44v4nmeud06cvut3vpi8rjel', '::1', 1594551494, '__ci_last_regenerate|i:1594551494;user|s:4:\"test\";_ci_previous_url|s:48:\"http://localhost/eclipse/projectCiv/public/login\";'),
('na90v64el7ov6mrfg4urrutafd5vim6r', '::1', 1594551494, '__ci_last_regenerate|i:1594551494;user|s:4:\"test\";_ci_previous_url|s:43:\"http://localhost/eclipse/projectCiv/public/\";'),
('1iopjaeto5fq5gsskigmfnh7gsuvvs3a', '::1', 1594629831, '__ci_last_regenerate|i:1594629831;_ci_previous_url|s:43:\"http://localhost/eclipse/projectCiv/public/\";user|s:4:\"test\";'),
('tpresl2tc807m2e6uv7vkpqo2b9i6p5t', '::1', 1594634364, '__ci_last_regenerate|i:1594634364;_ci_previous_url|s:43:\"http://localhost/eclipse/projectCiv/public/\";user|s:4:\"test\";'),
('aiff4b69b1bm87k8ua9mhhi6a500blbn', '::1', 1594634896, '__ci_last_regenerate|i:1594634896;_ci_previous_url|s:48:\"http://localhost/eclipse/projectCiv/public/login\";user|s:4:\"test\";'),
('fkgnpg5lulpgd52ur10u7tq16os0av9f', '::1', 1594635337, '__ci_last_regenerate|i:1594635337;_ci_previous_url|s:48:\"http://localhost/eclipse/projectCiv/public/login\";user|s:4:\"test\";'),
('ck2l9v1donk930tk1j4di6d4sbi3nioe', '::1', 1594635338, '__ci_last_regenerate|i:1594635337;_ci_previous_url|s:48:\"http://localhost/eclipse/projectCiv/public/login\";user|s:4:\"test\";');

-- --------------------------------------------------------

--
-- Struttura della tabella `pc_users`
--

CREATE TABLE IF NOT EXISTS `pc_users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `pc_users`
--

INSERT INTO `pc_users` (`id`, `user`, `password`) VALUES
(1, 'hitmanghe', '36651c335915b02cdc3e455769ba78bc'),
(2, 'test', '0fe4f43e1dd173abc07ce508a74800e2');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
