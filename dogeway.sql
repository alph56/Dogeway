-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2023 a las 03:18:54
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

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
  `descripcion` text NOT NULL,
  `especie` varchar(32) NOT NULL,
  `raza` varchar(40) NOT NULL,
  `edad` int(11) NOT NULL,
  `cartilla` varchar(128) NOT NULL,
  `especificaciones` varchar(256) NOT NULL,
  `caracteristicas` varchar(256) NOT NULL,
  `fotografiaMascota` varchar(128) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT 1,
  `categoria` int(2) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`id`, `nombreMascota`, `descripcion`, `especie`, `raza`, `edad`, `cartilla`, `especificaciones`, `caracteristicas`, `fotografiaMascota`, `estatus`, `categoria`, `id_usuario`) VALUES
(1, 'Bebeuwu', 'Es jugueton, le gusta jugar con niños', '1', 'pitbull', 1, '5188bc92e46c57cca8d8c177ede9c646.jpg', 'ryzen 5, con 3 patas', 'es cafe', 'cc969ce2d8b9fa4f6eb71f6fb87f23c7.jpg', 1, 2, 50),
(2, 'Pancho', 'Es muy flojo pero chido', '2', 'Rayado', 1, '232989164976465ced2ba4b34c6c80e6.jpg', 'Sano', 'Gris con cafe', 'bdb71ebf5107dbec1d4a3bf2d2b303c9.jpg', 1, 1, 51),
(3, 'Pecesin', 'Naranja jugueton', '2', 'payaso', 3, 'b87c5e0cc82637cadf1c7d9fec6d02cf.jpg', 'sano', 'naranja', '5282bbeb4b692eaf668f71671df21f0a.jpg', 1, 2, 51);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `match`
--

CREATE TABLE `match` (
  `id1` int(11) NOT NULL,
  `id2` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `idmatch` int(11) NOT NULL
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
  `admin` int(2) NOT NULL DEFAULT 0,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `email`, `codigo_verificacion`, `verificado`, `pass`, `curp`, `telefono`, `nickname`, `apellidos`, `municipio`, `fechanac`, `fotografia`, `archivo_n`, `ine`, `admin`, `status`) VALUES
(50, 'Daniel', 'esequien333@gmail.com', '6e5400def35b38c2a91f18dab7b0e7e9', 1, '202cb962ac59075b964b07152d234b70', 'JUSD030212HCLRLNA4', '8715243308', 'DanCatFly', 'Juarez', 'Guadalajara', '2003-02-12', 'f5931efe62aee7519a49676cb36ece32.jpg', 'communityIcon_y44umx9mwy041.jpg', 'JRSLDN03021205H600', 0, 'Offline'),
(51, 'Samantha', 'androlausam2@gmail.com', '9f77720ef7b5122aabf45b49dd1266c6', 1, '0cdfb256110772e88c21ddf94ee6f1ba', 'TEGL031023MJCLRRA1', '3310766433', 'samnette', 'Telles', 'Guadalajara', '2003-10-23', 'd06f547c157893df34569aa4ca374099.jpg', 'miyamurita.jpg', 'LSEGNM03021205M700', 1, 'Offline'),
(52, 'Logan', 'alphc056@gmail.com', 'a616abf9d883b7ec31b4a6f259685ed4', 0, '622be4f47f555a3f8fc87d1d7cf31430', 'LXCA030811MJCPNLA0', '3324303048', 'alph56', 'Cuenca', 'Zapopan', '2003-08-11', 'ed7bbcb87ac9dbf04e3988a73bf81e17.png', 'Alphoto.png', 'LPCNAL03081114M000', 1, ''),
(53, 'Christian', 'cristiansillochavech@gmail.com', '97fda7f4e1bb04c48b022eb09f3d998b', 0, '827ccb0eea8a706c4c34a16891f84e7b', 'FFFF030404HJCVFFF8', '3334945085', 'Cris Ruvalcaba', 'Ruvalcava', 'Guadalajara', '2003-04-04', '47d9e075126125bd9f6b97850df044c6.jpg', 'crisfoto.jpg', 'AAAAAA03040414H400', 1, ''),
(54, 'Trilce', 'trilceflores15@gmail.com', 'c466a0eae55f4e1042bab05e1d49e5d0', 0, '637460cd3f487aa97158cfcc01a2f6b4', 'FLARTR03022114M201', '3318296199', 'trilce', 'Flores', 'Guadalajara', '2003-02-21', '60a0d0ccbae677e42adc5592f771a1a2.jpg', 'trilcefoto.jpg', 'TTTTTT21020314M120', 1, ''),
(55, 'Diego', 'diegoalejandrolopezcoronado@hotmail.com', '50e8d5e64f0c3f7c743e63489569c78e', 0, '49aadac47c39944fd6078ac36e7e53bc', 'LOCD770814MJRPCGO0', '3357845617', 'diego', 'Lopez', 'Guadalajara', '1999-08-14', 'e41253bb71e52c8f14a518a519c84ef3.jpeg', 'diegofoto.jpeg', 'DDDDDD08119914H810', 1, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_usuario` (`id_usuario`);

--
-- Indices de la tabla `match`
--
ALTER TABLE `match`
  ADD PRIMARY KEY (`idmatch`),
  ADD KEY `fk_id1_usuario` (`id1`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `match`
--
ALTER TABLE `match`
  MODIFY `idmatch` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `match`
--
ALTER TABLE `match`
  ADD CONSTRAINT `fk_id1_usuario` FOREIGN KEY (`id1`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
