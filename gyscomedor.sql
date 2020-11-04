-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `Alumnos`;
CREATE TABLE `Alumnos` (
  `id` int(48) NOT NULL AUTO_INCREMENT,
  `claseid` int(16) NOT NULL,
  `nombrealumno` varchar(80) NOT NULL,
  `primerapellidoalumno` varchar(50) NOT NULL,
  `segundoapellidoalumno` varchar(50) DEFAULT NULL,
  `alergiasalumno` varchar(512) DEFAULT NULL,
  `mon` bit(1) DEFAULT b'0',
  `tue` bit(1) DEFAULT b'0',
  `wed` bit(1) DEFAULT b'0',
  `thu` bit(1) DEFAULT b'0',
  `fri` bit(1) DEFAULT b'0',
  PRIMARY KEY (`id`),
  KEY `claseid` (`claseid`),
  CONSTRAINT `Alumnos_ibfk_1` FOREIGN KEY (`claseid`) REFERENCES `Clases` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `Alumnos` (`id`, `claseid`, `nombrealumno`, `primerapellidoalumno`, `segundoapellidoalumno`, `alergiasalumno`, `mon`, `tue`, `wed`, `thu`, `fri`) VALUES
(1,	1,	'Francisco',	'Fernandez',	'Garcia',	'Ninguna',	CONV('1', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('0', 2, 10) + 0,	CONV('0', 2, 10) + 0),
(2,	1,	'Carlos',	'Garcia',	'Segura',	'Ninguna',	CONV('0', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('0', 2, 10) + 0,	CONV('0', 2, 10) + 0),
(4,	1,	'Federico',	'Saez',	'Gonzalez',	'Ninguna',	CONV('1', 2, 10) + 0,	CONV('0', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('0', 2, 10) + 0,	CONV('1', 2, 10) + 0),
(5,	1,	'Gonzalo',	'Alvarez',	'Ferrer',	'Vainilla',	CONV('1', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('0', 2, 10) + 0,	CONV('0', 2, 10) + 0,	CONV('1', 2, 10) + 0),
(6,	1,	'Maria',	'Alvarez',	'Garcia',	'Frutos Secos',	CONV('1', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('0', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('1', 2, 10) + 0),
(7,	1,	'Maria',	'Del Mar',	'Miravet',	'Verduras',	CONV('0', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('1', 2, 10) + 0),
(8,	1,	'Matias',	'Figueroa',	'Castillo',	'Ninguna',	CONV('0', 2, 10) + 0,	CONV('0', 2, 10) + 0,	CONV('0', 2, 10) + 0,	CONV('0', 2, 10) + 0,	CONV('0', 2, 10) + 0),
(9,	1,	'Ruben',	'Rodriguez',	'Martinez',	'Ninguna',	CONV('0', 2, 10) + 0,	CONV('0', 2, 10) + 0,	CONV('0', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('0', 2, 10) + 0),
(10,	1,	'Ismael',	'Soltero',	'Garbache',	'Ninguna',	CONV('0', 2, 10) + 0,	CONV('0', 2, 10) + 0,	CONV('0', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('0', 2, 10) + 0),
(11,	1,	'Ivan',	'Blasco',	'Garcia',	'Ninguna',	CONV('0', 2, 10) + 0,	CONV('0', 2, 10) + 0,	CONV('0', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('0', 2, 10) + 0),
(12,	1,	'Carlos',	'Garcia',	'Montero',	'Ninguna',	CONV('0', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('0', 2, 10) + 0),
(13,	2,	'Segundo',	'Oliveira',	'Gonzalez',	'Ninguna',	CONV('1', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('1', 2, 10) + 0),
(14,	2,	'Paulo',	'Toboada',	'Cobadonga',	'Lactosa',	CONV('0', 2, 10) + 0,	CONV('0', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('1', 2, 10) + 0),
(15,	14,	'Gonzalo',	'Martines',	'-',	'Ninguna',	CONV('1', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('0', 2, 10) + 0);

DROP TABLE IF EXISTS `Calendarios`;
CREATE TABLE `Calendarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dfecha` varchar(16) DEFAULT '1',
  `mfecha` varchar(16) DEFAULT '1',
  `afecha` varchar(16) DEFAULT '2000',
  `comida` varchar(510) DEFAULT 'x',
  `centro` int(16) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `centro` (`centro`),
  CONSTRAINT `Calendarios_ibfk_1` FOREIGN KEY (`centro`) REFERENCES `Centros` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `Calendarios` (`id`, `dfecha`, `mfecha`, `afecha`, `comida`, `centro`) VALUES
(1,	'1',	'05',	'2020',	'Pure de patatas',	1),
(2,	'2',	'05',	'2000',	'Pollo asado',	1),
(3,	'3',	'05',	'2020',	'Lentejas',	1),
(4,	'4',	'05',	'2020',	'Ensaladilla',	1),
(5,	'5',	'05',	'2020',	'Paella ',	1),
(6,	'8',	'05',	'2020',	'Ensalada Cesar',	1);

DROP TABLE IF EXISTS `Centros`;
CREATE TABLE `Centros` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(180) NOT NULL,
  `direccion` varchar(512) NOT NULL,
  `correo` varchar(180) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `Centros` (`id`, `nombre`, `direccion`, `correo`) VALUES
(1,	'IES San Francisco',	'Calle del cisco',	'cisco@gva.com'),
(2,	'IES Francisco Billena',	'C. San Francisco 13 , Castellon de la Plana',	'75184198273@gva.com');

DROP TABLE IF EXISTS `Clases`;
CREATE TABLE `Clases` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `centro` int(16) NOT NULL,
  `tutornombre` varchar(80) NOT NULL,
  `tutorapellidos` varchar(100) NOT NULL,
  `nombreclase` varchar(100) NOT NULL,
  `sent` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`),
  KEY `centro` (`centro`),
  CONSTRAINT `Clases_ibfk_1` FOREIGN KEY (`centro`) REFERENCES `Centros` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `Clases` (`id`, `centro`, `tutornombre`, `tutorapellidos`, `nombreclase`, `sent`) VALUES
(1,	1,	'Carlos',	'Nuñez Feijo',	'Cocodrilos',	CONV('1', 2, 10) + 0),
(2,	1,	'Francisco',	'Martinez Pizarro',	'Dragones',	CONV('1', 2, 10) + 0),
(5,	1,	'Marcos',	'Carrascosa',	'Leones',	CONV('0', 2, 10) + 0),
(6,	1,	'Marcos',	'Carrascosa',	'Perezosos',	CONV('0', 2, 10) + 0),
(11,	1,	'Octavio',	'Francisco Javier',	'1ºB',	CONV('0', 2, 10) + 0),
(12,	1,	'Francisco',	'Garcia Gracia',	'1ºA',	CONV('0', 2, 10) + 0),
(13,	1,	'Maria-Isabel',	'Hoyos',	'2ºA',	CONV('0', 2, 10) + 0),
(14,	1,	'Rosa Maria',	'Bellido',	'2ºB',	CONV('0', 2, 10) + 0),
(15,	1,	'Iryna',	'Carmona',	'3ºA',	CONV('0', 2, 10) + 0),
(16,	1,	'Basilio',	'Ruz',	'3ºB',	CONV('0', 2, 10) + 0),
(17,	1,	'Montse',	'Veiga Monsi',	'4ºA',	CONV('0', 2, 10) + 0),
(18,	1,	'Carlos Alberto',	'del Pozo Mayor',	'4ºB',	CONV('0', 2, 10) + 0),
(19,	1,	'Imanol',	'Mena',	'5ºA',	CONV('0', 2, 10) + 0);

DROP TABLE IF EXISTS `Comedor`;
CREATE TABLE `Comedor` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `alumno` int(48) NOT NULL,
  `fecha` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `alumno` (`alumno`),
  CONSTRAINT `Comedor_ibfk_1` FOREIGN KEY (`alumno`) REFERENCES `Alumnos` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `Comedor` (`id`, `alumno`, `fecha`) VALUES
(1,	5,	'15-05-2020'),
(2,	6,	'15-05-2020'),
(3,	11,	'15-05-2020'),
(4,	7,	'15-05-2020'),
(5,	1,	'15-05-2020'),
(6,	8,	'15-05-2020'),
(7,	2,	'15-05-2020'),
(8,	12,	'15-05-2020'),
(9,	9,	'15-05-2020'),
(10,	4,	'15-05-2020'),
(11,	10,	'15-05-2020'),
(12,	13,	'15-05-2020'),
(13,	14,	'15-05-2020');

DROP TABLE IF EXISTS `comentario_comida`;
CREATE TABLE `comentario_comida` (
  `comida` int(180) NOT NULL AUTO_INCREMENT,
  `alumno` int(48) NOT NULL,
  `comentario_comida` varchar(512) NOT NULL,
  `fecha_comida` date NOT NULL,
  PRIMARY KEY (`comida`),
  KEY `alumno` (`alumno`),
  CONSTRAINT `comentario_comida_ibfk_1` FOREIGN KEY (`alumno`) REFERENCES `Alumnos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `Usuarios`;
CREATE TABLE `Usuarios` (
  `id` int(180) NOT NULL AUTO_INCREMENT,
  `centro` int(16) DEFAULT NULL,
  `alumno` int(48) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `correo` varchar(180) DEFAULT NULL,
  `password` varchar(180) DEFAULT NULL,
  `rol` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `centro` (`centro`),
  KEY `alumno` (`alumno`),
  CONSTRAINT `Usuarios_ibfk_1` FOREIGN KEY (`centro`) REFERENCES `Centros` (`id`),
  CONSTRAINT `Usuarios_ibfk_2` FOREIGN KEY (`alumno`) REFERENCES `Alumnos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `Usuarios` (`id`, `centro`, `alumno`, `nombre`, `correo`, `password`, `rol`) VALUES
(4,	1,	NULL,	'Director1',	'director1@info.com',	'$2y$10$YM4dq52yViJopI7KmgslRO/3DUAdHxNmQNbDngUWjQ1ALjfj66rO6',	'director'),
(5,	NULL,	NULL,	NULL,	'info@gyswu.com',	'$2y$10$MvsD0KdeJva9hCTYMK5qKePlE0ecXUYhN1phB0ZmVwM.a1bK2W8GO',	'admin'),
(6,	1,	1,	'Pablo',	'alumno1@info.com',	'$2y$10$Z28DVP9UAUxHCooVxDRV9uOf8C.il3xu3UI7XdRgJDdggyQ0njP5a',	'alumno');

-- 2020-05-28 01:23:55
