-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2023 at 09:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dogeway`
--

-- --------------------------------------------------------

--
-- Table structure for table `mascota`
--

CREATE TABLE `mascota` (
  `id` int(11) NOT NULL,
  `nombreMascota` varchar(32) NOT NULL,
  `nicknameUsuario` varchar(32) NOT NULL,
  `descripcion` varchar(128) NOT NULL,
  `raza` varchar(40) NOT NULL,
  `edad` int(11) NOT NULL,
  `cartilla` varchar(128) NOT NULL,
  `especificaciones` varchar(256) NOT NULL,
  `fotografiaMascota` varchar(128) NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `id_dueno` int(11) NOT NULL,
  foreign kEY(`nicknameUsuario`) references usuario(`nickname`),
  foreign KEY(`id_dueno`) REFERENCES usuario(`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `codigo_verificacion` varchar(32) NOT NULL,
  `verificado` tinyint(1) NOT NULL DEFAULT 0,
  `pass` varchar(50) NOT NULL,
  `curp` varchar(20) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `nickname` varchar(30) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `municipio` varchar(50) NOT NULL,
  `fechanac` date NOT NULL,
  `fotografia` text NOT NULL,
  `ine` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `email`, `codigo_verificacion`, `verificado`, `pass`, `curp`, `telefono`, `nickname`, `apellidos`, `municipio`, `fechanac`, `fotografia`, `ine`) VALUES
(27, 'Daniel Antonio', 'dangatovolador@gmail.com', 'f95ae455e52ed86f571427d89b1c566d', 1, '123', '543543', '+528715243308', 'tumama', 'Juarez Silva', '432423423', '2003-02-12', '', 'ineunico'),
(28, 'Samantha', 'moonly.uwu15@gmail.com', 'e8366e7cdefb1dfc0b1144f41de0c7cb', 1, '1235', 'ASDFGHJKL', '1234567890', 'samnette', 'Telles', 'Guadalajara', '2003-10-23', '', 'QWERTYUIOP');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mascota`
--
ALTER TABLE `mascota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE `matchs`(
  `amistad` TINYINT(1) DEFAULT 0,
  `cruza` TINYINT(1) DEFAULT 0,
  `adopcion` TINYINT(1) DEFAULT 0
);

CREATE TABLE `chat`(
  `nickname_persona1` varchar(30) NOT NULL,
  `nickname_persona2` varchar(30) NOT NULL,
  `mensaje` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `datos_match` TINYINT(1) NOT NULL,
  FOREIGN KEY(`datos_match`) REFERENCES matchs(`amistad`, `cruza`, `adopcion`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `bloquear`(
  `id_bloquear` int(11) NOT NULL,
  `id_bloqueado` int(11) NOT NULL,
  `fecha_bloqueo` date NOT NULL,
  `razon` text NOT NULL,
  `ban` TINYINT(1) NOT null default 0,
  FOREIGN KEY(`ban`) REFERENCES usuario(`verificado`),
  FOREIGN KEY(`id_bloquear`) REFERENCES usuario(`id`),
  FOREIGN KEY(`id_bloqueado`) REFERENCES usuario(`id`),
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;