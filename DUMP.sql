-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2020 a las 21:34:49
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `moviepass`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `percentaje` int(11) DEFAULT NULL,
  `maximum` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `dateFrom` date NOT NULL,
  `dateTo` date NOT NULL,
  `days` varchar(300) NOT NULL,
  `minTickets` int(11) NOT NULL,
  `description` text,
  `state` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `discounts`
--

INSERT INTO `discounts` (`id`, `percentaje`, `maximum`, `amount`, `dateFrom`, `dateTo`, `days`, `minTickets`, `description`, `state`) VALUES
(10, 25, 2000, 0, '2020-11-01', '3000-12-31', 'Tuesday Wednesday ', 2, 'Descuento de los días martes y miércoles.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `functions`
--

CREATE TABLE `functions` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `theater_id` int(11) NOT NULL,
  `theater_room_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `functions`
--

INSERT INTO `functions` (`id`, `movie_id`, `theater_id`, `theater_room_id`, `price`, `date`) VALUES
(21, 4, 5, 8, 320, '2020-11-21 16:00:00'),
(22, 5, 5, 9, 220, '2020-11-20 16:00:00'),
(23, 6, 4, 7, 315, '2020-11-23 17:30:00'),
(25, 6, 5, 8, 315, '2020-11-20 16:00:00'),
(26, 7, 4, 6, 300, '2020-12-13 20:00:00'),
(27, 4, 5, 12, 350, '2020-12-30 13:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `api_movie_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `genre` varchar(50) NOT NULL,
  `duration` varchar(5) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `movies`
--

INSERT INTO `movies` (`id`, `api_movie_id`, `name`, `description`, `genre`, `duration`, `image`) VALUES
(3, 439015, 'Slender Man', '“El hombre más pálido. El traje más oscuro. Más grande que el gigante más alto. Ten miedo de este hombre: Slender Man ya que puede hacer lo que nadie puede”. Estas son algunas de las características que usuarios del internet dieron al personaje ficticio de terror Slender Man (el hombre delgado). Ahora la criatura llega a la gran pantalla con este film de terror, que nace de una de las leyendas urbanas de la web más populares, en base de una recopilación de imágenes en el foro Something Awful y hoy en día, pertenece a la cultura \"creepypasta\".', 'Misterio', '93', 'https://image.tmdb.org/t/p/w500/huSncs4RyvQDBmHjBBYHSBYJbSJ.jpg'),
(4, 299534, 'Avengers: Endgame', 'Después de los devastadores eventos de los Vengadores: Infinity War (2018), el universo está en ruinas. Con la ayuda de los aliados restantes, los Vengadores se reúnen una vez más para revertir las acciones de Thanos y restaurar el equilibrio del universo.', 'Aventura', '180', 'https://image.tmdb.org/t/p/w500/br6krBFpaYmCSglLBWRuhui7tPc.jpg'),
(5, 333339, 'Ready Player One: Comienza el juego', 'La historia sucede en 2045, con el mundo al borde del caos y el colapso. Pero la gente encuentra la salvación en OASIS, universo expansivo de realidad virtual creado por el brillante y excéntrico James Halliday. Halliday muere y su inmensa fortuna será heredada por la primera persona que encuentre un huevo de Pascua digital que él escondió en algún lugar de OASIS... y así se detona una competencia que engancha al mundo entero. Cuando Wade Watts un joven e improbable héroe decide unirse a la competencia, se ve arrastrado dentro de una vertiginosa cacería de tesoros que distrosiona la realidad a través de un universo fantástico de misterio, exploración y peligro.', 'Aventura', '140', 'https://image.tmdb.org/t/p/w500/2iuVrtC5IpwLtSFSgkIIIKLs0Zq.jpg'),
(6, 454626, 'Sonic: La película', 'Tom Wachowski, el sheriff de la ciudad de Green Hills, viajará a San Francisco para ayudar a Sonic, un erizo azul antropomórfico que corre a velocidades supersónicas, en su batalla contra el maligno Dr. Robotnik y sus aliados.', 'Acción', '100', 'https://image.tmdb.org/t/p/w500/rK25c71fYVi0Bv7RrTChK7NAQjC.jpg'),
(7, 181812, 'Star Wars: El ascenso de Skywalker', 'Un año después de los eventos de \"Los últimos Jedi\", los restos de la Resistencia se enfrentarán una vez más a la Primera Orden, involucrando conflictos del pasado y del presente. Mientras tanto, el antiguo conflicto entre los Jedi y los Sith llegará a su clímax, lo que llevará a la saga de los Skywalker a un final definitivo. Final de la trilogía iniciada con \"El despertar de la Fuerza\".', 'Acción', '141', 'https://image.tmdb.org/t/p/w500/16G2wZAkmKqSGK3it2VPjco5oyn.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `theaters`
--

CREATE TABLE `theaters` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `ticket_price` decimal(10,2) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `theaters`
--

INSERT INTO `theaters` (`id`, `name`, `address`, `ticket_price`, `state`) VALUES
(4, 'Ambassador', 'Córdoba 1673', '0.00', 1),
(5, 'Cines Paseo Aldrey', 'Sarmiento 2685', '0.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `theater_rooms`
--

CREATE TABLE `theater_rooms` (
  `id` int(11) NOT NULL,
  `theater_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `seats` int(5) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `theater_rooms`
--

INSERT INTO `theater_rooms` (`id`, `theater_id`, `name`, `seats`, `state`) VALUES
(6, 4, 'Sala 1', 180, 1),
(7, 4, 'Sala 2', 250, 0),
(8, 5, 'Sala 1', 200, 1),
(9, 5, 'Sala 2', 170, 1),
(10, 4, 'Sala 3', 250, 1),
(11, 4, 'Sala 4', 150, 1),
(12, 5, 'Sala 3', 350, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL DEFAULT 'MD5(id)',
  `user_id` int(11) NOT NULL,
  `function_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` float NOT NULL,
  `discount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id`, `token`, `user_id`, `function_id`, `date`, `price`, `discount`) VALUES
(5, 'c4ca4238a0b923820dcc509a6f75849b', 8, 27, '2020-11-24 17:26:01', 262.5, 10),
(6, '1679091c5a880faf6fb5e6087eb1b2dc', 8, 27, '2020-11-24 17:26:03', 262.5, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `role` enum('ADMIN','CUSTOMER') NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `role`, `created`) VALUES
(6, 'sz.andres150@gmail.com', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'Andres', 'Sanchez', 'ADMIN', '2020-11-09 22:56:47'),
(7, 'sanchez.andres1500@gmail.com', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'Andres', 'Sanchez', 'CUSTOMER', '2020-11-18 23:10:09'),
(8, 'marianitoconte@yahoo.com.ar', 'c212f120e611b35e73710e0350efd617982c5f07', 'Mariano', 'Conte', 'CUSTOMER', '2020-11-23 22:09:25');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `functions`
--
ALTER TABLE `functions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `theater_room_id` (`theater_room_id`),
  ADD KEY `theater_id` (`theater_id`) USING BTREE;

--
-- Indices de la tabla `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `api_movie_id` (`api_movie_id`);

--
-- Indices de la tabla `theaters`
--
ALTER TABLE `theaters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `theater_rooms`
--
ALTER TABLE `theater_rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `theater_id` (`theater_id`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `function_id` (`function_id`),
  ADD KEY `discount` (`discount`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `functions`
--
ALTER TABLE `functions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `theaters`
--
ALTER TABLE `theaters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `theater_rooms`
--
ALTER TABLE `theater_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `functions`
--
ALTER TABLE `functions`
  ADD CONSTRAINT `functions_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`),
  ADD CONSTRAINT `functions_ibfk_2` FOREIGN KEY (`theater_room_id`) REFERENCES `theater_rooms` (`id`),
  ADD CONSTRAINT `functions_ibfk_3` FOREIGN KEY (`theater_id`) REFERENCES `theaters` (`id`);

--
-- Filtros para la tabla `theater_rooms`
--
ALTER TABLE `theater_rooms`
  ADD CONSTRAINT `theater_rooms_ibfk_1` FOREIGN KEY (`theater_id`) REFERENCES `theaters` (`id`);

--
-- Filtros para la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`function_id`) REFERENCES `functions` (`id`),
  ADD CONSTRAINT `tickets_ibfk_3` FOREIGN KEY (`discount`) REFERENCES `discounts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
