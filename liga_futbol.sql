-- Adminer 4.7.9 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

USE `liga_futbol`;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `edicion`;
CREATE TABLE `edicion` (
  `id` int(11) unsigned NOT NULL,
  `inicio` date NOT NULL,
  `final` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `edicion`;
INSERT INTO `edicion` (`id`, `inicio`, `final`) VALUES
(90,	'2020-09-12',	'2020-05-23'),
(91,	'2021-08-13',	'2022-05-22');

DROP TABLE IF EXISTS `equipos`;
CREATE TABLE `equipos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estadio` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `equipos`;
INSERT INTO `equipos` (`id`, `nombre`, `estadio`) VALUES
(1,	'Athletic Club',	'Estadio San Mamés'),
(2,	'Atlético de Madrid',	'Wanda Metropolitano'),
(3,	'CA Osasuna',	'Estadio El Sadar'),
(4,	'Cádiz CF',	'Estadio Nuevo Mirandilla'),
(5,	'Deportivo Alavés',	'Mendizorroza'),
(6,	'Elche CF',	'Estadio Martínez Valero'),
(7,	'FC Barcelona',	'Camp Nou'),
(8,	'Getafe CF',	'Coliseum Alfonso Pérez'),
(9,	'Granada CF',	'Nuevo Los Cármenes'),
(10,	'Levante UD',	'Estadio Ciutat de València'),
(11,	'Rayo Vallecano',	'Estadio de Vallecas'),
(12,	'RC Celta',	'Estadio ABANCA Balaídos'),
(13,	'RCD Espanyol de Barcelona',	'RCDE Stadium'),
(14,	'RCD Mallorca',	'Visit Mallorca Estadi'),
(15,	'Real Betis',	'Estadio Benito Villamarín'),
(16,	'Real Madrid',	'Estadio Santiago Bernabéu'),
(17,	'Real Sociedad',	'Reale Arena'),
(18,	'Sevilla FC',	'Ramón Sánchez-Pizjuán'),
(19,	'Valencia CF',	'Camp de Mestalla'),
(20,	'Villarreal CF',	'Estadio de la Cerámica');

DROP TABLE IF EXISTS `jugadors`;
CREATE TABLE `jugadors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_equipo` int(10) unsigned NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posicion` enum('entrenador','portero','defensa','centrocampista','delantero') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_equipo` (`id_equipo`),
  CONSTRAINT `jugadors_ibfk_1` FOREIGN KEY (`id_equipo`) REFERENCES `equipos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `jugadors`;
INSERT INTO `jugadors` (`id`, `id_equipo`, `nombre`, `posicion`) VALUES
(1,	7,	'Xavi Hernández',	'entrenador'),
(2,	7,	'Ter Stegen',	'portero'),
(3,	7,	'Sergiño Dest',	'defensa'),
(4,	7,	'Gerard Piqué',	'defensa'),
(5,	7,	'Jordi Alba',	'defensa'),
(6,	7,	'Samuel Umtiti',	'defensa'),
(7,	7,	'Sergio Busquets',	'centrocampista'),
(8,	7,	'Philippe Coutinho Correia',	'centrocampista'),
(9,	7,	'Pedro González López \'Pedri\'',	'centrocampista'),
(10,	7,	'Frenkie de Jong',	'centrocampista'),
(11,	7,	'Ricard \'Riqui\' Puig Martí',	'delantero'),
(12,	7,	'Ousmane Dembélé',	'delantero'),
(13,	7,	'Memphis Depay',	'delantero'),
(14,	7,	'Anssumane \'Ansu\' Fati Vieira',	'delantero'),
(15,	16,	'Carlo Ancelotti',	'entrenador'),
(16,	16,	'Thibaut Courtois',	'portero'),
(17,	16,	'Daniel Carvajal',	'defensa'),
(18,	16,	'Éder Gabriel Militão',	'defensa'),
(19,	16,	'David Alaba',	'defensa'),
(20,	16,	'Marcelo Vieira Da Silva Junior',	'defensa'),
(21,	16,	'Toni Kroos',	'centrocampista'),
(22,	16,	'Luka Modric',	'centrocampista'),
(23,	16,	'Dani Ceballos',	'centrocampista'),
(24,	16,	'Francisco \'Isco\' Román Alarcón Suárez',	'centrocampista'),
(25,	16,	'Eden Hazard',	'delantero'),
(26,	16,	'Karim Benzema',	'delantero'),
(27,	16,	'Luka Jovic',	'delantero'),
(28,	16,	'Gareth Bale',	'delantero');

DROP TABLE IF EXISTS `partido`;
CREATE TABLE `partido` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_edicion` int(10) unsigned NOT NULL,
  `jornada` tinyint(4) NOT NULL,
  `equipo_local` int(10) unsigned NOT NULL,
  `equipo_visitante` int(10) unsigned NOT NULL,
  `goles_local` tinyint(4) NOT NULL,
  `goles_visitante` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `equipo_local_equipo_visitante_id_edicion` (`equipo_local`,`equipo_visitante`,`id_edicion`),
  KEY `equipo_visitante` (`equipo_visitante`),
  KEY `id_edicion` (`id_edicion`),
  CONSTRAINT `partido_ibfk_1` FOREIGN KEY (`equipo_local`) REFERENCES `equipos` (`id`),
  CONSTRAINT `partido_ibfk_2` FOREIGN KEY (`equipo_visitante`) REFERENCES `equipos` (`id`),
  CONSTRAINT `partido_ibfk_3` FOREIGN KEY (`id_edicion`) REFERENCES `edicion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `partido`;
INSERT INTO `partido` (`id`, `id_edicion`, `jornada`, `equipo_local`, `equipo_visitante`, `goles_local`, `goles_visitante`) VALUES
(1,	91,	1,	19,	8,	1,	0),
(2,	91,	1,	14,	15,	1,	1),
(3,	91,	1,	4,	10,	1,	1),
(4,	91,	1,	5,	16,	1,	4),
(5,	91,	1,	3,	13,	0,	0),
(6,	91,	1,	12,	2,	1,	2),
(7,	91,	1,	7,	17,	4,	2),
(8,	91,	1,	18,	11,	3,	0),
(9,	91,	1,	20,	9,	0,	0),
(10,	91,	1,	6,	1,	0,	0),
(11,	91,	2,	15,	4,	1,	1),
(12,	91,	2,	5,	14,	0,	1),
(13,	91,	2,	9,	19,	1,	1),
(14,	91,	2,	13,	20,	0,	0),
(15,	91,	2,	1,	7,	1,	1),
(16,	91,	2,	17,	11,	1,	0),
(17,	91,	2,	2,	6,	1,	0),
(18,	91,	2,	10,	16,	3,	3),
(19,	91,	2,	8,	18,	0,	1),
(20,	91,	2,	3,	12,	0,	0);

-- 2022-01-13 09:21:17
