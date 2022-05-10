-- phpMyAdmin SQL Dump
-- version 2.6.4-pl3
-- http://www.phpmyadmin.net
-- 
-- Servidor: db93.1and1.es
-- Tiempo de generación: 03-03-2013 a las 04:22:05
-- Versión del servidor: 5.1.67
-- Versión de PHP: 5.3.3-7+squeeze14
-- 
-- Base de datos: `db249200913`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `ctcontenedor`
-- 


-- 
-- Volcar la base de datos para la tabla `ctcontenedor`
-- 

INSERT INTO `ctcontenedor` VALUES (133, 'GLPU587466-6', 'cargado', '0', '6', '2013-02-19', '');
INSERT INTO `ctcontenedor` VALUES (132, 'BIDU546987-6', 'vacio', 'limpio', '17', '2013-02-22', '');
INSERT INTO `ctcontenedor` VALUES (137, 'TRLU325614-2', 'cargado', '0', '7', '2013-02-21', '');
INSERT INTO `ctcontenedor` VALUES (135, 'CRXU659845-6', 'vacio', 'limpio', '3', '2013-02-20', '');
INSERT INTO `ctcontenedor` VALUES (140, '0-', '0', '0', '0', '', '');
INSERT INTO `ctcontenedor` VALUES (138, 'NOBU654789-9', 'cargado', '0', '7', '2013-02-21', '');
INSERT INTO `ctcontenedor` VALUES (139, 'TRLU999999-9', 'vacio', 'limpio', '4', '23/05/2012', '');
INSERT INTO `ctcontenedor` VALUES (141, 'BIDU326541-1', 'vacio', 'limpio', '2', '2012-02-21', '');
INSERT INTO `ctcontenedor` VALUES (143, 'BUKU362514-6', 'cargado', '0', '7', '2013-02-22', '');
INSERT INTO `ctcontenedor` VALUES (144, 'BUKU777777-7', 'cargado', 'limpio', '19', '12/12/2013', '');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `ctletra`
-- 

CREATE TABLE `ctletra` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `letra` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- 
-- Volcar la base de datos para la tabla `ctletra`
-- 

INSERT INTO `ctletra` VALUES (1, 'BIDU');
INSERT INTO `ctletra` VALUES (2, 'BUKU');
INSERT INTO `ctletra` VALUES (3, 'DIDU');
INSERT INTO `ctletra` VALUES (4, 'TRLU');
INSERT INTO `ctletra` VALUES (5, 'EXFU');
INSERT INTO `ctletra` VALUES (6, 'USPU');
INSERT INTO `ctletra` VALUES (7, 'MXMU');
INSERT INTO `ctletra` VALUES (8, 'GLPU');
INSERT INTO `ctletra` VALUES (9, 'TAYU');
INSERT INTO `ctletra` VALUES (10, 'NOBU');
INSERT INTO `ctletra` VALUES (11, 'PPLU');
INSERT INTO `ctletra` VALUES (12, 'CRXU');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `ctregistro`
-- 

CREATE TABLE `ctregistro` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `contenedor` varchar(20) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `subestado` varchar(10) DEFAULT NULL,
  `sector` varchar(2) NOT NULL,
  `fecha_entrada` varchar(10) NOT NULL,
  `user_entrada` varchar(30) NOT NULL,
  `fecha_salida` varchar(10) DEFAULT NULL,
  `user_salida` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

-- 
-- Volcar la base de datos para la tabla `ctregistro`
-- 

