-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2020 a las 14:34:52
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `poligonos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poli`
--

CREATE TABLE `poli` (
  `id_poligono` int(11) NOT NULL,
  `zona` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `clave` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `coordenadas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `color` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `poli`
--

INSERT INTO `poli` (`id_poligono`, `zona`, `clave`, `coordenadas`, `color`, `created_at`) VALUES
(1, 'La primavera', 'JKR-2', '[{lat: 20.3668855, lng: -102.7837861}, {lat: 20.3648337, lng: -102.776233}, {lat: 20.3726789, lng: -102.7733148}, {lat: 20.3750123, lng: -102.7805246}, {lat: 20.3668855, lng: -102.7837861}]', '#ff9a8c', '2020-11-06 04:00:00'),
(2, 'Centro', 'JKR-5', '[{lat: 20.3467989, lng: -102.7776894}, {lat: 20.3448675, lng: -102.774857}, {lat: 20.3470404, lng: -102.7698788}, {lat: 20.3510641, lng: -102.7694067}, {lat: 20.3532771, lng: -102.7684197}, {lat: 20.3534783, lng: -102.7744278}, {lat: 20.3537197, lng: -102.7748999}, {lat: 20.3520298, lng: -102.778891}, {lat: 20.349857,  lng: -102.7776035}, {lat: 20.3467989, lng: -102.7776894}]', '#892cdc', '2020-11-07 05:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id_poligono`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `poli`
--
ALTER TABLE `poli`
  MODIFY `id_poligono` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
