-- Adminer 4.1.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `copy_url`;
CREATE TABLE `copy_url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url_id` int(11) DEFAULT NULL,
  `title` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `menu_text` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `link_title` varchar(156) COLLATE utf8_czech_ci NOT NULL,
  `meta_descr` varchar(200) COLLATE utf8_czech_ci NOT NULL,
  `galerie_collection_id` int(11) DEFAULT NULL,
  `hidden` tinyint(4) NOT NULL DEFAULT '0',
  `url1` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `url2` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `presenter_id` int(11) NOT NULL,
  `texy` text COLLATE utf8_czech_ci NOT NULL,
  `html` text COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `url_id` (`url_id`),
  KEY `presenter_id` (`presenter_id`),
  CONSTRAINT `copy_url_ibfk_1` FOREIGN KEY (`url_id`) REFERENCES `url` (`id`),
  CONSTRAINT `copy_url_ibfk_2` FOREIGN KEY (`presenter_id`) REFERENCES `presenter` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `copy_url` (`id`, `url_id`, `title`, `menu_text`, `link_title`, `meta_descr`, `galerie_collection_id`, `hidden`, `url1`, `url2`, `presenter_id`, `texy`, `html`) VALUES
(1,	NULL,	'úvodní strana',	'Úvod',	'zpět na úvod',	'bla bla bla úvodní strana třikrát bla',	NULL,	0,	'',	'',	1,	'',	''),
(2,	NULL,	'titulinda - ramram - 2',	'menu2',	'bublina2',	'bla bla bla úvodní strana třikrát bla - a to teďkonc podruhé',	NULL,	0,	'u2',	'',	1,	'',	''),
(3,	NULL,	'titulek3',	'menu3',	'bublina3',	'popisek3',	NULL,	0,	'u3',	'',	1,	'',	''),
(4,	NULL,	'titulek4',	'menu4',	'bublina4',	'description4',	NULL,	0,	'u4',	'',	1,	'',	''),
(5,	NULL,	'titulek5',	'menu5',	'bublina5',	'description5',	NULL,	0,	'u5',	'',	1,	'',	''),
(6,	NULL,	'titulek6',	'menu6',	'bublina6',	'description6',	NULL,	0,	'u6',	'',	1,	'',	''),
(7,	NULL,	'titulek7',	'menu7',	'bublina7',	'description7',	NULL,	0,	'u3',	'u4',	1,	'',	''),
(8,	NULL,	'titulek8',	'menu8',	'bublina8',	'description8',	NULL,	0,	'u3',	'u5',	1,	'',	''),
(9,	NULL,	'titulek9',	'menu9',	'bublina9',	'description9',	NULL,	0,	'u3',	'u6',	1,	'',	''),
(10,	NULL,	'titulek10',	'menu10',	'bublina10',	'description10',	NULL,	0,	'u3',	'u7',	1,	'',	''),
(11,	NULL,	'titulek11',	'menu11',	'bublina11',	'description11',	NULL,	1,	'uu',	'u11',	1,	'',	''),
(12,	NULL,	'titulek12',	'menu12',	'bublina12',	'description12',	NULL,	0,	'uu',	'u12',	1,	'',	''),
(13,	NULL,	'titulek13',	'menu13',	'bublina13',	'description13',	NULL,	1,	'uu',	'u13',	1,	'',	''),
(14,	NULL,	'titulek14',	'menu14',	'bublina14',	'description14',	NULL,	0,	'uu',	'u14',	1,	'',	''),
(15,	NULL,	'titulek15',	'menu15',	'bublina15',	'description15',	NULL,	0,	'uu15',	'ub',	1,	'',	''),
(16,	NULL,	'titulek16',	'menu16',	'bublina16',	'description16',	NULL,	0,	'uu16',	'ub',	1,	'',	''),
(17,	NULL,	'titulek17',	'menu17',	'bublina17',	'description17',	NULL,	0,	'uu17',	'ub',	1,	'',	'');