INSERT INTO `ctregistro` VALUES (1, 'BUKU123456-5', 'cargado', '0', '8', '2013-02-11', 'Prueva', NULL, NULL);
INSERT INTO `ctregistro` VALUES (16, 'GLPU587466-6', 'cargado', '0', '6', '2013-02-19', 'Prueva', NULL, NULL);
INSERT INTO `ctregistro` VALUES (15, 'BIDU546987-6', 'vacio', 'limpio', '17', '2013-02-22', 'Prueva', NULL, NULL);
INSERT INTO `ctregistro` VALUES (14, 'DIDU654144-9', 'cargado', '0', '18', '2013-02-19', 'Prueva', '2013-02-21', 'Prueva');
INSERT INTO `ctregistro` VALUES (13, 'BUKU654321-8', 'vacio', 'sucio', '7', '2013-02-19', 'Prueva', '2013-02-21', 'tonivr');
INSERT INTO `ctregistro` VALUES (11, 'aaaa000000-0', 'cargado', '0', '9', '2013-02-21', 'Prueva', '', 'Prueva');
INSERT INTO `ctregistro` VALUES (12, 'TAYU123123-9', 'cargado', '0', '9', '2013-02-21', 'Prueva', '2013-02-21', 'Prueva');
INSERT INTO `ctregistro` VALUES (17, 'NOBU456789-7', 'cargado', '0', '16', '2013-02-20', 'Prueva', '21/04/2013', 'mephi');
INSERT INTO `ctregistro` VALUES (18, 'CRXU659845-6', 'vacio', 'limpio', '3', '2013-02-20', 'Prueva', NULL, NULL);
INSERT INTO `ctregistro` VALUES (19, 'PPLU654584-4', 'vacio', 'limpio', '10', '2013-02-20', 'Prueva', '2013-02-22', 'mephi');
INSERT INTO `ctregistro` VALUES (20, 'TRLU325614-2', 'cargado', '0', '7', '2013-02-21', 'Prueva', NULL, NULL);
INSERT INTO `ctregistro` VALUES (21, 'NOBU654789-9', 'cargado', '0', '7', '2013-02-21', 'tonivr', NULL, NULL);
INSERT INTO `ctregistro` VALUES (22, 'TRLU999999-9', 'vacio', 'limpio', '4', '23/05/2012', 'mephi', NULL, NULL);
INSERT INTO `ctregistro` VALUES (23, '0-', '0', '0', '0', '', 'tonivr', NULL, NULL);
INSERT INTO `ctregistro` VALUES (24, 'BIDU326541-1', 'vacio', 'limpio', '2', '2012-02-21', 'tonivr', NULL, NULL);
INSERT INTO `ctregistro` VALUES (25, 'TRLU212121-2', 'vacio', 'limpio', '10', '2013-02-20', 'admin', '2013-02-24', 'admin');
INSERT INTO `ctregistro` VALUES (26, 'BUKU362514-6', 'cargado', '0', '7', '2013-02-22', 'tonivr', NULL, NULL);
INSERT INTO `ctregistro` VALUES (27, 'BUKU777777-7', 'cargado', 'limpio', '19', '12/12/2013', 'admin', NULL, NULL);
INSERT INTO `ctregistro` VALUES (28, 'BIDU111111-1', 'cargado', '0', '1', '01/01/2013', 'admin', '11/01/2013', 'admin');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `ctsector`
-- 

CREATE TABLE `ctsector` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `numero` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

-- 
-- Volcar la base de datos para la tabla `ctsector`
-- 

INSERT INTO `ctsector` VALUES (1, 1);
INSERT INTO `ctsector` VALUES (2, 2);
INSERT INTO `ctsector` VALUES (3, 3);
INSERT INTO `ctsector` VALUES (4, 4);
INSERT INTO `ctsector` VALUES (5, 5);
INSERT INTO `ctsector` VALUES (6, 6);
INSERT INTO `ctsector` VALUES (7, 7);
INSERT INTO `ctsector` VALUES (8, 8);
INSERT INTO `ctsector` VALUES (9, 9);
INSERT INTO `ctsector` VALUES (10, 10);
INSERT INTO `ctsector` VALUES (11, 11);
INSERT INTO `ctsector` VALUES (12, 12);
INSERT INTO `ctsector` VALUES (13, 13);
INSERT INTO `ctsector` VALUES (14, 14);
INSERT INTO `ctsector` VALUES (15, 15);
INSERT INTO `ctsector` VALUES (16, 16);
INSERT INTO `ctsector` VALUES (17, 17);
INSERT INTO `ctsector` VALUES (18, 18);
INSERT INTO `ctsector` VALUES (19, 19);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `ctuser`
-- 

CREATE TABLE `ctuser` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `pws` varchar(30) NOT NULL,
  `privilegios` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- Volcar la base de datos para la tabla `ctuser`
-- 

INSERT INTO `ctuser` VALUES (1, 'admin', '1234', 1);
INSERT INTO `ctuser` VALUES (2, 'tonivr', '1234', 1);
INSERT INTO `ctuser` VALUES (3, 'mephi', '1234', 0);
INSERT INTO `ctuser` VALUES (5, 'pepito', '1234', 0);
