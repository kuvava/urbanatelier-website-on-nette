-- Adminer 4.1.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `presenter`;
CREATE TABLE `presenter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jmeno` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `presenter` (`id`, `jmeno`) VALUES
(1,	'www');

DROP TABLE IF EXISTS `prispevek`;
CREATE TABLE `prispevek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulek` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `hlavni_nadpis` varchar(100) COLLATE utf8_czech_ci DEFAULT NULL,
  `napis_menu` varchar(100) COLLATE utf8_czech_ci DEFAULT NULL,
  `bublina_odkazu` varchar(156) COLLATE utf8_czech_ci DEFAULT NULL,
  `shrnuti_vyhledavace` varchar(200) COLLATE utf8_czech_ci NOT NULL,
  `text1_texy` text COLLATE utf8_czech_ci,
  `text1_html` text COLLATE utf8_czech_ci,
  `galerie_celek_id` int(11) DEFAULT NULL,
  `smazano` tinyint(4) NOT NULL DEFAULT '0',
  `cas` time NOT NULL,
  `datum` date NOT NULL,
  `cas_zmeny` time DEFAULT NULL,
  `datum_zmeny` date DEFAULT NULL,
  `url1` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `url2` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `presenter_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `presenter_id` (`presenter_id`),
  CONSTRAINT `prispevek_ibfk_1` FOREIGN KEY (`presenter_id`) REFERENCES `presenter` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `prispevek` (`id`, `titulek`, `hlavni_nadpis`, `napis_menu`, `bublina_odkazu`, `shrnuti_vyhledavace`, `text1_texy`, `text1_html`, `galerie_celek_id`, `smazano`, `cas`, `datum`, `cas_zmeny`, `datum_zmeny`, `url1`, `url2`, `presenter_id`) VALUES
(1,	'úvodní strana',	NULL,	NULL,	NULL,	'bla bla bla úvodní strana třikrát bla',	NULL,	':-)',	NULL,	0,	'22:44:28',	'2014-10-01',	NULL,	NULL,	'',	'',	1);

-- 2014-10-01 21:02:45
