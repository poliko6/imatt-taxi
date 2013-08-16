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

-- Dumping structure for table imattio_taxi.amphur
DROP TABLE IF EXISTS `amphur`;
CREATE TABLE IF NOT EXISTS `amphur` (
  `amphurId` int(5) NOT NULL auto_increment,
  `provinceId` int(5) NOT NULL default '0',
  `amphurCode` varchar(4) collate utf8_unicode_ci NOT NULL,
  `amphurName` varchar(150) collate utf8_unicode_ci NOT NULL,
  `amphurNameEng` varchar(150) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`amphurId`),
  UNIQUE KEY `AMPHUR_ID` (`amphurId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='<double-click to overwrite multiple objects>';

-- Dumping data for table imattio_taxi.amphur: 0 rows
DELETE FROM `amphur`;
/*!40000 ALTER TABLE `amphur` DISABLE KEYS */;
/*!40000 ALTER TABLE `amphur` ENABLE KEYS */;


-- Dumping structure for table imattio_taxi.car
DROP TABLE IF EXISTS `car`;
CREATE TABLE IF NOT EXISTS `car` (
  `carId` int(10) NOT NULL auto_increment,
  `carRegistration` varchar(10) default NULL COMMENT 'ทะเบียนรถ',
  `carYear` int(10) default '0' COMMENT 'ปีรถ',
  `carImage` varchar(150) default NULL COMMENT 'รูปภาพ',
  `dateAdd` timestamp NULL default CURRENT_TIMESTAMP COMMENT 'วันที่เพิมรถ',
  `garageId` int(10) NOT NULL,
  `carTypeId` int(11) NOT NULL,
  `carBannerId` int(11) NOT NULL,
  `carModelId` int(11) NOT NULL,
  `carGasId` int(11) NOT NULL,
  `carFuelId` int(11) NOT NULL,
  `carColorId` int(11) NOT NULL,
  `carStatusId` int(10) NOT NULL,
  PRIMARY KEY  (`carId`),
  KEY `fk_car_carType1_idx` (`carTypeId`),
  KEY `fk_car_carModel1_idx` (`carModelId`),
  KEY `fk_car_carBanner1_idx` (`carBannerId`),
  KEY `fk_car_garageList1_idx` (`garageId`),
  KEY `fk_car_carGas1_idx` (`carGasId`),
  KEY `fk_car_carFuel1_idx` (`carFuelId`),
  KEY `fk_car_carColor1_idx` (`carColorId`),
  KEY `fk_car_carStatus1_idx` (`carStatusId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='<double-click to overwrite multiple objects>';

-- Dumping data for table imattio_taxi.car: 0 rows
DELETE FROM `car`;
/*!40000 ALTER TABLE `car` DISABLE KEYS */;
/*!40000 ALTER TABLE `car` ENABLE KEYS */;


-- Dumping structure for table imattio_taxi.carbanner
DROP TABLE IF EXISTS `carbanner`;
CREATE TABLE IF NOT EXISTS `carbanner` (
  `carBannerId` int(11) NOT NULL auto_increment,
  `carBannerName` varchar(50) NOT NULL default '',
  `dateAdd` timestamp NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`carBannerId`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='<double-click to overwrite multiple objects>';

-- Dumping data for table imattio_taxi.carbanner: 0 rows
DELETE FROM `carbanner`;
/*!40000 ALTER TABLE `carbanner` DISABLE KEYS */;
/*!40000 ALTER TABLE `carbanner` ENABLE KEYS */;


-- Dumping structure for table imattio_taxi.carcolor
DROP TABLE IF EXISTS `carcolor`;
CREATE TABLE IF NOT EXISTS `carcolor` (
  `carColorId` int(11) NOT NULL auto_increment,
  `carColorName` varchar(50) NOT NULL,
  `dateAdd` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`carColorId`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='<double-click to overwrite multiple objects>';

-- Dumping data for table imattio_taxi.carcolor: 0 rows
DELETE FROM `carcolor`;
/*!40000 ALTER TABLE `carcolor` DISABLE KEYS */;
/*!40000 ALTER TABLE `carcolor` ENABLE KEYS */;


-- Dumping structure for table imattio_taxi.carfuel
DROP TABLE IF EXISTS `carfuel`;
CREATE TABLE IF NOT EXISTS `carfuel` (
  `carFuelId` int(11) NOT NULL auto_increment,
  `carFuelName` varchar(50) NOT NULL,
  `dateAdd` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`carFuelId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='<double-click to overwrite multiple objects>';

-- Dumping data for table imattio_taxi.carfuel: 0 rows
DELETE FROM `carfuel`;
/*!40000 ALTER TABLE `carfuel` DISABLE KEYS */;
/*!40000 ALTER TABLE `carfuel` ENABLE KEYS */;


-- Dumping structure for table imattio_taxi.cargas
DROP TABLE IF EXISTS `cargas`;
CREATE TABLE IF NOT EXISTS `cargas` (
  `carGasId` int(11) NOT NULL auto_increment,
  `carGasName` varchar(50) NOT NULL,
  `dateAdd` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`carGasId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='<double-click to overwrite multiple objects>';

-- Dumping data for table imattio_taxi.cargas: 0 rows
DELETE FROM `cargas`;
/*!40000 ALTER TABLE `cargas` DISABLE KEYS */;
/*!40000 ALTER TABLE `cargas` ENABLE KEYS */;


-- Dumping structure for table imattio_taxi.carmodel
DROP TABLE IF EXISTS `carmodel`;
CREATE TABLE IF NOT EXISTS `carmodel` (
  `carModelId` int(11) NOT NULL auto_increment,
  `carBannerId` int(255) default '0',
  `carModelName` varchar(50) NOT NULL,
  `dateAdd` timestamp NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`carModelId`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='<double-click to overwrite multiple objects>';

-- Dumping data for table imattio_taxi.carmodel: 0 rows
DELETE FROM `carmodel`;
/*!40000 ALTER TABLE `carmodel` DISABLE KEYS */;
/*!40000 ALTER TABLE `carmodel` ENABLE KEYS */;


-- Dumping structure for table imattio_taxi.carstatus
DROP TABLE IF EXISTS `carstatus`;
CREATE TABLE IF NOT EXISTS `carstatus` (
  `carStatusId` int(10) NOT NULL auto_increment,
  `carStatusName` varchar(50) default NULL COMMENT 'ชื่อสถานะ',
  PRIMARY KEY  (`carStatusId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='<double-click to overwrite multiple objects>';

-- Dumping data for table imattio_taxi.carstatus: 0 rows
DELETE FROM `carstatus`;
/*!40000 ALTER TABLE `carstatus` DISABLE KEYS */;
/*!40000 ALTER TABLE `carstatus` ENABLE KEYS */;


-- Dumping structure for table imattio_taxi.cartype
DROP TABLE IF EXISTS `cartype`;
CREATE TABLE IF NOT EXISTS `cartype` (
  `carTypeId` int(11) NOT NULL auto_increment,
  `carTypeName` varchar(50) NOT NULL,
  `dateAdd` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`carTypeId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='<double-click to overwrite multiple objects>';

-- Dumping data for table imattio_taxi.cartype: 0 rows
DELETE FROM `cartype`;
/*!40000 ALTER TABLE `cartype` DISABLE KEYS */;
/*!40000 ALTER TABLE `cartype` ENABLE KEYS */;


-- Dumping structure for table imattio_taxi.customer
DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customerId` int(10) NOT NULL auto_increment,
  `facebookId` varchar(50) NOT NULL COMMENT 'รหัสIDจากFacebook',
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `citizenId` varchar(20) NOT NULL COMMENT 'รหัสบัตร ปชช.',
  `location` varchar(150) NOT NULL,
  `birthday` varchar(20) NOT NULL,
  `mobilePhone` varchar(20) NOT NULL COMMENT 'เบอร์มือถือ',
  `telephone` varchar(20) NOT NULL COMMENT 'เบอร์บ้าน',
  `gender` varchar(20) NOT NULL,
  `dateAdded` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `dateUpdated` datetime NOT NULL,
  PRIMARY KEY  (`customerId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table imattio_taxi.customer: 0 rows
DELETE FROM `customer`;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;


-- Dumping structure for table imattio_taxi.district
DROP TABLE IF EXISTS `district`;
CREATE TABLE IF NOT EXISTS `district` (
  `districtId` int(5) NOT NULL auto_increment,
  `amphurId` int(5) NOT NULL default '0',
  `provinceId` int(5) NOT NULL default '0',
  `districtCode` varchar(6) collate utf8_unicode_ci NOT NULL,
  `districtName` varchar(150) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`districtId`)
) ENGINE=MyISAM AUTO_INCREMENT=8861 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='<double-click to overwrite multiple objects>';

-- Dumping data for table imattio_taxi.district: 0 rows
DELETE FROM `district`;
/*!40000 ALTER TABLE `district` DISABLE KEYS */;
/*!40000 ALTER TABLE `district` ENABLE KEYS */;


-- Dumping structure for table imattio_taxi.driverhistory
DROP TABLE IF EXISTS `driverhistory`;
CREATE TABLE IF NOT EXISTS `driverhistory` (
  `historyId` int(10) NOT NULL auto_increment,
  `driverId` int(10) NOT NULL,
  `customerId` int(10) NOT NULL,
  `startPlace` varchar(50) NOT NULL,
  `finishPlace` varchar(50) NOT NULL,
  `driveTime` datetime NOT NULL,
  `score` varchar(50) NOT NULL,
  PRIMARY KEY  (`historyId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table imattio_taxi.driverhistory: 0 rows
DELETE FROM `driverhistory`;
/*!40000 ALTER TABLE `driverhistory` DISABLE KEYS */;
/*!40000 ALTER TABLE `driverhistory` ENABLE KEYS */;


-- Dumping structure for table imattio_taxi.drivertaxi
DROP TABLE IF EXISTS `drivertaxi`;
CREATE TABLE IF NOT EXISTS `drivertaxi` (
  `driverId` int(10) NOT NULL auto_increment,
  `firstName` varchar(50) default NULL COMMENT 'ชื่อ',
  `lastName` varchar(100) default NULL COMMENT 'นามสกุล',
  `citizenId` int(15) default NULL COMMENT 'รหัสบัตรประชนชน',
  `licenseNumber` int(15) default NULL COMMENT 'รหัสใบขับขี่',
  `driverBirthday` int(15) default NULL COMMENT 'อายุผู้ขับขี่',
  `address` varchar(200) default NULL COMMENT 'ที่อยู่',
  `zipcode` varchar(50) default NULL COMMENT 'รหัสไปรษณีย์',
  `driverImage` varchar(150) default NULL COMMENT 'รูปผู้ขับขี่',
  `mobilePhone` varchar(20) default NULL COMMENT 'มือถือ',
  `telephone` varchar(20) default NULL COMMENT 'เบอร์บ้าน',
  `dateAdd` timestamp NULL default CURRENT_TIMESTAMP COMMENT 'วันที่เพิ่ม',
  `dateUpdate` datetime default NULL COMMENT 'วันที่ปรับปรุง',
  `districtId` int(5) NOT NULL,
  `amphurId` int(5) NOT NULL,
  `provinceId` int(5) NOT NULL,
  PRIMARY KEY  (`driverId`),
  KEY `fk_driverTaxi_district1_idx` (`districtId`),
  KEY `fk_driverTaxi_amphur1_idx` (`amphurId`),
  KEY `fk_driverTaxi_province1_idx` (`provinceId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='<double-click to overwrite multiple objects>';

-- Dumping data for table imattio_taxi.drivertaxi: 0 rows
DELETE FROM `drivertaxi`;
/*!40000 ALTER TABLE `drivertaxi` DISABLE KEYS */;
/*!40000 ALTER TABLE `drivertaxi` ENABLE KEYS */;


-- Dumping structure for table imattio_taxi.garagelist
DROP TABLE IF EXISTS `garagelist`;
CREATE TABLE IF NOT EXISTS `garagelist` (
  `garageId` int(10) NOT NULL auto_increment,
  `garageName` varchar(100) NOT NULL default '0',
  `garageShortName` varchar(20) NOT NULL default '0',
  `dateAdded` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `dateUpdated` datetime NOT NULL,
  PRIMARY KEY  (`garageId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='<double-click to overwrite multiple objects>';

-- Dumping data for table imattio_taxi.garagelist: 0 rows
DELETE FROM `garagelist`;
/*!40000 ALTER TABLE `garagelist` DISABLE KEYS */;
/*!40000 ALTER TABLE `garagelist` ENABLE KEYS */;


-- Dumping structure for table imattio_taxi.majoradmin
DROP TABLE IF EXISTS `majoradmin`;
CREATE TABLE IF NOT EXISTS `majoradmin` (
  `majorId` int(20) NOT NULL auto_increment,
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
  `majorTypeId` int(10) NOT NULL,
  `garageId` int(10) NOT NULL,
  `provinceId` int(5) NOT NULL,
  `amphurId` int(5) NOT NULL,
  `districtId` int(5) NOT NULL,
  PRIMARY KEY  (`majorId`),
  KEY `fk_majorAdmin_garageList1_idx` (`garageId`),
  KEY `fk_majorAdmin_province1_idx` (`provinceId`),
  KEY `fk_majorAdmin_amphur1_idx` (`amphurId`),
  KEY `fk_majorAdmin_district1_idx` (`districtId`),
  KEY `fk_majorAdmin_majorType1_idx` (`majorTypeId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='<double-click to overwrite multiple objects>';

-- Dumping data for table imattio_taxi.majoradmin: 0 rows
DELETE FROM `majoradmin`;
/*!40000 ALTER TABLE `majoradmin` DISABLE KEYS */;
/*!40000 ALTER TABLE `majoradmin` ENABLE KEYS */;


-- Dumping structure for table imattio_taxi.majortype
DROP TABLE IF EXISTS `majortype`;
CREATE TABLE IF NOT EXISTS `majortype` (
  `majorTypeId` int(10) NOT NULL auto_increment,
  `majorType` varchar(50) NOT NULL,
  PRIMARY KEY  (`majorTypeId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='<double-click to overwrite multiple objects>';

-- Dumping data for table imattio_taxi.majortype: 0 rows
DELETE FROM `majortype`;
/*!40000 ALTER TABLE `majortype` DISABLE KEYS */;
/*!40000 ALTER TABLE `majortype` ENABLE KEYS */;


-- Dumping structure for table imattio_taxi.menulist
DROP TABLE IF EXISTS `menulist`;
CREATE TABLE IF NOT EXISTS `menulist` (
  `menuId` int(10) NOT NULL auto_increment,
  `menuName` varchar(100) NOT NULL,
  `majorAllowed` int(11) NOT NULL,
  `minorAllowed` int(11) NOT NULL,
  `dateAdded` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `dateUpdated` datetime NOT NULL,
  PRIMARY KEY  (`menuId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='<double-click to overwrite multiple objects>';

-- Dumping data for table imattio_taxi.menulist: 4 rows
DELETE FROM `menulist`;
/*!40000 ALTER TABLE `menulist` DISABLE KEYS */;
INSERT INTO `menulist` (`menuId`, `menuName`, `majorAllowed`, `minorAllowed`, `dateAdded`, `dateUpdated`) VALUES
	(1, 'user.major', 1, 0, '2013-08-16 18:26:19', '0000-00-00 00:00:00'),
	(2, 'user.minor', 1, 1, '2013-08-16 18:26:31', '0000-00-00 00:00:00'),
	(3, 'car.type', 1, 0, '2013-08-16 18:27:36', '0000-00-00 00:00:00'),
	(4, 'car.banner', 1, 0, '2013-08-16 18:27:59', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `menulist` ENABLE KEYS */;


-- Dumping structure for table imattio_taxi.minoradmin
DROP TABLE IF EXISTS `minoradmin`;
CREATE TABLE IF NOT EXISTS `minoradmin` (
  `minorId` int(20) NOT NULL auto_increment,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  `mobilePhone` varchar(20) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateAdded` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `dateUpdated` datetime NOT NULL,
  `garageId` int(10) NOT NULL,
  `province_provinceId` int(5) NOT NULL,
  `amphur_amphurId` int(5) NOT NULL,
  `district_districtId` int(5) NOT NULL,
  `minorTypeId` int(10) NOT NULL,
  PRIMARY KEY  (`minorId`),
  KEY `fk_minorAdmin_garageList1_idx` (`garageId`),
  KEY `fk_minorAdmin_province1_idx` (`province_provinceId`),
  KEY `fk_minorAdmin_amphur1_idx` (`amphur_amphurId`),
  KEY `fk_minorAdmin_district1_idx` (`district_districtId`),
  KEY `fk_minorAdmin_minorType1_idx` (`minorTypeId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='<double-click to overwrite multiple objects>';

-- Dumping data for table imattio_taxi.minoradmin: 0 rows
DELETE FROM `minoradmin`;
/*!40000 ALTER TABLE `minoradmin` DISABLE KEYS */;
/*!40000 ALTER TABLE `minoradmin` ENABLE KEYS */;


-- Dumping structure for table imattio_taxi.minortype
DROP TABLE IF EXISTS `minortype`;
CREATE TABLE IF NOT EXISTS `minortype` (
  `minorTypeId` int(10) NOT NULL,
  `garageId` int(10) NOT NULL default '0',
  `minorType` varchar(50) NOT NULL default '0',
  `dateAdded` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `dateUpdated` datetime NOT NULL,
  `menuId` int(10) NOT NULL,
  PRIMARY KEY  (`minorTypeId`),
  KEY `fk_minorType_menuList1_idx` (`menuId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='<double-click to overwrite multiple objects>';

-- Dumping data for table imattio_taxi.minortype: 0 rows
DELETE FROM `minortype`;
/*!40000 ALTER TABLE `minortype` DISABLE KEYS */;
/*!40000 ALTER TABLE `minortype` ENABLE KEYS */;


-- Dumping structure for table imattio_taxi.mobile
DROP TABLE IF EXISTS `mobile`;
CREATE TABLE IF NOT EXISTS `mobile` (
  `mobileId` int(10) NOT NULL auto_increment,
  `mobileNumber` int(20) default '0' COMMENT 'หมายเลขโทรศัพท์',
  `simId` int(20) default '0',
  `mobileBanner` varchar(50) default '0' COMMENT 'ยี่ห้อโทรศัพท์',
  `mobileModel` varchar(20) default '0' COMMENT 'รุ่นโทรศัพท์',
  `EmiMsi` varchar(50) default '0' COMMENT 'หมายเลข EMI/ MSI',
  `dateAdd` timestamp NULL default CURRENT_TIMESTAMP COMMENT 'วันที่เพิม',
  `dateUpdate` datetime default NULL COMMENT 'วันที่ปรับปรุง',
  `mobileNetworkId` int(11) NOT NULL,
  `garageId` int(10) NOT NULL,
  PRIMARY KEY  (`mobileId`),
  KEY `fk_mobile_mobileNetwork1_idx` (`mobileNetworkId`),
  KEY `fk_mobile_garageList1_idx` (`garageId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='<double-click to overwrite multiple objects>';

-- Dumping data for table imattio_taxi.mobile: 0 rows
DELETE FROM `mobile`;
/*!40000 ALTER TABLE `mobile` DISABLE KEYS */;
/*!40000 ALTER TABLE `mobile` ENABLE KEYS */;


-- Dumping structure for table imattio_taxi.mobilenetwork
DROP TABLE IF EXISTS `mobilenetwork`;
CREATE TABLE IF NOT EXISTS `mobilenetwork` (
  `mobileNetworkId` int(11) NOT NULL auto_increment,
  `mobileNetworName` varchar(50) NOT NULL default '',
  `dateAdd` timestamp NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`mobileNetworkId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='<double-click to overwrite multiple objects>';

-- Dumping data for table imattio_taxi.mobilenetwork: 0 rows
DELETE FROM `mobilenetwork`;
/*!40000 ALTER TABLE `mobilenetwork` DISABLE KEYS */;
/*!40000 ALTER TABLE `mobilenetwork` ENABLE KEYS */;


-- Dumping structure for table imattio_taxi.province
DROP TABLE IF EXISTS `province`;
CREATE TABLE IF NOT EXISTS `province` (
  `provinceId` int(5) NOT NULL auto_increment,
  `provinceCode` varchar(2) collate utf8_unicode_ci NOT NULL,
  `provinceName` varchar(150) collate utf8_unicode_ci NOT NULL,
  `provinceNameEng` varchar(150) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`provinceId`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='<double-click to overwrite multiple objects>';

-- Dumping data for table imattio_taxi.province: 0 rows
DELETE FROM `province`;
/*!40000 ALTER TABLE `province` DISABLE KEYS */;
/*!40000 ALTER TABLE `province` ENABLE KEYS */;


-- Dumping structure for table imattio_taxi.timeschedule
DROP TABLE IF EXISTS `timeschedule`;
CREATE TABLE IF NOT EXISTS `timeschedule` (
  `timeScheduleId` int(10) NOT NULL auto_increment,
  `scheduleName` varchar(50) NOT NULL,
  `timeStart` datetime NOT NULL,
  `timeEnd` datetime NOT NULL,
  `garageId` int(10) NOT NULL,
  PRIMARY KEY  (`timeScheduleId`),
  KEY `fk_timeSchedule_garageList1_idx` (`garageId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='<double-click to overwrite multiple objects>';

-- Dumping data for table imattio_taxi.timeschedule: 0 rows
DELETE FROM `timeschedule`;
/*!40000 ALTER TABLE `timeschedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `timeschedule` ENABLE KEYS */;


-- Dumping structure for table imattio_taxi.transportsection
DROP TABLE IF EXISTS `transportsection`;
CREATE TABLE IF NOT EXISTS `transportsection` (
  `transportSectionId` int(10) NOT NULL auto_increment,
  `detail` text COMMENT 'รายละเอียด',
  `dateAdd` timestamp NULL default CURRENT_TIMESTAMP COMMENT 'วันที่เพิ่ม',
  `driverId` int(10) NOT NULL,
  `mobileId` int(10) NOT NULL,
  `carId` int(10) NOT NULL,
  `garageId` int(10) NOT NULL,
  `timeScheduleId` int(10) NOT NULL,
  PRIMARY KEY  (`transportSectionId`),
  KEY `fk_transportSection_driverTaxi_idx` (`driverId`),
  KEY `fk_transportSection_mobile1_idx` (`mobileId`),
  KEY `fk_transportSection_car1_idx` (`carId`),
  KEY `fk_transportSection_garageList1_idx` (`garageId`),
  KEY `fk_transportSection_timeSchedule1_idx` (`timeScheduleId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='<double-click to overwrite multiple objects>';

-- Dumping data for table imattio_taxi.transportsection: 0 rows
DELETE FROM `transportsection`;
/*!40000 ALTER TABLE `transportsection` DISABLE KEYS */;
/*!40000 ALTER TABLE `transportsection` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
