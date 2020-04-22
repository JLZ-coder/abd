-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-04-2020 a las 13:58:56
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
(25, 1, '2020-04-27 20:30:00'),
(43, 1, '2020-04-27 20:30:00'),
(44, 1, '2020-04-27 20:30:00'),
(63, 1, '2020-04-27 20:30:00');

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
(3, 'The Fast & The Furious', 'Un policía encubierto se infiltra en una banda de carreras callejeras de Los Ángeles mientras investiga robos de automóviles.'),
(4, 'Parasite', 'Tanto Gi Taek como su familia están sin trabajo. Cuando su hijo mayor, Gi Woo, empieza a impartir clases particulares en la adinerada casa de los Park, las dos familias, que tienen mucho en común pese a pertenecer a dos mundos totalmente distintos, entablan una relación de resultados imprevisibles.'),
(5, 'Back to the Future', 'Una máquina del tiempo transporta a un adolescente a los años 50, cuando sus padres todavía estudiaban en la secundaria.');

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
(17, '2020-04-27 20:30:00', 1, 25, '2020-04-22 11:57:50'),
(18, '2020-04-27 20:30:00', 1, 43, '2020-04-22 11:57:50'),
(19, '2020-04-27 20:30:00', 1, 44, '2020-04-22 11:57:50'),
(20, '2020-04-27 20:30:00', 1, 63, '2020-04-22 11:57:50');

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
(1, 200),
(2, 300),
(3, 200);

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
('2020-04-27 20:00:00', 2, 4, 10),
('2020-04-27 20:30:00', 1, 3, 9),
('2020-04-27 22:00:00', 1, 3, 9),
('2020-04-27 22:30:00', 2, 4, 10),
('2020-04-27 23:30:00', 1, 3, 9);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asientos`
--
ALTER TABLE `asientos`
  ADD CONSTRAINT `asientos_ibfk_1` FOREIGN KEY (`fecha_sesion`) REFERENCES `sesion` (`fecha`);

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
