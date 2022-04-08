-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-04-2022 a las 15:00:48
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `arriendos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bancos`
--

CREATE TABLE `bancos` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bancos`
--

INSERT INTO `bancos` (`id`, `nombre`) VALUES
(1, 'CHILE'),
(2, 'INTERNACIONAL'),
(3, 'SCOTIABANK'),
(4, 'BCI'),
(5, 'BICE'),
(6, 'HSBC BANK'),
(7, 'SANTANDER'),
(8, 'ITAÚ'),
(9, 'CORPBANCA'),
(10, 'SECURITY'),
(11, 'FALABELLA'),
(12, 'RIPLEY'),
(13, 'CONSORCIO'),
(14, 'SCOTIABANK AZUL(BBVA)'),
(15, 'BTG PACTUAL'),
(16, 'ESTADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `fecha`, `creacion`) VALUES
(6, 'cinceladores 5 kilos', '2022-02-25 23:25:51', '2022-03-11 21:37:24'),
(8, 'SONDA FLEXIBLES', '2022-02-28 20:34:04', '2022-03-11 21:37:24'),
(9, 'DEMOLEDOR 5 kilos', '2022-02-28 21:31:37', '2022-03-11 21:37:24'),
(10, 'DEMOLEDOR 10 KILOS', '2022-03-21 21:51:31', '2022-03-21 21:51:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `constructoras`
--

CREATE TABLE `constructoras` (
  `id` int(11) NOT NULL,
  `rut` text COLLATE utf8_spanish_ci NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `contacto_cobranza` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono_cobranza` text COLLATE utf8_spanish_ci NOT NULL,
  `email_cobranza` text COLLATE utf8_spanish_ci NOT NULL,
  `forma_pago_id` int(11) NOT NULL,
  `banco` int(11) DEFAULT NULL,
  `codigo_actividad` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `constructoras`
--

