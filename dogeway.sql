-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2023 a las 03:45:48
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mascota`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
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
  `ine` text NOT NULL,
  `dato_match` TINYINT(1) NOT NULL,
  foreign key(`dato_match`) references match(`amistad`, `cruza`, `adopcion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE `mascota`(
  `caract_fisicas` varchar(255) NOT NULL,
  `nickname_dueno` varchar(30) NOT NULL,
  `nombre_mascota` varchar(30) NOT NULL,
  `status_salud` varchar(150) NOT NULL,
  `edad` int(3) NOT NULL,
  `raza` varchar(50) NOT NULL,
  `id_dueno` int(11) NOT NULL,
  `fotografia_masc` text NOT NULL,
  foreign kEY(`nickname_dueno`) references usuario(`nickname`),
  foreign KEY(`id_dueno`) REFERENCES usuario(`id`) 
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `match`(
  TINYINT(1) DEFAULT 0,
  `cruza` TINYINT(1) DEFAULT 0,
  `adopcion` TINYINT(1) DEFAULT 0
);

CREATE TABLE `chat`(
  `nickname_persona1` varchar(30) NOT NULL,
  `nickname_persona2` varchar(30) NOT NULL,
  `mensaje` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `datos_match` TINYINT(1) NOT NULL,
  FOREIGN KEY(`datos_match`) REFERENCES match(`amistad`, `cruza`, `adopcion`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;