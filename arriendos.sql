-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-09-2022 a las 04:07:23
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
-- Estructura de tabla para la tabla `dte`
--

CREATE TABLE `dte` (
  `id` int(11) NOT NULL,
  `id_empresa_operativa` int(11) NOT NULL,
  `numero_guia` int(11) NOT NULL,
  `numero_factura` int(11) NOT NULL,
  `numero_nc` int(11) NOT NULL,
  `numero_nd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dte`
--

INSERT INTO `dte` (`id`, `id_empresa_operativa`, `numero_guia`, `numero_factura`, `numero_nc`, `numero_nd`) VALUES
(1, 1, 5215, 3652, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas_operativas`
--

CREATE TABLE `empresas_operativas` (
  `id` int(11) NOT NULL,
  `rut_empresa` text COLLATE utf8_spanish_ci NOT NULL,
  `razon_social` text COLLATE utf8_spanish_ci NOT NULL,
  `giro` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `comuna` text COLLATE utf8_spanish_ci NOT NULL,
  `ciudad` text COLLATE utf8_spanish_ci NOT NULL,
  `codigo_actividad` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empresas_operativas`
--

INSERT INTO `empresas_operativas` (`id`, `rut_empresa`, `razon_social`, `giro`, `telefono`, `direccion`, `comuna`, `ciudad`, `codigo_actividad`) VALUES
(1, '77756789-7', 'FYB ARRIENDOS SPA', 'ARRIENDO MAQUINARIA CONSTRUCCION', '265987451', 'RECOLETA 6585', 'RECOLETA', 'SANTIAGO', '965844');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_transporte`
--

CREATE TABLE `empresa_transporte` (
  `id` int(11) NOT NULL,
  `rut` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empresa_transporte`
--

INSERT INTO `empresa_transporte` (`id`, `rut`) VALUES
(1, '76015943-3');

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
  `id_sucursal` int(11) NOT NULL DEFAULT 1,
  `codigo_anterior` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `serie_anterior` text COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id`, `id_nombre_equipos`, `id_factura`, `codigo`, `numero_serie`, `precio_compra`, `tiene_movimiento`, `id_estado`, `fecha_creado`, `creacion`, `id_sucursal`, `codigo_anterior`, `serie_anterior`) VALUES
(2, 7, 1, '654111', '654111', 165000, 1, 2, '2022-03-14 14:04:38', '2022-03-14 14:04:38', 1, '654111', '654111'),
(7, 7, 1, '9658445', '9658445', 36500, 1, 2, '2022-03-14 14:51:53', '2022-03-14 14:51:53', 1, '9658445', '9658445'),
(8, 16, 1, '6541110', '6541110', 36222, 0, 1, '2022-03-14 17:06:50', '2022-03-14 17:06:50', 1, '6541110', '6541110'),
(9, 16, 3, '3652', '3652', 650000, 1, 1, '2022-03-14 18:08:36', '2022-03-14 18:08:36', 1, '3652', '3652'),
(10, 16, 6, '365211', '365211', 65222, 1, 1, '2022-03-14 18:13:02', '2022-03-14 18:13:02', 1, '365211', '365211'),
(11, 7, 7, '362541', '362541', 96000, 1, 2, '2022-03-14 18:24:18', '2022-03-14 18:24:18', 1, '362541', '362541'),
(12, 11, 8, '8544', '8544', 200000, 1, 2, '2022-03-14 19:46:51', '2022-03-14 19:46:51', 1, '8544', '8544'),
(13, 15, 7, '854741', '854741', 365000, 1, 2, '2022-03-14 20:22:19', '2022-03-14 20:22:19', 1, '854741', '854741'),
(14, 6, 9, '98544', '98544', 652000, 1, 1, '2022-03-14 20:39:02', '2022-03-14 20:39:02', 1, '98544', '98544'),
(15, 15, 9, '985474', '985474', 562000, 1, 1, '2022-03-14 20:39:18', '2022-03-14 20:39:18', 1, '985474', '985474'),
(16, 15, 1, '36521P', '36521', 65000, 1, 1, '2022-03-14 20:55:40', '2022-03-14 20:55:40', 1, '36521', '36521'),
(17, 8, 10, '652144', '652144', 320000, 1, 1, '2022-03-14 21:08:35', '2022-03-14 21:08:35', 1, '652144', '652144'),
(18, 8, 10, '658455', '658455', 320000, 1, 1, '2022-03-14 21:08:49', '2022-03-14 21:08:49', 1, '658455', '658455'),
(19, 8, 10, 'PCG524', '854545', 320000, 1, 2, '2022-03-14 21:09:40', '2022-03-14 21:09:40', 1, 'PCG524', '854545'),
(25, 6, 14, '6521P', '6521', 36500, 1, 1, '2022-03-15 21:45:46', '2022-03-15 21:45:46', 1, '6521', '6521'),
(26, 6, 14, '6522', '6521', 36500, 1, 2, '2022-03-15 21:46:09', '2022-03-15 21:46:09', 1, '6522', '6521'),
(27, 6, 14, '6522365', '6522', 36500, 1, 2, '2022-03-15 21:46:12', '2022-03-15 21:46:12', 1, '6522365', '6522'),
(28, 8, 14, '6521', '6521', 36800, 1, 2, '2022-03-15 21:52:10', '2022-03-15 21:52:10', 1, '6521', '6521'),
(29, 8, 14, '698542541', '69854', 36800, 0, 1, '2022-03-15 21:52:30', '2022-03-15 21:52:30', 1, '698542541', '69854'),
(30, 8, 3, '3621', '3652', 36800, 1, 1, '2022-03-15 21:59:21', '2022-03-15 21:59:21', 1, '3621', '3652'),
(31, 8, 3, '3622', '3621', 36800, 1, 2, '2022-03-15 21:59:41', '2022-03-15 21:59:41', 1, '3622', '3621'),
(32, 7, 15, '36545', '36521', 38500, 1, 1, '2022-03-15 22:01:33', '2022-03-15 22:01:33', 1, '36545', '36521'),
(36, 8, 15, '36545', '36545', 69800, 1, 2, '2022-03-15 22:19:04', '2022-03-15 22:19:04', 1, '36545', '36545'),
(44, 8, 12, '6521', '6521', 98544, 1, 1, '2022-03-15 22:46:36', '2022-03-15 22:46:36', 1, '6521', '6521'),
(45, 8, 12, '6521', '6521', 65200, 1, 1, '2022-03-15 22:46:58', '2022-03-15 22:46:58', 1, '6521', '6521'),
(46, 8, 12, '6521', '6521', 65200, 1, 1, '2022-03-15 22:47:54', '2022-03-15 22:47:54', 1, '6521', '6521'),
(47, 11, 12, '6521', '6521', 6522, 1, 2, '2022-03-15 22:48:12', '2022-03-15 22:48:12', 1, '6521', '6521'),
(48, 11, 12, '6521', '6521', 85445, 1, 2, '2022-03-15 22:48:49', '2022-03-15 22:48:49', 1, '6521', '6521'),
(49, 11, 12, '6521', '6521', 96500, 1, 2, '2022-03-15 22:49:52', '2022-03-15 22:49:52', 1, '6521', '6521'),
(51, 7, 11, '65212', '65212', 985445, 1, 2, '2022-03-15 22:53:55', '2022-03-15 22:53:55', 1, '65212', '65212'),
(52, 7, 11, '652198', '65219874561', 1200, 1, 1, '2022-03-15 22:54:02', '2022-03-15 22:54:02', 2, '652198', '652198'),
(58, 8, 13, '65844', '65844', 98500, 1, 1, '2022-03-15 23:05:12', '2022-03-15 23:05:12', 1, '65844', '65844'),
(59, 15, 11, '65211', '65214', 69800, 1, 2, '2022-03-16 22:28:03', '2022-03-16 22:28:03', 1, '65211', '65214'),
(60, 6, 16, '85474', '25412', 63254, 1, 2, '2022-03-16 22:53:15', '2022-03-16 22:53:15', 1, '85474', '25412'),
(61, 6, 16, '32100', '32100', 65200, 1, 1, '2022-03-21 15:47:23', '2022-03-21 15:47:23', 1, '32100', '32100'),
(62, 8, 15, '6528744L', '5212', 63200, 1, 1, '2022-04-08 01:33:45', '2022-04-08 01:33:45', 1, '6528744L', '5212'),
(63, 7, 16, '78001452', '745844854', 68000, 1, 2, '2022-05-13 06:07:53', '2022-05-13 06:07:53', 1, '78001452', '745844854'),
(69, 11, 16, '85PP', '85PP', 3400, 1, 1, '2022-09-01 14:31:06', '2022-09-01 14:31:06', 2, '85PP', '85PP'),
(70, 11, 16, '789PO', '789PO', 369000, 0, 1, '2022-09-01 14:31:20', '2022-09-01 14:31:20', 2, '789PO', '789PO'),
(72, 7, 17, 'RTPO09', 'OPRRR4555', 4500, 1, 1, '2022-09-01 14:45:42', '2022-09-01 14:45:42', 2, 'RTPO09', 'OPRRR4555'),
(73, 20, 17, 'ELAS45', '65877', 4000, 1, 2, '2022-09-25 04:19:16', '2022-09-25 04:19:16', 1, 'ELAS45', '65877');

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
(2, 'ARRENDADO'),
(3, 'SERVICIO TECNICO'),
(4, 'DE BAJA'),
(5, 'EN TRASLADO'),
(6, 'ROBADO'),
(7, 'EN CONSTRUCCIÓN'),
(8, 'PENDIENTE'),
(9, 'FINALIZADO'),
(10, 'ARRIENDO'),
(11, 'CAMBIO'),
(12, 'NO ENVIADA SII'),
(13, 'ENVIADA SII'),
(14, 'ANULADO'),
(15, 'TERMINO ARRIENDO'),
(16, 'POR VALIDAR RETIRO OBRA'),
(17, 'POR VALIDAR ENTREGA OBRA');

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
(16, 1, 65214452, '2022-03-17', 'vistas/img/facturaCompra/1-65214452.pdf', 0, '2022-03-16 22:53:03', 'LEONARDO FREY'),
(17, 1, 784444, '2022-09-01', NULL, 0, '2022-09-01 13:56:44', 'LEONARDO FREY');

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
-- Estructura de tabla para la tabla `guia_despacho`
--

CREATE TABLE `guia_despacho` (
  `id` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `numero_guia` int(11) DEFAULT NULL,
  `fecha_guia` date NOT NULL,
  `id_constructoras` int(11) NOT NULL,
  `id_obras` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `adjunto` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `oc` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_termino` date DEFAULT NULL,
  `id_transporte_guia` int(11) DEFAULT NULL,
  `rut_empresa_transporte` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `rut_transportista` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre_transportista` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `patente_transportista` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado_guia` int(11) NOT NULL DEFAULT 12,
  `tipo_guia` text COLLATE utf8_spanish_ci NOT NULL,
  `creado_por` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `guia_despacho`
--

INSERT INTO `guia_despacho` (`id`, `id_empresa`, `numero_guia`, `fecha_guia`, `id_constructoras`, `id_obras`, `id_sucursal`, `adjunto`, `oc`, `fecha_termino`, `id_transporte_guia`, `rut_empresa_transporte`, `rut_transportista`, `nombre_transportista`, `patente_transportista`, `estado_guia`, `tipo_guia`, `creado_por`, `fecha_creacion`) VALUES
(1, 1, 5207, '2022-04-28', 3, 6, 1, 'vistas/img/GuiasDespacho/1.pdf', '', '0000-00-00', 1, '77854789-7', '13485480-4', 'LEONARDO FREY', 'HFJZ-12', 13, 'A', '', '2022-04-27 05:00:08'),
(19, 1, 5206, '2022-05-03', 5, 10, 1, NULL, '', '0000-00-00', 1, '77854789-7', '13485480-4', 'LEONARDO FREY', 'HFJZ-12', 13, 'A', 'LEONARDO FREY', '2022-05-03 22:33:55'),
(20, 1, 5205, '2022-05-03', 4, 8, 1, 'vistas/img/GuiasDespacho/20.pdf', '', '0000-00-00', 1, '77854789-7', '13485480-4', 'LEONARDO FREY', 'HFJZ-12', 13, 'A', 'LEONARDO FREY', '2022-05-04 01:42:51'),
(21, 1, 5204, '2022-05-03', 5, 10, 1, '', '', '0000-00-00', 1, '77854789-7', '13485480-4', 'LEONARDO FREY', 'HFJZ-12', 13, 'A', 'LEONARDO FREY', '2022-05-04 01:52:35'),
(22, 1, 5208, '2022-05-10', 5, 10, 1, NULL, '', '0000-00-00', 1, '77854789-7', '13485480-4', 'LEONARDO FREY', 'HFJZ-12', 14, 'A', 'LEONARDO FREY', '2022-05-10 04:25:02'),
(23, 1, 5209, '2022-05-10', 5, 10, 1, NULL, '', '0000-00-00', 1, '77854789-7', '13485480-4', 'LEONARDO FREY', 'HFJZ-12', 14, 'A', 'LEONARDO FREY', '2022-05-10 04:35:19'),
(25, 1, 5210, '2022-05-10', 5, 10, 1, NULL, '', '0000-00-00', 1, '77854789-7', '13485480-4', 'LEONARDO FREY', 'HFJZ-12', 14, 'A', 'LEONARDO FREY', '2022-05-10 05:09:19'),
(26, 1, 5211, '2022-06-07', 3, 6, 1, NULL, '', '0000-00-00', 1, '77854789-7', '13485480-4', 'LEONARDO FREY', 'HFJZ-12', 13, 'A', 'LEONARDO FREY', '2022-06-08 03:09:01'),
(27, 1, 5212, '2022-09-25', 4, 8, 1, NULL, '', '0000-00-00', 1, '76015943-3', '13485480-4', 'LEONARDO FREY', 'HFJZ-12', 13, 'A', 'LEONARDO FREY', '2022-09-25 05:38:07'),
(29, 1, 5213, '2022-09-29', 3, 3, 1, NULL, '', '0000-00-00', 1, '76015943-3', '13485480-4', 'LEONARDO FREY', 'HFJZ-12', 14, 'A', 'LEONARDO FREY', '2022-09-29 18:46:01'),
(30, 1, 5214, '2022-09-29', 3, 3, 1, NULL, '', '0000-00-00', 1, '76015943-3', '13485480-4', 'LEONARDO FREY', 'HFJZ-12', 13, 'A', 'LEONARDO FREY', '2022-09-30 01:33:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guia_despacho_detalle`
--

CREATE TABLE `guia_despacho_detalle` (
  `id` int(11) NOT NULL,
  `id_guia` int(11) NOT NULL,
  `id_equipo` int(11) NOT NULL,
  `precio_arriendo` int(11) NOT NULL,
  `fecha_arriendo` date NOT NULL,
  `detalle` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_devolucion` date DEFAULT NULL,
  `fecha_devolucion_real` date DEFAULT NULL,
  `id_tipo_movimiento` int(11) NOT NULL COMMENT 'arriendo=10, cambio=11',
  `match_cambio` int(11) DEFAULT NULL COMMENT 'id registro por el que sale, cambio',
  `contrato` int(11) DEFAULT NULL COMMENT 'id guia despacho cuando es cambio',
  `devuelto` int(1) DEFAULT 0,
  `id_report_devolucion` int(11) DEFAULT NULL,
  `devolucion_tipo` int(11) DEFAULT NULL COMMENT '15 termino o 11 cambio',
  `detalle_devolucion` text COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'detalle al cambiar',
  `fecha_retiro_obra` datetime DEFAULT NULL,
  `validado` int(11) NOT NULL DEFAULT 1,
  `validado_retiro` int(11) NOT NULL DEFAULT 1,
  `registro_eliminado` tinyint(1) NOT NULL DEFAULT 0,
  `usuario_elimina` int(11) DEFAULT NULL,
  `fecha_elimina` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `guia_despacho_detalle`
--

INSERT INTO `guia_despacho_detalle` (`id`, `id_guia`, `id_equipo`, `precio_arriendo`, `fecha_arriendo`, `detalle`, `fecha_devolucion`, `fecha_devolucion_real`, `id_tipo_movimiento`, `match_cambio`, `contrato`, `devuelto`, `id_report_devolucion`, `devolucion_tipo`, `detalle_devolucion`, `fecha_retiro_obra`, `validado`, `validado_retiro`, `registro_eliminado`, `usuario_elimina`, `fecha_elimina`) VALUES
(33, 1, 52, 1200, '2022-05-12', '', '0000-00-00', '2022-09-27', 10, NULL, 1, 1, 22, 15, '', '2022-09-27 23:17:16', 0, 0, 0, 0, NULL),
(34, 20, 31, 7500, '2022-05-03', '', '2022-05-23', NULL, 10, NULL, 20, 0, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL),
(35, 19, 16, 5000, '2022-05-03', '', '0000-00-00', '2022-09-27', 10, NULL, 19, 1, 18, 15, '', '2022-09-27 21:09:49', 0, 0, 0, NULL, NULL),
(36, 20, 36, 7500, '2022-05-03', '', '0000-00-00', NULL, 10, NULL, 20, 0, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL),
(39, 21, 11, 1200, '2022-05-09', '', '0000-00-00', NULL, 11, NULL, 21, 0, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL),
(40, 21, 48, 3400, '2022-05-09', 'sin detalles', '0000-00-00', NULL, 11, NULL, 21, 0, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL),
(45, 21, 10, 7500, '2022-05-09', '', '0000-00-00', NULL, 11, NULL, 21, 0, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL),
(46, 21, 32, 1200, '2022-05-09', '', '0000-00-00', '2022-09-27', 10, NULL, 21, 1, 21, 15, '', '2022-09-27 23:16:49', 0, 0, 0, NULL, NULL),
(54, 21, 2, 1000, '2022-05-12', '', '0000-00-00', NULL, 11, NULL, 21, 0, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL),
(55, 20, 51, 1200, '2022-05-22', '', '2022-05-23', NULL, 10, NULL, 20, 0, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL),
(56, 20, 63, 1200, '2022-05-22', '', '0000-00-00', NULL, 10, NULL, 20, 0, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL),
(57, 20, 7, 1200, '2022-05-22', 'detalles de pru', '0000-00-00', NULL, 10, NULL, 20, 0, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL),
(58, 20, 25, 5600, '2022-05-22', '', '2022-05-23', '2022-09-26', 10, NULL, 20, 1, 17, 15, '', '2022-09-26 00:46:35', 0, 0, 0, NULL, NULL),
(59, 20, 61, 5600, '2022-05-22', '', '0000-00-00', '2022-09-26', 10, NULL, 20, 1, 17, 11, '', '2022-09-26 00:46:37', 0, 0, 0, NULL, NULL),
(61, 21, 19, 9000, '2022-05-23', '', '0000-00-00', NULL, 11, NULL, 21, 0, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL),
(62, 21, 15, 5000, '2022-05-23', '', '0000-00-00', '2022-09-27', 10, NULL, 21, 1, 21, 15, '', '2022-09-27 23:16:47', 0, 0, 0, NULL, NULL),
(63, 21, 14, 8500, '2022-05-23', '', '0000-00-00', '2022-09-27', 10, NULL, 21, 1, 18, 15, '', '2022-09-27 21:09:47', 0, 0, 0, NULL, NULL),
(64, 21, 13, 5000, '2022-05-23', '', '0000-00-00', NULL, 10, NULL, 21, 0, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL),
(65, 20, 26, 5600, '2022-05-23', '', '0000-00-00', NULL, 10, NULL, 20, 0, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL),
(66, 20, 60, 5600, '2022-05-23', '', '0000-00-00', NULL, 10, NULL, 20, 0, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL),
(67, 20, 27, 5600, '2022-05-23', '', '0000-00-00', NULL, 10, NULL, 20, 0, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL),
(68, 20, 47, 3400, '2022-05-23', 'detalle', '2022-05-23', NULL, 10, NULL, 20, 0, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL),
(69, 20, 49, 3400, '2022-05-23', '', '0000-00-00', NULL, 10, NULL, 20, 0, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL),
(70, 20, 12, 3400, '2022-05-23', '', '0000-00-00', NULL, 10, NULL, 20, 0, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL),
(71, 20, 59, 5500, '2022-05-23', '', '0000-00-00', NULL, 10, NULL, 20, 0, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL),
(72, 19, 51, 1000, '2022-05-31', '', '0000-00-00', NULL, 11, NULL, 19, 0, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL),
(76, 26, 32, 1200, '2022-06-07', '', '0000-00-00', '2022-09-28', 10, NULL, 26, 1, 23, 15, '', '2022-09-28 00:19:14', 0, 0, 0, NULL, NULL),
(77, 26, 10, 7500, '2022-07-11', '', '0000-00-00', '2022-09-27', 10, NULL, 26, 1, 20, 15, '', '2022-09-27 23:16:35', 0, 0, 0, NULL, NULL),
(79, 26, 9, 4500, '2022-09-25', '', '0000-00-00', '2022-09-27', 10, NULL, 26, 1, 19, 15, '', '2022-09-27 23:06:18', 0, 0, 0, NULL, NULL),
(80, 27, 73, 4000, '2022-09-25', '', '0000-00-00', NULL, 11, 59, 20, 0, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL),
(81, 27, 28, 7500, '2022-09-25', '', '0000-00-00', NULL, 11, NULL, 27, 0, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL),
(84, 29, 10, 4500, '2022-09-29', '', '0000-00-00', NULL, 10, NULL, 29, 0, NULL, NULL, NULL, NULL, 1, 1, 0, NULL, NULL),
(86, 29, 17, 7500, '2022-09-29', '', '0000-00-00', NULL, 10, NULL, 29, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 1, '2022-09-29 15:48:01'),
(87, 30, 30, 7500, '2022-09-29', '', '0000-00-00', '2022-10-02', 10, NULL, 30, 1, 29, 15, '', '2022-09-29 22:47:19', 0, 0, 0, NULL, NULL),
(88, 30, 45, 7500, '2022-09-29', '', '0000-00-00', '2022-10-02', 10, NULL, 30, 1, 29, 15, '', '2022-09-29 22:47:24', 0, 0, 0, NULL, NULL),
(89, 30, 62, 7500, '2022-09-29', '', '0000-00-00', NULL, 10, NULL, 30, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 1, '2022-09-29 22:38:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_mantenedor_equipos`
--

CREATE TABLE `log_mantenedor_equipos` (
  `id` int(11) NOT NULL,
  `id_equipo` int(11) NOT NULL,
  `codigo_equipo` text COLLATE utf8_spanish_ci NOT NULL,
  `serie_equipo` text COLLATE utf8_spanish_ci NOT NULL,
  `precio_equipo` int(11) NOT NULL,
  `id_sucursal_equipo` int(11) NOT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `log_mantenedor_equipos`
--

INSERT INTO `log_mantenedor_equipos` (`id`, `id_equipo`, `codigo_equipo`, `serie_equipo`, `precio_equipo`, `id_sucursal_equipo`, `fecha_actualizacion`, `id_usuario`) VALUES
(1, 72, 'OPRRR45', 'OPRRR45', 1200, 2, '2022-09-13 05:35:15', 1),
(2, 72, 'OPRRR45', 'OPRRR45', 1200, 2, '2022-09-13 05:47:27', 1),
(3, 72, 'RTPO09', 'OPRRR45', 1200, 2, '2022-09-13 05:47:48', 1),
(4, 52, '6521', '6521', 1200, 2, '2022-09-19 20:02:56', 1),
(5, 52, '6521', '6521', 1200, 2, '2022-09-19 20:03:03', 1),
(6, 52, '6521', '6521', 1200, 1, '2022-09-19 20:04:52', 1),
(7, 52, '6521', '6521', 1200, 2, '2022-09-19 20:05:12', 1),
(8, 52, '6521', '6521', 1200, 1, '2022-09-19 20:06:50', 1),
(9, 72, 'RTPO09', 'OPRRR45', 1200, 1, '2022-09-19 20:06:58', 1),
(10, 52, '6521', '6521', 1200, 2, '2022-09-19 20:07:01', 1),
(11, 52, '6521', '6521', 6200, 2, '2022-09-19 20:07:15', 1),
(12, 52, '6521', '6521', 2500, 2, '2022-09-19 20:07:26', 1),
(13, 52, '6521', '6521', 1200, 1, '2022-09-19 20:07:32', 1),
(14, 52, '6521987123', '65219874561', 5600, 2, '2022-09-19 20:10:19', 1),
(15, 72, 'RTPO09', 'OPRRR45', 4500, 2, '2022-09-19 20:14:00', 1),
(16, 69, '85PP', '85PP', 3401, 2, '2022-09-19 20:24:40', 1),
(17, 69, '85PP', '85PP', 3400, 1, '2022-09-19 20:24:52', 1),
(18, 69, '85PP', '85PP', 3400, 2, '2022-09-19 20:24:57', 1),
(19, 52, '652198', '652198', 1200, 2, '2022-09-19 21:48:12', 1),
(20, 52, '652198', '65219874561', 1200, 2, '2022-09-19 21:58:03', 1),
(21, 73, 'ELAS45', '65877', 4000, 1, '2022-09-25 05:37:44', 1);

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
  `foto` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `precio` int(11) NOT NULL DEFAULT 0,
  `modelo` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `meses_garantia` int(11) NOT NULL DEFAULT 0,
  `vida_util` int(11) DEFAULT 0,
  `creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `actualizado` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario` text COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `nombre_equipos`
--

INSERT INTO `nombre_equipos` (`id`, `id_categoria`, `id_marca`, `descripcion`, `foto`, `estado`, `precio`, `modelo`, `meses_garantia`, `vida_util`, `creacion`, `actualizado`, `usuario`) VALUES
(6, 10, 6, 'CINCELADOR 10 KGS', '', 1, 5600, 'TGH', 24, 50, '2022-03-11 21:39:02', '2022-09-19 23:16:07', 'LEONARDO FREY'),
(7, 8, 2, 'SONDA FLEXIBLE 4X5MTS', 'vistas/img/productos/7/445.jpg', 1, 1200, 'FLX', 6, NULL, '2022-03-11 21:39:02', '2022-09-19 23:16:07', 'LEONARDO FREY'),
(8, 10, 3, 'CINCELADOR 10 KGS', '', 1, 7500, 'XYZ', 24, 40, '2022-03-11 21:39:02', '2022-09-19 23:16:07', 'LEONARDO FREY'),
(11, 6, 2, 'CINCELADOR 10 KGS', '', 1, 3400, 'AVR', 24, 40, '2022-03-11 21:39:02', '2022-09-19 23:16:07', 'LEONARDO FREY'),
(15, 6, 2, 'CINCELADOR 10 KGS Y 4 \'\'', '', 1, 5500, 'TGB', 24, 40, '2022-03-11 21:39:02', '2022-09-19 23:16:07', 'LEONARDO FREY'),
(16, 9, 3, 'DEMOLEDOR  7 KGS', 'vistas/img/productos/16/866.jpg', 1, 4500, 'TYU', 24, 12, '2022-03-11 21:39:02', '2022-09-19 23:16:07', 'LEONARDO FREY'),
(17, 9, 3, 'DEMOLEDOR 10 KGS', '', 1, 8500, 'SDR', 24, NULL, '2022-03-14 14:17:08', '2022-09-19 23:16:07', 'LEONARDO FREY'),
(19, 9, 2, 'DEMOLEDOR 15 KILOS', '', 1, 3500, 'BYU', 24, 12, '2022-04-28 04:12:56', '2022-09-19 23:16:07', 'LEONARDO FREY'),
(20, 8, 3, 'SONDA FLEXIBLE ELASTICA', '', 1, 4000, 'ELAS', 10, 16, '2022-09-25 04:17:52', '2022-09-25 04:17:52', NULL);

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
(3, 3, 6, 1, 1, 8, 0, '', '85477', '2022-03-31 04:33:06'),
(4, 3, 9, 1, 1, 8, 0, 'vistas/img/PedidoEquipos/4.pdf', '', '2022-03-31 05:06:32'),
(6, 5, 10, 1, 1, 8, 0, NULL, '', '2022-03-31 20:34:04'),
(7, 3, 5, 2, 1, 8, 0, NULL, '', '2022-05-03 03:17:59'),
(8, 5, 10, 2, 1, 8, 0, NULL, '', '2022-09-25 04:15:18');

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
  `tipo` int(11) NOT NULL COMMENT 'arriendo=10, cambio=11',
  `id_guia_despacho` int(11) DEFAULT NULL COMMENT 'id guia_despacho_detalle',
  `cantidad_guia` int(11) DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedido_equipo_detalle`
--

INSERT INTO `pedido_equipo_detalle` (`id`, `id_pedido_equipo`, `id_nombre_equipo`, `cantidad_solicita`, `observaciones`, `tipo`, `id_guia_despacho`, `cantidad_guia`, `fecha_entrega`) VALUES
(32, 3, 7, 0, '', 11, NULL, NULL, NULL),
(33, 6, 16, 0, 'con mango y discos', 10, NULL, 1, NULL),
(34, 6, 16, 0, 'con botones', 10, NULL, NULL, NULL),
(35, 6, 6, 0, '', 10, NULL, NULL, NULL),
(36, 6, 6, 0, '', 10, NULL, NULL, NULL),
(38, 3, 6, 0, '', 11, NULL, NULL, NULL),
(39, 3, 15, 0, '', 10, NULL, NULL, NULL),
(40, 4, 7, 0, '', 11, NULL, NULL, NULL),
(46, 7, 11, 0, '', 11, NULL, NULL, NULL),
(47, 7, 8, 0, '', 10, NULL, NULL, NULL),
(48, 7, 8, 0, '', 10, NULL, NULL, NULL),
(49, 7, 8, 0, '', 10, NULL, NULL, NULL),
(50, 7, 8, 0, '', 10, NULL, NULL, NULL),
(51, 8, 7, 0, '', 10, NULL, NULL, NULL),
(52, 8, 17, 0, '', 11, NULL, NULL, NULL),
(53, 8, 7, 0, '', 10, NULL, NULL, NULL),
(54, 8, 7, 0, '', 10, NULL, NULL, NULL),
(55, 8, 7, 0, '', 10, NULL, NULL, NULL),
(56, 3, 7, 0, '', 10, NULL, NULL, NULL),
(57, 3, 20, 0, '', 10, NULL, NULL, NULL),
(58, 3, 20, 0, '', 10, NULL, NULL, NULL),
(59, 3, 20, 0, '', 10, NULL, NULL, NULL);

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

--
-- Volcado de datos para la tabla `precios_clientes`
--

INSERT INTO `precios_clientes` (`id`, `id_constructoras`, `id_obras`, `id_nombre_equipos`, `precio`, `creado`, `usuario`) VALUES
(150, 5, 10, 11, 4600, '2022-05-03 21:05:24', 'LEONARDO FREY'),
(151, 5, 10, 15, 5000, '2022-05-03 21:05:24', 'LEONARDO FREY'),
(152, 5, 10, 6, 8500, '2022-05-03 21:05:24', 'LEONARDO FREY'),
(153, 5, 10, 8, 9000, '2022-05-03 21:05:24', 'LEONARDO FREY'),
(154, 5, 10, 16, 9000, '2022-05-03 21:05:24', 'LEONARDO FREY'),
(155, 5, 10, 17, 8000, '2022-05-03 21:05:24', 'LEONARDO FREY'),
(156, 5, 10, 19, 3000, '2022-05-03 21:05:24', 'LEONARDO FREY'),
(157, 5, 10, 7, 1000, '2022-05-03 21:05:24', 'LEONARDO FREY');

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
(1, '13.485.480-4', 'HILTI CHILE', 'EL VENDEDOR', 'NUEVA COSTANERA 25654', '865455221', 'l.frey.g@gmail.com', '2022-05-13 04:22:27'),
(2, '13.663.730-4', 'BOSH', 'LEO', 'SIN DIRECCION', '965845545', 'l.frey.g@gmail.com', '2022-03-11 21:39:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `report_devolucion`
--

CREATE TABLE `report_devolucion` (
  `id` int(11) NOT NULL,
  `id_constructoras` int(11) NOT NULL,
  `id_obras` int(11) NOT NULL,
  `fecha_report` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_usuario` int(11) NOT NULL,
  `documento` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `id_sucursal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `report_devolucion`
--

INSERT INTO `report_devolucion` (`id`, `id_constructoras`, `id_obras`, `fecha_report`, `id_usuario`, `documento`, `estado`, `id_sucursal`) VALUES
(2, 4, 8, '2022-05-13 02:33:00', 1, '', 14, 1),
(3, 5, 10, '2022-05-13 02:33:10', 1, NULL, 14, 1),
(9, 5, 10, '2022-06-01 02:44:02', 1, NULL, 14, 1),
(12, 5, 10, '2022-06-01 03:03:53', 1, NULL, 14, 1),
(13, 5, 10, '2022-06-01 03:04:59', 1, NULL, 14, 1),
(14, 3, 6, '2022-06-08 03:08:37', 1, NULL, 14, 1),
(15, 3, 6, '2022-07-19 01:53:36', 1, NULL, 14, 1),
(16, 4, 8, '2022-09-25 05:38:36', 1, NULL, 14, 1),
(17, 4, 8, '2022-09-26 03:34:09', 1, NULL, 9, 1),
(18, 5, 10, '2022-09-27 21:54:29', 1, NULL, 9, 1),
(19, 3, 6, '2022-09-28 02:06:13', 3, NULL, 9, 1),
(20, 3, 6, '2022-09-28 02:16:32', 1, NULL, 9, 1),
(21, 5, 10, '2022-09-28 02:16:44', 1, NULL, 9, 1),
(22, 3, 6, '2022-09-28 02:17:12', 1, NULL, 9, 1),
(23, 3, 6, '2022-09-28 03:19:01', 3, NULL, 9, 1),
(24, 3, 3, '2022-09-30 01:34:10', 1, NULL, 14, 1),
(25, 3, 3, '2022-09-30 01:34:44', 1, NULL, 14, 1),
(26, 3, 3, '2022-09-30 01:35:10', 1, NULL, 14, 1),
(27, 3, 3, '2022-09-30 01:37:42', 1, NULL, 14, 1),
(28, 3, 3, '2022-09-30 01:40:10', 1, NULL, 14, 1),
(29, 3, 3, '2022-09-30 01:46:26', 1, NULL, 9, 1);

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
(1, 'OFICINA CENTRAL', 'SANTIAGO CENTRO', 'LEO FREY', '967564098', 'l.frey.g@gmail.com', '2022-03-11 21:39:48'),
(2, 'SAN BERNARDO', 'SAN BERNARDO 3422', 'CARLOS GALAZ', '225698745', 'l.frey.g@gmail.com', '2022-05-03 03:17:44');

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
-- Estructura de tabla para la tabla `transporte_guia`
--

CREATE TABLE `transporte_guia` (
  `id` int(11) NOT NULL,
  `rut` text COLLATE utf8_spanish_ci NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `patente` text COLLATE utf8_spanish_ci NOT NULL,
  `rut_empresa_transporte` text COLLATE utf8_spanish_ci NOT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `transporte_guia`
--

INSERT INTO `transporte_guia` (`id`, `rut`, `nombre`, `patente`, `rut_empresa_transporte`, `eliminado`) VALUES
(1, '13485480-4', 'LEONARDO FREY', 'HFJZ-12', '76015943-3', 0);

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
(1, 'LEONARDO FREY', 'lfrey', '$2a$07$asxx54ahjppf45sd87a5auFl5oL1MQ3CVLaN0VsRRmfoos4w12Lu.', 1, '', 1, '2022-09-29 18:48:08', '2022-09-29 21:48:08', 1, '2022-05-13 04:24:55'),
(2, 'CRISTIAN VALLEJOS', 'cvallejos', '$2a$07$asxx54ahjppf45sd87a5auGZEtGHuyZwm.Ur.FJvWLCql3nmsMbXy', 2, 'vistas/img/usuarios/cvallejos/678.jpg', 1, '2022-02-23 18:16:46', '2022-03-03 13:35:00', 1, '2022-03-11 21:40:11'),
(3, 'BASTIAN FREY', 'bfrey', '$2a$07$asxx54ahjppf45sd87a5auGZEtGHuyZwm.Ur.FJvWLCql3nmsMbXy', 1, '', 1, '2022-09-28 00:11:15', '2022-09-28 03:11:15', 1, '2022-04-01 22:21:17'),
(4, 'ADMINISTRADOR', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 1, '', 1, '2022-08-02 11:06:23', '2022-08-02 15:06:23', 1, '2022-04-27 06:00:09');

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
-- Indices de la tabla `dte`
--
ALTER TABLE `dte`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empresas_operativas`
--
ALTER TABLE `empresas_operativas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empresa_transporte`
--
ALTER TABLE `empresa_transporte`
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
-- Indices de la tabla `guia_despacho`
--
ALTER TABLE `guia_despacho`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `guia_despacho_detalle`
--
ALTER TABLE `guia_despacho_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `log_mantenedor_equipos`
--
ALTER TABLE `log_mantenedor_equipos`
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
-- Indices de la tabla `report_devolucion`
--
ALTER TABLE `report_devolucion`
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
-- Indices de la tabla `transporte_guia`
--
ALTER TABLE `transporte_guia`
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
-- AUTO_INCREMENT de la tabla `dte`
--
ALTER TABLE `dte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empresas_operativas`
--
ALTER TABLE `empresas_operativas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empresa_transporte`
--
ALTER TABLE `empresa_transporte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `facturas_compra_equipos`
--
ALTER TABLE `facturas_compra_equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `guia_despacho`
--
ALTER TABLE `guia_despacho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `guia_despacho_detalle`
--
ALTER TABLE `guia_despacho_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT de la tabla `log_mantenedor_equipos`
--
ALTER TABLE `log_mantenedor_equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `nombre_equipos`
--
ALTER TABLE `nombre_equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `obras`
--
ALTER TABLE `obras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pedido_equipo`
--
ALTER TABLE `pedido_equipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pedido_equipo_detalle`
--
ALTER TABLE `pedido_equipo_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `precios_clientes`
--
ALTER TABLE `precios_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `report_devolucion`
--
ALTER TABLE `report_devolucion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_cobro`
--
ALTER TABLE `tipo_cobro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `transporte_guia`
--
ALTER TABLE `transporte_guia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
