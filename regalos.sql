-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 24-11-2020 a las 01:48:07
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.3.21

START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `regalos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `existencia` int NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `edad` varchar(20) NOT NULL,
  `genero` varchar(20) NOT NULL,
  `foto` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `marca`, `descripcion`, `existencia`, `precio`, `tipo`, `edad`, `genero`, `foto`) VALUES
(57, 'jona', 'z', 'el mas guapo del mundo', 3, '10000000.99', 'z', '0-3', 'Niño', ''),
(58, 'jona', 'z', 'el mas guapo del mundo', 4, '10000000.99', 'z', '0-3', 'Niño', ''),
(59, 'jona', 'z', 'el mas guapo del mundo', 8, '10000000.99', 'z', '0-3', 'Niño', ''),
(60, 'jona', 'z', 'el mas guapo del mundo', 1, '10000000.99', 'z', '0-3', 'Niño', ''),
(61, 'jona', 'z', 'el mas guapo del mundo', 1, '10000000.99', 'z', '0-3', 'Niño', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
