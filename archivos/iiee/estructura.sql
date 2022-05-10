-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-02-2016 a las 05:21:43
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `contenedor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctcontenedor`
--

CREATE TABLE IF NOT EXISTS `ctcontenedor` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subestado` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sector` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fecha_entrada` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_salida` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `carril` int(1) NOT NULL,
  `posicio` int(1) NOT NULL,
  `pis` int(1) NOT NULL,
  `adjunt` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `aduana` int(1) NOT NULL,
  `dua_id` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `presente` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_iiee` varchar(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21222 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctiiee`
--

CREATE TABLE IF NOT EXISTS `ctiiee` (
  `id_iiee` int(11) NOT NULL AUTO_INCREMENT,
  `id_contenedor` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `ncontenedor` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_entrada` date NOT NULL,
  `epifiscal` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `codigonc` int(8) NOT NULL,
  `producto` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `caeprovee` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `arc` varchar(22) COLLATE utf8_unicode_ci NOT NULL,
  `litros15c` int(10) NOT NULL,
  `fecha_salida` date NOT NULL,
  `documento` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `num_dispo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nif_destino` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nom_destino` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `regimen` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `adjuntent` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `adjuntsal` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `recibido` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NO',
  PRIMARY KEY (`id_iiee`),
  UNIQUE KEY `id_iiee` (`id_iiee`),
  KEY `fecha_entrada` (`fecha_entrada`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctregistro`
--

CREATE TABLE IF NOT EXISTS `ctregistro` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `id_contenedor` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contenedor` varchar(20) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `subestado` varchar(10) DEFAULT NULL,
  `sector` varchar(2) NOT NULL,
  `fecha_entrada` varchar(10) NOT NULL,
  `user_entrada` varchar(30) NOT NULL,
  `fecha_salida` varchar(10) DEFAULT NULL,
  `user_salida` varchar(30) DEFAULT NULL,
  `carril` int(1) NOT NULL,
  `posicio` int(1) NOT NULL,
  `pis` int(1) NOT NULL,
  `adjunt` varchar(100) NOT NULL,
  `aduana` int(1) NOT NULL,
  `dua_id` int(9) NOT NULL,
  `export_id` int(9) NOT NULL,
  `iiee_id` varchar(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21103 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
