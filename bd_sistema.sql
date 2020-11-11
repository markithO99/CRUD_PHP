-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 11-11-2020 a las 11:21:12
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_sistema`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_cliente`
--

CREATE TABLE `tb_cliente` (
  `tb_cliente_id` int(11) NOT NULL,
  `tb_cliente_xac` int(1) NOT NULL DEFAULT '1',
  `tb_cliente_apepa` varchar(100) DEFAULT NULL,
  `tb_cliente_apema` varchar(100) DEFAULT NULL,
  `tb_cliente_nom` varchar(100) DEFAULT NULL,
  `tb_cliente_doc` varchar(8) DEFAULT NULL,
  `tb_genero_id` int(11) DEFAULT NULL,
  `tb_estudiosnivel_id` int(11) DEFAULT NULL,
  `tb_cliente_email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_cliente`
--

INSERT INTO `tb_cliente` (`tb_cliente_id`, `tb_cliente_xac`, `tb_cliente_apepa`, `tb_cliente_apema`, `tb_cliente_nom`, `tb_cliente_doc`, `tb_genero_id`, `tb_estudiosnivel_id`, `tb_cliente_email`) VALUES
(1, 1, 'CRUZ', 'CRUZ', 'MARCO', '74921620', 1, 2, 'marco.rodriguez.cruz.99@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_estudiosnivel`
--

CREATE TABLE `tb_estudiosnivel` (
  `tb_estudiosnivel_id` int(11) NOT NULL,
  `tb_estudiosnivel_des` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_estudiosnivel`
--

INSERT INTO `tb_estudiosnivel` (`tb_estudiosnivel_id`, `tb_estudiosnivel_des`) VALUES
(1, 'universtario'),
(2, 'tecnico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_genero`
--

CREATE TABLE `tb_genero` (
  `tb_genero_id` int(11) NOT NULL,
  `tb_genero_des` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_genero`
--

INSERT INTO `tb_genero` (`tb_genero_id`, `tb_genero_des`) VALUES
(1, 'masculino'),
(2, 'femenino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `login` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `login`, `password`, `activo`) VALUES
(1, 'admin', 'admin', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD PRIMARY KEY (`tb_cliente_id`),
  ADD KEY `fk_clientes_genero_idx` (`tb_genero_id`),
  ADD KEY `fk_clientes_estudios_nivel_idx` (`tb_estudiosnivel_id`);

--
-- Indices de la tabla `tb_estudiosnivel`
--
ALTER TABLE `tb_estudiosnivel`
  ADD PRIMARY KEY (`tb_estudiosnivel_id`);

--
-- Indices de la tabla `tb_genero`
--
ALTER TABLE `tb_genero`
  ADD PRIMARY KEY (`tb_genero_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_cliente`
--
ALTER TABLE `tb_cliente`
  MODIFY `tb_cliente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD CONSTRAINT `FK_clientes_genero` FOREIGN KEY (`tb_genero_id`) REFERENCES `tb_genero` (`tb_genero_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_clientes_estudios_nivel` FOREIGN KEY (`tb_estudiosnivel_id`) REFERENCES `tb_estudiosnivel` (`tb_estudiosnivel_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
