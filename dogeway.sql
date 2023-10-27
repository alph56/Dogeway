-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-10-2023 a las 04:54:25
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
-- Base de datos: `dogeway`
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
  `ine` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `email`, `codigo_verificacion`, `verificado`, `pass`, `curp`, `telefono`, `nickname`, `apellidos`, `municipio`, `fechanac`, `fotografia`, `ine`) VALUES
(16, 'Danilo', 'esequien333@gmail.com', 'c229261ba37fa20748996bca0a7cb670', 1, '123', 'sdfsdfssfsdfsd', '+528715243308', 'DanCatFly', 'Juarez Silva', '54231', '2003-02-12', '', ''),
(17, 'fsdfsd', 'daniel.juarez0204@alumnos.udg.mx', '1a2e2f95725b57b0fe9b4c42ceb9a50d', 0, '123', '312312312', '+528715243308', 'samnette', 'fsdfsdfs', '312312', '2003-02-12', '', ''),
(27, 'Daniel Antonio', 'dangatovolador@gmail.com', 'f95ae455e52ed86f571427d89b1c566d', 1, '123', '543543', '+528715243308', 'tumama', 'Juarez Silva', '432423423', '2003-02-12', '', 'ineunico');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