DROP TABLE IF EXISTS `main_text`;
CREATE TABLE `main_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url_id` int(11) NOT NULL,
  `texy` text COLLATE utf8_czech_ci NOT NULL,
  `html` text COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `url_id` (`url_id`),
  CONSTRAINT `main_text_ibfk_1` FOREIGN KEY (`url_id`) REFERENCES `url` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `main_text` (`id`, `url_id`, `texy`, `html`) VALUES
(1,	1,	'',	'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nibh est,\r\ntempor id, tempus sit amet, facilisis in, erat. In hac habitasse platea\r\ndictumst. Donec fermentum, pede vitae hendrerit sodales, odio lacus mattis ante,\r\nnon ultrices ligula tellus et massa. Praesent placerat est sed dui. Nulla\r\naccumsan. Mauris fringilla, eros at gravida dapibus, libero massa semper nibh,\r\nsed ultrices turpis massa a enim. Suspendisse tempor erat a tortor. Curabitur\r\naccumsan arcu ut augue. Aliquam erat volutpat. Maecenas posuere sem\r\nvitae elit.</p>\r\n\r\n<p>Fusce convallis. Ut adipiscing nulla vel risus. Aenean tristique, augue in\r\nblandit varius, turpis metus sodales quam, eu aliquet est lectus sed purus.\r\nPhasellus a risus. Morbi ut turpis vitae augue rhoncus faucibus. Mauris mi est,\r\nconsequat a, volutpat non, dictum a, enim. Donec ultricies sollicitudin turpis.\r\nVivamus ut ipsum. Ut in nunc. In suscipit rhoncus pede. Donec a neque sed turpis\r\nluctus dignissim. Aliquam sed mauris. Mauris vel turpis sed risus tincidunt\r\nluctus.</p>\r\n'),
(3,	4,	'',	'<h2>Brumbadadá kup</h2>\r\n<p>Horampadá kumbamdum</p>\r\n<p>Dombuc kram hulamandá krup fur rumadan tomopokim sam ladum...</p>'),
(4,	8,	'',	'<p>Lorem ipsum dolor sit amet consectetuer orci Fusce In malesuada faucibus. Hendrerit Sed consectetuer vel amet Aliquam consectetuer gravida id aliquam tortor. Auctor nunc Vivamus leo parturient velit Curabitur quis condimentum pellentesque auctor. Aenean non vitae arcu turpis Vivamus porttitor turpis nulla sapien facilisi. Nam semper laoreet Suspendisse tellus felis Proin Phasellus ut tellus aliquet. Sed Praesent lorem elit eget leo euismod ligula Aenean lobortis ligula. </p>\r\n<p>Quis aliquet accumsan massa orci nunc Nam hac id id condimentum. At adipiscing tristique ac eget faucibus interdum nulla habitant pellentesque condimentum. Montes libero metus eros adipiscing tempor volutpat Vestibulum justo egestas arcu. Phasellus volutpat orci sed gravida elit a Duis ornare cursus ultrices. Eget feugiat accumsan Integer tristique consequat dolor Morbi semper eros hac. Vestibulum elit et libero Mauris sapien cursus vitae id eget Nulla. </p>\r\n'),
(5,	8,	'',	'<p>Haf haf</p>\r\n<p>Mňau mňau</p>');

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url_id` int(11) NOT NULL,
  `priority` tinyint(4) NOT NULL DEFAULT '0',
  `special_text` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `special_link_title` varchar(156) COLLATE utf8_czech_ci NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `url_id` (`url_id`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`url_id`) REFERENCES `url` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `menu` (`id`, `url_id`, `priority`, `special_text`, `special_link_title`, `lft`, `rgt`, `level`) VALUES
(1,	1,	0,	'',	'',	1,	2,	0),
(2,	2,	0,	'',	'',	3,	31,	0),
(3,	3,	0,	'',	'',	4,	5,	1),
(4,	5,	0,	'',	'',	6,	22,	1),
(5,	6,	0,	'',	'',	7,	12,	2),
(6,	7,	0,	'',	'',	8,	9,	3),
(7,	8,	0,	'',	'',	10,	11,	3),
(8,	4,	0,	'',	'',	13,	14,	2),
(9,	9,	0,	'',	'',	14,	19,	2),
(10,	10,	0,	'Bla bla bla 10',	'',	15,	16,	3),
(11,	11,	1,	'',	'',	17,	18,	3),
(12,	12,	0,	'',	'',	20,	21,	2),
(13,	13,	0,	'',	'',	23,	28,	1),
(14,	14,	0,	'',	'',	24,	25,	2),
(15,	15,	0,	'',	'',	26,	27,	2),
(16,	16,	0,	'',	'',	29,	30,	1),
(17,	17,	0,	'',	'',	32,	33,	0),
(18,	11,	3,	'',	'',	33,	34,	0),
(19,	8,	0,	'',	'',	35,	36,	0);

DROP TABLE IF EXISTS `presenter`;
CREATE TABLE `presenter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `presenter` (`id`, `name`) VALUES
(1,	'Www');

