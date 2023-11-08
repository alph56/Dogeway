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
--GRANT ALL PRIVILIEGES ON dogeway.* TO 'root'@'localhost' IDENTIFIED BY 'root';--Comando para otorgar todos los permisos a un usuario
--Desde consola

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
  foreign key(`dato_match`) references matchs(`amistad`, `cruza`, `adopcion`)
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
  `razon` varchar(255) NOT NULL,
  `ban` TINYINT(1) NOT null default 0,
  FOREIGN KEY(`ban`) REFERENCES usuario(`verificado`),
  FOREIGN KEY(`id_bloquear`) REFERENCES usuario(`id`),
  FOREIGN KEY(`id_bloqueado`) REFERENCES usuario(`id`),
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

