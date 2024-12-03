-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 03-12-2024 a las 05:50:43
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `control_medico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajas`
--

DROP TABLE IF EXISTS `cajas`;
CREATE TABLE IF NOT EXISTS `cajas` (
  `expediente` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `total` decimal(7,2) NOT NULL,
  `abono` decimal(7,2) NOT NULL,
  `tipo_pago` varchar(100) NOT NULL,
  `comentarios` varchar(254) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cajas`
--

INSERT INTO `cajas` (`expediente`, `nombre`, `total`, `abono`, `tipo_pago`, `comentarios`) VALUES
(12312, 'dsada', '1221.00', '121.00', 'efectivo', 'adadasdasda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

DROP TABLE IF EXISTS `medicos`;
CREATE TABLE IF NOT EXISTS `medicos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`id`, `nombre`) VALUES
(1, 'Leticia Chavez Diaz'),
(2, 'Antonio Garcia Becerra'),
(3, 'Liliana Cruz Tenorio'),
(4, 'Talia Montes Lucio'),
(5, 'Wendy Naisyn Estrada Renteria'),
(6, 'Vanesa Toledo Reyna'),
(7, 'Balvir Martin Marin Correa'),
(8, 'José Amparo Toledo Villalobos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE IF NOT EXISTS `pacientes` (
  `numero_expediente` int NOT NULL AUTO_INCREMENT,
  `nombre_paciente` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `calle` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `numero` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `colonia` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `municipio` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `cp` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`numero_expediente`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamientos`
--

DROP TABLE IF EXISTS `tratamientos`;
CREATE TABLE IF NOT EXISTS `tratamientos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `numero_expediente` int NOT NULL,
  `nombre_paciente` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tratamiento` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `observaciones` text COLLATE utf8mb4_general_ci,
  `cantidad` int NOT NULL,
  `costo_unitario` decimal(10,2) NOT NULL,
  `costo_total` decimal(10,2) GENERATED ALWAYS AS ((`cantidad` * `costo_unitario`)) STORED,
  `cd_id` int NOT NULL,
  `fecha` date NOT NULL,
  `usuario_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cd_id` (`cd_id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `tratamientos_ibfk_1` (`numero_expediente`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `rol` enum('admin','usuario') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'usuario',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol`) VALUES
(1, 'Administrador', 'admin@ejemplo.com', '0192023a7bbd73250516f069df18b500', 'admin'),
(2, 'Usuario1', 'usuario1@ejemplo.com', '401cec94d3ed586d8cb895c10c0f7db6', 'usuario');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  ADD CONSTRAINT `tratamientos_ibfk_1` FOREIGN KEY (`numero_expediente`) REFERENCES `pacientes` (`numero_expediente`) ON DELETE CASCADE,
  ADD CONSTRAINT `tratamientos_ibfk_2` FOREIGN KEY (`cd_id`) REFERENCES `medicos` (`id`),
  ADD CONSTRAINT `tratamientos_ibfk_3` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
