-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2018 a las 23:27:00
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gotoevent`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(13, 'Quizte Zebazeo', 3),
(14, 'Massacre', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artists_in_calendars`
--

CREATE TABLE `artists_in_calendars` (
  `id_artist` int(11) NOT NULL,
  `id_calendar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `artists_in_calendars`
--

INSERT INTO `artists_in_calendars` (`id_artist`, `id_calendar`) VALUES
(5, 27),
(6, 22),
(6, 28),
(8, 25),
(8, 29),
(9, 26),
(9, 29),
(11, 27),
(11, 28),
(12, 27),
(12, 29),
(13, 28),
(14, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendars`
--

CREATE TABLE `calendars` (
  `id` int(11) NOT NULL,
  `descr` varchar(255) NOT NULL,
  `day` date NOT NULL,
  `hour` time NOT NULL,
  `site_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `calendars`
--

INSERT INTO `calendars` (`id`, `descr`, `day`, `hour`, `site_id`, `event_id`) VALUES
(22, 'asd', '2018-11-03', '22:00:00', 2, 50),
(25, 'XQXQXQXXQQX', '2018-03-27', '23:00:00', 2, 51),
(26, 'OWEHITEBIWEr', '2018-10-17', '21:00:00', 2, 52),
(27, 'primera fecha', '2018-11-21', '16:00:00', 6, 53),
(28, 'segunda fecha', '2018-11-23', '16:00:00', 1, 53),
(29, 'tercer fecha', '2018-11-25', '16:00:00', 2, 53),
(30, 'Descripción de la fecha', '2018-03-09', '22:00:00', 7, 54);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `event_categories`
--

CREATE TABLE `event_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `genre_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `genres`
--

INSERT INTO `genres` (`id`, `genre_name`) VALUES
(1, 'Rock'),
(2, 'Pop'),
(3, 'Metal'),
(4, 'Rap'),
(5, 'Reggae'),
(6, 'Reggaetón'),
(7, 'Electrónica'),
(8, 'Indie'),
(9, 'Punk'),
(10, 'Blues'),
(11, 'Cumbia'),
(12, 'House'),
(13, 'Country');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gigs`
--

CREATE TABLE `gigs` (
  `id` int(11) NOT NULL,
  `event_category_id` int(11) NOT NULL,
  `descr` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image_link` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gigs`
--

INSERT INTO `gigs` (`id`, `event_category_id`, `descr`, `name`, `image_link`) VALUES
(50, 1, 'turf asd', 'Turf Gira Odisea', 'assets/images/turf-inter.jpg'),
(51, 1, 'ROMEO SANTOS HIPODROMO DE PALERMO', 'TestEvento', 'assets/images/romeoSegundaInter.jpg'),
(52, 1, 'TEQUE TEQUE TOCA TOCA ESTA HINCHADA ESTA RE LOCA SOMOS TODOS DIVIDIDOS DIVIDIDOS LAS PELOTAS', 'Divididos 30 años', 'assets/images/divididos-graficagenerica-inter.jpg'),
(53, 2, 'Veni veni veni, no seas puto y veni', 'Mangueras Musmanno Rock Festival', 'assets/images/maxresdefault.jpg'),
(54, 1, 'Descripción de Evento Obligatoria', 'Massacre', 'assets/images/massacreDic18.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `invoices`
--

INSERT INTO `invoices` (`id`, `user_id`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seats`
--

CREATE TABLE `seats` (
  `id` int(11) NOT NULL,
  `number` varchar(8) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `seat_type_id` int(11) NOT NULL,
  `calendar_id` int(11) NOT NULL,
  `availability` smallint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `seats`
--

INSERT INTO `seats` (`id`, `number`, `price`, `seat_type_id`, `calendar_id`, `availability`) VALUES
(454, '1-0', 20, 1, 22, 1),
(655, '1-0', 50, 1, 25, 0),
(656, '1-0', 100, 1, 26, 1),
(657, '1-1', 100, 1, 26, 0),
(658, '1-2', 100, 1, 26, 0),
(659, '1-3', 100, 1, 26, 0),
(660, '1-4', 100, 1, 26, 0),
(661, '1-0', 500, 1, 27, 1),
(662, '1-1', 500, 1, 27, 1),
(663, '1-2', 500, 1, 27, 1),
(664, '1-3', 500, 1, 27, 1),
(665, '1-4', 500, 1, 27, 0),
(666, '1-5', 500, 1, 27, 0),
(667, '1-6', 500, 1, 27, 0),
(668, '1-7', 500, 1, 27, 0),
(669, '1-8', 500, 1, 27, 0),
(670, '1-9', 500, 1, 27, 0),
(671, '1-0', 500, 1, 28, 0),
(672, '1-1', 500, 1, 28, 0),
(673, '1-2', 500, 1, 28, 0),
(674, '1-3', 500, 1, 28, 0),
(675, '1-4', 500, 1, 28, 0),
(676, '1-5', 500, 1, 28, 0),
(677, '1-6', 500, 1, 28, 0),
(678, '1-7', 500, 1, 28, 0),
(679, '1-8', 500, 1, 28, 0),
(680, '1-9', 500, 1, 28, 0),
(681, '1-10', 500, 1, 28, 0),
(682, '1-11', 500, 1, 28, 0),
(683, '1-12', 500, 1, 28, 0),
(684, '1-13', 500, 1, 28, 0),
(685, '1-14', 500, 1, 28, 0),
(686, '1-15', 500, 1, 28, 0),
(687, '1-16', 500, 1, 28, 0),
(688, '1-17', 500, 1, 28, 0),
(689, '1-18', 500, 1, 28, 0),
(690, '1-19', 500, 1, 28, 0),
(691, '1-20', 500, 1, 28, 0),
(692, '1-21', 500, 1, 28, 0),
(693, '1-22', 500, 1, 28, 0),
(694, '1-23', 500, 1, 28, 0),
(695, '1-24', 500, 1, 28, 0),
(696, '1-0', 550, 1, 29, 0),
(697, '1-1', 550, 1, 29, 0),
(698, '1-2', 550, 1, 29, 0),
(699, '1-3', 550, 1, 29, 0),
(700, '1-4', 550, 1, 29, 0),
(701, '1-5', 550, 1, 29, 0),
(702, '1-6', 550, 1, 29, 0),
(703, '1-7', 550, 1, 29, 0),
(704, '1-8', 550, 1, 29, 0),
(705, '1-9', 550, 1, 29, 0),
(706, '1-10', 550, 1, 29, 0),
(707, '1-11', 550, 1, 29, 0),
(708, '1-12', 550, 1, 29, 0),
(709, '1-13', 550, 1, 29, 0),
(710, '1-14', 550, 1, 29, 0),
(711, '1-15', 550, 1, 29, 0),
(712, '1-16', 550, 1, 29, 0),
(713, '1-17', 550, 1, 29, 0),
(714, '1-18', 550, 1, 29, 0),
(715, '1-19', 550, 1, 29, 0),
(716, '1-0', 20, 1, 30, 0),
(717, '1-1', 20, 1, 30, 0),
(718, '1-2', 20, 1, 30, 0),
(719, '1-3', 20, 1, 30, 0),
(720, '1-4', 20, 1, 30, 0),
(721, '1-5', 20, 1, 30, 0),
(722, '1-6', 20, 1, 30, 0),
(723, '1-7', 20, 1, 30, 0),
(724, '1-8', 20, 1, 30, 0),
(725, '1-9', 20, 1, 30, 0),
(726, '1-10', 20, 1, 30, 0),
(727, '1-11', 20, 1, 30, 0),
(728, '1-12', 20, 1, 30, 0),
(729, '1-13', 20, 1, 30, 0),
(730, '1-14', 20, 1, 30, 0),
(731, '1-15', 20, 1, 30, 0),
(732, '1-16', 20, 1, 30, 0),
(733, '1-17', 20, 1, 30, 0),
(734, '1-18', 20, 1, 30, 0),
(735, '1-19', 20, 1, 30, 0),
(736, '1-20', 20, 1, 30, 0),
(737, '1-21', 20, 1, 30, 0),
(738, '1-22', 20, 1, 30, 0),
(739, '1-23', 20, 1, 30, 0),
(740, '1-24', 20, 1, 30, 0),
(741, '1-25', 20, 1, 30, 0),
(742, '1-26', 20, 1, 30, 0),
(743, '1-27', 20, 1, 30, 0),
(744, '1-28', 20, 1, 30, 0),
(745, '1-29', 20, 1, 30, 0),
(746, '1-30', 20, 1, 30, 0),
(747, '1-31', 20, 1, 30, 0),
(748, '1-32', 20, 1, 30, 0),
(749, '1-33', 20, 1, 30, 0),
(750, '1-34', 20, 1, 30, 0),
(751, '1-35', 20, 1, 30, 0),
(752, '1-36', 20, 1, 30, 0),
(753, '1-37', 20, 1, 30, 0),
(754, '1-38', 20, 1, 30, 0),
(755, '1-39', 20, 1, 30, 0),
(756, '1-40', 20, 1, 30, 0),
(757, '1-41', 20, 1, 30, 0),
(758, '1-42', 20, 1, 30, 0),
(759, '1-43', 20, 1, 30, 0),
(760, '1-44', 20, 1, 30, 0),
(761, '1-45', 20, 1, 30, 0),
(762, '1-46', 20, 1, 30, 0),
(763, '1-47', 20, 1, 30, 0),
(764, '1-48', 20, 1, 30, 0),
(765, '1-49', 20, 1, 30, 0),
(766, '1-50', 20, 1, 30, 0),
(767, '1-51', 20, 1, 30, 0),
(768, '1-52', 20, 1, 30, 0),
(769, '1-53', 20, 1, 30, 0),
(770, '1-54', 20, 1, 30, 0),
(771, '1-55', 20, 1, 30, 0),
(772, '1-56', 20, 1, 30, 0),
(773, '1-57', 20, 1, 30, 0),
(774, '1-58', 20, 1, 30, 0),
(775, '1-59', 20, 1, 30, 0),
(776, '1-60', 20, 1, 30, 0),
(777, '1-61', 20, 1, 30, 0),
(778, '1-62', 20, 1, 30, 0),
(779, '1-63', 20, 1, 30, 0),
(780, '1-64', 20, 1, 30, 0),
(781, '1-65', 20, 1, 30, 0),
(782, '1-66', 20, 1, 30, 0),
(783, '1-67', 20, 1, 30, 0),
(784, '1-68', 20, 1, 30, 0),
(785, '1-69', 20, 1, 30, 0),
(786, '1-70', 20, 1, 30, 0),
(787, '1-71', 20, 1, 30, 0),
(788, '1-72', 20, 1, 30, 0),
(789, '1-73', 20, 1, 30, 0),
(790, '1-74', 20, 1, 30, 0),
(791, '1-75', 20, 1, 30, 0),
(792, '1-76', 20, 1, 30, 0),
(793, '1-77', 20, 1, 30, 0),
(794, '1-78', 20, 1, 30, 0),
(795, '1-79', 20, 1, 30, 0),
(796, '1-80', 20, 1, 30, 0),
(797, '1-81', 20, 1, 30, 0),
(798, '1-82', 20, 1, 30, 0),
(799, '1-83', 20, 1, 30, 0),
(800, '1-84', 20, 1, 30, 0),
(801, '1-85', 20, 1, 30, 0),
(802, '1-86', 20, 1, 30, 0),
(803, '1-87', 20, 1, 30, 0),
(804, '1-88', 20, 1, 30, 0),
(805, '1-89', 20, 1, 30, 0),
(806, '1-90', 20, 1, 30, 0),
(807, '1-91', 20, 1, 30, 0),
(808, '1-92', 20, 1, 30, 0),
(809, '1-93', 20, 1, 30, 0),
(810, '1-94', 20, 1, 30, 0),
(811, '1-95', 20, 1, 30, 0),
(812, '1-96', 20, 1, 30, 0),
(813, '1-97', 20, 1, 30, 0),
(814, '1-98', 20, 1, 30, 0),
(815, '1-99', 20, 1, 30, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seat_types`
--

CREATE TABLE `seat_types` (
  `id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `sites` (
  `id` int(11) NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `address` varchar(80) DEFAULT NULL,
  `establishment` varchar(50) DEFAULT NULL,
  `capacity` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sites`
--

INSERT INTO `sites` (`id`, `city`, `province`, `address`, `establishment`, `capacity`) VALUES
(1, 'Mar del Plata', 'Buenos Aires', 'Av. de las Olimpiadas 760', 'Estadio José María Minella', 50000),
(2, 'Mar del Plata', 'Buenos Aires', 'Juan B. Justo 1100', 'Abbey Road', 2000),
(6, 'TaMasLavadoQUe', 'AY ME QUEME', 'Mexico y 25 de Mayo', 'Los turos de las tores', 25000),
(7, 'Mar del Plata', 'Buenos Aires', 'J. B. Justo', 'Liverpool', 1500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL,
  `qrcode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id`, `invoice_id`, `seat_id`, `qrcode`) VALUES
(1, 1, 454, '454-1-0'),
(2, 2, 661, '661-1-0'),
(3, 2, 662, '662-1-1'),
(4, 2, 663, '663-1-2'),
(5, 2, 664, '664-1-3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `mail` varchar(80) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`) VALUES
(1, 'Usuario'),
(2, 'Admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_genre` (`genre_id`);

--
-- Indices de la tabla `artists_in_calendars`
--
ALTER TABLE `artists_in_calendars`
  ADD PRIMARY KEY (`id_artist`,`id_calendar`),
  ADD KEY `id_calendar` (`id_calendar`);

--
-- Indices de la tabla `calendars`
--
ALTER TABLE `calendars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `site_id` (`site_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indices de la tabla `event_categories`
--
ALTER TABLE `event_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gigs`
--
ALTER TABLE `gigs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_category_id` (`event_category_id`);

--
-- Indices de la tabla `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seat_type_id` (`seat_type_id`),
  ADD KEY `calendar_id` (`calendar_id`);

--
-- Indices de la tabla `seat_types`
--
ALTER TABLE `seat_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `seat_id` (`seat_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_ibfk_1` (`role_id`);

--
-- Indices de la tabla `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `calendars`
--
ALTER TABLE `calendars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `event_categories`
--
ALTER TABLE `event_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `gigs`
--
ALTER TABLE `gigs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `seats`
--
ALTER TABLE `seats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=816;

--
-- AUTO_INCREMENT de la tabla `seat_types`
--
ALTER TABLE `seat_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `artists_in_calendars_ibfk_1` FOREIGN KEY (`id_artist`) REFERENCES `artists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `artists_in_calendars_ibfk_2` FOREIGN KEY (`id_calendar`) REFERENCES `calendars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `calendars`
--
ALTER TABLE `calendars`
  ADD CONSTRAINT `calendars_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `calendars_ibfk_3` FOREIGN KEY (`event_id`) REFERENCES `gigs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `gigs`
--
ALTER TABLE `gigs`
  ADD CONSTRAINT `gigs_ibfk_1` FOREIGN KEY (`event_category_id`) REFERENCES `event_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_ibfk_1` FOREIGN KEY (`seat_type_id`) REFERENCES `seat_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seats_ibfk_2` FOREIGN KEY (`calendar_id`) REFERENCES `calendars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
