-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-03-2019 a las 10:09:48
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sifaj2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_compras`
--

CREATE TABLE `carrito_compras` (
  `id_producto` int(10) DEFAULT NULL,
  `cod` int(11) NOT NULL,
  `nombre_pro` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cant` int(5) DEFAULT NULL,
  `precio` float(10,2) DEFAULT NULL,
  `total` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `categoria`, `status`) VALUES
(2, 'LIBROS', 1),
(3, 'CUADERNOS DE TRABAJO', 1),
(4, 'PAQUETES', 1),
(5, 'LIBROS 8VO ', 1),
(6, 'LIBROS 9VO ', 1),
(7, 'LIBROS 10VO ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `genero` char(1) NOT NULL,
  `nacionalidad` varchar(100) NOT NULL,
  `fecha_nac` date NOT NULL,
  `fecha_ing` date NOT NULL,
  `hora_registro` varchar(10) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `cedula`, `nombre`, `apellido`, `genero`, `nacionalidad`, `fecha_nac`, `fecha_ing`, `hora_registro`, `status`) VALUES
(1, '123456789', 'ERICA', 'ESPINOZA', 'F', 'ECUATORIANA', '1990-01-01', '2015-05-23', ' 8:37:55 a', 1),
(2, '1714028592', 'JUAN FERNANDO', 'PEREZ ALVEAR', 'M', 'COLOMBIANO', '1986-01-01', '2019-03-12', ' 9:06:57 p', 1),
(3, '1204459535', 'MARIA FERNANDA', 'ALVAREZ JUDIEL', 'F', 'ECUATORIANO', '2019-03-23', '2019-03-24', ' 4:23:49 a', 1),
(4, '1234567890', 'MABEL LESLY', 'CAIZA LEON', 'F', 'ECUATORIANO', '0000-00-00', '2019-03-29', ' 2:47:12 a', 1),
(5, '6546546548', 'ERICK', 'FLORES', 'M', 'ECUATORIANA', '2019-03-01', '2019-03-29', ' 8:53:35 a', 1),
(6, '0174598752', 'FUNDACION VN', 'FUNDACION VN', 'M', 'ECUATORIANA', '2019-03-01', '2019-03-29', ' 9:37:19 a', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_facturas`
--

CREATE TABLE `detalles_facturas` (
  `id_producto` int(11) NOT NULL,
  `id_factura` int(11) NOT NULL,
  `precioXu` decimal(10,2) NOT NULL,
  `cant` int(3) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalles_facturas`
--

INSERT INTO `detalles_facturas` (`id_producto`, `id_factura`, `precioXu`, `cant`, `total`) VALUES
(1, 3, '10.00', 1, '10.00'),
(2, 4, '10.00', 2, '20.00'),
(1, 5, '9.00', 1, '9.00'),
(2, 5, '10.00', 1, '10.00'),
(3, 5, '7.00', 1, '7.00'),
(5, 5, '12.00', 2, '24.00'),
(1, 6, '9.00', 2, '18.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_cliente`
--

CREATE TABLE `direccion_cliente` (
  `id_direclt` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `direccion` varchar(300) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `direccion_cliente`
--

INSERT INTO `direccion_cliente` (`id_direclt`, `id_cliente`, `direccion`, `status`) VALUES
(1, 1, ' QUITO SOLANDA', 1),
(2, 2, 'QUITO', 1),
(3, 4, 'QUITO GUAMANI', 1),
(4, 5, 'GUAMANI', 1),
(5, 6, 'GUAMANI', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_empleado`
--

CREATE TABLE `direccion_empleado` (
  `id_direccion_empleado` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `direccion_empleado` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `direccion_empleado`
--

INSERT INTO `direccion_empleado` (`id_direccion_empleado`, `id_empleado`, `direccion_empleado`, `status`) VALUES
(1, 3, '           maracay edo aragua', 1),
(2, 1, '           guaruto calle merida ', 1),
(3, 4, '   BARRIO GUARUTO CALLE MERIDA CASA #26', 1),
(4, 5, '  EL AMPARO APURE FRENTE A LA MARINA EDO APURE', 1),
(5, 6, '  VALENCIA', 1),
(6, 0, 'KJKJHKJHKJHKJHKJHK ', 1),
(7, 0, 'QUITO SOLANDA', 1),
(8, 0, 'QUITO GUAMANI', 1),
(9, 0, 'QUITO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `email_empleado`
--

CREATE TABLE `email_empleado` (
  `id_email_empleado` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `email_empleado` varchar(150) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `email_empleado`
--

INSERT INTO `email_empleado` (`id_email_empleado`, `id_empleado`, `email_empleado`, `status`) VALUES
(1, 3, 'erica_peroz@hotmail.com', 1),
(2, 2, 'maria@hotmail.com', 1),
(3, 1, 'anthonyjesus_3009@hotmail.com', 1),
(8, 6, 'anthonyjesus2307@gmail.com', 1),
(9, 0, 'holger@g.com', 1),
(10, 0, 'maria@c.com', 1),
(11, 0, 'mabel@c.com', 1),
(12, 0, 'dany@g.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `cedula` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `nombres` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nac` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_registro` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `cargo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `edo_civil` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `grado_formacion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `ocupacion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `genero` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `status` varchar(10) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'activo',
  `nacionalidad` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `cedula`, `nombres`, `apellidos`, `fecha_nac`, `fecha_registro`, `cargo`, `edo_civil`, `grado_formacion`, `ocupacion`, `genero`, `status`, `nacionalidad`) VALUES
(1, '98765432', 'ANTHONY JESUS', 'ARAUJO PEROZA', '23/11/1994', '23/05/2015', 'ADMINISTRADOR', 'SOLTERO', 'BACHILLER', 'ESTUDIANTE', 'M', 'activo', 'VENEZOLANO'),
(2, '78945612', 'MARIA LUCIA', 'TORRES', '29/10/1953', '23/05/215', 'VENDEDOR', 'VIUDA', 'PRIMARIA', 'AMA DE CASA', 'F', 'activo', 'VENEZOLANO'),
(10, '17140285', 'ERICK DANIEL', 'PORTILLA LASO', '2019/03/01', '29/03/2019', 'INVITADO', 'SOLTERO(A)', 'BACHILLER', 'ESTUDIANTE', 'M', 'activo', 'ECUATORIANO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id_factura` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `fecha_venta` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `hora_venta` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id_factura`, `id_cliente`, `id_empleado`, `fecha_venta`, `hora_venta`, `status`) VALUES
(3, 1, 2, '2015-05-23', ' 6:08:34 pm', 1),
(4, 1, 0, '2019-03-24', ' 7:02:00 pm', 1),
(5, 5, 1, '2019-03-29', ' 9:03:55 am', 1),
(6, 6, 1, '2019-03-29', ' 9:38:44 am', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `id_categoria` int(2) NOT NULL,
  `codigo_pro` int(11) NOT NULL,
  `nombre_pro` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `existencia_pro` int(11) NOT NULL,
  `fecha_registro` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `costoxU` float NOT NULL,
  `precioxU` float NOT NULL,
  `status` varchar(10) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `id_categoria`, `codigo_pro`, `nombre_pro`, `existencia_pro`, `fecha_registro`, `costoxU`, `precioxU`, `status`) VALUES
(1, 2, 1, 'LIBRO QUIMICA', 6, '23/05/2015', 7, 9, 'activo'),
(2, 3, 2, 'CUADERNO DE TRABAJO EESS ', 7, '23/05/2015', 8, 10, 'activo'),
(3, 3, 3, 'CUADERNO DE TRABAJO CCNN ', 7, '23/05/2015', 5, 7, 'activo'),
(4, 2, 4, 'LIBRO FISICA', 10, '23/05/2015', 6, 8, 'activo'),
(5, 2, 5, 'LIBROS DE MATEMÃTICAS', 22, '29/03/2019', 10, 12, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tlf_cliente`
--

CREATE TABLE `tlf_cliente` (
  `id_tlfcliente` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tlf_cliente`
--

INSERT INTO `tlf_cliente` (`id_tlfcliente`, `id_cliente`, `telefono`, `status`) VALUES
(1, 1, '+584260000000', 1),
(2, 2, '', 1),
(3, 0, '+58-131321321321', 1),
(4, 3, '3132132132132', 1),
(5, 4, '+58-0999255331', 1),
(6, 5, '+59345435', 1),
(7, 6, '+593888888888', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tlf_empleado`
--

CREATE TABLE `tlf_empleado` (
  `id_tlf_empleado` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `telefono_empleado` varchar(15) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tlf_empleado`
--

INSERT INTO `tlf_empleado` (`id_tlf_empleado`, `id_empleado`, `telefono_empleado`, `status`) VALUES
(1, 3, '+58-42600000', 1),
(2, 1, '041600000', 1),
(3, 4, '+58-041600000', 1),
(4, 5, '+58-41600000', 1),
(5, 6, '+58-04100000', 1),
(6, 0, '+43-0999255331', 1),
(7, 0, '+58-13132132132', 1),
(8, 0, '+58-0999255331', 1),
(9, 0, '+58-946546546', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nivel` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_empleado`, `usuario`, `clave`, `nivel`) VALUES
(3, 1, 'admin', 'admin', 1),
(12, 0, '1714028592', '.29032019', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `categoria` (`categoria`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `detalles_facturas`
--
ALTER TABLE `detalles_facturas`
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_factura` (`id_factura`);

--
-- Indices de la tabla `direccion_cliente`
--
ALTER TABLE `direccion_cliente`
  ADD PRIMARY KEY (`id_direclt`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `direccion_empleado`
--
ALTER TABLE `direccion_empleado`
  ADD PRIMARY KEY (`id_direccion_empleado`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `email_empleado`
--
ALTER TABLE `email_empleado`
  ADD PRIMARY KEY (`id_email_empleado`),
  ADD UNIQUE KEY `email_empleado` (`email_empleado`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `codigo_pro` (`codigo_pro`),
  ADD UNIQUE KEY `nombre_pro` (`nombre_pro`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_categoria_2` (`id_categoria`);

--
-- Indices de la tabla `tlf_cliente`
--
ALTER TABLE `tlf_cliente`
  ADD PRIMARY KEY (`id_tlfcliente`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `tlf_empleado`
--
ALTER TABLE `tlf_empleado`
  ADD PRIMARY KEY (`id_tlf_empleado`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `direccion_cliente`
--
ALTER TABLE `direccion_cliente`
  MODIFY `id_direclt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `direccion_empleado`
--
ALTER TABLE `direccion_empleado`
  MODIFY `id_direccion_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `email_empleado`
--
ALTER TABLE `email_empleado`
  MODIFY `id_email_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `tlf_cliente`
--
ALTER TABLE `tlf_cliente`
  MODIFY `id_tlfcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `tlf_empleado`
--
ALTER TABLE `tlf_empleado`
  MODIFY `id_tlf_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles_facturas`
--
ALTER TABLE `detalles_facturas`
  ADD CONSTRAINT `detalles_facturas_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `detalles_facturas_ibfk_2` FOREIGN KEY (`id_factura`) REFERENCES `facturas` (`id_factura`);

--
-- Filtros para la tabla `direccion_cliente`
--
ALTER TABLE `direccion_cliente`
  ADD CONSTRAINT `direccion_cliente_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
