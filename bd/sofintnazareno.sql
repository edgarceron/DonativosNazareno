-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2018 a las 15:50:38
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sofintnazareno`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acciones`
--

CREATE TABLE `acciones` (
  `id` int(11) NOT NULL,
  `modulo` varchar(20) NOT NULL,
  `accion` varchar(20) NOT NULL,
  `ruta` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `acciones`
--

INSERT INTO `acciones` (`id`, `modulo`, `accion`, `ruta`) VALUES
(1, 'plugins', 'index', 'application.modules.plugins.controllers.acciones.IndexAction'),
(2, 'plugins', 'registrarplugin', 'application.modules.plugins.controllers.acciones.RegistrarpluginAction'),
(3, 'plugins', 'unregistrarplugin', 'application.modules.plugins.controllers.acciones.UnregistrarpluginAction'),
(4, 'usuarios', 'index', 'application.modules.usuarios.controllers.acciones.IndexAction'),
(5, 'usuarios', 'view', 'application.modules.usuarios.controllers.acciones.ViewAction'),
(6, 'usuarios', 'create', 'application.modules.usuarios.controllers.acciones.CreateAction'),
(7, 'usuarios', 'borrar', 'application.modules.usuarios.controllers.acciones.BorrarAction'),
(8, 'usuarios', 'perfil', 'application.modules.usuarios.controllers.acciones.PerfilAction'),
(9, 'usuarios', 'verperfil', 'application.modules.usuarios.controllers.acciones.VerperfilAction'),
(10, 'usuarios', 'borrarperfil', 'application.modules.usuarios.controllers.acciones.BorrarperfilAction'),
(11, 'usuarios', 'grupo', 'application.modules.usuarios.controllers.acciones.GrupoAction'),
(16, 'eventos', 'index', 'application.modules.eventos.controllers.acciones.IndexAction'),
(17, 'donantes', 'index', 'application.modules.donantes.controllers.acciones.IndexAction'),
(18, 'donaciones', 'index', 'application.modules.donaciones.controllers.acciones.IndexAction'),
(19, 'donaciones', 'prueba', 'application.modules.donaciones.controllers.acciones.IndexAction'),
(20, 'eventos', 'vista', 'application.modules.eventos.controllers.acciones.VistaAction'),
(21, 'eventos', 'crear', 'application.modules.eventos.controllers.acciones.CrearAction'),
(22, 'eventos', 'editar', 'application.modules.eventos.controllers.acciones.EditarAction'),
(23, 'eventos', 'guardar', 'application.modules.eventos.controllers.acciones.GuardarEventoAction'),
(24, 'eventos', 'lista', 'application.modules.eventos.controllers.acciones.ListaAction'),
(25, 'eventos', 'eliminar', 'application.modules.eventos.controllers.acciones.EliminarAction'),
(26, 'donantes', 'crear', 'application.modules.donantes.controllers.acciones.CrearAction'),
(27, 'donantes', 'lista', 'application.modules.donantes.controllers.acciones.ListaAction'),
(28, 'donantes', 'editar', 'application.modules.donantes.controllers.acciones.EditarAction'),
(29, 'donantes', 'guardar', 'application.modules.donantes.controllers.acciones.GuardarEventoAction'),
(30, 'donantes', 'eliminar', 'application.modules.donantes.controllers.acciones.EliminarAction'),
(31, 'donantes', 'Vista', 'application.modules.donantes.controllers.acciones.VistaAction'),
(32, 'donaciones', 'crear', 'application.modules.donaciones.controllers.acciones.CrearAction'),
(33, 'donaciones', 'lista', 'application.modules.donaciones.controllers.acciones.ListaAction'),
(34, 'donaciones', 'editar', 'application.modules.donaciones.controllers.acciones.EditarAction'),
(35, 'donaciones', 'guardar', 'application.modules.donaciones.controllers.acciones.GuardarAction'),
(36, 'donaciones', 'eliminar', 'application.modules.donaciones.controllers.acciones.EliminarAction'),
(37, 'donaciones', 'vista', 'application.modules.donaciones.controllers.acciones.VistaAction'),
(38, 'donaciones', 'eventosFiltrar', 'application.modules.donaciones.controllers.acciones.EventosFiltrarAction'),
(39, 'donaciones', 'donanteCargar', 'application.modules.donaciones.controllers.acciones.DonanteCargarAction'),
(40, 'donaciones', 'donanteGuardar', 'application.modules.donaciones.controllers.acciones.DonanteGuardarAction'),
(41, 'usuarios', 'restablecer', 'application.modules.usuarios.controllers.acciones.RestablecerAction'),
(42, 'usuarios', 'nuevaContra', 'application.modules.usuarios.controllers.acciones.NuevaContraAction'),
(43, 'usuarios', 'recuperar', 'application.modules.usuarios.controllers.acciones.RecuperarAction'),
(44, 'usuarios', 'cambiar', 'application.modules.usuarios.controllers.acciones.CambiarAction'),
(45, 'donaciones', 'reportePdf', 'application.modules.donaciones.controllers.acciones.ReportePdfAction'),
(46, 'donantes', 'certificado', 'application.modules.donantes.controllers.acciones.CertificadoAction'),
(47, 'donaciones', 'reporteExcel', 'application.modules.donaciones.controllers.acciones.ReporteExcelAction'),
(48, 'donaciones', 'donanteTipo', 'application.modules.donaciones.controllers.acciones.DonanteTipo'),
(49, 'donantes', 'reporte', 'application.modules.donantes.controllers.acciones.DonantesPorFechaAction'),
(50, 'donantes', 'consolidado', 'application.modules.donantes.controllers.acciones.ConsolidadoAction'),
(51, 'donantes', 'donantesTipo', 'application.modules.donantes.controllers.acciones.DonantesTipoAction'),
(52, 'usuarios', 'cuenta', 'application.modules.usuarios.controllers.acciones.CuentaAction');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id`, `nombre`) VALUES
(1, 'ADMINISTRACION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `ID` int(11) NOT NULL,
  `accion` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id` varchar(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha_creacion` bigint(20) NOT NULL,
  `version` varchar(20) NOT NULL,
  `desarrollador` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `nombre`, `estado`, `fecha_creacion`, `version`, `desarrollador`) VALUES
('admin', 'admin', 1, 1459344759, '1', 'nojuancho@hotmail.com'),
('donaciones', 'donaciones', 1, 1538869495, '1', 'edgar.ceron@correounivalle.edu.co'),
('donantes', 'donantes', 1, 1538869332, '1', 'edgar.ceron@correounivalle.edu.co'),
('eventos', 'eventos', 1, 1538453137, '1', 'edgar.ceron@correounivalle.edu.co'),
('maestros', 'maestros', 1, 1464791267, '1', 'nojuancho@hotmail.com'),
('plugins', 'plugins', 1, 1459344760, '1', 'nojuancho@hotmail.com'),
('usuarios', 'usuarios', 1, 1459344761, '1', 'nojuancho@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones`
--

CREATE TABLE `opciones` (
  `id` int(11) NOT NULL,
  `opcion` varchar(32) NOT NULL,
  `valor` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `opciones`
--

INSERT INTO `opciones` (`id`, `opcion`, `valor`) VALUES
(1, 'password', 'dGFrYWdpLm1peVU3OTE4'),
(2, 'email', 'matsuurahana@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `fecha_creacion` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id`, `nombre`, `descripcion`, `fecha_creacion`) VALUES
(1, 'ADMINISTRADOR', 'Administrador del sistema', 1459345066),
(2, 'registrador', 'Perfil para registrar donaciones', 1542301613);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_contenido`
--

CREATE TABLE `perfil_contenido` (
  `id` int(11) NOT NULL,
  `modulo` varchar(20) NOT NULL,
  `controlador` varchar(20) NOT NULL,
  `accion` varchar(20) NOT NULL,
  `estado` int(11) NOT NULL,
  `perfil` int(11) NOT NULL,
  `fecha_creacion` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil_contenido`
--

INSERT INTO `perfil_contenido` (`id`, `modulo`, `controlador`, `accion`, `estado`, `perfil`, `fecha_creacion`) VALUES
(976, 'donaciones', 'donaciones', 'donaciones', 1, 2, 1542301664),
(977, 'donaciones', 'donaciones', 'index', 1, 2, 1542301664),
(978, 'donaciones', 'donaciones', 'prueba', 1, 2, 1542301664),
(979, 'donaciones', 'donaciones', 'crear', 1, 2, 1542301664),
(980, 'donaciones', 'donaciones', 'lista', 1, 2, 1542301664),
(981, 'donaciones', 'donaciones', 'editar', 1, 2, 1542301664),
(982, 'donaciones', 'donaciones', 'guardar', 1, 2, 1542301664),
(983, 'donaciones', 'donaciones', 'eliminar', 1, 2, 1542301664),
(984, 'donaciones', 'donaciones', 'vista', 1, 2, 1542301664),
(985, 'donaciones', 'donaciones', 'eventosFiltrar', 1, 2, 1542301664),
(986, 'donaciones', 'donaciones', 'donanteCargar', 1, 2, 1542301664),
(987, 'donaciones', 'donaciones', 'donanteGuardar', 1, 2, 1542301664),
(988, 'donaciones', 'donaciones', 'reportePdf', 1, 2, 1542301664),
(989, 'donaciones', 'donaciones', 'reporteExcel', 1, 2, 1542301664),
(990, 'donaciones', 'donaciones', 'donanteTipo', 1, 2, 1542301664),
(991, 'donantes', 'donantes', 'donantes', 1, 2, 1542301664),
(992, 'donantes', 'donantes', 'index', 1, 2, 1542301664),
(993, 'donantes', 'donantes', 'crear', 1, 2, 1542301664),
(994, 'donantes', 'donantes', 'lista', 1, 2, 1542301664),
(995, 'donantes', 'donantes', 'editar', 1, 2, 1542301664),
(996, 'donantes', 'donantes', 'guardar', 1, 2, 1542301664),
(997, 'donantes', 'donantes', 'eliminar', 1, 2, 1542301664),
(998, 'donantes', 'donantes', 'Vista', 1, 2, 1542301664),
(999, 'donantes', 'donantes', 'certificado', 1, 2, 1542301664),
(1000, 'donantes', 'donantes', 'reporte', 1, 2, 1542301664),
(1001, 'donantes', 'donantes', 'consolidado', 1, 2, 1542301664),
(1002, 'donantes', 'donantes', 'donantesTipo', 1, 2, 1542301664),
(1003, 'eventos', 'eventos', 'eventos', 1, 2, 1542301664),
(1004, 'eventos', 'eventos', 'index', 1, 2, 1542301665),
(1005, 'eventos', 'eventos', 'vista', 1, 2, 1542301665),
(1006, 'eventos', 'eventos', 'crear', 1, 2, 1542301665),
(1007, 'eventos', 'eventos', 'editar', 1, 2, 1542301665),
(1008, 'eventos', 'eventos', 'lista', 1, 2, 1542301665),
(1009, 'eventos', 'eventos', 'eliminar', 1, 2, 1542301665),
(1010, 'usuarios', 'usuarios', 'cuenta', 1, 2, 1542301665),
(1011, 'admin', 'admin', 'admin', 1, 1, 1542303665),
(1012, 'donaciones', 'donaciones', 'donaciones', 1, 1, 1542303665),
(1013, 'donaciones', 'donaciones', 'index', 1, 1, 1542303665),
(1014, 'donaciones', 'donaciones', 'crear', 1, 1, 1542303665),
(1015, 'donaciones', 'donaciones', 'lista', 1, 1, 1542303665),
(1016, 'donaciones', 'donaciones', 'editar', 1, 1, 1542303665),
(1017, 'donaciones', 'donaciones', 'guardar', 1, 1, 1542303665),
(1018, 'donaciones', 'donaciones', 'eliminar', 1, 1, 1542303665),
(1019, 'donaciones', 'donaciones', 'vista', 1, 1, 1542303665),
(1020, 'donaciones', 'donaciones', 'eventosFiltrar', 1, 1, 1542303665),
(1021, 'donaciones', 'donaciones', 'donanteCargar', 1, 1, 1542303665),
(1022, 'donaciones', 'donaciones', 'donanteGuardar', 1, 1, 1542303666),
(1023, 'donaciones', 'donaciones', 'reportePdf', 1, 1, 1542303666),
(1024, 'donaciones', 'donaciones', 'reporteExcel', 1, 1, 1542303666),
(1025, 'donaciones', 'donaciones', 'donanteTipo', 1, 1, 1542303666),
(1026, 'donantes', 'donantes', 'donantes', 1, 1, 1542303666),
(1027, 'donantes', 'donantes', 'index', 1, 1, 1542303666),
(1028, 'donantes', 'donantes', 'crear', 1, 1, 1542303666),
(1029, 'donantes', 'donantes', 'lista', 1, 1, 1542303666),
(1030, 'donantes', 'donantes', 'editar', 1, 1, 1542303666),
(1031, 'donantes', 'donantes', 'guardar', 1, 1, 1542303666),
(1032, 'donantes', 'donantes', 'eliminar', 1, 1, 1542303666),
(1033, 'donantes', 'donantes', 'Vista', 1, 1, 1542303666),
(1034, 'donantes', 'donantes', 'certificado', 1, 1, 1542303666),
(1035, 'donantes', 'donantes', 'reporte', 1, 1, 1542303666),
(1036, 'donantes', 'donantes', 'consolidado', 1, 1, 1542303666),
(1037, 'donantes', 'donantes', 'donantesTipo', 1, 1, 1542303666),
(1038, 'eventos', 'eventos', 'eventos', 1, 1, 1542303666),
(1039, 'eventos', 'eventos', 'index', 1, 1, 1542303666),
(1040, 'eventos', 'eventos', 'vista', 1, 1, 1542303666),
(1041, 'eventos', 'eventos', 'crear', 1, 1, 1542303666),
(1042, 'eventos', 'eventos', 'editar', 1, 1, 1542303666),
(1043, 'eventos', 'eventos', 'guardar', 1, 1, 1542303666),
(1044, 'eventos', 'eventos', 'lista', 1, 1, 1542303666),
(1045, 'eventos', 'eventos', 'eliminar', 1, 1, 1542303666),
(1046, 'maestros', 'maestros', 'maestros', 1, 1, 1542303666),
(1047, 'plugins', 'plugins', 'plugins', 1, 1, 1542303666),
(1048, 'plugins', 'plugins', 'index', 1, 1, 1542303666),
(1049, 'plugins', 'plugins', 'registrarplugin', 1, 1, 1542303666),
(1050, 'plugins', 'plugins', 'unregistrarplugin', 1, 1, 1542303666),
(1051, 'usuarios', 'usuarios', 'usuarios', 1, 1, 1542303666),
(1052, 'usuarios', 'usuarios', 'index', 1, 1, 1542303666),
(1053, 'usuarios', 'usuarios', 'view', 1, 1, 1542303666),
(1054, 'usuarios', 'usuarios', 'create', 1, 1, 1542303666),
(1055, 'usuarios', 'usuarios', 'borrar', 1, 1, 1542303666),
(1056, 'usuarios', 'usuarios', 'perfil', 1, 1, 1542303666),
(1057, 'usuarios', 'usuarios', 'verperfil', 1, 1, 1542303666),
(1058, 'usuarios', 'usuarios', 'borrarperfil', 1, 1, 1542303666),
(1059, 'usuarios', 'usuarios', 'grupo', 1, 1, 1542303666),
(1060, 'usuarios', 'usuarios', 'restablecer', 1, 1, 1542303666),
(1061, 'usuarios', 'usuarios', 'nuevaContra', 1, 1, 1542303666),
(1062, 'usuarios', 'usuarios', 'recuperar', 1, 1, 1542303666),
(1063, 'usuarios', 'usuarios', 'cambiar', 1, 1, 1542303666),
(1064, 'usuarios', 'usuarios', 'cuenta', 1, 1, 1542303666);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperar`
--

CREATE TABLE `recuperar` (
  `id` int(11) NOT NULL,
  `url` varchar(10) NOT NULL,
  `estado` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sofint_users`
--

CREATE TABLE `sofint_users` (
  `id` int(11) NOT NULL,
  `nick` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `telefono` int(11) DEFAULT NULL,
  `movil` bigint(11) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `direccion` text,
  `perfil` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha_creacion` int(11) NOT NULL,
  `restablecer` int(11) DEFAULT NULL,
  `grupo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sofint_users`
--

INSERT INTO `sofint_users` (`id`, `nick`, `password`, `nombre`, `apellido`, `telefono`, `movil`, `email`, `foto`, `direccion`, `perfil`, `estado`, `fecha_creacion`, `restablecer`, `grupo`) VALUES
(1, 'admin', 'c4d269375a376158e18a9bc0a32a45c8', 'Edgar Mauricio', 'Ceron Florez', 0, 0, 'edgar.ceron@correounivalle.edu.co', '', '', 1, -1, 1390152537, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acciones`
--
ALTER TABLE `acciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `opciones`
--
ALTER TABLE `opciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfil_contenido`
--
ALTER TABLE `perfil_contenido`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recuperar`
--
ALTER TABLE `recuperar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recuperar_ibfk_1` (`id_usuario`);

--
-- Indices de la tabla `sofint_users`
--
ALTER TABLE `sofint_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acciones`
--
ALTER TABLE `acciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `opciones`
--
ALTER TABLE `opciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `perfil_contenido`
--
ALTER TABLE `perfil_contenido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1065;

--
-- AUTO_INCREMENT de la tabla `recuperar`
--
ALTER TABLE `recuperar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sofint_users`
--
ALTER TABLE `sofint_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `recuperar`
--
ALTER TABLE `recuperar`
  ADD CONSTRAINT `recuperar_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `sofint_users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
