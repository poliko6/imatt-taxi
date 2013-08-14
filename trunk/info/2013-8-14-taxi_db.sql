-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.0.51b-community-nt-log - MySQL Community Edition (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             8.0.0.4396
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table taxi_db.customer
DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customerId` int(10) NOT NULL auto_increment,
  `facebookId` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `citizenId` varchar(20) NOT NULL,
  `location` varchar(150) NOT NULL,
  `birthday` varchar(20) NOT NULL,
  `mobilePhone` varchar(20) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `dateAdded` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `dateUpdated` datetime NOT NULL,
  PRIMARY KEY  (`customerId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table taxi_db.customer: 1 rows
DELETE FROM `customer`;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` (`customerId`, `facebookId`, `email`, `password`, `firstName`, `lastName`, `citizenId`, `location`, `birthday`, `mobilePhone`, `telephone`, `gender`, `dateAdded`, `dateUpdated`) VALUES
	(1, '0', 'crizift@hotmail.com', 'testtest', 'Papai', 'Papai', '', 'Chiang Mai', '09/07/2534', '', '0824838633', 'male', '2013-08-14 15:58:35', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;


-- Dumping structure for table taxi_db.garagelist
DROP TABLE IF EXISTS `garagelist`;
CREATE TABLE IF NOT EXISTS `garagelist` (
  `garageId` int(10) NOT NULL auto_increment,
  `garageName` varchar(100) NOT NULL default '0',
  `garageShortName` varchar(20) NOT NULL default '0',
  `dateAdded` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `dateUpdated` datetime NOT NULL,
  PRIMARY KEY  (`garageId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table taxi_db.garagelist: 0 rows
DELETE FROM `garagelist`;
/*!40000 ALTER TABLE `garagelist` DISABLE KEYS */;
/*!40000 ALTER TABLE `garagelist` ENABLE KEYS */;


-- Dumping structure for table taxi_db.majoradmin
DROP TABLE IF EXISTS `majoradmin`;
CREATE TABLE IF NOT EXISTS `majoradmin` (
  `majorId` int(20) NOT NULL auto_increment,
  `garageId` int(10) NOT NULL,
  `districtId` int(20) NOT NULL,
  `amphurId` int(20) NOT NULL,
  `provinceId` int(20) NOT NULL,
  `majorType` varchar(50) NOT NULL,
  `thaiCompanyName` varchar(255) NOT NULL,
  `englishCompanyName` varchar(255) NOT NULL,
  `managerName` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `businessType` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  `mobilePhone` varchar(20) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `callCenter` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dateAdded` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `dateUpdated` datetime NOT NULL,
  PRIMARY KEY  (`majorId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table taxi_db.majoradmin: 0 rows
DELETE FROM `majoradmin`;
/*!40000 ALTER TABLE `majoradmin` DISABLE KEYS */;
/*!40000 ALTER TABLE `majoradmin` ENABLE KEYS */;


-- Dumping structure for table taxi_db.majortype
DROP TABLE IF EXISTS `majortype`;
CREATE TABLE IF NOT EXISTS `majortype` (
  `majorTypeId` int(10) NOT NULL auto_increment,
  `majorType` varchar(50) NOT NULL,
  PRIMARY KEY  (`majorTypeId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table taxi_db.majortype: 2 rows
DELETE FROM `majortype`;
/*!40000 ALTER TABLE `majortype` DISABLE KEYS */;
INSERT INTO `majortype` (`majorTypeId`, `majorType`) VALUES
	(1, 'supervisor'),
	(2, 'admin');
/*!40000 ALTER TABLE `majortype` ENABLE KEYS */;


-- Dumping structure for table taxi_db.menulist
DROP TABLE IF EXISTS `menulist`;
CREATE TABLE IF NOT EXISTS `menulist` (
  `menuId` int(10) NOT NULL auto_increment,
  `menuName` varchar(100) NOT NULL,
  `majorAllowed` varchar(10) NOT NULL,
  `minorAllowed` varchar(10) NOT NULL,
  `dateAdded` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `dateUpdated` datetime NOT NULL,
  PRIMARY KEY  (`menuId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table taxi_db.menulist: 0 rows
DELETE FROM `menulist`;
/*!40000 ALTER TABLE `menulist` DISABLE KEYS */;
/*!40000 ALTER TABLE `menulist` ENABLE KEYS */;


-- Dumping structure for table taxi_db.minoradmin
DROP TABLE IF EXISTS `minoradmin`;
CREATE TABLE IF NOT EXISTS `minoradmin` (
  `minorId` int(20) NOT NULL auto_increment,
  `majorId` int(20) NOT NULL default '0',
  `garageId` int(10) NOT NULL default '0',
  `districtId` int(20) NOT NULL,
  `amphurId` int(20) NOT NULL,
  `provinceId` int(20) NOT NULL,
  `firstName` varchar(100) NOT NULL default '0',
  `lastName` varchar(100) NOT NULL default '0',
  `address` varchar(150) NOT NULL default '0',
  `zipcode` varchar(20) NOT NULL,
  `mobilePhone` varchar(20) NOT NULL default '0',
  `email` varchar(100) NOT NULL default '0',
  `username` varchar(100) NOT NULL default '0',
  `password` varchar(255) NOT NULL default '0',
  `minorType` varchar(50) NOT NULL default '0',
  `dateAdded` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `dateUpdated` datetime NOT NULL,
  PRIMARY KEY  (`minorId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table taxi_db.minoradmin: 0 rows
DELETE FROM `minoradmin`;
/*!40000 ALTER TABLE `minoradmin` DISABLE KEYS */;
/*!40000 ALTER TABLE `minoradmin` ENABLE KEYS */;


-- Dumping structure for table taxi_db.minortype
DROP TABLE IF EXISTS `minortype`;
CREATE TABLE IF NOT EXISTS `minortype` (
  `minorAdminId` int(10) NOT NULL auto_increment,
  `garageId` int(10) NOT NULL default '0',
  `minorType` varchar(50) NOT NULL default '0',
  `menuId` varchar(255) NOT NULL default '0',
  `dateAdded` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `dateUpdated` datetime NOT NULL,
  PRIMARY KEY  (`minorAdminId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table taxi_db.minortype: 0 rows
DELETE FROM `minortype`;
/*!40000 ALTER TABLE `minortype` DISABLE KEYS */;
/*!40000 ALTER TABLE `minortype` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
