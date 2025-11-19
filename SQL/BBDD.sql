-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-06-2025 a las 17:43:15
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
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_personales`
--

CREATE TABLE `datos_personales` (
  `id` bigint(20) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `email` text NOT NULL,
  `nombre` text NOT NULL,
  `apellidos` text NOT NULL,
  `pais` text NOT NULL,
  `ciudad` text NOT NULL,
  `cp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `datos_personales`
--

INSERT INTO `datos_personales` (`id`, `id_usuario`, `email`, `nombre`, `apellidos`, `pais`, `ciudad`, `cp`) VALUES
(3, 6, 'pepito@hotmail.com', 'Rael', 'NuÃ±ez Almech', 'EspaÃ±a', 'Madrid', '28032'),
(5, 21, 'pepito@pepito', 'pepito', 'grillo', 'espaÃ±a', 'madrid', '28003');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `usuario` varchar(100) DEFAULT NULL,
  `accion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`id`, `fecha`, `usuario`, `accion`) VALUES
(1, '2025-06-08 01:16:55', 'admin1', 'Inicio de sesiÃ³n'),
(2, '2025-06-08 01:21:33', 'admin1', 'Inicio de sesiÃ³n'),
(3, '2025-06-08 01:31:28', 'admin1', 'Inicio de sesiÃ³n'),
(4, '2025-06-08 01:50:57', 'admin1', 'Inicio de sesiÃ³n'),
(5, '2025-06-08 01:51:22', 'fapen', 'Inicio de sesiÃ³n'),
(6, '2025-06-08 11:37:35', 'admin1', 'Inicio de sesiÃ³n'),
(7, '2025-06-08 11:37:55', 'fapen', 'Inicio de sesiÃ³n'),
(8, '2025-06-08 11:40:24', 'admin1', 'Inicio de sesiÃ³n'),
(9, '2025-06-08 11:42:32', 'admin1', 'EliminÃ³ al usuario: fapen'),
(10, '2025-06-08 12:33:32', 'admin1', 'Inicio de sesiÃ³n'),
(11, '2025-06-08 12:33:43', 'admin1', 'EliminÃ³ al usuario: '),
(12, '2025-06-08 12:46:11', 'admin1', 'Inicio de sesiÃ³n'),
(13, '2025-06-08 12:46:19', 'admin1', 'EliminÃ³ al usuario: '),
(14, '2025-06-08 13:09:14', 'Alberto', 'Inicio de sesiÃ³n'),
(15, '2025-06-08 13:09:45', 'Alberto', 'Inicio de sesiÃ³n'),
(16, '2025-06-08 13:11:23', 'Alberto', 'Inicio de sesiÃ³n'),
(17, '2025-06-08 13:13:50', 'Alberto', 'Inicio de sesiÃ³n'),
(18, '2025-06-08 13:14:48', 'admin1', 'Inicio de sesiÃ³n'),
(19, '2025-06-08 13:28:23', 'admin1', 'Inicio de sesiÃ³n'),
(20, '2025-06-08 13:28:40', 'admin1', 'EliminÃ³ al usuario: '),
(21, '2025-06-08 13:28:45', 'admin1', 'EliminÃ³ al usuario: fapen1'),
(22, '2025-06-08 13:28:47', 'admin1', 'EliminÃ³ al usuario: fapen'),
(23, '2025-06-08 13:30:10', 'admin1', 'Inicio de sesiÃ³n'),
(24, '2025-06-08 13:34:48', 'admin1', 'Inicio de sesiÃ³n'),
(25, '2025-06-08 13:41:52', 'admin1', 'Inicio de sesiÃ³n'),
(26, '2025-06-08 13:42:33', 'admin1', 'Inicio de sesiÃ³n'),
(27, '2025-06-08 13:45:25', 'admin1', 'Inicio de sesiÃ³n'),
(28, '2025-06-08 13:45:56', 'Alberto', 'Inicio de sesiÃ³n'),
(29, '2025-06-08 13:47:44', 'Alberto', 'Inicio de sesiÃ³n'),
(30, '2025-06-08 13:47:59', 'Alberto', 'Inicio de sesiÃ³n'),
(31, '2025-06-08 13:50:04', 'Alberto', 'Inicio de sesiÃ³n'),
(32, '2025-06-08 13:52:24', 'Alberto', 'Inicio de sesiÃ³n'),
(33, '2025-06-08 13:52:52', 'admin1', 'Inicio de sesiÃ³n'),
(34, '2025-06-08 14:00:54', 'admin1', 'Inicio de sesiÃ³n'),
(35, '2025-06-08 14:03:30', 'admin1', 'Inicio de sesiÃ³n'),
(36, '2025-06-08 14:10:22', 'admin1', 'Inicio de sesiÃ³n'),
(37, '2025-06-08 14:21:43', 'admin1', 'Inicio de sesiÃ³n'),
(38, '2025-06-10 18:45:49', 'admin1', 'Inicio de sesiÃ³n'),
(39, '2025-06-11 20:35:43', 'admin1', 'Inicio de sesiÃ³n'),
(40, '2025-06-11 20:36:15', 'Alberto', 'Inicio de sesiÃ³n'),
(41, '2025-06-11 20:37:24', 'Alberto', 'Inicio de sesiÃ³n'),
(42, '2025-06-11 20:40:53', 'Alberto', 'Inicio de sesiÃ³n'),
(43, '2025-06-11 21:16:39', 'admin1', 'Inicio de sesiÃ³n'),
(44, '2025-06-11 21:19:28', 'admin1', 'Inicio de sesiÃ³n'),
(45, '2025-06-11 21:29:30', 'admin1', 'Inicio de sesiÃ³n'),
(46, '2025-06-11 21:30:55', 'admin1', 'EliminÃ³ al usuario: rael'),
(47, '2025-06-11 21:30:58', 'admin1', 'EliminÃ³ al usuario: minoshia'),
(48, '2025-06-11 21:31:00', 'admin1', 'EliminÃ³ al usuario: lourdes'),
(49, '2025-06-11 22:48:11', 'admin1', 'Inicio de sesiÃ³n'),
(50, '2025-06-11 22:49:58', 'admin1', 'Inicio de sesiÃ³n'),
(51, '2025-06-11 22:50:08', 'admin1', 'Inicio de sesiÃ³n'),
(52, '2025-06-11 22:55:11', 'admin1', 'Inicio de sesiÃ³n'),
(53, '2025-06-11 22:55:20', 'admin1', 'Inicio de sesiÃ³n'),
(54, '2025-06-11 22:55:34', 'admin1', 'Inicio de sesiÃ³n'),
(55, '2025-06-11 22:56:32', 'admin1', 'Inicio de sesiÃ³n'),
(56, '2025-06-11 22:56:41', 'admin1', 'Inicio de sesiÃ³n'),
(57, '2025-06-11 22:58:57', 'admin1', 'Inicio de sesiÃ³n'),
(58, '2025-06-11 22:59:57', 'admin1', 'Inicio de sesiÃ³n'),
(59, '2025-06-11 23:00:12', 'admin1', 'Inicio de sesiÃ³n'),
(60, '2025-06-11 23:01:07', 'admin1', 'Inicio de sesiÃ³n'),
(61, '2025-06-11 23:02:47', 'admin1', 'Inicio de sesiÃ³n'),
(62, '2025-06-11 23:03:44', 'admin1', 'Inicio de sesiÃ³n'),
(63, '2025-06-12 01:14:28', 'admin1', 'Inicio de sesiÃ³n'),
(64, '2025-06-13 01:03:56', 'admin1', 'Inicio de sesiÃ³n'),
(65, '2025-06-13 01:13:46', 'admin1', 'Inicio de sesiÃ³n'),
(66, '2025-06-13 19:55:47', 'Alberto', 'Inicio de sesiÃ³n'),
(67, '2025-06-13 19:58:31', 'admin1', 'Inicio de sesiÃ³n'),
(68, '2025-06-13 19:59:25', 'admin1', 'EliminÃ³ al usuario: fapen1'),
(69, '2025-06-13 20:02:29', 'admin1', 'Inicio de sesiÃ³n'),
(70, '2025-06-13 20:02:56', 'admin1', 'Inicio de sesiÃ³n'),
(71, '2025-06-13 20:27:38', 'admin1', 'Inicio de sesiÃ³n'),
(72, '2025-06-13 20:30:22', 'admin1', 'EliminÃ³ al usuario: Alberto'),
(73, '2025-06-13 20:31:09', 'pepito', 'Inicio de sesiÃ³n'),
(74, '2025-06-15 17:40:11', 'admin1', 'Inicio de sesiÃ³n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id` bigint(20) NOT NULL,
  `type` enum('registrado','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `type`) VALUES
(1, 'registrado'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones`
--

CREATE TABLE `transacciones` (
  `id` bigint(20) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `type` enum('ingreso','gasto') NOT NULL,
  `method` enum('efectivo','transferencia','tarjeta') NOT NULL,
  `date` date NOT NULL,
  `descripcion` text NOT NULL DEFAULT 'Sin descripción',
  `categoria` text NOT NULL DEFAULT 'General'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `transacciones`
--

INSERT INTO `transacciones` (`id`, `id_usuario`, `cantidad`, `type`, `method`, `date`, `descripcion`, `categoria`) VALUES
(29, 6, 1600.00, 'ingreso', 'transferencia', '0000-00-00', 'nomina', 'Salario'),
(30, 6, 50.00, 'gasto', 'efectivo', '0000-00-00', 'pizza', 'Comida'),
(31, 6, 30.00, 'gasto', 'tarjeta', '0000-00-00', 'comics', 'Ocio'),
(32, 21, 1000.00, 'ingreso', 'transferencia', '0000-00-00', 'nomina', 'Salario'),
(34, 21, 23.00, 'gasto', 'tarjeta', '0000-00-00', 'melones', 'Comida'),
(35, 21, 22.00, 'gasto', 'efectivo', '0000-00-00', 'comics', 'Ocio'),
(36, 21, 80.00, 'gasto', 'efectivo', '0000-00-00', 'bus', 'Transporte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) NOT NULL,
  `usuario` text NOT NULL,
  `password` text NOT NULL,
  `id_tipo_usuario` bigint(20) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `id_tipo_usuario`) VALUES
(6, 'admin1', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 2),
(21, 'pepito', 'c8cdf720db5562a039be5d81c51a07c5120eaf0bf142b2144f1a1eb7a95678d3', 1),
(22, 'cupido', '90c0665a9baafe1ae7271679aa82721b9b40a8c3ec2090d40c4aef79057afe9a', 1),
(23, 'fapen', '251ef98629eed0b6730b4507deb076ffa1bdd7fbf0491d6ac20c7b5795710b43', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING HASH,
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`);

--
-- Indices de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`) USING HASH,
  ADD KEY `id_tipo_usuario` (`id_tipo_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  ADD CONSTRAINT `datos_personales_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD CONSTRAINT `transacciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
