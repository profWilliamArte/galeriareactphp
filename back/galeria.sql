-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-12-2024 a las 13:55:46
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `galeria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autor`
--

CREATE TABLE `autor` (
  `id` int NOT NULL,
  `idtipoautor` int NOT NULL,
  `idestatus` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Volcado de datos para la tabla `autor`
--

INSERT INTO `autor` (`id`, `idtipoautor`, `idestatus`, `nombre`, `fecha`) VALUES
(1, 1, 1, 'Pedro Perez', '2024-11-27'),
(2, 2, 1, 'Carlos Ramos', '2024-11-27'),
(3, 3, 1, 'Juan Garcia', '2024-11-27'),
(4, 3, 1, 'Carmen Alcantara', '2024-11-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Familiar'),
(2, 'Recreativo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleevento`
--

CREATE TABLE `detalleevento` (
  `id` int NOT NULL,
  `idevento` int NOT NULL,
  `imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Volcado de datos para la tabla `detalleevento`
--

INSERT INTO `detalleevento` (`id`, `idevento`, `imagen`) VALUES
(1, 13, '29cc69b9f60a92f6d10215ed8e796dc5.jpeg'),
(2, 14, '0c680eba4d1a02c85ed8b6df8cae39c5.jpg'),
(3, 14, 'b5ad6d7b022dbedeb1a1b8514e9f2278.jpg'),
(4, 14, '917ea934f7af1db9d4da7e38ec8ef4b9.jpg'),
(5, 14, '2979a3f030f6a9c946e939b50e5c2caa.jpg'),
(6, 16, '954bd3f1b6060529604056913c3b5a61.jpeg'),
(7, 17, 'c4bbf5a065e73421f47c0650ce109db7.jpeg'),
(8, 18, '7136e1a62f8a1aa90b0557db5605c3b3.jpg'),
(9, 18, '3b556c882f7dcebfe17761c37be695f0.jpg'),
(10, 18, '84e3ffb8952ab0c276e2b4d8986348c4.jpg'),
(11, 18, '16f3cd4a502389e6b5d4cca6ac72b290.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE `estatus` (
  `id` int NOT NULL,
  `nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Volcado de datos para la tabla `estatus`
--

INSERT INTO `estatus` (`id`, `nombre`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int NOT NULL,
  `idautor` int NOT NULL,
  `idestatus` int NOT NULL,
  `idcategoria` int NOT NULL,
  `idtipoevento` int NOT NULL,
  `lugar` varchar(100) CHARACTER SET utf32 COLLATE utf32_general_ci DEFAULT NULL,
  `descripcion` text NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `idautor`, `idestatus`, `idcategoria`, `idtipoevento`, `lugar`, `descripcion`, `fecha`) VALUES
(1, 2, 1, 1, 1, 'Parque Central', 'Fiesta temática con decoraciones y actividades basadas en los intereses del cumpleañero.', '2024-05-15'),
(2, 2, 1, 1, 2, 'Jardín Botánico', 'Ceremonia al aire libre en un jardín seguido de una recepción familiar.', '2024-06-20'),
(3, 2, 1, 1, 3, 'Iglesia San Juan', 'Ceremonia religiosa seguida de un banquete familiar.', '2024-07-10'),
(4, 1, 1, 1, 4, 'Casa Familiar', 'Fiesta para celebrar la Primera Comunión con amigos y familiares.', '2024-09-05'),
(5, 2, 1, 1, 5, 'Casa de la futura mamá', 'Celebración antes del nacimiento con juegos y regalos.', '2024-11-01'),
(6, 1, 1, 2, 7, 'Playa del Sol', 'Disfrutar de juegos de playa, picnics y deportes acuáticos.', '2024-08-15'),
(7, 2, 1, 2, 8, 'Parque Nacional', 'Caminatas adecuadas para todas las edades con paradas para picnics.', '2024-10-10'),
(8, 1, 1, 2, 9, 'Puerto Deportivo', 'Paseos en barco o actividades como snorkel o paddleboarding.', '2024-07-25'),
(9, 2, 1, 2, 10, 'Camping El Bosque', 'Noches de camping con fogatas y cuentos.', '2024-09-20'),
(10, 1, 1, 2, 11, 'Casa Familiar', 'Comidas familiares donde todos los miembros se reúnen.', '2024-12-25'),
(11, 1, 1, 1, 5, 'Lugar', '232 342342', '2024-11-28'),
(12, 1, 1, 1, 5, 'Lugar', '232 342342', '2024-11-28'),
(13, 1, 1, 1, 5, 'Lugar', '232 342342', '2024-11-28'),
(14, 1, 1, 2, 8, 'Subir el cerro el cafe', 'Fue un pasea al cerro el cafe, salimos a las 6 de la mañana con muchas ganas de hacer ejercicios', '2024-11-29'),
(15, 1, 1, 1, 3, '23232', '23        safsfsfsdf sdfs', '2024-11-01'),
(16, 1, 1, 1, 3, '23232', '23        safsfsfsdf sdfs', '2024-11-01'),
(17, 1, 1, 1, 3, '23232', '23        safsfsfsdf sdfs', '2024-11-01'),
(18, 1, 1, 2, 7, 'La Rosa', 'Un dia de playa fantastico con la familia y amigos, fuimos con los primos y la Tia Meche, nos quedamos en puerto cabello en la posada la Gaviota', '2024-11-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoautor`
--

CREATE TABLE `tipoautor` (
  `id` int NOT NULL,
  `nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Volcado de datos para la tabla `tipoautor`
--

INSERT INTO `tipoautor` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Publicador'),
(3, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoevento`
--

CREATE TABLE `tipoevento` (
  `id` int NOT NULL,
  `idcategoria` int NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Volcado de datos para la tabla `tipoevento`
--

INSERT INTO `tipoevento` (`id`, `idcategoria`, `nombre`) VALUES
(1, 1, 'Cumpleaños'),
(2, 1, 'Matrimonio'),
(3, 1, 'Bautizo'),
(4, 1, 'Comunión'),
(5, 1, 'Baby Shower'),
(6, 1, 'Graduacion'),
(7, 2, 'Día de playa '),
(8, 2, 'Senderismo '),
(9, 2, 'Excursiones'),
(10, 2, 'Acampadas'),
(11, 2, 'Reuniones familiares');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalleevento`
--
ALTER TABLE `detalleevento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipoautor`
--
ALTER TABLE `tipoautor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipoevento`
--
ALTER TABLE `tipoevento`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autor`
--
ALTER TABLE `autor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalleevento`
--
ALTER TABLE `detalleevento`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `tipoautor`
--
ALTER TABLE `tipoautor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipoevento`
--
ALTER TABLE `tipoevento`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