DROP TABLE IF EXISTS `url`;
CREATE TABLE `url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `menu_text` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `link_title` varchar(156) COLLATE utf8_czech_ci NOT NULL,
  `meta_descr` varchar(200) COLLATE utf8_czech_ci NOT NULL,
  `galerie_collection_id` int(11) DEFAULT NULL,
  `hidden` tinyint(4) NOT NULL DEFAULT '0',
  `url1` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `url2` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `presenter_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `presenter_id` (`presenter_id`),
  CONSTRAINT `url_ibfk_1` FOREIGN KEY (`presenter_id`) REFERENCES `presenter` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `url` (`id`, `title`, `menu_text`, `link_title`, `meta_descr`, `galerie_collection_id`, `hidden`, `url1`, `url2`, `presenter_id`) VALUES
(1,	'úvodní strana',	'Úvod',	'zpět na úvod',	'bla bla bla úvodní strana třikrát bla',	NULL,	0,	'',	'',	1),
(2,	'titulinda - ramram - 2',	'menu2',	'bublina2',	'bla bla bla úvodní strana třikrát bla - a to teďkonc podruhé',	NULL,	0,	'u2',	'',	1),
(3,	'titulek3',	'menu3',	'bublina3',	'popisek3',	NULL,	0,	'u3',	'',	1),
(4,	'titulek4',	'menu4',	'bublina4',	'description4',	NULL,	0,	'u4',	'',	1),
(5,	'titulek5',	'menu5',	'bublina5',	'description5',	NULL,	0,	'u5',	'',	1),
(6,	'titulek6',	'menu6',	'bublina6',	'description6',	NULL,	0,	'u6',	'',	1),
(7,	'titulek7',	'menu7',	'bublina7',	'description7',	NULL,	0,	'u3',	'u4',	1),
(8,	'titulek8',	'menu8',	'bublina8',	'description8',	NULL,	0,	'u3',	'u5',	1),
(9,	'titulek9',	'menu9',	'bublina9',	'description9',	NULL,	0,	'u3',	'u6',	1),
(10,	'titulek10',	'menu10',	'bublina10',	'description10',	NULL,	0,	'u3',	'u7',	1),
(11,	'titulek11',	'menu11',	'bublina11',	'description11',	NULL,	1,	'uu',	'u11',	1),
(12,	'titulek12',	'menu12',	'bublina12',	'description12',	NULL,	0,	'uu',	'u12',	1),
(13,	'titulek13',	'menu13',	'bublina13',	'description13',	NULL,	1,	'uu',	'u13',	1),
(14,	'titulek14',	'menu14',	'bublina14',	'description14',	NULL,	0,	'uu',	'u14',	1),
(15,	'titulek15',	'menu15',	'bublina15',	'description15',	NULL,	0,	'uu15',	'ub',	1),
(16,	'titulek16',	'menu16',	'bublina16',	'description16',	NULL,	0,	'uu16',	'ub',	1),
(17,	'titulek17',	'menu17',	'bublina17',	'description17',	NULL,	0,	'uu17',	'ub',	1);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `role` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;


-- 2014-10-14 18:21:13
