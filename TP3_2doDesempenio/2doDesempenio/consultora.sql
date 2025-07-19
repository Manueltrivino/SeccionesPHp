-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-06-2025 a las 02:51:25
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
-- Base de datos: `consultora`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(10) NOT NULL,
  `denominacion` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `quiencarga` int(50) NOT NULL,
  `observaciones` varchar(50) DEFAULT NULL,
  `idpais` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `denominacion`, `fecha`, `quiencarga`, `observaciones`, `idpais`) VALUES
(1, 'AVEC Automotores', '0000-00-00', 2, 'Carga manual', 1),
(2, 'prueba4', '2025-06-13', 4, '                                        ', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `Id` int(11) NOT NULL,
  `Denominacion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`Id`, `Denominacion`) VALUES
(1, 'Analisis Iniciado'),
(2, 'En Desarrollo'),
(3, 'Terminado'),
(4, 'Cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paiss`
--

CREATE TABLE `paiss` (
  `Id` int(11) NOT NULL,
  `Denominacion` varchar(50) NOT NULL,
  `img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `paiss`
--

INSERT INTO `paiss` (`Id`, `Denominacion`, `img`) VALUES
(1, 'Argentina', 'img/countries/ARG.jpg'),
(2, 'Chile', 'img/countries/CHI.jpg'),
(3, 'Uruguay', 'img/countries/URU.jpg'),
(4, 'Braasil', 'img/countries/BRA.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prioridad`
--

CREATE TABLE `prioridad` (
  `prioridad` varchar(20) DEFAULT NULL,
  `id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prioridad`
--

INSERT INTO `prioridad` (`prioridad`, `id`) VALUES
('Sin prioridad', 0),
('Con prioridad', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id` int(10) NOT NULL,
  `denominacion` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `idEmpresa` int(11) NOT NULL,
  `estado` int(10) NOT NULL,
  `idlider` int(10) NOT NULL,
  `observaciones` varchar(50) DEFAULT NULL,
  `prioridad` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id`, `denominacion`, `fecha`, `idEmpresa`, `estado`, `idlider`, `observaciones`, `prioridad`) VALUES
(1, 'prueba', '2025-06-12', 1, 1, 2, '                                        ', 0),
(2, 'prueba4', '2025-06-13', 1, 1, 2, '                Prueba 2                        ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rols`
--

CREATE TABLE `rols` (
  `Id` int(11) NOT NULL,
  `Denominacion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rols`
--

INSERT INTO `rols` (`Id`, `Denominacion`) VALUES
(1, 'Administrador'),
(2, 'Lider'),
(3, 'Analista Funcional'),
(4, 'Programador/a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `img` varchar(50) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `clave` int(50) NOT NULL,
  `idrol` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `mail`, `img`, `alias`, `clave`, `idrol`) VALUES
(1, 'Mara', 'Ferrero', 'mferrero@mail.com', 'img/avatars/mferrero.jpg', 'mferrero', 123, 4),
(2, 'Marcos', 'Gutierrez', 'mferrero@mail.com', 'img/avatars/mgutierrez.jpg', 'mferrero', 123, 2),
(3, 'William', 'Jhonson', 'wjhonson@mail.com', 'img/avatars/wjhonson.jpg', 'wjhonson', 123, 2),
(4, 'Sue', 'Palacios', 'spalacios@mail.com', 'img/avatars/spalacios.png', 'spalacios', 123, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`quiencarga`),
  ADD KEY `pais` (`idpais`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `paiss`
--
ALTER TABLE `paiss`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `prioridad`
--
ALTER TABLE `prioridad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prioridad` (`prioridad`),
  ADD KEY `estado` (`estado`),
  ADD KEY `empresa` (`idEmpresa`),
  ADD KEY `lider` (`idlider`);

--
-- Indices de la tabla `rols`
--
ALTER TABLE `rols`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idrol` (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `paiss`
--
ALTER TABLE `paiss`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rols`
--
ALTER TABLE `rols`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `pais` FOREIGN KEY (`idpais`) REFERENCES `paiss` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario` FOREIGN KEY (`quiencarga`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD CONSTRAINT `empresa` FOREIGN KEY (`idEmpresa`) REFERENCES `empresa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estado` FOREIGN KEY (`estado`) REFERENCES `estado` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lider` FOREIGN KEY (`idlider`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prioridad` FOREIGN KEY (`prioridad`) REFERENCES `prioridad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `idrol` FOREIGN KEY (`idrol`) REFERENCES `rols` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
