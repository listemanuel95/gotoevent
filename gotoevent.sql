-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2018 a las 18:19:19
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `gotoevent`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artists`
--

CREATE TABLE IF NOT EXISTS `artists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `genre_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_genre` (`genre_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `artists`
--

INSERT INTO `artists` (`id`, `name`, `genre_id`) VALUES
(2, 'Metallica', 3),
(3, 'Megadeth', 3),
(4, 'Pulse', 1),
(5, 'OCONNOR', 3),
(6, 'Turf', 1),
(7, 'Jennifer Lopez', 2),
(8, 'Romeo Santos', 3),
(9, 'Divididos', 1),
(10, 'Bombita Rodriguez', 1),
(11, 'Pomelo', 1),
(12, 'Micky Vainilla', 2),
(13, 'Quizte Zebazeo', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artists_in_calendars`
--

CREATE TABLE IF NOT EXISTS `artists_in_calendars` (
  `id_artist` int(11) NOT NULL,
  `id_calendar` int(11) NOT NULL,
  PRIMARY KEY (`id_artist`,`id_calendar`),
  KEY `id_calendar` (`id_calendar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `artists_in_calendars`
--

INSERT INTO `artists_in_calendars` (`id_artist`, `id_calendar`) VALUES
(6, 22),
(8, 25),
(9, 26),
(5, 27),
(11, 27),
(12, 27),
(6, 28),
(11, 28),
(13, 28),
(8, 29),
(9, 29),
(12, 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendars`
--

CREATE TABLE IF NOT EXISTS `calendars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descr` varchar(255) NOT NULL,
  `day` date NOT NULL,
  `hour` time NOT NULL,
  `site_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Volcado de datos para la tabla `calendars`
--

INSERT INTO `calendars` (`id`, `descr`, `day`, `hour`, `site_id`, `event_id`) VALUES
(22, 'asd', '2018-11-03', '22:00:00', 2, 50),
(25, 'XQXQXQXXQQX', '2018-03-27', '23:00:00', 2, 51),
(26, 'OWEHITEBIWEr', '2018-10-17', '21:00:00', 2, 52),
(27, 'primera fecha', '2018-11-21', '16:00:00', 6, 53),
(28, 'segunda fecha', '2018-11-23', '16:00:00', 1, 53),
(29, 'tercer fecha', '2018-11-25', '16:00:00', 2, 53);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `event_categories`
--

CREATE TABLE IF NOT EXISTS `event_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `event_categories`
--

INSERT INTO `event_categories` (`id`, `name`) VALUES
(1, 'Recital'),
(2, 'Festival'),
(3, 'Concierto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genre_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `genres`
--

INSERT INTO `genres` (`id`, `genre_name`) VALUES
(1, 'Rock'),
(2, 'Pop'),
(3, 'Metal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gigs`
--

CREATE TABLE IF NOT EXISTS `gigs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_category_id` int(11) NOT NULL,
  `descr` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image_link` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_category_id` (`event_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Volcado de datos para la tabla `gigs`
--

INSERT INTO `gigs` (`id`, `event_category_id`, `descr`, `name`, `image_link`) VALUES
(50, 1, 'turf asd', 'Turf Gira Odisea', 'https://www.tuentrada.com/Articlemedia/Images/TuEntrada/mas_info/Trastienda%20san%20telmo/turf-inter.jpg'),
(51, 1, 'ROMEO SANTOS HIPODROMO DE PALERMO', 'TestEvento', 'https://www.daleplayticket.com/Articlemedia/Images/Brands/daleplayticket/intermedia/romeoSegundaInter.jpg'),
(52, 1, 'TEQUE TEQUE TOCA TOCA ESTA HINCHADA ESTA RE LOCA SOMOS TODOS DIVIDIDOS DIVIDIDOS LAS PELOTAS', 'Divididos 30 años', 'https://www.tuentrada.com/Articlemedia/Images/TuEntrada/mas_info/Divididos/divididos-graficagenerica-inter.jpg'),
(53, 2, 'Veni veni veni, no seas puto y veni', 'Mangueras Musmanno Rock Festival', 'https://i.ytimg.com/vi/BvM9vvAja6E/maxresdefault.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seats`
--

CREATE TABLE IF NOT EXISTS `seats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(8) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `seat_type_id` int(11) NOT NULL,
  `calendar_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `seat_type_id` (`seat_type_id`),
  KEY `calendar_id` (`calendar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=716 ;

--
-- Volcado de datos para la tabla `seats`
--

INSERT INTO `seats` (`id`, `number`, `price`, `seat_type_id`, `calendar_id`) VALUES
(454, '1-0', 20, 1, 22),
(655, '1-0', 50, 1, 25),
(656, '1-0', 100, 1, 26),
(657, '1-1', 100, 1, 26),
(658, '1-2', 100, 1, 26),
(659, '1-3', 100, 1, 26),
(660, '1-4', 100, 1, 26),
(661, '1-0', 500, 1, 27),
(662, '1-1', 500, 1, 27),
(663, '1-2', 500, 1, 27),
(664, '1-3', 500, 1, 27),
(665, '1-4', 500, 1, 27),
(666, '1-5', 500, 1, 27),
(667, '1-6', 500, 1, 27),
(668, '1-7', 500, 1, 27),
(669, '1-8', 500, 1, 27),
(670, '1-9', 500, 1, 27),
(671, '1-0', 500, 1, 28),
(672, '1-1', 500, 1, 28),
(673, '1-2', 500, 1, 28),
(674, '1-3', 500, 1, 28),
(675, '1-4', 500, 1, 28),
(676, '1-5', 500, 1, 28),
(677, '1-6', 500, 1, 28),
(678, '1-7', 500, 1, 28),
(679, '1-8', 500, 1, 28),
(680, '1-9', 500, 1, 28),
(681, '1-10', 500, 1, 28),
(682, '1-11', 500, 1, 28),
(683, '1-12', 500, 1, 28),
(684, '1-13', 500, 1, 28),
(685, '1-14', 500, 1, 28),
(686, '1-15', 500, 1, 28),
(687, '1-16', 500, 1, 28),
(688, '1-17', 500, 1, 28),
(689, '1-18', 500, 1, 28),
(690, '1-19', 500, 1, 28),
(691, '1-20', 500, 1, 28),
(692, '1-21', 500, 1, 28),
(693, '1-22', 500, 1, 28),
(694, '1-23', 500, 1, 28),
(695, '1-24', 500, 1, 28),
(696, '1-0', 550, 1, 29),
(697, '1-1', 550, 1, 29),
(698, '1-2', 550, 1, 29),
(699, '1-3', 550, 1, 29),
(700, '1-4', 550, 1, 29),
(701, '1-5', 550, 1, 29),
(702, '1-6', 550, 1, 29),
(703, '1-7', 550, 1, 29),
(704, '1-8', 550, 1, 29),
(705, '1-9', 550, 1, 29),
(706, '1-10', 550, 1, 29),
(707, '1-11', 550, 1, 29),
(708, '1-12', 550, 1, 29),
(709, '1-13', 550, 1, 29),
(710, '1-14', 550, 1, 29),
(711, '1-15', 550, 1, 29),
(712, '1-16', 550, 1, 29),
(713, '1-17', 550, 1, 29),
(714, '1-18', 550, 1, 29),
(715, '1-19', 550, 1, 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seat_types`
--

CREATE TABLE IF NOT EXISTS `seat_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `seat_types`
--

INSERT INTO `seat_types` (`id`, `type`) VALUES
(1, 'Campo'),
(2, 'Platea'),
(3, 'Campo VIP'),
(4, 'Pullman');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sites`
--

CREATE TABLE IF NOT EXISTS `sites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `address` varchar(80) DEFAULT NULL,
  `establishment` varchar(50) DEFAULT NULL,
  `capacity` int(7) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `sites`
--

INSERT INTO `sites` (`id`, `city`, `province`, `address`, `establishment`, `capacity`) VALUES
(1, 'Mar del Plata', 'Buenos Aires', 'Av. de las Olimpiadas 760', 'Estadio José María Minella', 50000),
(2, 'Mar del Plata', 'Buenos Aires', 'Juan B. Justo 1100', 'Abbey Road', 2000),
(6, 'TaMasLavadoQUe', 'AY ME QUEME', 'Mexico y 25 de Mayo', 'Los turos de las tores', 25000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(80) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_ibfk_1` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `mail`, `password`, `role_id`) VALUES
(1, 'test@test.test', 'a8f5f167f44f4964e6c998dee827110c', 2),
(2, 'wtih@rtehtheo.wer', '098f6bcd4621d373cade4e832627b4f6', 1),
(3, 'natanga@natu.nat', 'c03f001c5c5341769ecb304e6c669b0f', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_roles`
--

CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`) VALUES
(1, 'Usuario'),
(2, 'Admin');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `artists`
--
ALTER TABLE `artists`
  ADD CONSTRAINT `artists_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `artists_in_calendars`
--
ALTER TABLE `artists_in_calendars`
  ADD CONSTRAINT `artists_in_calendars_ibfk_2` FOREIGN KEY (`id_calendar`) REFERENCES `calendars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `artists_in_calendars_ibfk_1` FOREIGN KEY (`id_artist`) REFERENCES `artists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `calendars`
--
ALTER TABLE `calendars`
  ADD CONSTRAINT `calendars_ibfk_3` FOREIGN KEY (`event_id`) REFERENCES `gigs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `calendars_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `gigs`
--
ALTER TABLE `gigs`
  ADD CONSTRAINT `gigs_ibfk_1` FOREIGN KEY (`event_category_id`) REFERENCES `event_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_ibfk_2` FOREIGN KEY (`calendar_id`) REFERENCES `calendars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seats_ibfk_1` FOREIGN KEY (`seat_type_id`) REFERENCES `seat_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
