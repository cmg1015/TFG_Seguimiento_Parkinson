-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-06-2024 a las 17:45:29
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `webparkinson`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id_actividad` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `numero_bloqueos` int(11) NOT NULL,
  `velocidad_media` decimal(10,2) NOT NULL,
  `numero_pasos` int(11) NOT NULL,
  `duracion` float NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id_actividad`, `id_paciente`, `numero_bloqueos`, `velocidad_media`, `numero_pasos`, `duracion`, `fecha`, `hora`) VALUES
(1, 8, 0, 0.00, 0, 0, NULL, '00:00:00'),
(2, 8, 0, 0.00, 0, 0, NULL, '00:00:00'),
(3, 8, 0, 0.00, 0, 0, NULL, '00:00:00'),
(4, 8, 3, 2.28, 32, 0.8, NULL, '00:00:00'),
(5, 8, 0, 2.87, 26, 0.38, NULL, '00:00:00'),
(6, 8, 2, 2.84, 24, 0.55, NULL, '00:00:00'),
(7, 8, 1, 1.14, 14, 0.47, NULL, '00:00:00'),
(8, 8, 1, 2.37, 14, 0.35, NULL, '00:00:00'),
(9, 8, 1, 1.44, 18, 0.45, NULL, '00:00:00'),
(10, 8, 1, 1.44, 18, 0.45, NULL, '00:00:00'),
(11, 8, 2, 2.19, 40, 0.88, NULL, '00:00:00'),
(12, 8, 0, 3.35, 6, 0.13, NULL, '00:00:00'),
(13, 8, 3, 2.44, 10, 0.35, NULL, '00:00:00'),
(14, 8, 8, 1.80, 26, 1.18, NULL, '00:00:00'),
(15, 8, 0, 1.51, 2, 0.1, NULL, '00:00:00'),
(22, 8, 2, 2.44, 26, 0.75, NULL, '00:00:00'),
(23, 8, 1, 2.02, 16, 0.35, NULL, '00:00:00'),
(24, 8, 1, 0.95, 2, 0.13, NULL, '00:00:00'),
(25, 8, 4, 2.17, 42, 1.17, NULL, '00:00:00'),
(26, 8, 0, 1.53, 6, 0.12, NULL, '00:00:00'),
(27, 8, 0, 0.81, 4, 0.1, NULL, '00:00:00'),
(28, 8, 0, 0.53, 2, 0.08, NULL, '00:00:00'),
(29, 8, 0, 0.53, 2, 0.08, NULL, '00:00:00'),
(30, 8, 0, 0.16, 2, 0.08, NULL, '00:00:00'),
(31, 8, 0, 2.13, 14, 0.32, NULL, '00:00:00'),
(32, 8, 3, 3.11, 54, 1.02, NULL, '00:00:00'),
(33, 8, 0, 0.00, 0, 0.02, NULL, '00:00:00'),
(34, 8, 0, 2.71, 4, 0.08, NULL, '00:00:00'),
(35, 8, 1, 1.79, 4, 0.12, NULL, '00:00:00'),
(36, 8, 0, 1.30, 12, 0.82, NULL, '00:00:00'),
(37, 8, 0, 2.25, 32, 0.9, NULL, '00:00:00'),
(38, 8, 2, 3.10, 24, 0.5, NULL, '00:00:00'),
(39, 8, 2, 3.10, 24, 0.5, NULL, '00:00:00'),
(40, 8, 3, 2.09, 24, 0.8, NULL, '00:00:00'),
(41, 8, 6, 3.43, 34, 0.75, NULL, '00:00:00'),
(42, 8, 2, 4.11, 18, 0.27, NULL, '00:00:00'),
(43, 8, 6, 4.56, 36, 0.52, NULL, '00:00:00'),
(44, 8, 2, 1.72, 16, 0.85, NULL, '00:00:00'),
(45, 8, 1, 1.62, 10, 0.37, NULL, '00:00:00'),
(46, 8, 0, 0.00, 0, 0, NULL, '00:00:00'),
(47, 8, 0, 0.00, 0, 0, NULL, '00:00:00'),
(48, 8, 0, 0.00, 0, 0, NULL, '00:00:00'),
(49, 8, 0, 0.00, 0, 0.02, NULL, '00:00:00'),
(51, 8, 7, 0.00, 0, 1.2, '2024-05-20', '20:29:21'),
(52, 8, 7, 2.00, 20, 2.4, '2024-05-20', '10:30:00'),
(53, 8, 3, 1.45, 8, 0.27, '2024-06-05', '20:49:13'),
(55, 11, 3, 3.29, 24, 0.24, '2024-06-05', '00:09:41'),
(56, 11, 2, 5.88, 14, 0.07, '2024-06-05', '00:17:04'),
(57, 11, 8, 6.83, 30, 0.18, '2024-06-05', '00:20:26'),
(58, 11, 3, 4.97, 4, 0.02, '2024-06-05', '00:22:07'),
(59, 11, 2, 3.93, 30, 0.3, '2024-06-05', '00:27:19'),
(60, 8, 2, 1.84, 26, 0.38, '2024-06-06', '11:20:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diario`
--

CREATE TABLE `diario` (
  `id_tabla` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `durmiendo` int(11) NOT NULL,
  `off_status` int(11) NOT NULL,
  `on_status` int(11) NOT NULL,
  `ondis_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `diario`
--

INSERT INTO `diario` (`id_tabla`, `fecha`, `hora`, `durmiendo`, `off_status`, `on_status`, `ondis_status`) VALUES
(1, '2024-05-20', '07:00:00', 1, 0, 0, 0),
(2, '2024-05-20', '07:30:00', 1, 0, 0, 0),
(3, '2024-05-20', '08:00:00', 0, 1, 0, 0),
(4, '2024-05-20', '08:30:00', 0, 1, 0, 0),
(5, '2024-05-20', '09:00:00', 0, 1, 0, 0),
(6, '2024-05-20', '09:30:00', 0, 1, 0, 0),
(7, '2024-05-20', '10:00:00', 0, 0, 1, 0),
(8, '2024-05-20', '10:30:00', 0, 0, 1, 0),
(9, '2024-05-20', '11:00:00', 0, 0, 1, 0),
(10, '2024-05-20', '11:30:00', 0, 0, 0, 1),
(11, '2024-05-20', '12:00:00', 0, 0, 0, 1),
(12, '2024-05-20', '12:30:00', 0, 0, 0, 1),
(13, '2024-05-20', '13:00:00', 0, 0, 0, 1),
(14, '2024-05-20', '13:30:00', 0, 0, 0, 1),
(15, '2024-05-20', '14:00:00', 0, 0, 1, 0),
(16, '2024-05-20', '14:30:00', 0, 1, 0, 0),
(17, '2024-05-20', '15:00:00', 0, 1, 0, 0),
(18, '2024-05-20', '15:30:00', 0, 1, 0, 0),
(19, '2024-05-20', '16:00:00', 0, 1, 0, 0),
(20, '2024-05-20', '16:30:00', 0, 1, 0, 0),
(21, '2024-05-20', '17:00:00', 0, 1, 0, 0),
(22, '2024-05-20', '17:30:00', 1, 0, 0, 0),
(23, '2024-05-20', '18:00:00', 1, 0, 0, 0),
(24, '2024-05-20', '18:30:00', 1, 0, 0, 0),
(25, '2024-05-20', '19:00:00', 0, 0, 1, 0),
(26, '2024-05-20', '19:30:00', 0, 0, 1, 0),
(27, '2024-05-20', '20:00:00', 0, 0, 0, 1),
(28, '2024-05-20', '20:30:00', 0, 0, 0, 1),
(29, '2024-05-20', '21:00:00', 0, 0, 0, 1),
(30, '2024-05-20', '21:30:00', 0, 1, 0, 0),
(31, '2024-05-20', '22:00:00', 0, 1, 0, 0),
(32, '2024-05-20', '22:30:00', 0, 1, 0, 0),
(33, '2024-05-20', '23:00:00', 1, 0, 0, 0),
(34, '2024-05-20', '23:30:00', 1, 0, 0, 0),
(108, '2024-06-02', '07:00:00', 1, 0, 0, 0),
(109, '2024-06-02', '07:30:00', 1, 0, 0, 0),
(110, '2024-06-02', '08:00:00', 1, 0, 0, 0),
(111, '2024-06-02', '08:30:00', 1, 0, 0, 0),
(112, '2024-06-02', '09:00:00', 1, 0, 0, 0),
(113, '2024-06-02', '09:30:00', 1, 0, 0, 0),
(114, '2024-06-02', '10:00:00', 1, 0, 0, 0),
(115, '2024-06-02', '10:30:00', 1, 0, 0, 0),
(116, '2024-06-02', '11:00:00', 1, 0, 0, 0),
(117, '2024-06-02', '11:30:00', 1, 0, 0, 0),
(118, '2024-06-02', '12:00:00', 1, 0, 0, 0),
(119, '2024-06-02', '12:30:00', 1, 0, 0, 0),
(120, '2024-06-02', '13:00:00', 1, 0, 0, 0),
(121, '2024-06-02', '13:30:00', 1, 0, 0, 0),
(122, '2024-06-02', '14:00:00', 1, 0, 0, 0),
(123, '2024-06-02', '14:30:00', 1, 0, 0, 0),
(124, '2024-06-02', '15:00:00', 1, 0, 0, 0),
(125, '2024-06-02', '15:30:00', 1, 0, 0, 0),
(126, '2024-06-02', '16:00:00', 0, 0, 0, 1),
(127, '2024-06-02', '16:30:00', 0, 0, 0, 1),
(128, '2024-06-02', '17:00:00', 0, 0, 1, 0),
(129, '2024-06-02', '17:30:00', 0, 0, 1, 0),
(130, '2024-06-02', '18:00:00', 0, 0, 1, 0),
(131, '2024-06-02', '18:30:00', 0, 0, 1, 0),
(132, '2024-06-02', '19:00:00', 0, 0, 1, 0),
(133, '2024-06-02', '19:30:00', 0, 0, 1, 0),
(134, '2024-06-02', '20:00:00', 0, 0, 1, 0),
(135, '2024-06-02', '20:30:00', 0, 0, 1, 0),
(136, '2024-06-02', '21:00:00', 0, 0, 1, 0),
(137, '2024-06-02', '21:30:00', 0, 1, 0, 0),
(138, '2024-06-02', '22:00:00', 0, 1, 0, 0),
(139, '2024-06-02', '22:30:00', 0, 1, 0, 0),
(140, '2024-06-02', '23:00:00', 0, 1, 0, 0),
(141, '2024-06-02', '23:30:00', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diario2`
--

CREATE TABLE `diario2` (
  `id_tabla` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `medicacion` text DEFAULT NULL,
  `hora_1` time DEFAULT NULL,
  `hora_2` time DEFAULT NULL,
  `hora_3` time DEFAULT NULL,
  `hora_4` time DEFAULT NULL,
  `hora_5` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `diario2`
--

INSERT INTO `diario2` (`id_tabla`, `fecha`, `medicacion`, `hora_1`, `hora_2`, `hora_3`, `hora_4`, `hora_5`) VALUES
(1, '2024-05-02', NULL, NULL, NULL, NULL, NULL, NULL),
(5, '2024-05-01', '', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(6, '2024-05-03', 'levodopa', '02:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(7, '2024-05-03', 'levodopa', '02:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(8, '2024-05-03', 'levodopa', '02:00:00', '05:00:00', '08:00:00', '11:00:00', '14:00:00'),
(9, '2024-05-03', 'levodopa', '02:00:00', '05:00:00', '08:00:00', '11:00:00', '14:00:00'),
(10, '2024-05-03', '', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(11, '2024-05-03', 'levodopa', '02:00:00', '05:00:00', '08:00:00', '11:00:00', '14:00:00'),
(12, '2024-05-03', 'fghjkl', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(13, '2024-05-03', 'levodopa', '02:00:00', '05:00:00', '08:00:00', '11:00:00', '14:00:00'),
(14, '2024-05-03', 'levodopa2', '01:00:00', '04:00:00', '07:00:00', '10:00:00', '13:00:00'),
(15, '2024-05-03', 'levodopa3', '00:00:00', '03:00:00', '06:00:00', '09:00:00', '12:00:00'),
(16, '2024-05-03', 'levodopa4', '03:00:00', '06:00:00', '09:00:00', '12:00:00', '15:00:00'),
(17, '2024-05-03', 'levodopa5', '04:00:00', '07:00:00', '10:00:00', '13:00:00', '16:00:00'),
(18, '2024-05-03', 'levodopa', '02:00:00', '05:00:00', '08:00:00', '11:00:00', '14:00:00'),
(19, '2024-05-03', 'levodopa2', '01:00:00', '04:00:00', '07:00:00', '10:00:00', '13:00:00'),
(20, '2024-05-03', 'levodopa3', '00:00:00', '03:00:00', '06:00:00', '09:00:00', '12:00:00'),
(21, '2024-05-03', 'levodopa4', '03:00:00', '06:00:00', '09:00:00', '12:00:00', '15:00:00'),
(22, '2024-05-03', 'levodopa5', '04:00:00', '07:00:00', '10:00:00', '13:00:00', '16:00:00'),
(23, '2024-05-03', 'levodopa', '02:00:00', '05:00:00', '08:00:00', '11:00:00', '14:00:00'),
(24, '2024-05-03', 'levodopa2', '01:00:00', '04:00:00', '07:00:00', '10:00:00', '13:00:00'),
(25, '2024-05-03', 'levodopa3', '00:00:00', '03:00:00', '06:00:00', '09:00:00', '12:00:00'),
(26, '2024-05-03', 'levodopa4', '03:00:00', '06:00:00', '09:00:00', '12:00:00', '15:00:00'),
(27, '2024-05-20', 'levodopa5', '04:00:00', '07:00:00', '10:00:00', '13:00:00', '16:00:00'),
(28, '2024-05-20', 'levodopa', '08:00:00', '15:00:00', '18:00:00', '00:00:00', '00:00:00'),
(29, '2024-05-03', 'levodopa2', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(30, '2024-05-03', 'levodopa3', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(31, '2024-05-03', 'levodopa', '08:00:00', '15:00:00', '18:00:00', '00:00:00', '00:00:00'),
(32, '2024-05-03', 'levodopa2', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(33, '2024-05-03', 'levodopa3', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(34, '2024-05-03', 'levodopa', '08:00:00', '15:00:00', '18:00:00', '00:00:00', '00:00:00'),
(35, '2024-05-03', 'levodopa2', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(36, '2024-05-03', 'levodopa3', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(37, '2024-05-03', 'levodopa', '08:00:00', '15:00:00', '18:00:00', '00:00:00', '00:00:00'),
(38, '2024-05-03', '', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(39, '2024-05-03', 'levodopa', '03:00:00', '16:00:00', '19:00:00', '00:00:00', '00:00:00'),
(40, '2024-05-03', 'levodopa2', '04:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(41, '2024-05-03', 'levodopa3', '11:00:00', '18:00:00', '00:00:00', '00:00:00', '00:00:00'),
(42, '2024-05-19', 'levodopa', '01:00:00', '02:00:00', '03:00:00', '04:00:00', '05:00:00'),
(43, '2024-05-19', 'levodopa2', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(44, '2024-05-19', 'levodopa3', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(45, '2024-05-19', 'levodopa4', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int(11) NOT NULL,
  `altura` int(3) NOT NULL,
  `sexo` enum('M','F') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id_paciente`, `altura`, `sexo`) VALUES
(8, 150, 'M'),
(10, 170, 'F'),
(11, 167, 'F');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pautas`
--

CREATE TABLE `pautas` (
  `id_tabla` int(11) NOT NULL,
  `paciente` text NOT NULL,
  `nummed` int(11) NOT NULL,
  `medicacion` text NOT NULL,
  `hora_1` text NOT NULL,
  `hora_2` text NOT NULL,
  `hora_3` text NOT NULL,
  `hora_4` text NOT NULL,
  `hora_5` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pautas`
--

INSERT INTO `pautas` (`id_tabla`, `paciente`, `nummed`, `medicacion`, `hora_1`, `hora_2`, `hora_3`, `hora_4`, `hora_5`) VALUES
(2, '8', 1, 'levodopa', '00:00', '00:00', '', '', ''),
(3, '8', 2, 'levodopa2', '00:00', '00:00', '00:00', '', ''),
(4, '8', 3, 'levodopa3', '00:00', '00:00', '00:00', '00:00', ''),
(5, '8', 4, 'levodopa4', '00:00', '00:00', '00:00', '00:00', '00:00'),
(6, '8', 5, 'levodopa5', '00:00', '', '', '', ''),
(7, '10', 1, 'levodopa', '00:00', '00:00', '', '', ''),
(8, '10', 2, 'levodopa2', '00:00', '00:00', '', '', ''),
(9, '11', 1, 'j', '03:00', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personalizacion`
--

CREATE TABLE `personalizacion` (
  `id_actividad` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `numero_bloqueos` int(11) NOT NULL,
  `velocidad_media` decimal(10,2) NOT NULL,
  `numero_pasos` int(11) NOT NULL,
  `duracion` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personalizacion`
--

INSERT INTO `personalizacion` (`id_actividad`, `id_paciente`, `numero_bloqueos`, `velocidad_media`, `numero_pasos`, `duracion`) VALUES
(1, 0, 0, 0.00, 0, 0),
(2, 6, 6, 2.20, 8, 3.2),
(3, 5, 9, 2.47, 7, 6.4),
(132, 0, 0, 1.24, 14, 0.4),
(133, 8, 3, 2.48, 32, 0.97),
(134, 8, 3, 2.48, 32, 0.97),
(135, 8, 7, 1.69, 54, 1.85),
(136, 8, 1, 3.32, 16, 0.28),
(137, 8, 1, 2.50, 14, 0.27),
(138, 8, 0, 0.00, 0, 0),
(139, 8, 0, 0.00, 0, 0),
(140, 8, 1, 1.97, 14, 0.38),
(141, 8, 5, 2.74, 30, 0.87),
(142, 8, 4, 2.29, 36, 1.02),
(143, 8, 0, 0.00, 0, 0),
(144, 8, 1, 3.42, 16, 0.27),
(145, 8, 0, 1.99, 12, 0.23),
(146, 8, 0, 2.13, 12, 0.27),
(147, 8, 0, 4.51, 14, 0.15),
(148, 8, 0, 2.16, 16, 0.27),
(149, 8, 0, 2.52, 12, 0.27),
(150, 8, 1, 2.45, 14, 0.28),
(151, 8, 0, 3.78, 14, 0.17),
(152, 8, 0, 1.49, 12, 0.25),
(153, 8, 0, 2.90, 14, 0.25),
(154, 8, 0, 2.90, 14, 0.25),
(155, 8, 2, 3.00, 36, 0.67),
(156, 8, 0, 1.91, 14, 0.3),
(157, 8, 0, 2.93, 16, 0.28),
(158, 8, 3, 1.86, 20, 0.75),
(159, 8, 2, 3.02, 22, 0.4),
(160, 8, 0, 2.98, 12, 0.2),
(161, 8, 0, 2.38, 14, 0.25),
(162, 8, 0, 2.56, 14, 0.23),
(163, 8, 1, 1.43, 22, 1.1),
(164, 8, 1, 1.43, 22, 1.1),
(165, 8, 0, 2.59, 20, 0.3),
(166, 8, 0, 1.19, 14, 0.45),
(167, 8, 8, 3.10, 56, 1.18),
(168, 8, 0, 0.00, 0, 0),
(169, 8, 0, 0.80, 14, 1.65),
(170, 8, 0, 1.20, 14, 0.42),
(171, 8, 0, 1.71, 26, 1.05),
(172, 8, 0, 1.36, 14, 0.28),
(173, 8, 3, 1.89, 48, 1.33),
(174, 8, 0, 1.01, 14, 0.32),
(175, 8, 0, 1.99, 14, 0.3),
(176, 8, 0, 1.80, 12, 0.2),
(177, 8, 0, 1.22, 14, 0.34),
(178, 0, 0, 1.40, 14, 0.18),
(179, 8, 0, 1.65, 14, 0.21),
(180, 11, 0, 1.46, 14, 0.23),
(181, 11, 0, 1.27, 14, 0.19),
(182, 11, 0, 2.72, 18, 0.16),
(183, 11, 0, 2.55, 18, 0.23),
(184, 11, 0, 2.22, 18, 0.3),
(185, 11, 7, 1.39, 30, 1.06),
(186, 11, 0, 1.53, 14, 0.32),
(187, 11, 0, 2.04, 14, 0.15),
(188, 11, 0, 2.04, 14, 0.15),
(189, 11, 0, 1.45, 14, 0.25),
(190, 11, 0, 1.82, 16, 0.37),
(191, 11, 0, 0.72, 14, 0.36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesional_paciente`
--

CREATE TABLE `profesional_paciente` (
  `id_profesional` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesional_paciente`
--

INSERT INTO `profesional_paciente` (`id_profesional`, `id_paciente`) VALUES
(6, 8),
(6, 10),
(6, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `correo_electronico` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `tipo_usuario` enum('administrador','profesional','paciente') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellidos`, `correo_electronico`, `contrasena`, `tipo_usuario`) VALUES
(1, 'Ines', 'Martos Barbero', 'imb1006@alu.ubu.es', 'gestion', 'administrador'),
(6, 'Celia', 'Martos Barbero', 'cemb1006@alu.ubu.es', 'prof', 'profesional'),
(7, 'prueba', 'prueba', 'carmargor23@gmail.com', '123', 'administrador'),
(8, 's', 's', 's@gmail.com', 's', 'paciente'),
(10, 'C', 'M', 'c@gmail.com', 'c', 'paciente'),
(11, 'Sara', 'Fernandez', 'sf@gmail.com', 'sf', 'paciente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id_actividad`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `diario`
--
ALTER TABLE `diario`
  ADD PRIMARY KEY (`id_tabla`);

--
-- Indices de la tabla `diario2`
--
ALTER TABLE `diario2`
  ADD PRIMARY KEY (`id_tabla`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`);

--
-- Indices de la tabla `pautas`
--
ALTER TABLE `pautas`
  ADD PRIMARY KEY (`id_tabla`);

--
-- Indices de la tabla `personalizacion`
--
ALTER TABLE `personalizacion`
  ADD PRIMARY KEY (`id_actividad`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `profesional_paciente`
--
ALTER TABLE `profesional_paciente`
  ADD PRIMARY KEY (`id_profesional`,`id_paciente`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo_electronico` (`correo_electronico`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `diario`
--
ALTER TABLE `diario`
  MODIFY `id_tabla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT de la tabla `diario2`
--
ALTER TABLE `diario2`
  MODIFY `id_tabla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT de la tabla `pautas`
--
ALTER TABLE `pautas`
  MODIFY `id_tabla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `personalizacion`
--
ALTER TABLE `personalizacion`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `actividades_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`);

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `pacientes_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `profesional_paciente`
--
ALTER TABLE `profesional_paciente`
  ADD CONSTRAINT `profesional_paciente_ibfk_1` FOREIGN KEY (`id_profesional`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `profesional_paciente_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
