-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: bstaaxredphdizbd8zrh-mysql.services.clever-cloud.com:3306
-- Tiempo de generación: 22-02-2024 a las 21:36:38
-- Versión del servidor: 8.0.22-13
-- Versión de PHP: 8.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bstaaxredphdizbd8zrh`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`utu8ouwielrititx`@`%` PROCEDURE `example_while_loop` ()   BEGIN
    DECLARE counter INT DEFAULT 10;

    WHILE counter < 20 DO
        -- Realiza las operaciones que deseas realizar en cada iteración del bucle
        -- Puedes ejecutar consultas SQL u otras operaciones aquí
INSERT INTO `users` (`id`, `nombre`, `apellido`) VALUES ('2018'+counter, 'Vendedor '+counter, 'VEndedor 2'+counter);
        -- Incrementa el contador para evitar un bucle infinito
        SET counter = counter + 1;
    END WHILE;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacenes`
--

CREATE TABLE `almacenes` (
  `id_almacen` int NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `idArticulo` int NOT NULL,
  `nombre` varchar(29) COLLATE utf8_unicode_ci DEFAULT NULL,
  `costo` double DEFAULT NULL,
  `proveedor` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`idArticulo`, `nombre`, `costo`, `proveedor`) VALUES
(1, 'Cable Tipo C', NULL, NULL),
(2, 'Cable V8', NULL, NULL),
(3, 'Cubo', NULL, NULL),
(4, 'Audifonos', NULL, NULL),
(5, 'Cable Lightning', NULL, NULL),
(6, 'Cargador Carro', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosFiscales`
--

CREATE TABLE `datosFiscales` (
  `idDatos` int NOT NULL,
  `nombreTienda` varchar(25) DEFAULT NULL,
  `nombreRepresentante` varchar(50) DEFAULT NULL,
  `rfc` varchar(13) DEFAULT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `cp` int DEFAULT NULL,
  `ciudad` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `celular` varchar(11) DEFAULT NULL,
  `regimen` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `datosFiscales`
--

INSERT INTO `datosFiscales` (`idDatos`, `nombreTienda`, `nombreRepresentante`, `rfc`, `direccion`, `cp`, `ciudad`, `estado`, `celular`, `regimen`) VALUES
(1, '1ACCESORIOS', 'IVAN GUADALUPE CORONADO RUIZ', 'CORI870503BG9', 'BLVD. 5 DE FEBRERO, LOCAL 16, COL. PUEBLO NUEVO', 23060, 'LA PAZ', 'B.C.S.', '6121672304', 'REGIMEN SIMPLIFICADO DE CONFIANZA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DetalleVenta`
--

CREATE TABLE `DetalleVenta` (
  `detalle_id` int NOT NULL,
  `venta_id` int DEFAULT NULL,
  `idArticulo` int DEFAULT NULL,
  `cantidad` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `DetalleVenta`
--

INSERT INTO `DetalleVenta` (`detalle_id`, `venta_id`, `idArticulo`, `cantidad`) VALUES
(1, 26, 2, 10),
(2, 27, 1, 5),
(3, 28, 1, 3),
(4, 28, 5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE `insumos` (
  `id` int NOT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `estatus` varchar(25) DEFAULT NULL,
  `responsable` varchar(25) DEFAULT NULL,
  `stock` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`id`, `nombre`, `estatus`, `responsable`, `stock`) VALUES
(3, 'Cable Tipo C', 'Transito', 'Ivan', 500),
(4, 'Cable Tipo C', 'Blister', 'Ivan', 1500),
(5, 'Cable Tipo C', 'Manufactura', 'Chinos', 750);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda`
--

CREATE TABLE `tienda` (
  `id_tienda` int NOT NULL,
  `nombre` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre_responsable` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitud` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitud` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(115) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RFC` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_creacion` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_ultima_visita` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor` int DEFAULT NULL,
  `precio` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tienda`
--

INSERT INTO `tienda` (`id_tienda`, `nombre`, `nombre_responsable`, `direccion`, `latitud`, `longitud`, `correo`, `telefono`, `RFC`, `fecha_creacion`, `fecha_ultima_visita`, `vendedor`, `precio`) VALUES
(1, 'Fixcel', 'IVAN GUADALUPE CORONADO RUIZ', 'PLAZA SAN DIEGO LOCAL 16', '-1110545', '14515', 'CORONADO008@HOTMAIL.COM', '6121672304', 'CORI', '07/0/2024', '07/02/2024', 20188, 60),
(2, 'FIXCEL 2', 'ivanoue', 'Lic verdad', ' 24.1440789', ' -110.3173099', 'ventasfixcel@gmail.com', '6122001310', 'CORONA ', '2024/02/07', '2024/02/07', 20188, 70),
(12, 'Casa osmar', 'osmar ', 'opalina 2740', ' 24.1066294', ' -110.3170122', 'osmarsamirlucerosaiza@gmail.com', '6122001310', 'luso001113v53', '2024/02/16', NULL, NULL, NULL),
(14, 'PRUEBA', 'ENCARGADO', 'PRUEBADIRE', NULL, NULL, 'CORREO@GMAIL.COM', '696575', 'RFEPRUEBA', '2024-02-20', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int DEFAULT NULL,
  `nombre` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rol` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `apellido`, `rol`) VALUES
(20188, 'Horacio', 'Herrejon', ''),
(20189, 'Vendedor 2', 'VEndedor 2', ''),
(20199, 'Osmar', 'Lucero', ''),
(6969, 'Ivan', 'Coronado', 'Encargado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ventas`
--

CREATE TABLE `Ventas` (
  `venta_id` int NOT NULL,
  `fecha_venta` date DEFAULT NULL,
  `cliente_id` int DEFAULT NULL,
  `id_vendedor` int DEFAULT NULL,
  `tipo_venta` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `forma_de_pago` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_venta` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Ventas`
--

INSERT INTO `Ventas` (`venta_id`, `fecha_venta`, `cliente_id`, `id_vendedor`, `tipo_venta`, `forma_de_pago`, `total_venta`) VALUES
(26, '2024-02-15', 1, 20188, 'Consigna', NULL, 600),
(27, '2024-02-16', 1, 20188, 'Consigna', NULL, 300),
(28, '2024-02-16', 1, 20188, 'Consigna', NULL, 360);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  ADD PRIMARY KEY (`id_almacen`);

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`idArticulo`);

--
-- Indices de la tabla `datosFiscales`
--
ALTER TABLE `datosFiscales`
  ADD PRIMARY KEY (`idDatos`);

--
-- Indices de la tabla `DetalleVenta`
--
ALTER TABLE `DetalleVenta`
  ADD PRIMARY KEY (`detalle_id`),
  ADD KEY `fk_venta` (`venta_id`),
  ADD KEY `fk_producto` (`idArticulo`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tienda`
--
ALTER TABLE `tienda`
  ADD PRIMARY KEY (`id_tienda`);

--
-- Indices de la tabla `Ventas`
--
ALTER TABLE `Ventas`
  ADD PRIMARY KEY (`venta_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `idArticulo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `datosFiscales`
--
ALTER TABLE `datosFiscales`
  MODIFY `idDatos` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `DetalleVenta`
--
ALTER TABLE `DetalleVenta`
  MODIFY `detalle_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tienda`
--
ALTER TABLE `tienda`
  MODIFY `id_tienda` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `Ventas`
--
ALTER TABLE `Ventas`
  MODIFY `venta_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `DetalleVenta`
--
ALTER TABLE `DetalleVenta`
  ADD CONSTRAINT `fk_producto` FOREIGN KEY (`idArticulo`) REFERENCES `articulos` (`idArticulo`),
  ADD CONSTRAINT `fk_venta` FOREIGN KEY (`venta_id`) REFERENCES `Ventas` (`venta_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
