-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-11-2023 a las 01:17:21
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
-- Estructura de tabla para la tabla `adopcion`
--

CREATE TABLE `adopcion` (
  `id1` int(11) NOT NULL,
  `id2` int(11) NOT NULL,
  `id3` int(11) NOT NULL,
  `idA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `adopcion`
--

INSERT INTO `adopcion` (`id1`, `id2`, `id3`, `idA`) VALUES
(51, 53, 3, 40),
(51, 54, 86, 41),
(50, 57, 6, 42);

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
  `id_usuario` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`id`, `nombreMascota`, `descripcion`, `especie`, `raza`, `edad`, `cartilla`, `especificaciones`, `caracteristicas`, `fotografiaMascota`, `estatus`, `categoria`, `id_usuario`, `fecha`) VALUES
(1, 'Bebeuwu', 'Es jugueton, le gusta jugar con niños', '1', 'pitbull', 1, '5188bc92e46c57cca8d8c177ede9c646.jpg', 'ryzen 5, con 3 patas', 'es cafe', 'cc969ce2d8b9fa4f6eb71f6fb87f23c7.jpg', 1, 1, 50, '2023-11-28 16:44:43'),
(2, 'Pancho', 'Es muy flojo pero chido', '2', 'Rayado', 1, '02c185756901e2bc870dd1c4b3ceab83.JPG', 'Sano', 'Gris con cafe', 'bdb71ebf5107dbec1d4a3bf2d2b303c9.jpg', 1, 1, 51, '2023-11-28 14:12:25'),
(3, 'Pecesin', 'Naranja amigable', '5', 'Payaso', 1, '02c185756901e2bc870dd1c4b3ceab83.JPG', 'Sano', 'Naranja', 'da6d8b47d2bf24fe77f052e11f9fdd24.JPG', 1, 2, 51, '2023-11-28 14:12:27'),
(4, 'Terry', 'Amable y puro, le gusta comer mucho', '1', 'Puppy', 3, 'afbd8424fdddb5986d9d4e3142cb168d.jpg', 'Es un poco sordo', 'Color miel', 'ce979ff63e55823dbfca2124402a370d.jpg', 1, 2, 51, '2023-11-28 14:12:28'),
(5, 'Hamtaro', 'Travieso y escurridizo, busca amor', '6', 'Hamster', 1, '8186a0d8ba62af961e25e9be0238f2d6.jpg', 'Obeso', 'Es gris y pequeño', '3f3ba17ebbc47ec471154a30dbc36cfc.jpg', 1, 2, 51, '2023-11-28 14:12:41'),
(6, 'Tobby', 'Le gustan las gallinas', '1', 'Pitcher', 8, '02c185756901e2bc870dd1c4b3ceab83.JPG', 'Tiene la oreja caida', 'Negro, enano y de poca inteligencia.', '7e752725b030baa1c079ded0ca0c13b7.JPG', 1, 2, 50, '2023-11-27 20:06:10'),
(7, 'Panda', 'Es gordito', '1', 'Puddle', 3, '02c185756901e2bc870dd1c4b3ceab83.JPG', 'sano,peludo', 'Blanco,Negro,Pequeño', 'cd9065690d7f79d190810c749204a058.JPG', 1, 1, 51, '2023-11-28 14:12:44'),
(8, 'Faustino', 'Es muy flojo', '1', 'Pug', 2, '761accc0dd5d39bb7726fcd318e90e99.JPG', 'Batalla para respirar', 'Cremita, gordo, obeso, morbido', '0dbcb5ee6fbda4dcfe419367240fe244.JPG', 1, 1, 50, '2023-11-27 20:05:56'),
(77, 'Adopción', 'Adopcion', '1', '1', 1, '1111.jpg', '111.jpg', '111.jpg', '111.jpg', 0, 0, 51, '2023-11-22 14:47:34'),
(78, 'Rodolfe', 'Es muy activo', '1', 'Terrier', 2, '512b0c9f3e01f7c24a80f4a72168ef57.JPG', 'No batalla para respirar', 'Blanco, Peludo, flaco', '94142862f5a6bce6aba9c760ae387c29.JPG', 1, 1, 52, '2023-11-28 22:43:42'),
(79, 'Taco', 'Jugueton', '1', 'Salchicha', 1, '911a17a524751ba22d80dfb1460b6fd7.jpg', 'Sano y curioso', 'Es largo y de color cafe', '429b5097483201e1f79e55fb2ea9d093.jpg', 1, 2, 53, '2023-11-29 00:11:05'),
(80, 'Goyito', 'Es muy amigable', '3', 'Gorrion', 2, '38abd68a9ae23c341e0437d6de57ef67.jpg', 'Tiene una patita lastimada', 'Peque y de muchos colores', '2dc2c339498d4f4989ae83645ae3375d.jpg', 1, 1, 53, '2023-11-29 00:12:26'),
(81, 'Negro', 'Enojon y de gran corazon', '2', 'Gato negro', 1, 'cc5e39beabc4e0f98eaef0b933cf52ae.jpg', 'Hiperactividad', 'Pelaje negro azabache', '33b8f5f7b256fa3df023342f713001e5.jpg', 1, 1, 53, '2023-11-29 00:14:54'),
(82, 'Guapo', 'Busca amor', '4', 'Dragon barbudo', 9, 'c6c1e93d405d13df30ba23228d96921c.jpg', 'Exceso de fuerza', 'Es amigable con otros animales', '5e10e4d11562e1247f9783861fa33fe4.jpg', 1, 2, 53, '2023-11-29 00:16:35'),
(83, 'Cachetes', 'Amable y cariñoso', '6', 'Cuyo', 1, 'cc5e39beabc4e0f98eaef0b933cf52ae.jpg', 'Propenso a infartos', 'Chiquito y veloz', '09f934445a169c76a16493441364f423.jpeg', 1, 1, 53, '2023-11-29 00:20:33'),
(84, 'Canela', 'Un poco gruñona', '1', 'Chihuahua', 2, '36739f83ddbd7a155317ed03e263b671.jpg', 'Sana', 'Pequeña', '48195d803cb54fa7d12535e41585d504.jpg', 1, 1, 54, '2023-11-29 00:24:36'),
(85, 'Blacky', 'Amoroso', '2', 'Bombay', 5, 'de040a25414d09fc144ac8f921c87c2d.jpg', 'Sano', 'Pelaje oscuro como la noche', '7c61b1f74074904548edff14e5d2272a.jpg', 1, 1, 54, '2023-11-29 00:25:46'),
(86, 'Pelusin', 'Canta hermoso y come mucho', '3', 'Canario', 1, 'cc5e39beabc4e0f98eaef0b933cf52ae.jpg', 'Ciego', 'Plumaje extravagante', 'a5a1df337be6a17c405ab7e0d5c0c2ee.jpg', 1, 2, 51, '2023-11-29 00:27:44'),
(87, 'Tiburoncin', 'Come mucho', '5', 'Beta', 1, '3fa6b9c240abf8b8ef158d9da6e8bec2.jpg', 'Sano', 'Aletas hermosas y especial', 'ffeaef6a2356cccc9962d2f3d0076b44.jpg', 1, 1, 56, '2023-11-29 00:34:07'),
(88, 'Chenol', 'Mordelon', '6', 'Lewis', 1, '38d00972da8e88da342412d7be0631ba.jpg', 'Sano', 'Chiquito y blanquito', '38d00972da8e88da342412d7be0631ba.jpg', 0, 0, 55, '2023-11-29 00:39:35'),
(89, 'Chenol', 'Es chiquito y juguetón', '6', 'Lewis', 1, 'de040a25414d09fc144ac8f921c87c2d.jpg', 'Sano', 'Chiquito y blanquito', '68677d9960fef4eafe3bfec697c68468.jpg', 1, 1, 55, '2023-11-29 01:07:26'),
(90, 'Cafe', 'Esta chiquito', '1', 'Puddle', 1, '36739f83ddbd7a155317ed03e263b671.jpg', 'Sano', 'Cafecito', 'c9975df5df5d6a2f350ab2b29df080db.jpg', 1, 1, 57, '2023-11-29 08:40:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `match`
--

CREATE TABLE `match` (
  `id1` int(11) NOT NULL,
  `id2` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `idmatch` int(11) NOT NULL,
  `idMascota1` int(11) NOT NULL,
  `idMascota2` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `match`
--

INSERT INTO `match` (`id1`, `id2`, `status`, `idmatch`, `idMascota1`, `idMascota2`, `fecha`) VALUES
(987654321, 123456789, 4, 220, 7, 8, '2023-11-28 22:25:16'),
(123456789, 793683764, 5, 221, 8, 78, '2023-11-28 22:26:52'),
(793683764, 987654321, 4, 222, 78, 7, '2023-11-28 22:28:00'),
(987654321, 549412433, 6, 241, 3, 77, '2023-11-29 00:12:47'),
(987654321, 586934568, 6, 242, 86, 77, '2023-11-29 00:29:42'),
(987654321, 586934568, 1, 243, 2, 85, '2023-11-29 00:57:05'),
(1356393593, 987654321, 0, 244, 90, 7, '2023-11-29 08:42:52'),
(1356393593, 123456789, 2, 245, 90, 1, '2023-11-29 08:41:08'),
(1356393593, 123456789, 3, 246, 90, 8, '2023-11-29 08:41:14'),
(123456789, 1356393593, 6, 247, 6, 77, '2023-11-29 08:45:16'),
(987654321, 549412433, 1, 248, 2, 81, '2023-11-29 08:45:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(26, 987654321, 123456789, 'Message example 01'),
(27, 987654321, 123456789, '%%$$Mesa!$\"&($Example);'),
(28, 793683764, 123456789, 'Si'),
(29, 123456789, 987654321, 'hola'),
(30, 987654321, 123456789, 'waos'),
(31, 123456789, 987654321, 'waos'),
(32, 987654321, 123456789, 'Te huele la cola'),
(33, 123456789, 987654321, 'Si'),
(34, 793683764, 987654321, 'Hola desconocido'),
(35, 793683764, 123456789, 'Tu mama'),
(36, 987654321, 123456789, 's'),
(37, 987654321, 123456789, 'Si'),
(38, 123456789, 987654321, 'Ah'),
(39, 123456789, 987654321, 'si sirve bien'),
(40, 123456789, 987654321, 'Si'),
(41, 123456789, 987654321, 'A'),
(42, 123456789, 987654321, 'hola te comes mi hamster'),
(43, 987654321, 123456789, 'Si'),
(44, 987654321, 123456789, 'presio'),
(45, 793683764, 123456789, 'Siiasdas'),
(46, 1356393593, 987654321, 'Hola presio'),
(47, 123456789, 1356393593, 'Hola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rating`
--

CREATE TABLE `rating` (
  `idR` int(15) NOT NULL,
  `idUser` int(15) NOT NULL,
  `rating` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rating`
--

INSERT INTO `rating` (`idR`, `idUser`, `rating`) VALUES
(1, 987654321, 4),
(2, 987654321, 5),
(3, 987654321, 3),
(4, 987654321, 1),
(5, 123456789, 4),
(6, 987654321, 1),
(7, 987654321, 1),
(8, 987654321, 1),
(9, 987654321, 5),
(10, 793683764, 4),
(11, 987654321, 5),
(12, 987654321, 5),
(13, 987654321, 5),
(14, 123456789, 4),
(15, 123456789, 5),
(16, 987654321, 5),
(17, 987654321, 5),
(18, 987654321, 5),
(19, 987654321, 4),
(20, 987654321, 5),
(21, 1356393593, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE `reporte` (
  `idR` int(10) NOT NULL,
  `idreportado` int(10) NOT NULL,
  `idreporte` int(10) NOT NULL,
  `motivo` text NOT NULL,
  `fecha` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reporte`
--

INSERT INTO `reporte` (`idR`, `idreportado`, `idreporte`, `motivo`, `fecha`) VALUES
(4, 987654321, 123456789, 'Eres furra', '2023-11-27 01:29:20'),
(7, 0, 793683764, 'Si funciona', '2023-11-29 03:57:02'),
(8, 0, 123456789, 'Es una naca', '2023-11-29 04:49:02'),
(9, 987654321, 123456789, 'Es una naca y stripper en roblox', '2023-11-29 04:51:04'),
(10, 1356393593, 987654321, 'Nomas', '2023-11-29 14:43:52');

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
  `status` varchar(20) NOT NULL,
  `unique_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `email`, `codigo_verificacion`, `verificado`, `pass`, `curp`, `telefono`, `nickname`, `apellidos`, `municipio`, `fechanac`, `fotografia`, `archivo_n`, `ine`, `admin`, `status`, `unique_id`) VALUES
(50, 'Daniel', 'esequien333@gmail.com', '6e5400def35b38c2a91f18dab7b0e7e9', 1, '202cb962ac59075b964b07152d234b70', 'JUSD030212HCLRLNA4', '8715243308', 'DanCatFly', 'Juarez', 'Guadalajara', '2003-02-12', '1ef7e01a5d78d4bba6176186cbd6ce96.jpg', 'pocoyo.jpg', 'JRSLDN03021205H600', 0, 'Offline', 123456789),
(51, 'Samantha', 'androlausam2@gmail.com', '9f77720ef7b5122aabf45b49dd1266c6', 1, '0cdfb256110772e88c21ddf94ee6f1ba', 'TEGL031023MJCLRRA1', '3310766433', 'samnette', 'Telles', 'Guadalajara', '2003-10-23', 'd06f547c157893df34569aa4ca374099.jpg', 'miyamurita.jpg', 'LSEGNM03021205M700', 1, 'Disponible', 987654321),
(52, 'Alberto', 'dangatovolador@gmail.com', 'e51fadadb39f8d188f495ab3a663c924', 2, 'caf1a3dfb505ffed0d024130f58c5cfa', 'JSTL031023MJCLRRS1', '4671007191', 'Juarez9516', 'Silva', 'Guadalajara', '2006-01-18', '05abde1caafd58db602eada746fb7404.jpg', 'soyese.jpg', 'AJEGNM03021205M711', 0, 'Suspendido', 793683764),
(53, 'Christian', 'cristiansillochavech@gmail.com', '97fda7f4e1bb04c48b022eb09f3d998b', 1, '827ccb0eea8a706c4c34a16891f84e7b', 'FFFF030404HJCVFFF8', '3334945085', 'Cris Ruvalcaba', 'Ruvalcava', 'Guadalajara', '2003-04-04', '47d9e075126125bd9f6b97850df044c6.jpg', 'crisfoto.jpg', 'AAAAAA03040414H400', 1, 'Offline', 549412433),
(54, 'Trilce', 'trilceflores15@gmail.com', 'c466a0eae55f4e1042bab05e1d49e5d0', 1, '637460cd3f487aa97158cfcc01a2f6b4', 'FLARTR03022114M201', '3318296199', 'trilce', 'Flores', 'Guadalajara', '2003-02-21', '60a0d0ccbae677e42adc5592f771a1a2.jpg', 'trilcefoto.jpg', 'TTTTTT21020314M120', 1, 'Offline', 586934568),
(55, 'Diego', 'diegoalejandrolopezcoronado@hotmail.com', '50e8d5e64f0c3f7c743e63489569c78e', 1, '49aadac47c39944fd6078ac36e7e53bc', 'LOCD770814MJRPCGO0', '3357845617', 'diego', 'Lopez', 'Guadalajara', '1999-08-14', 'e41253bb71e52c8f14a518a519c84ef3.jpeg', 'diegofoto.jpeg', 'DDDDDD08119914H810', 1, 'Offline', 785432076),
(56, 'Logan', 'alphc056@gmail.com', 'a616abf9d883b7ec31b4a6f259685ed4', 1, '622be4f47f555a3f8fc87d1d7cf31430', 'LXCA030811MJCPNLA0', '3324303048', 'alph56', 'Cuenca', 'Zapopan', '2003-08-11', 'ed7bbcb87ac9dbf04e3988a73bf81e17.png', 'Alphoto.png', 'LPCNAL03081114M000', 1, 'Offline', 639721044),
(57, 'Andrea', 'androlausam@gmail.com', '956d74d6ce41095a44eb82be6afd4618', 1, '827ccb0eea8a706c4c34a16891f84e7b', 'FOOT123012MJCFAQR4', '3314545889', 'liz', 'Hernandez', 'Zapopan', '2000-05-12', 'ab1c3f06c23aca30625209cd0603b815.jpg', 'usuario.jpg', 'FLARTT03022114M201', 0, 'Offline', 1356393593);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adopcion`
--
ALTER TABLE `adopcion`
  ADD PRIMARY KEY (`idA`),
  ADD KEY `id1` (`id1`);

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
  ADD PRIMARY KEY (`idmatch`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indices de la tabla `rating`
--
ALTER TABLE `rating`
  ADD UNIQUE KEY `idR` (`idR`);

--
-- Indices de la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD UNIQUE KEY `idR` (`idR`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adopcion`
--
ALTER TABLE `adopcion`
  MODIFY `idA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de la tabla `match`
--
ALTER TABLE `match`
  MODIFY `idmatch` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `rating`
--
ALTER TABLE `rating`
  MODIFY `idR` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `reporte`
--
ALTER TABLE `reporte`
  MODIFY `idR` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adopcion`
--
ALTER TABLE `adopcion`
  ADD CONSTRAINT `adopcion_ibfk_1` FOREIGN KEY (`id1`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
