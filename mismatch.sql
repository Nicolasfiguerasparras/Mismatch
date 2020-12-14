-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-12-2020 a las 07:32:39
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mismatch`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mismatch_category`
--

CREATE TABLE `mismatch_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mismatch_category`
--

INSERT INTO `mismatch_category` (`category_id`, `category_name`) VALUES
(1, 'Appearance'),
(2, 'Entertainment'),
(3, 'Food'),
(4, 'People'),
(5, 'Activities');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mismatch_response`
--

CREATE TABLE `mismatch_response` (
  `response_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `response` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `mismatch_response`
--

INSERT INTO `mismatch_response` (`response_id`, `user_id`, `topic_id`, `response`) VALUES
(26, 6, 1, 0),
(27, 6, 2, 0),
(28, 6, 3, 0),
(29, 6, 4, 0),
(30, 6, 5, 0),
(31, 6, 6, 0),
(32, 6, 7, 0),
(33, 6, 8, 0),
(34, 6, 9, 0),
(35, 6, 10, 0),
(36, 6, 11, 0),
(37, 6, 12, 0),
(38, 6, 13, 0),
(39, 6, 14, 0),
(40, 6, 15, 0),
(41, 6, 16, 0),
(42, 6, 17, 0),
(43, 6, 18, 0),
(44, 6, 19, 0),
(45, 6, 20, 0),
(46, 6, 21, 0),
(47, 6, 22, 0),
(48, 6, 23, 0),
(49, 6, 24, 0),
(50, 6, 25, 0),
(51, 7, 1, 1),
(52, 7, 2, 1),
(53, 7, 3, 1),
(54, 7, 4, 1),
(55, 7, 5, 1),
(56, 7, 6, 1),
(57, 7, 7, 1),
(58, 7, 8, 1),
(59, 7, 9, 1),
(60, 7, 10, 1),
(61, 7, 11, 1),
(62, 7, 12, 1),
(63, 7, 13, 1),
(64, 7, 14, 1),
(65, 7, 15, 1),
(66, 7, 16, 1),
(67, 7, 17, 1),
(68, 7, 18, 1),
(69, 7, 19, 1),
(70, 7, 20, 1),
(71, 7, 21, 1),
(72, 7, 22, 1),
(73, 7, 23, 1),
(74, 7, 24, 1),
(75, 7, 25, 1),
(76, 8, 1, 1),
(77, 8, 2, 1),
(78, 8, 3, 0),
(79, 8, 4, 0),
(80, 8, 5, 1),
(81, 8, 6, 1),
(82, 8, 7, 0),
(83, 8, 8, 0),
(84, 8, 9, 0),
(85, 8, 10, 1),
(86, 8, 11, 0),
(87, 8, 12, 1),
(88, 8, 13, 1),
(89, 8, 14, 1),
(90, 8, 15, 1),
(91, 8, 16, 1),
(92, 8, 17, 1),
(93, 8, 18, 1),
(94, 8, 19, 1),
(95, 8, 20, 0),
(96, 8, 21, 0),
(97, 8, 22, 1),
(98, 8, 23, 0),
(99, 8, 24, 1),
(100, 8, 25, 1),
(101, 9, 1, 1),
(102, 9, 2, 0),
(103, 9, 3, 0),
(104, 9, 4, 1),
(105, 9, 5, 0),
(106, 9, 6, 0),
(107, 9, 7, 0),
(108, 9, 8, 1),
(109, 9, 9, 0),
(110, 9, 10, 0),
(111, 9, 11, 1),
(112, 9, 12, 0),
(113, 9, 13, 1),
(114, 9, 14, 1),
(115, 9, 15, 0),
(116, 9, 16, 1),
(117, 9, 17, 1),
(118, 9, 18, 1),
(119, 9, 19, 0),
(120, 9, 20, 1),
(121, 9, 21, 0),
(122, 9, 22, 1),
(123, 9, 23, 1),
(124, 9, 24, 1),
(125, 9, 25, 1),
(126, 11, 1, 1),
(127, 11, 2, 0),
(128, 11, 3, 0),
(129, 11, 4, 1),
(130, 11, 5, 1),
(131, 11, 6, 1),
(132, 11, 7, 1),
(133, 11, 8, 1),
(134, 11, 9, 1),
(135, 11, 10, 1),
(136, 11, 11, 1),
(137, 11, 12, 0),
(138, 11, 13, 0),
(139, 11, 14, 0),
(140, 11, 15, 0),
(141, 11, 16, 1),
(142, 11, 17, 0),
(143, 11, 18, 0),
(144, 11, 19, 0),
(145, 11, 20, 0),
(146, 11, 21, 1),
(147, 11, 22, 1),
(148, 11, 23, 0),
(149, 11, 24, 0),
(150, 11, 25, 1),
(151, 10, 1, 1),
(152, 10, 2, 0),
(153, 10, 3, 0),
(154, 10, 4, 0),
(155, 10, 5, 0),
(156, 10, 6, 0),
(157, 10, 7, 1),
(158, 10, 8, 0),
(159, 10, 9, 0),
(160, 10, 10, 0),
(161, 10, 11, 0),
(162, 10, 12, 0),
(163, 10, 13, 0),
(164, 10, 14, 0),
(165, 10, 15, 0),
(166, 10, 16, 1),
(167, 10, 17, 0),
(168, 10, 18, 0),
(169, 10, 19, 0),
(170, 10, 20, 0),
(171, 10, 21, 0),
(172, 10, 22, 0),
(173, 10, 23, 0),
(174, 10, 24, 1),
(175, 10, 25, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mismatch_topic`
--

CREATE TABLE `mismatch_topic` (
  `topic_id` int(11) NOT NULL,
  `name` varchar(48) COLLATE utf8_spanish_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mismatch_topic`
--

INSERT INTO `mismatch_topic` (`topic_id`, `name`, `category_id`) VALUES
(1, 'Tattoos', 1),
(2, 'Gold chains', 1),
(3, 'Body piercings', 1),
(4, 'Cowboy boots', 1),
(5, 'Long hair', 1),
(6, 'Reality TV', 2),
(7, 'Professional wrestling', 2),
(8, 'Horror movies', 2),
(9, 'Easy listening music', 2),
(10, 'The opera', 2),
(11, 'Sushi', 3),
(12, 'Spam', 3),
(13, 'Spicy food', 3),
(14, 'Peanut butter & banana sandwiches', 3),
(15, 'Martinis', 3),
(16, 'Howard Stern', 4),
(17, 'Bill Gates', 4),
(18, 'Barbara Streisand', 4),
(19, 'Hugh Hefner', 4),
(20, 'Martha Stewart', 4),
(21, 'Yoga', 5),
(22, 'Weightlifting', 5),
(23, 'Cube puzzles', 5),
(24, 'Karaoke', 5),
(25, 'Hiking', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `sessions_id` int(11) NOT NULL,
  `sessions_token` varchar(40) DEFAULT NULL,
  `sessions_serial` varchar(40) DEFAULT NULL,
  `sessions_date` datetime DEFAULT NULL,
  `sessions_userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`sessions_id`, `sessions_token`, `sessions_serial`, `sessions_date`, `sessions_userid`) VALUES
(26, 'enGtyanlhehnvsenaddeaFhsevnhsrcaelenemoe', NULL, '2020-12-14 04:05:54', 3),
(40, 'PmJniicoheyyerdulrenteGusunnlFncnanvtwe5', NULL, '2020-12-14 07:22:54', 8),
(41, 'StdhelaeeerierlereleynBleGgmidentnluttnr', NULL, '2020-12-14 07:23:24', 9),
(42, 'nenieeh5ivrtttnolBtSTnsuluueinty8uetuneh', NULL, '2020-12-14 07:23:49', 10),
(43, 'nBlngFpPntinottnavviloInnnentFmlnsf8eeei', NULL, '2020-12-14 07:24:20', 7),
(44, 'liiyervm5alnfilhem8aBPuvtnegteeydrdenh', NULL, '2020-12-14 07:24:30', 11),
(45, 'aieBrnfTmfweiwoeedrnraSlveerfnlgistlwtdh', NULL, '2020-12-14 07:24:40', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_username` varchar(25) DEFAULT NULL,
  `users_password` varchar(40) DEFAULT NULL,
  `users_status` int(1) DEFAULT NULL,
  `users_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `users_lastname` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `users_gender` int(1) DEFAULT NULL,
  `users_birthdate` datetime DEFAULT NULL,
  `users_city` varchar(20) DEFAULT NULL,
  `users_state` varchar(25) DEFAULT NULL,
  `users_picture` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`users_id`, `users_username`, `users_password`, `users_status`, `users_name`, `users_lastname`, `users_gender`, `users_birthdate`, `users_city`, `users_state`, `users_picture`) VALUES
(1, 'Admin', '4e7afebcfbae000b22c7c85e5560f89a2a0280b4', 1, 'Administrador', 'Gonzalez', 1, '1999-03-22 00:00:00', 'Granada', NULL, NULL),
(6, 'nicopafi', 'db1b5240f143d73bb4904235ac052d670705670f', 1, 'Nicolás', 'Figueras Parras', 2, '1999-03-22 00:00:00', 'Granada', 'España', 'img/profile2.jpg'),
(7, 'beacano', '6cdaf5f17abbb53814450a0ccc0349c1028c23d7', 1, 'Bea', 'Cano', 1, '1999-08-28 00:00:00', 'Granada', 'España', 'img/profile1.jpg'),
(8, 'jesus', '8d5004c9c74259ab775f63f7131da077814a7636', 1, 'Jesus', 'Sánchez Miranda', 2, '1999-01-01 00:00:00', 'Granada', 'España', 'img/profile3.jpg'),
(9, 'jorge', '33f927344e079e00d3fa45d8833b04e735223eec', 1, 'Jorge', '', 2, '1999-01-01 00:00:00', 'Granada', 'España', 'img/profile13.jpg'),
(10, 'mode', 'e78fe7049341b36116d8054f5a3e00d01f245fcc', 2, 'Modesto', '', 2, '1999-01-01 00:00:00', 'Granada', 'España', 'img/profile4.jpg'),
(11, 'noemi', 'b8c0fc69468c35df5a00022332a69eeab3312588', 1, 'Noemí', 'Parras', 1, '1999-01-01 00:00:00', 'Granada', 'España', 'img/profile7.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mismatch_category`
--
ALTER TABLE `mismatch_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indices de la tabla `mismatch_response`
--
ALTER TABLE `mismatch_response`
  ADD PRIMARY KEY (`response_id`);

--
-- Indices de la tabla `mismatch_topic`
--
ALTER TABLE `mismatch_topic`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`sessions_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mismatch_category`
--
ALTER TABLE `mismatch_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `mismatch_response`
--
ALTER TABLE `mismatch_response`
  MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT de la tabla `mismatch_topic`
--
ALTER TABLE `mismatch_topic`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `sessions`
--
ALTER TABLE `sessions`
  MODIFY `sessions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
