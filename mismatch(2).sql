-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-12-2020 a las 03:15:57
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
(1, 3, 1, 1),
(2, 3, 2, NULL),
(3, 3, 3, NULL),
(4, 3, 4, NULL),
(5, 3, 5, NULL),
(6, 3, 6, NULL),
(7, 3, 7, NULL),
(8, 3, 8, NULL),
(9, 3, 9, NULL),
(10, 3, 10, NULL),
(11, 3, 11, NULL),
(12, 3, 12, NULL),
(13, 3, 13, NULL),
(14, 3, 14, NULL),
(15, 3, 15, NULL),
(16, 3, 16, NULL),
(17, 3, 17, NULL),
(18, 3, 18, NULL),
(19, 3, 19, NULL),
(20, 3, 20, NULL),
(21, 3, 21, NULL),
(22, 3, 22, NULL),
(23, 3, 23, NULL),
(24, 3, 24, NULL),
(25, 3, 25, NULL);

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
(20, 'uuhnaenthertrJePenninnsseed5tnneireitrn', NULL, '2020-12-14 01:16:28', 3);

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
(3, 'Yisus', '580ea35d434591d9880ad70419e56e3a061d24f7', 1, 'JesÃºs', 'SÃ¡nchez Miranda', 2, '1999-11-04 00:00:00', 'Granada', 'EspaÃ±a', NULL),
(5, 'nicopafi', 'nicopafi', 1, 'Nicolas', 'Figueras Parras', 1, '1999-03-22 00:00:00', 'Granada', 'EspaÃ±a', NULL);

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
  MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `mismatch_topic`
--
ALTER TABLE `mismatch_topic`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `sessions`
--
ALTER TABLE `sessions`
  MODIFY `sessions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
