-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2023 a las 03:32:18
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
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE `mascota` (
  `id` int(11) NOT NULL,
  `nombreMascota` varchar(32) NOT NULL,
  `descripcion` varchar(128) NOT NULL,
  `especie` varchar(32) NOT NULL,
  `raza` varchar(40) NOT NULL,
  `edad` int(11) NOT NULL,
  `cartilla` varchar(128) NOT NULL,
  `especificaciones` varchar(256) NOT NULL,
  `caracteristicas` varchar(256) NOT NULL,
  `fotografiaMascota` varchar(128) NOT NULL,
  `archivo_m` varchar(128) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT 1,
  `situacion` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `fotografia` varchar(128) NOT NULL,
  `archivo_n` varchar(128) NOT NULL,
  `ine` text NOT NULL,
  `admin` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `email`, `codigo_verificacion`, `verificado`, `pass`, `curp`, `telefono`, `nickname`, `apellidos`, `municipio`, `fechanac`, `fotografia`, `archivo_n`, `ine`, `admin`) VALUES
(50, 'Daniel Antonio', 'esequien333@gmail.com', '6e5400def35b38c2a91f18dab7b0e7e9', 1, '202cb962ac59075b964b07152d234b70', 'JUSD030212HCLRLNA4', '8715243308', 'DanCatFly', 'Juarez Silva', 'Guadalajara', '2003-02-12', 'f5931efe62aee7519a49676cb36ece32.jpg', 'communityIcon_y44umx9mwy041.jpg', 'JRSLDN03021205H600', 0),
(51, 'Laura Samantha', 'androlausam2@gmail.com', '9f77720ef7b5122aabf45b49dd1266c6', 1, '0cdfb256110772e88c21ddf94ee6f1ba', 'TEGL031023MJCLRRA1', '3310766433', 'samnette', 'Telles Gordillo', 'Guadalajara', '2003-10-23', 'd06f547c157893df34569aa4ca374099.jpg', 'miyamurita.jpg', 'LSEGNM03021205M700', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD CONSTRAINT `mascota_ibfk_1` FOREIGN KEY (`id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
