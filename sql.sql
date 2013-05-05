-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.29-0ubuntu0.12.04.2-log - (Ubuntu)
-- Server OS:                    debian-linux-gnu
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2013-05-05 11:16:54
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table zf_shop.gebruikers
CREATE TABLE IF NOT EXISTS `gebruikers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `naam` varchar(50) DEFAULT '0',
  `wachtwoord` varchar(50) DEFAULT '0',
  `id_role` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_gebruikers_roles` (`id_role`),
  CONSTRAINT `FK_gebruikers_roles` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table zf_shop.gebruikers: ~2 rows (approximately)
/*!40000 ALTER TABLE `gebruikers` DISABLE KEYS */;
REPLACE INTO `gebruikers` (`id`, `naam`, `wachtwoord`, `id_role`) VALUES
	(1, 'kris', 'kris2', 3),
	(2, 'thomas', 'thomas', 2);
/*!40000 ALTER TABLE `gebruikers` ENABLE KEYS */;


-- Dumping structure for table zf_shop.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) DEFAULT '0',
  `action` varchar(50) DEFAULT '0',
  `controller` varchar(50) DEFAULT '0',
  `module` varchar(50) DEFAULT 'default',
  `locale` varchar(5) DEFAULT '0',
  `slug` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table zf_shop.menu: ~6 rows (approximately)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
REPLACE INTO `menu` (`id`, `label`, `action`, `controller`, `module`, `locale`, `slug`) VALUES
	(1, 'Home', 'index', 'index', 'default', 'nl_BE', 'home'),
	(2, 'Producten', 'index', 'product', 'admin', 'nl_BE', 'producten'),
	(3, 'Winkelmand', 'index', 'winkelmand', 'default', 'nl_BE', 'winkelmand'),
	(4, 'Gebruikers', 'index', 'user', 'admin', 'nl_BE', 'users'),
	(5, 'Menu', 'index', 'menu', 'admin', 'nl_BE', 'menu'),
	(6, 'Roles', 'index', 'role', 'admin', 'nl_BE', 'roles');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


-- Dumping structure for table zf_shop.menuroles
CREATE TABLE IF NOT EXISTS `menuroles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_menu` int(10) NOT NULL DEFAULT '0',
  `id_role` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_menuroles_menu` (`id_menu`),
  KEY `FK_menuroles_roles` (`id_role`),
  CONSTRAINT `FK_menuroles_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`),
  CONSTRAINT `FK_menuroles_roles` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Dumping data for table zf_shop.menuroles: ~10 rows (approximately)
/*!40000 ALTER TABLE `menuroles` DISABLE KEYS */;
REPLACE INTO `menuroles` (`id`, `id_menu`, `id_role`) VALUES
	(1, 1, 1),
	(3, 1, 2),
	(4, 1, 3),
	(5, 3, 1),
	(6, 3, 2),
	(7, 3, 3),
	(9, 4, 3),
	(12, 5, 3),
	(13, 6, 3),
	(18, 2, 3);
/*!40000 ALTER TABLE `menuroles` ENABLE KEYS */;


-- Dumping structure for table zf_shop.producten
CREATE TABLE IF NOT EXISTS `producten` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `naam` varchar(255) DEFAULT '0',
  `prijs` float DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table zf_shop.producten: ~2 rows (approximately)
/*!40000 ALTER TABLE `producten` DISABLE KEYS */;
REPLACE INTO `producten` (`id`, `naam`, `prijs`) VALUES
	(1, 'test111', 10),
	(2, 'test2', 20);
/*!40000 ALTER TABLE `producten` ENABLE KEYS */;


-- Dumping structure for table zf_shop.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table zf_shop.roles: ~3 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
REPLACE INTO `roles` (`id`, `role`) VALUES
	(1, 'GUEST'),
	(2, 'USER'),
	(3, 'ADMIN');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


-- Dumping structure for table zf_shop.translate
CREATE TABLE IF NOT EXISTS `translate` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `locale` varchar(5) NOT NULL DEFAULT '0',
  `tag` varchar(50) NOT NULL DEFAULT '0',
  `translation` varchar(50) NOT NULL DEFAULT '0',
  `translated` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table zf_shop.translate: ~4 rows (approximately)
/*!40000 ALTER TABLE `translate` DISABLE KEYS */;
REPLACE INTO `translate` (`id`, `locale`, `tag`, `translation`, `translated`) VALUES
	(1, 'nl_BE', 'lbl_Naam', 'Naam', 1),
	(2, 'nl_BE', 'lbl_Wachtwoord', 'Wachtwoord', 1),
	(3, 'fr_FR', 'lbl_Naam', 'Nom', 1),
	(4, 'fr_FR', 'lbl_Wachtwoord', 'Mots de passe', 1);
/*!40000 ALTER TABLE `translate` ENABLE KEYS */;


-- Dumping structure for table zf_shop.winkelmanden
CREATE TABLE IF NOT EXISTS `winkelmanden` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_product` int(10) DEFAULT '0',
  `id_gebruiker` int(10) DEFAULT '0',
  `session` varchar(50) DEFAULT '0',
  `aantal` int(10) DEFAULT '0',
  `naam` varchar(255) DEFAULT '0',
  `prijs` float DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_winkelmanden_producten` (`id_product`),
  KEY `FK_winkelmanden_gebruikers` (`id_gebruiker`),
  CONSTRAINT `FK_winkelmanden_gebruikers` FOREIGN KEY (`id_gebruiker`) REFERENCES `gebruikers` (`id`),
  CONSTRAINT `FK_winkelmanden_producten` FOREIGN KEY (`id_product`) REFERENCES `producten` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- Dumping data for table zf_shop.winkelmanden: ~4 rows (approximately)
/*!40000 ALTER TABLE `winkelmanden` DISABLE KEYS */;
REPLACE INTO `winkelmanden` (`id`, `id_product`, `id_gebruiker`, `session`, `aantal`, `naam`, `prijs`) VALUES
	(1, 1, NULL, 'qhvljoh4auakrpc4k3skih4ga0', 20, '0', 10),
	(7, 1, NULL, 'oe21rlmav19buhvv91b1prnce4', 2, 'test1', 10),
	(24, 2, 1, 'ern39pv4i86mtjtbeuufkd61v4', 229, 'test2', 20),
	(25, 1, NULL, 'ern39pv4i86mtjtbeuufkd61v4', 1, 'test111', 10);
/*!40000 ALTER TABLE `winkelmanden` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
