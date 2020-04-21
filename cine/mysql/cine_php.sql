-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-04-2020 a las 20:42:30
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cine_php`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asientos`
--

CREATE TABLE `asientos` (
  `id` int(11) NOT NULL,
  `id_sala` int(11) NOT NULL,
  `fecha_sesion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asientos`
--

INSERT INTO `asientos` (`id`, `id_sala`, `fecha_sesion`) VALUES
(0, 2, '2020-04-22 18:00:00'),
(1, 2, '2020-04-22 18:00:00'),
(99, 2, '2020-04-22 18:00:00'),
(0, 3, '2020-04-21 20:00:00'),
(1, 3, '2020-04-21 20:00:00'),
(2, 3, '2020-04-21 20:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pelicula`
--

CREATE TABLE `pelicula` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pelicula`
--

INSERT INTO `pelicula` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Matrix', 'Un clasicazo pero no en mayusculas.'),
(2, 'Cuatri 2, el suspenso', 'Es inevitable.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `id` int(11) NOT NULL,
  `sesion` datetime NOT NULL,
  `id_sala` int(11) NOT NULL,
  `asiento` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`id`, `sesion`, `id_sala`, `asiento`, `fecha`) VALUES
(2, '2020-04-21 20:00:00', 3, 0, '2020-04-21 16:58:47'),
(3, '2020-04-21 20:00:00', 3, 1, '2020-04-21 16:58:47'),
(4, '2020-04-21 20:00:00', 3, 2, '2020-04-21 16:58:47'),
(5, '2020-04-22 18:00:00', 2, 0, '2020-04-21 17:00:12'),
(6, '2020-04-22 18:00:00', 2, 1, '2020-04-21 17:00:12'),
(7, '2020-04-22 18:00:00', 2, 99, '2020-04-21 17:00:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sala`
--

CREATE TABLE `sala` (
  `id` int(11) NOT NULL,
  `aforo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sala`
--

INSERT INTO `sala` (`id`, `aforo`) VALUES
(1, 25),
(2, 100),
(3, 500),
(4, 1),
(5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion`
--

CREATE TABLE `sesion` (
  `fecha` datetime NOT NULL,
  `id_sala` int(11) NOT NULL,
  `id_peli` int(11) NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sesion`
--

INSERT INTO `sesion` (`fecha`, `id_sala`, `id_peli`, `precio`) VALUES
('2020-04-21 20:00:00', 3, 1, 7),
('2020-04-22 18:00:00', 2, 1, 10);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asientos`
--
ALTER TABLE `asientos`
  ADD PRIMARY KEY (`id_sala`,`id`,`fecha_sesion`) USING BTREE,
  ADD KEY `id` (`id`),
  ADD KEY `fecha_sesion` (`fecha_sesion`);

--
-- Indices de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sesion` (`sesion`),
  ADD KEY `id_sala` (`id_sala`),
  ADD KEY `asiento` (`asiento`);

--
-- Indices de la tabla `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD PRIMARY KEY (`fecha`,`id_sala`),
  ADD KEY `id_peli` (`id_peli`),
  ADD KEY `id_sala` (`id_sala`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asientos`
--
ALTER TABLE `asientos`
  ADD CONSTRAINT `asientos_ibfk_1` FOREIGN KEY (`fecha_sesion`) REFERENCES `sesion` (`fecha`);

--
-- Filtros para la tabla `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `registro_ibfk_2` FOREIGN KEY (`id_sala`) REFERENCES `asientos` (`id_sala`),
  ADD CONSTRAINT `registro_ibfk_3` FOREIGN KEY (`asiento`) REFERENCES `asientos` (`id`),
  ADD CONSTRAINT `registro_ibfk_4` FOREIGN KEY (`sesion`) REFERENCES `asientos` (`fecha_sesion`);

--
-- Filtros para la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD CONSTRAINT `sesion_ibfk_2` FOREIGN KEY (`id_peli`) REFERENCES `pelicula` (`id`),
  ADD CONSTRAINT `sesion_ibfk_3` FOREIGN KEY (`id_sala`) REFERENCES `sala` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
