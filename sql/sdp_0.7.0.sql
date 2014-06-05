SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE `wp_sdp_Arbitros` (
  `IdArbitro` bigint(20) NOT NULL AUTO_INCREMENT,
  `Nif_Passport` varchar(50) NOT NULL,
  `Apellido1` varchar(50) DEFAULT NULL,
  `Apellido2` varchar(50) DEFAULT NULL,
  `Nombre` varchar(50) NOT NULL,
  `EsUniversitario` tinyint(1) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Sexo` varchar(50) NOT NULL,
  `FechaNacimiento` datetime DEFAULT NULL,
  `Direccion` varchar(60) DEFAULT NULL,
  `Localidad` varchar(15) DEFAULT NULL,
  `Provincia` varchar(15) DEFAULT NULL,
  `CodPostal` varchar(5) DEFAULT NULL,
  `Telefono` varchar(9) DEFAULT NULL,
  `TelefonoMovil` varchar(9) DEFAULT NULL,
  `Foto` longblob,
  `Comentarios` longtext,
  `EntidadBancaria` varchar(25) DEFAULT NULL,
  `CCC` varchar(23) DEFAULT NULL,
  `IdCurso` int(11) DEFAULT '2004',
  PRIMARY KEY (`IdArbitro`),
  KEY `CodPostal` (`CodPostal`),
  KEY `IdCurso` (`IdCurso`),
  KEY `Nif_Passport` (`Nif_Passport`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `wp_sdp_AsistenciaJugadoresEquipo1` (
  `IdPartido` int(11) DEFAULT NULL,
  `IdJugador` int(11) DEFAULT NULL,
  `Asistencia` tinyint(1) DEFAULT '0',
  KEY `IdPartido` (`IdPartido`,`IdJugador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `wp_sdp_AsistenciaJugadoresEquipo2` (
  `IdPartido` int(11) DEFAULT NULL,
  `IdJugador` int(11) DEFAULT NULL,
  `Asistencia` tinyint(1) DEFAULT '0',
  KEY `IdPartido` (`IdPartido`,`IdJugador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `wp_sdp_Asistencias_a_partidos` (
  `IdPartido` int(11) NOT NULL,
  `IdJugador` int(11) NOT NULL,
  PRIMARY KEY (`IdPartido`,`IdJugador`),
  KEY `IdJugador` (`IdJugador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `wp_sdp_Centros` (
  `IdCentro` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`IdCentro`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `wp_sdp_Centros` (`IdCentro`, `Nombre`) VALUES
(1, 'Facultad de Veterinaria'),
(2, 'Facultad de Ciencias Biológicas y Ambientales'),
(3, 'Facultad de Derecho'),
(4, 'Facultad de Filosofía y Letras'),
(5, 'Facultad de Ciencias Económicas y Empresariales'),
(6, 'Facultad de Ciencias del Trabajo.'),
(7, 'Escuela de Ingenierías Industrial e Informática'),
(8, 'Escuela Universitaria de Ingeniería Técnica  de Minas'),
(9, 'Escuela Superior y Técnica de Ingeniería Agraria'),
(10, 'Facultad de Educación'),
(11, 'Escuela Universitaria de Ciencias de la Salud'),
(12, 'Escuela Universitaria de Trabajo Social'),
(13, 'Facultad de Ciencias de la Actividad Física y del Deporte (F.A.C.A.F.D.)'),
(14, 'Escuela de Cinematografía y Artes Visuales de Castilla y León'),
(15, 'Residencia Universitaria Consejo de Europa'),
(16, 'Residencia Universitaria Infanta Dña Sancha'),
(17, 'Colegio Mayor San Isidoro'),
(18, 'Residencia Universitaria Miguel de Unamuno'),
(19, 'Residencia Universitaria San Isidoro');

CREATE TABLE `wp_sdp_Cruces_tipo` (
  `IdPartido` int(11) NOT NULL AUTO_INCREMENT,
  `Jornada` int(11) DEFAULT NULL,
  `Partido` int(11) DEFAULT NULL,
  `Equipo1` int(11) DEFAULT NULL,
  `Equipo2` int(11) DEFAULT NULL,
  `NumeroEquipos` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdPartido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `wp_sdp_Cursos_academicos` (
  `IdCurso` int(11) NOT NULL,
  `CursoAcademico` varchar(9) DEFAULT NULL,
  PRIMARY KEY (`IdCurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `wp_sdp_Cursos_academicos` (`IdCurso`, `CursoAcademico`) VALUES
(2002, '2002/2003'),
(2003, '2003/2004'),
(2004, '2004/2005'),
(2005, '2005/2006'),
(2006, '2006/2007'),
(2007, '2007/2008'),
(2008, '2008/2009'),
(2009, '2009/2010'),
(2010, '2010/2011'),
(2011, '2011-2012'),
(2012, '2012-2013'),
(2013, '2013-2014');

CREATE TABLE `wp_sdp_Detalles_de_arbitros` (
  `IdArbitro` int(11) NOT NULL,
  `IdModalidad` int(11) NOT NULL,
  `Division` int(11) NOT NULL,
  PRIMARY KEY (`IdArbitro`,`IdModalidad`,`Division`),
  KEY `IdArbitro` (`IdArbitro`),
  KEY `IdModalidad` (`IdModalidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `wp_sdp_Detalles_de_equipos` (
  `IdEquipo` int(11) NOT NULL,
  `IdJugador` int(11) NOT NULL,
  PRIMARY KEY (`IdJugador`,`IdEquipo`),
  KEY `IdEquipo` (`IdEquipo`),
  KEY `IdJugador` (`IdJugador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `wp_sdp_Detalles_de_instalaciones` (
  `IdDetalleInstalacion` int(11) NOT NULL AUTO_INCREMENT,
  `IdInstalacion` int(11) NOT NULL,
  `IdModalidad` int(11) NOT NULL,
  PRIMARY KEY (`IdDetalleInstalacion`),
  KEY `IdInstalacion` (`IdInstalacion`),
  KEY `IdModalidad` (`IdModalidad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `wp_sdp_Detalles_de_instalaciones` (`IdDetalleInstalacion`, `IdInstalacion`, `IdModalidad`) VALUES
(1, 1, 7),
(2, 1, 3),
(3, 1, 4),
(4, 2, 4),
(5, 1, 11),
(6, 2, 7),
(7, 3, 4),
(8, 3, 7),
(9, 4, 6),
(10, 5, 6),
(11, 4, 12),
(13, 6, 3),
(14, 6, 11),
(15, 7, 8),
(16, 1, 13),
(17, 8, 9),
(18, 6, 2),
(19, 9, 1),
(20, 10, 14),
(21, 10, 5),
(22, 11, 4),
(23, 11, 7),
(24, 12, 10),
(25, 1, 15),
(26, 6, 17),
(27, 13, 18),
(28, 10, 19),
(29, 14, 9),
(30, 1, 20);

CREATE TABLE `wp_sdp_Equipos` (
  `IdEquipo` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) DEFAULT NULL,
  `IdModalidad` int(11) DEFAULT NULL,
  `IdSexo` int(11) DEFAULT NULL,
  `Division` int(11) DEFAULT NULL,
  `Grupo` int(11) DEFAULT NULL,
  `IdCapitan` int(11) DEFAULT NULL,
  `Eliminado` tinyint(1) DEFAULT '0',
  `OrdenGrupo` int(11) NOT NULL,
  `Comentarios` longtext,
  `IdCurso` int(11) DEFAULT '2004',
  PRIMARY KEY (`IdEquipo`),
  KEY `IdCapitan` (`IdCapitan`),
  KEY `IdCurso` (`IdCurso`),
  KEY `IdModalidad` (`IdModalidad`),
  KEY `IdSexo` (`IdSexo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `wp_sdp_Instalaciones` (
  `IdInstalacion` int(11) NOT NULL AUTO_INCREMENT,
  `Instalacion` varchar(50) DEFAULT NULL,
  `IdTipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdInstalacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `wp_sdp_Instalaciones` (`IdInstalacion`, `Instalacion`, `IdTipo`) VALUES
(1, 'Pabellón', 1),
(2, 'Polideportivo 1', 2),
(3, 'Polideportivo 2', 2),
(4, 'Campo 1', 2),
(5, 'Campo 2', 2),
(6, 'Gimnasio', 1),
(7, 'Estadio Hispánico', 1),
(8, 'TENIS 3', 2),
(9, 'AULA', 1),
(10, 'FRONTON', 1),
(11, 'INEF PABELLON', 1),
(12, 'TENIS MESA', 1),
(13, 'Voley Playa', 2),
(14, 'TENIS 2', 2);

CREATE TABLE `wp_sdp_Jugadores` (
  `IdJugador` bigint(20) NOT NULL AUTO_INCREMENT,
  `Nif_Passport` varchar(50) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `EsUniversitario` tinyint(1) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `IdSexo` int(11) NOT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `IdCentro` int(11) NOT NULL,
  `Domicilio` varchar(50) DEFAULT NULL,
  `Localidad` varchar(50) DEFAULT NULL,
  `Provincia` varchar(50) DEFAULT NULL,
  `CodPostal` varchar(50) DEFAULT NULL,
  `Telefono` varchar(50) DEFAULT NULL,
  `TelefonoMovil` varchar(9) DEFAULT NULL,
  `Foto` longblob,
  `Comentarios` longtext,
  `IdCurso` int(11) DEFAULT NULL,
  KEY `IdCurso` (`IdCurso`),
  KEY `IdJugador` (`IdJugador`),
  KEY `Nif_Passport` (`Nif_Passport`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `wp_sdp_Modalidades` (
  `IdModalidad` int(11) NOT NULL AUTO_INCREMENT,
  `Modalidad` varchar(50) DEFAULT NULL,
  `EsUniversitario` tinyint(1) DEFAULT NULL,
  `TipoCompeticion` varchar(50) DEFAULT NULL,
  `PuntosVictoria` int(11) DEFAULT NULL,
  `PuntosEmpate` int(11) DEFAULT NULL,
  `PuntosDerrota` int(11) DEFAULT NULL,
  `PuntosNoPresentado` int(11) DEFAULT NULL,
  `NoPresentacionesRebajaMediaFianza` int(11) DEFAULT NULL,
  `NoPresentacionesEliminacion` int(11) DEFAULT NULL,
  `PrecioArbitraje` decimal(19,4) DEFAULT NULL,
  `RetencionArbitraje` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdModalidad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `wp_sdp_Modalidades` (`IdModalidad`, `Modalidad`, `EsUniversitario`, `TipoCompeticion`, `PuntosVictoria`, `PuntosEmpate`, `PuntosDerrota`, `PuntosNoPresentado`, `NoPresentacionesRebajaMediaFianza`, `NoPresentacionesEliminacion`, `PrecioArbitraje`, `RetencionArbitraje`) VALUES
(1, 'Ajedrez', NULL, NULL, 2, 1, 0, -1, 2, 3, NULL, 15),
(2, 'Badminton', NULL, NULL, 2, -100, 1, -1, 2, 3, NULL, 15),
(3, 'Baloncesto', NULL, NULL, 2, -100, 1, -1, 2, 3, 7.0000, 15),
(4, 'Balonmano', NULL, NULL, 3, 1, 0, -1, 2, 3, 7.0000, 15),
(5, 'Frontenis parejas', NULL, NULL, 2, -100, 1, -1, 2, 3, NULL, 15),
(6, 'Fútbol Hierba', NULL, NULL, 3, 1, 0, -1, 2, 3, 17.5000, 15),
(7, 'Fútbol Sala', NULL, NULL, 3, 1, 0, -1, 2, 3, 7.0000, 15),
(8, 'Squash', NULL, NULL, 2, -100, 1, -1, 2, 3, NULL, 15),
(9, 'Tenis', NULL, NULL, 2, -100, 1, -1, 2, 3, NULL, 15),
(10, 'Tenis de mesa', NULL, NULL, 2, -100, 1, -1, 2, 3, NULL, 15),
(11, 'Voleibol', NULL, NULL, 2, -100, 1, -1, 2, 3, 7.0000, 15),
(12, 'Rugby', NULL, NULL, 3, 1, 0, -1, 2, 3, NULL, 15),
(13, 'F. Sala DEPARTAMENTOS', NULL, NULL, 3, 1, 0, -1, 2, 3, 7.0000, 15),
(14, 'Frontenis indiv.', NULL, NULL, 2, -100, 1, -1, 2, 3, NULL, 15),
(15, 'Tenis Mesa Final', NULL, NULL, 2, -100, 1, -1, 2, 3, NULL, NULL),
(17, 'Badminton Final', NULL, NULL, 2, -100, 1, -1, 2, 3, NULL, NULL),
(18, 'Voley Playa', NULL, NULL, 2, -100, 0, -1, 2, 3, 7.0000, 15),
(19, 'Frontenis indiv FINAL', NULL, NULL, 3, -100, 1, -1, 2, 3, NULL, NULL),
(20, 'F.Sala Departamentos II', NULL, NULL, 3, 1, 0, -1, 2, 3, 7.0000, 15),
(96, 'Pruebaa', 0, 'Liga a -2  vueltas', 3, 2, 1, 0, 2, 3, 33.0000, NULL);

CREATE TABLE `wp_sdp_Partidos` (
  `IdPartido` int(11) NOT NULL AUTO_INCREMENT,
  `Ida_Vuelta` tinyint(1) DEFAULT '0',
  `Jornada` int(11) DEFAULT NULL,
  `Partido` int(11) DEFAULT NULL,
  `IdEquipo1` int(11) DEFAULT NULL,
  `IdEquipo2` int(11) DEFAULT NULL,
  `TantosEquipo1` int(11) DEFAULT NULL,
  `TantosEquipo2` int(11) DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL,
  `Hora` datetime DEFAULT NULL,
  `IdInstalacion` int(11) DEFAULT NULL,
  `Aplazado` tinyint(1) DEFAULT '0',
  `Comentarios` longtext,
  `IdCurso` int(11) DEFAULT '2004',
  PRIMARY KEY (`IdPartido`),
  KEY `IdCurso` (`IdCurso`),
  KEY `IdEquipo1` (`IdEquipo1`),
  KEY `IdEquipo2` (`IdEquipo2`),
  KEY `Jornada` (`Jornada`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `wp_sdp_Sanciones_equipos` (
  `IdPartido` int(11) NOT NULL,
  `IdEquipo` int(11) NOT NULL,
  `Sancion` int(11) DEFAULT NULL,
  `Comentarios` longtext,
  PRIMARY KEY (`IdPartido`,`IdEquipo`),
  KEY `IdPartido` (`IdPartido`),
  KEY `IdEquipo` (`IdEquipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `wp_sdp_Sanciones_jugadores` (
  `IdPartido` int(11) NOT NULL,
  `IdJugador` int(11) NOT NULL,
  `Sancion` int(11) NOT NULL,
  `Comentarios` longtext,
  PRIMARY KEY (`IdPartido`,`IdJugador`),
  KEY `IdPartido` (`IdPartido`),
  KEY `IdJugador` (`IdJugador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `wp_sdp_Sexos_equipo` (
  `IdSexo` int(11) NOT NULL AUTO_INCREMENT,
  `Sexo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdSexo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `wp_sdp_Sexos_equipo` (`IdSexo`, `Sexo`) VALUES
(1, 'Masculino'),
(2, 'Femenino'),
(3, 'Mixto');

CREATE TABLE `wp_sdp_Sexos_persona` (
  `IdSexo` int(11) NOT NULL AUTO_INCREMENT,
  `Sexo` varchar(50) DEFAULT NULL,
  `Tratamiento` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdSexo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `wp_sdp_Sexos_persona` (`IdSexo`, `Sexo`, `Tratamiento`) VALUES
(1, 'Hombre', 'D.'),
(2, 'Mujer', 'DÑA.');

CREATE TABLE `wp_sdp_Switchboard Items` (
  `SwitchboardID` int(11) NOT NULL,
  `ItemNumber` int(11) NOT NULL DEFAULT '0',
  `ItemText` varchar(255) DEFAULT NULL,
  `Command` int(11) DEFAULT NULL,
  `Argument` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`SwitchboardID`,`ItemNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `wp_sdp_Switchboard Items` (`SwitchboardID`, `ItemNumber`, `ItemText`, `Command`, `Argument`) VALUES
(1, 0, 'Panel de control principal', NULL, 'Default'),
(1, 1, 'Ver / Introducir Equipos', 3, 'Equipos'),
(1, 2, 'Ver / Introducir Jugadores', 3, 'Jugadores'),
(1, 3, 'Ver / Introducir Arbitros', 3, 'Arbitros'),
(1, 4, 'Ver / Introducir otra información...', 1, '3'),
(1, 5, 'Partidos...', 1, '4'),
(1, 6, 'Vista previa de los informes...', 1, '2'),
(1, 7, 'Acerca de Competición Interna', 3, 'Acerca de Competicion Interna'),
(1, 8, 'Salir de esta base de datos', 6, ''),
(2, 0, 'Panel de control de informes', 0, NULL),
(2, 1, 'Listado de equipos por grupo', 3, 'Dialogo de Informe de Equipos por Grupo'),
(2, 2, 'Clasificación', 3, 'Dialogo de Informe de Clasificacion'),
(2, 3, 'Arbitrajes', 1, '5'),
(2, 4, 'Equipos eliminados por No Presentaciones', 4, 'Equipos eliminados por No Presentaciones'),
(2, 5, 'Equipos sancionados por NP con embargo de media fianza', 4, 'Equipos sancionados por NP con embargo de media fianza'),
(2, 6, 'Jugadores en más de un equipo de la misma modalidad', 4, 'Jugadores en mas de un equipo de la misma modalidad'),
(2, 7, 'Certificados de participación', 3, 'Dialogo de Informe de Participacion'),
(2, 8, 'Volver al panel de control principal...', 1, '1'),
(3, 0, 'Panel de control de otros datos', 0, NULL),
(3, 1, 'Ver / Introducir Centros', 3, 'Centros'),
(3, 2, 'Ver / Introducir Instalaciones', 3, 'Instalaciones'),
(3, 3, 'Ver / Introducir Modalidades', 3, 'Modalidades'),
(3, 4, 'Volver al panel de control principal...', 1, '1'),
(4, 0, 'Panel de control de partidos', 0, NULL),
(4, 1, 'Programar partidos...', 3, 'Dialogo de Insertar Jornadas'),
(4, 2, 'Ver / Editar partidos...', 3, 'Dialogo de Formulario de Partidos'),
(4, 3, 'Publicar calendario de partidos', 3, 'Dialogo de Informe de Partidos'),
(4, 4, 'Publicar actas de partido', 3, 'Dialogo de Actas de Partido'),
(4, 5, 'Volver al panel de control principal...', 1, '1'),
(5, 0, 'Panel de control de arbitrajes', 0, NULL),
(5, 1, 'Informe de arbitrajes', 3, 'Dialogo de Informe de Arbitrajes'),
(5, 2, 'Resumen de arbitrajes', 3, 'Dialogo de Resumen de Arbitrajes'),
(5, 3, 'Recibo de arbitrajes', 3, 'Dialogo de Recibo de Arbitrajes'),
(5, 4, 'Volver al panel de control principal', 1, '1');

CREATE TABLE `wp_sdp_tblArbitrajes` (
  `IdPartido` int(11) NOT NULL,
  `IdArbitro` int(11) NOT NULL,
  `Fecha` datetime DEFAULT NULL,
  `Participa` tinyint(1) DEFAULT '0',
  `Pagado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`IdPartido`,`IdArbitro`),
  KEY `IdPartido` (`IdPartido`),
  KEY `IdArbitro` (`IdArbitro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `wp_sdp_Tipos_de_instalacion` (
  `IdTipo` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`IdTipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `wp_sdp_Tipos_de_instalacion` (`IdTipo`, `Tipo`) VALUES
(1, 'Interior'),
(2, 'Exterior');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
