-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-02-2024 a las 00:38:29
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

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
  `duracion` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id_actividad`, `id_paciente`, `numero_bloqueos`, `velocidad_media`, `numero_pasos`, `duracion`) VALUES
(1, 8, 0, '0.00', 0, 0),
(2, 8, 0, '0.00', 0, 0),
(3, 8, 0, '0.00', 0, 0),
(4, 8, 3, '2.28', 32, 0.8),
(5, 8, 0, '2.87', 26, 0.38),
(6, 8, 2, '2.84', 24, 0.55),
(7, 8, 1, '1.14', 14, 0.47),
(8, 8, 1, '2.37', 14, 0.35),
(9, 8, 1, '1.44', 18, 0.45),
(10, 8, 1, '1.44', 18, 0.45),
(11, 8, 2, '2.19', 40, 0.88),
(12, 8, 0, '3.35', 6, 0.13),
(13, 8, 3, '2.44', 10, 0.35),
(14, 8, 8, '1.80', 26, 1.18),
(15, 8, 0, '1.51', 2, 0.1);

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
(8, 150, 'M');

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
(6, 8);

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
(8, 's', 's', 's@gmail.com', 's', 'paciente');

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
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`);

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
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