INSERT INTO `constructoras` (`id`, `rut`, `nombre`, `direccion`, `telefono`, `contacto_cobranza`, `telefono_cobranza`, `email_cobranza`, `forma_pago_id`, `banco`, `codigo_actividad`, `estado`, `creacion`) VALUES
(3, '8.349.073-K', 'CONSTRUCTORA ALFA', 'CALLE 4 ORIENTE 55', '967564098', 'LEO', '967564098', 'l.frey.g@gmail.com', 6, 0, '410020', 1, '2022-03-11 21:37:41'),
(4, '13.663.730-4', 'CONSTRUCTORA GAMA', 'CALLE 4 ORIENTE 55', '967564098', 'DSDSDS', '985474445', 'dsdsd@gmail.com', 7, 7, '410020', 1, '2022-03-11 21:37:41'),
(5, '13.485.480-4', 'CONSTRUCTORA BETA', 'DSDSDSD', '967564094', 'DSDSDSD', '343434343', 'ssdsdsds@gmail', 8, 11, '410010', 1, '2022-03-11 21:37:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id` int(11) NOT NULL,
  `id_nombre_equipos` int(11) NOT NULL,
  `id_factura` int(11) NOT NULL,
  `codigo` text COLLATE utf8_spanish_ci NOT NULL,
  `numero_serie` text COLLATE utf8_spanish_ci NOT NULL,
  `precio_compra` int(11) NOT NULL,
  `tiene_movimiento` int(11) NOT NULL DEFAULT 0,
  `id_estado` int(11) NOT NULL DEFAULT 1,
  `fecha_creado` timestamp NOT NULL DEFAULT current_timestamp(),
  `creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_sucursal` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id`, `id_nombre_equipos`, `id_factura`, `codigo`, `numero_serie`, `precio_compra`, `tiene_movimiento`, `id_estado`, `fecha_creado`, `creacion`, `id_sucursal`) VALUES
(2, 7, 1, '654111', '654111', 165000, 0, 1, '2022-03-14 14:04:38', '2022-03-14 14:04:38', 1),
(7, 7, 1, '9658445', '9658445', 36500, 0, 1, '2022-03-14 14:51:53', '2022-03-14 14:51:53', 1),
(8, 16, 1, '6541110', '6541110', 36222, 0, 1, '2022-03-14 17:06:50', '2022-03-14 17:06:50', 1),
(9, 16, 3, '3652', '3652', 650000, 0, 1, '2022-03-14 18:08:36', '2022-03-14 18:08:36', 1),
(10, 16, 6, '365211', '365211', 65222, 0, 1, '2022-03-14 18:13:02', '2022-03-14 18:13:02', 1),
(11, 7, 7, '362541', '362541', 96000, 0, 1, '2022-03-14 18:24:18', '2022-03-14 18:24:18', 1),
(12, 11, 8, '8544', '8544', 200000, 0, 1, '2022-03-14 19:46:51', '2022-03-14 19:46:51', 1),
(13, 15, 7, '854741', '854741', 365000, 0, 1, '2022-03-14 20:22:19', '2022-03-14 20:22:19', 1),
(14, 6, 9, '98544', '98544', 652000, 0, 1, '2022-03-14 20:39:02', '2022-03-14 20:39:02', 1),
(15, 15, 9, '985474', '985474', 562000, 0, 1, '2022-03-14 20:39:18', '2022-03-14 20:39:18', 1),
(16, 15, 1, '36521', '36521', 65000, 0, 1, '2022-03-14 20:55:40', '2022-03-14 20:55:40', 1),
(17, 8, 10, '652144', '652144', 320000, 0, 1, '2022-03-14 21:08:35', '2022-03-14 21:08:35', 1),
(18, 8, 10, '658455', '658455', 320000, 0, 1, '2022-03-14 21:08:49', '2022-03-14 21:08:49', 1),
(19, 8, 10, 'PCG524', '854545', 320000, 0, 1, '2022-03-14 21:09:40', '2022-03-14 21:09:40', 1),
(25, 6, 14, '6521', '6521', 36500, 0, 1, '2022-03-15 21:45:46', '2022-03-15 21:45:46', 1),
(26, 6, 14, '6522', '6521', 36500, 0, 1, '2022-03-15 21:46:09', '2022-03-15 21:46:09', 1),
(27, 6, 14, '6522365', '6522', 36500, 0, 1, '2022-03-15 21:46:12', '2022-03-15 21:46:12', 1),
(28, 8, 14, '6521', '6521', 36800, 0, 1, '2022-03-15 21:52:10', '2022-03-15 21:52:10', 1),
(29, 8, 14, '698542541', '69854', 36800, 0, 1, '2022-03-15 21:52:30', '2022-03-15 21:52:30', 1),
(30, 8, 3, '3621', '3652', 36800, 0, 1, '2022-03-15 21:59:21', '2022-03-15 21:59:21', 1),
(31, 8, 3, '3622', '3621', 36800, 0, 1, '2022-03-15 21:59:41', '2022-03-15 21:59:41', 1),
(32, 7, 15, '36545', '36521', 38500, 1, 1, '2022-03-15 22:01:33', '2022-03-15 22:01:33', 1),
(36, 8, 15, '36545', '36545', 69800, 0, 1, '2022-03-15 22:19:04', '2022-03-15 22:19:04', 1),
(44, 8, 12, '6521', '6521', 98544, 0, 1, '2022-03-15 22:46:36', '2022-03-15 22:46:36', 1),
(45, 8, 12, '6521', '6521', 65200, 0, 1, '2022-03-15 22:46:58', '2022-03-15 22:46:58', 1),
(46, 8, 12, '6521', '6521', 65200, 0, 1, '2022-03-15 22:47:54', '2022-03-15 22:47:54', 1),
(47, 11, 12, '6521', '6521', 6522, 0, 1, '2022-03-15 22:48:12', '2022-03-15 22:48:12', 1),
(48, 11, 12, '6521', '6521', 85445, 0, 1, '2022-03-15 22:48:49', '2022-03-15 22:48:49', 1),
(49, 11, 12, '6521', '6521', 96500, 0, 1, '2022-03-15 22:49:52', '2022-03-15 22:49:52', 1),
(51, 7, 11, '65212', '65212', 985445, 0, 1, '2022-03-15 22:53:55', '2022-03-15 22:53:55', 1),
(52, 7, 11, '6521', '6521', 985445, 0, 1, '2022-03-15 22:54:02', '2022-03-15 22:54:02', 1),
(58, 8, 13, '65844', '65844', 98500, 0, 1, '2022-03-15 23:05:12', '2022-03-15 23:05:12', 1),
(59, 15, 11, '65211', '65214', 69800, 0, 1, '2022-03-16 22:28:03', '2022-03-16 22:28:03', 1),
(60, 6, 16, '85474', '25412', 63254, 0, 1, '2022-03-16 22:53:15', '2022-03-16 22:53:15', 1),
(61, 6, 16, '32100', '32100', 65200, 0, 1, '2022-03-21 15:47:23', '2022-03-21 15:47:23', 1),
(62, 8, 15, '6528744L', '5212', 63200, 0, 1, '2022-04-08 01:33:45', '2022-04-08 01:33:45', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `descripcion`) VALUES
(1, 'DISPONIBLE'),
(2, 'EN OBRA'),
(3, 'SERVICIO TECNICO'),
(4, 'DE BAJA'),
(5, 'EN TRASLADO'),
(6, 'ROBADO'),
(7, 'EN CONSTRUCCIÓN'),
(8, 'PENDIENTE'),
(9, 'FINALIZADO'),
(10, 'ARRIENDO'),
(11, 'CAMBIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_compra_equipos`
--

CREATE TABLE `facturas_compra_equipos` (
  `id` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `numero_factura` int(11) NOT NULL,
  `fecha_factura` date NOT NULL,
  `imagen` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_sucursal` int(11) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario_registro` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `facturas_compra_equipos`
--

INSERT INTO `facturas_compra_equipos` (`id`, `id_proveedor`, `numero_factura`, `fecha_factura`, `imagen`, `id_sucursal`, `fecha_registro`, `usuario_registro`) VALUES
(1, 2, 96521, '2022-03-14', 'vistas/img/facturaCompra/2-96521', 0, '2022-03-14 14:04:17', 'LEONARDO FREY'),
(3, 1, 98544, '2022-03-14', 'vistas/img/facturaCompra/1-98544.', 0, '2022-03-14 18:08:22', 'LEONARDO FREY'),
(6, 2, 96522, '2022-03-14', 'vistas/img/facturaCompra/2-96522.pdf', 0, '2022-03-14 18:12:00', 'LEONARDO FREY'),
(7, 1, 89565, '2022-03-14', NULL, 0, '2022-03-14 18:24:07', 'LEONARDO FREY'),
(8, 2, 985474, '2022-03-13', NULL, 0, '2022-03-14 19:46:27', 'LEONARDO FREY'),
(9, 2, 98544, '2022-03-14', NULL, 0, '2022-03-14 20:38:48', 'LEONARDO FREY'),
(10, 2, 69854, '2022-03-14', NULL, 0, '2022-03-14 21:07:12', 'LEONARDO FREY'),
(11, 1, 99, '2022-03-15', 'vistas/img/facturaCompra/1-99.pdf', 0, '2022-03-15 20:19:56', 'LEONARDO FREY'),
(12, 2, 99, '2022-03-15', 'vistas/img/facturaCompra/2-99.pdf', 0, '2022-03-15 20:34:01', 'LEONARDO FREY'),
(13, 1, 199, '2022-03-15', 'vistas/img/facturaCompra/1-199.pdf', 0, '2022-03-15 20:50:04', 'LEONARDO FREY'),
(14, 1, 98744, '2022-03-15', 'vistas/img/facturaCompra/1-98744.pdf', 0, '2022-03-15 21:26:00', 'LEONARDO FREY'),
(15, 1, 9854744, '2022-03-16', 'vistas/img/facturaCompra/1-9854744.pdf', 0, '2022-03-15 22:00:31', 'LEONARDO FREY'),
(16, 1, 65214452, '2022-03-17', 'vistas/img/facturaCompra/1-65214452.pdf', 0, '2022-03-16 22:53:03', 'LEONARDO FREY');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_pago`
--

CREATE TABLE `forma_pago` (
  `id` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `forma_pago`
--

INSERT INTO `forma_pago` (`id`, `descripcion`) VALUES
(1, 'Contado'),
(2, 'Plazo 15 Días'),
(3, 'Plazo 30 Días'),
(4, 'Plazo 45 Días'),
(5, 'Plazo 60 Días'),
(6, 'Plazo 90 Días'),
(7, 'Vale Vista'),
(8, 'Cheque');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `descripcion`, `creacion`) VALUES
(2, 'BOSH', '2022-03-11 21:38:46'),
(3, 'HILTI', '2022-03-11 21:38:46'),
(5, 'BAUKER', '2022-03-11 21:38:46'),
(6, 'BLACK AND DECKER', '2022-03-14 20:21:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nombre_equipos`
--

CREATE TABLE `nombre_equipos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `precio` int(11) NOT NULL DEFAULT 0,
  `modelo` text COLLATE utf8_spanish_ci NOT NULL,
  `meses_garantia` int(11) NOT NULL,
  `vida_util` int(11) DEFAULT NULL,
  `creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `nombre_equipos`
--

INSERT INTO `nombre_equipos` (`id`, `id_categoria`, `id_marca`, `descripcion`, `foto`, `estado`, `precio`, `modelo`, `meses_garantia`, `vida_util`, `creacion`) VALUES
(6, 6, 6, 'CINCELADOR 10 KGS', '', 1, 5600, 'TGH', 24, 50, '2022-03-11 21:39:02'),
(7, 8, 2, 'SONDA FLEXIBLE 4X5MTS', 'vistas/img/productos/7/445.jpg', 1, 1200, 'FLX', 6, NULL, '2022-03-11 21:39:02'),
(8, 6, 3, 'CINCELADOR 10 KGS', '', 1, 7500, 'AVR', 24, 40, '2022-03-11 21:39:02'),
(11, 6, 2, 'CINCELADOR 10 KGS', '', 1, 3400, 'AVR', 24, 40, '2022-03-11 21:39:02'),
(15, 6, 6, 'CINCELADOR 10 KGS', '', 1, 5500, 'TGB', 24, 40, '2022-03-11 21:39:02'),
(16, 9, 3, 'DEMOLEDOR  7 KGS', 'vistas/img/productos/16/866.jpg', 1, 7500, 'TYU', 24, NULL, '2022-03-11 21:39:02'),
(17, 9, 3, 'DEMOLEDOR 10 KGS', '', 1, 8500, 'SDR', 24, NULL, '2022-03-14 14:17:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obras`
--

CREATE TABLE `obras` (
  `id` int(11) NOT NULL,
  `id_constructoras` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `contacto` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `forma_cobro_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `obras`
--

INSERT INTO `obras` (`id`, `id_constructoras`, `nombre`, `contacto`, `direccion`, `telefono`, `email`, `forma_cobro_id`, `estado`, `creacion`) VALUES
(3, 3, 'LOS PINOS', 'PRUEBA', 'CUALQUIERA', '967564098', 'l.frey.g@gmail.com', 1, 1, '2022-03-11 21:39:18'),
(5, 3, 'PIEDRA LANCETA', ' SDSDS D', 'SDSDS', '', 'dsdsdsd@gmail.com', 1, 1, '2022-03-11 21:39:18'),
(6, 3, 'ACAPULCO', 'SDSDS', 'DSD', '967564098', 'dsdsds@fdd', 2, 1, '2022-03-11 21:39:18'),
(7, 3, 'LOS TOPACIOS', 'DSDS', 'DSDSD', '', 'sdsdsds@gmail.com', 3, 1, '2022-03-11 21:39:18'),
(8, 4, 'LOS LAURELES', 'DSDS', 'DSDS', '', 'sdsds@gmail.com', 1, 1, '2022-03-11 21:39:18'),
(9, 3, 'URBANISMO', 'SDSD', 'SDSDS', '', 'ds@sss', 2, 1, '2022-03-11 21:39:18'),
(10, 5, 'PRIMERA DE LINEA', 'LEO', 'LAS FLECHAS 85447, LAS CONDES', '985474455', 'l.frey.g@gmail.com', 1, 1, '2022-03-17 03:13:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_equipo`
--

CREATE TABLE `pedido_equipo` (
  `id` int(11) NOT NULL,
  `id_constructoras` int(11) NOT NULL,
  `id_obras` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 7,
  `compartido` int(11) NOT NULL DEFAULT 0,
  `documento` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `orden_compra` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `creado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedido_equipo`
--

INSERT INTO `pedido_equipo` (`id`, `id_constructoras`, `id_obras`, `id_sucursal`, `id_usuario`, `estado`, `compartido`, `documento`, `orden_compra`, `creado`) VALUES
(1, 3, 5, 1, 1, 8, 0, 'vistas/img/PedidoEquipos/1.pdf', '', '2022-03-31 01:13:14'),
(3, 3, 6, 1, 1, 8, 0, '', '65211', '2022-03-31 04:33:06'),
(4, 4, 8, 1, 1, 8, 0, 'vistas/img/PedidoEquipos/4.pdf', '', '2022-03-31 05:06:32'),
(6, 5, 10, 1, 1, 8, 0, NULL, '', '2022-03-31 20:34:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_equipo_detalle`
--

CREATE TABLE `pedido_equipo_detalle` (
  `id` int(11) NOT NULL,
  `id_pedido_equipo` int(11) NOT NULL,
  `id_nombre_equipo` int(11) NOT NULL,
  `cantidad_solicita` int(11) NOT NULL,
  `observaciones` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo` int(11) NOT NULL,
  `id_guia_despacho` int(11) DEFAULT NULL,
  `cantidad_guia` int(11) DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedido_equipo_detalle`
--

INSERT INTO `pedido_equipo_detalle` (`id`, `id_pedido_equipo`, `id_nombre_equipo`, `cantidad_solicita`, `observaciones`, `tipo`, `id_guia_despacho`, `cantidad_guia`, `fecha_entrega`) VALUES
(28, 1, 16, 0, '', 10, NULL, NULL, NULL),
(30, 1, 16, 0, '', 10, NULL, NULL, NULL),
(31, 1, 17, 0, '', 11, NULL, NULL, NULL),
(32, 3, 7, 0, '', 11, NULL, NULL, NULL),
(33, 6, 16, 0, 'con mango y discos', 10, NULL, 1, NULL),
(34, 6, 16, 0, 'con botones', 10, NULL, NULL, NULL),
(35, 6, 6, 0, '', 10, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios_clientes`
--

CREATE TABLE `precios_clientes` (
  `id` int(11) NOT NULL,
  `id_constructoras` int(11) NOT NULL,
  `id_obras` int(11) NOT NULL,
  `id_nombre_equipos` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario` text COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `rut` text COLLATE utf8_spanish_ci NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `contacto` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `rut`, `nombre`, `contacto`, `direccion`, `telefono`, `email`, `creacion`) VALUES
(1, '13.485.480-4', 'LEONARDO FREY', 'LEO FREY', 'LA FLECHA 08919', '967564098', 'l.frey.g@gmail.com', '2022-03-11 21:39:33'),
(2, '13.663.730-4', 'BOSH', 'LEO', 'SIN DIRECCION', '965845545', 'l.frey.g@gmail.com', '2022-03-11 21:39:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `descripcion`) VALUES
(1, 'Administrador'),
(2, 'Vendedor'),
(3, 'Bodeguero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `contacto` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id`, `nombre`, `direccion`, `contacto`, `telefono`, `email`, `creacion`) VALUES
(1, 'OFICINA CENTRAL', 'SANTIAGO CENTRO', 'LEO FREY', '967564098', 'l.frey.g@gmail.com', '2022-03-11 21:39:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cobro`
--

CREATE TABLE `tipo_cobro` (
  `id` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_cobro`
--

INSERT INTO `tipo_cobro` (`id`, `descripcion`) VALUES
(1, 'LUNES A LUNES'),
(2, 'LUNES A SABADO'),
(3, 'LUNES A VIERNES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` int(11) NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_sucursal` int(11) NOT NULL,
  `creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`, `id_sucursal`, `creacion`) VALUES
(1, 'LEONARDO FREY', 'lfrey', '$2a$07$asxx54ahjppf45sd87a5auFl5oL1MQ3CVLaN0VsRRmfoos4w12Lu.', 1, 'vistas/img/usuarios/lfrey/524.jpg', 1, '2022-04-08 00:01:04', '2022-04-08 04:01:04', 1, '2022-03-11 21:40:11'),
(2, 'CRISTIAN VALLEJOS', 'cvallejos', '$2a$07$asxx54ahjppf45sd87a5auGZEtGHuyZwm.Ur.FJvWLCql3nmsMbXy', 2, 'vistas/img/usuarios/cvallejos/678.jpg', 1, '2022-02-23 18:16:46', '2022-03-03 13:35:00', 1, '2022-03-11 21:40:11'),
(3, 'BASTIAN FREY', 'bfrey', '$2a$07$asxx54ahjppf45sd87a5auGZEtGHuyZwm.Ur.FJvWLCql3nmsMbXy', 1, '', 1, '2022-04-01 19:28:06', '2022-04-01 22:28:06', 1, '2022-04-01 22:21:17');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bancos`
--
ALTER TABLE `bancos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `constructoras`
--
ALTER TABLE `constructoras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `facturas_compra_equipos`
--
ALTER TABLE `facturas_compra_equipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nombre_equipos`
--
ALTER TABLE `nombre_equipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `obras`
--
ALTER TABLE `obras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedido_equipo`
--
ALTER TABLE `pedido_equipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedido_equipo_detalle`
--
ALTER TABLE `pedido_equipo_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `precios_clientes`
--
ALTER TABLE `precios_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_cobro`
--
ALTER TABLE `tipo_cobro`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bancos`
--
ALTER TABLE `bancos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `constructoras`
--
ALTER TABLE `constructoras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `facturas_compra_equipos`
--
ALTER TABLE `facturas_compra_equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `nombre_equipos`
--
ALTER TABLE `nombre_equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `obras`
--
ALTER TABLE `obras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pedido_equipo`
--
ALTER TABLE `pedido_equipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pedido_equipo_detalle`
--
ALTER TABLE `pedido_equipo_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `precios_clientes`
--
ALTER TABLE `precios_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_cobro`
--
ALTER TABLE `tipo_cobro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
