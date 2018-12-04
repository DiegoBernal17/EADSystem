-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-12-2018 a las 11:12:25
-- Versión del servidor: 5.7.22
-- Versión de PHP: 7.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemamateriasdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `idEspecialidad` int(5) NOT NULL,
  `especialidad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestro`
--

CREATE TABLE `maestro` (
  `idMaestro` int(5) NOT NULL,
  `maestroNombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `idMateria` int(5) NOT NULL,
  `clave` char(6) NOT NULL,
  `nombreMateria` varchar(100) NOT NULL,
  `hrsTeoria` tinyint(2) NOT NULL,
  `hrsPractica` tinyint(2) NOT NULL,
  `creditos` tinyint(2) NOT NULL,
  `idMateriaInterna` char(5) NOT NULL,
  `idEspecialidad` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planeacionsemestral`
--

CREATE TABLE `planeacionsemestral` (
  `idCarga` int(5) NOT NULL,
  `anio` year(4) NOT NULL,
  `semestre` tinyint(1) NOT NULL,
  `bimestre` tinyint(1) NOT NULL,
  `idMaestro` int(5) NOT NULL,
  `idMateria` int(5) NOT NULL,
  `seccion` char(1) NOT NULL DEFAULT 'A',
  `hora` time NOT NULL,
  `salon` char(5) NOT NULL DEFAULT 'EAD1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(5) NOT NULL,
  `nombreUsuario` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(60) NOT NULL,
  `fecha_creado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`idEspecialidad`),
  ADD UNIQUE KEY `especialidad` (`especialidad`);

--
-- Indices de la tabla `maestro`
--
ALTER TABLE `maestro`
  ADD PRIMARY KEY (`idMaestro`),
  ADD UNIQUE KEY `maestroNombre` (`maestroNombre`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`idMateria`),
  ADD KEY `FK_materiasEspecialidad` (`idEspecialidad`);

--
-- Indices de la tabla `planeacionsemestral`
--
ALTER TABLE `planeacionsemestral`
  ADD PRIMARY KEY (`idCarga`),
  ADD KEY `FK_PS_maestros` (`idMaestro`),
  ADD KEY `FK_PS_materias` (`idMateria`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `idEspecialidad` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `maestro`
--
ALTER TABLE `maestro`
  MODIFY `idMaestro` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `idMateria` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `planeacionsemestral`
--
ALTER TABLE `planeacionsemestral`
  MODIFY `idCarga` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(5) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `FK_materiasEspecialidad` FOREIGN KEY (`idEspecialidad`) REFERENCES `especialidad` (`idEspecialidad`);

--
-- Filtros para la tabla `planeacionsemestral`
--
ALTER TABLE `planeacionsemestral`
  ADD CONSTRAINT `FK_PS_maestros` FOREIGN KEY (`idMaestro`) REFERENCES `maestro` (`idMaestro`),
  ADD CONSTRAINT `FK_PS_materias` FOREIGN KEY (`idMateria`) REFERENCES `materias` (`idMateria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
