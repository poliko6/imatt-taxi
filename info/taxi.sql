SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`amphur`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`amphur` (
  `amphurId` INT(5) NOT NULL AUTO_INCREMENT,
  `provinceId` INT(5) NOT NULL DEFAULT '0',
  `amphurCode` VARCHAR(4) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `amphurName` VARCHAR(150) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `amphurNameEng` VARCHAR(150) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  PRIMARY KEY (`amphurId`),
  UNIQUE INDEX `AMPHUR_ID` (`amphurId` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 999
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = '<double-click to overwrite multiple objects>';


-- -----------------------------------------------------
-- Table `mydb`.`carType`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`carType` (
  `carTypeId` INT(11) NOT NULL AUTO_INCREMENT,
  `carTypeName` VARCHAR(50) NOT NULL,
  `dateAdd` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`carTypeId`))
ENGINE = MyISAM
COMMENT = '<double-click to overwrite multiple objects>'
ROW_FORMAT = DYNAMIC;


-- -----------------------------------------------------
-- Table `mydb`.`carModel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`carModel` (
  `carModelId` INT(11) NOT NULL AUTO_INCREMENT,
  `carBannerId` INT(255) NULL DEFAULT '0',
  `carModelName` VARCHAR(50) NOT NULL,
  `dateAdd` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY (`carModelId`))
ENGINE = MyISAM
AUTO_INCREMENT = 65
COMMENT = '<double-click to overwrite multiple objects>'
ROW_FORMAT = DYNAMIC;


-- -----------------------------------------------------
-- Table `mydb`.`carBanner`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`carBanner` (
  `carBannerId` INT(11) NOT NULL AUTO_INCREMENT,
  `carBannerName` VARCHAR(50) NOT NULL DEFAULT '',
  `dateAdd` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY (`carBannerId`))
ENGINE = MyISAM
AUTO_INCREMENT = 70
COMMENT = '<double-click to overwrite multiple objects>'
ROW_FORMAT = DYNAMIC;


-- -----------------------------------------------------
-- Table `mydb`.`garageList`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`garageList` (
  `garageId` INT(10) NOT NULL AUTO_INCREMENT,
  `garageName` VARCHAR(100) NOT NULL DEFAULT '0',
  `garageShortName` VARCHAR(20) NOT NULL DEFAULT '0',
  `dateAdded` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` DATETIME NOT NULL,
  PRIMARY KEY (`garageId`))
ENGINE = MyISAM
COMMENT = '<double-click to overwrite multiple objects>';


-- -----------------------------------------------------
-- Table `mydb`.`carGas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`carGas` (
  `carGasId` INT(11) NOT NULL AUTO_INCREMENT,
  `carGasName` VARCHAR(50) NOT NULL,
  `dateAdd` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`carGasId`))
ENGINE = MyISAM
COMMENT = '<double-click to overwrite multiple objects>'
ROW_FORMAT = DYNAMIC;


-- -----------------------------------------------------
-- Table `mydb`.`carFuel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`carFuel` (
  `carFuelId` INT(11) NOT NULL AUTO_INCREMENT,
  `carFuelName` VARCHAR(50) NOT NULL,
  `dateAdd` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`carFuelId`))
ENGINE = MyISAM
COMMENT = '<double-click to overwrite multiple objects>'
ROW_FORMAT = DYNAMIC;


-- -----------------------------------------------------
-- Table `mydb`.`carColor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`carColor` (
  `carColorId` INT(11) NOT NULL AUTO_INCREMENT,
  `carColorName` VARCHAR(50) NOT NULL,
  `dateAdd` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`carColorId`))
ENGINE = MyISAM
AUTO_INCREMENT = 16
COMMENT = '<double-click to overwrite multiple objects>'
ROW_FORMAT = DYNAMIC;


-- -----------------------------------------------------
-- Table `mydb`.`carStatus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`carStatus` (
  `carStatusId` INT(10) NOT NULL AUTO_INCREMENT,
  `carStatusName` VARCHAR(50) NULL DEFAULT NULL COMMENT 'ชื่อสถานะ',
  PRIMARY KEY (`carStatusId`))
ENGINE = MyISAM
COMMENT = '<double-click to overwrite multiple objects>';


-- -----------------------------------------------------
-- Table `mydb`.`car`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`car` (
  `carId` INT(10) NOT NULL AUTO_INCREMENT,
  `carRegistration` VARCHAR(10) NULL COMMENT 'ทะเบียนรถ',
  `carYear` INT(10) NULL DEFAULT '0' COMMENT 'ปีรถ',
  `carImage` VARCHAR(150) NULL DEFAULT NULL COMMENT 'รูปภาพ',
  `dateAdd` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่เพิมรถ',
  `garageId` INT(10) NOT NULL,
  `carTypeId` INT(11) NOT NULL,
  `carBannerId` INT(11) NOT NULL,
  `carModelId` INT(11) NOT NULL,
  `carGasId` INT(11) NOT NULL,
  `carFuelId` INT(11) NOT NULL,
  `carColorId` INT(11) NOT NULL,
  `carStatusId` INT(10) NOT NULL,
  PRIMARY KEY (`carId`),
  INDEX `fk_car_carType1_idx` (`carTypeId` ASC),
  INDEX `fk_car_carModel1_idx` (`carModelId` ASC),
  INDEX `fk_car_carBanner1_idx` (`carBannerId` ASC),
  INDEX `fk_car_garageList1_idx` (`garageId` ASC),
  INDEX `fk_car_carGas1_idx` (`carGasId` ASC),
  INDEX `fk_car_carFuel1_idx` (`carFuelId` ASC),
  INDEX `fk_car_carColor1_idx` (`carColorId` ASC),
  INDEX `fk_car_carStatus1_idx` (`carStatusId` ASC))
ENGINE = MyISAM
COMMENT = '<double-click to overwrite multiple objects>';


-- -----------------------------------------------------
-- Table `mydb`.`customer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`customer` (
  `customerId` INT(10) NOT NULL AUTO_INCREMENT,
  `facebookId` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `firstName` VARCHAR(50) NOT NULL,
  `lastName` VARCHAR(50) NOT NULL,
  `citizenId` VARCHAR(20) NOT NULL,
  `location` VARCHAR(150) NOT NULL,
  `birthday` VARCHAR(20) NOT NULL,
  `mobilePhone` VARCHAR(20) NOT NULL,
  `telephone` VARCHAR(20) NOT NULL,
  `gender` VARCHAR(20) NOT NULL,
  `dateAdded` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` DATETIME NOT NULL,
  PRIMARY KEY (`customerId`))
ENGINE = MyISAM
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`district`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`district` (
  `districtId` INT(5) NOT NULL AUTO_INCREMENT,
  `amphurId` INT(5) NOT NULL DEFAULT '0',
  `provinceId` INT(5) NOT NULL DEFAULT '0',
  `districtCode` VARCHAR(6) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `districtName` VARCHAR(150) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  PRIMARY KEY (`districtId`))
ENGINE = MyISAM
AUTO_INCREMENT = 8861
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = '<double-click to overwrite multiple objects>';


-- -----------------------------------------------------
-- Table `mydb`.`province`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`province` (
  `provinceId` INT(5) NOT NULL AUTO_INCREMENT,
  `provinceCode` VARCHAR(2) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `provinceName` VARCHAR(150) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `provinceNameEng` VARCHAR(150) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  PRIMARY KEY (`provinceId`))
ENGINE = MyISAM
AUTO_INCREMENT = 78
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = '<double-click to overwrite multiple objects>';


-- -----------------------------------------------------
-- Table `mydb`.`driverTaxi`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`driverTaxi` (
  `driverId` INT(10) NOT NULL AUTO_INCREMENT,
  `firstName` VARCHAR(50) NULL DEFAULT NULL COMMENT 'ชื่อ',
  `lastName` VARCHAR(100) NULL DEFAULT NULL COMMENT 'นามสกุล',
  `citizenId` INT(15) NULL COMMENT 'รหัสบัตรประชนชน',
  `licenseNumber` INT(15) NULL DEFAULT NULL COMMENT 'รหัสใบขับขี่',
  `driverAge` INT(15) NULL DEFAULT NULL COMMENT 'อายุผู้ขับขี่',
  `address` VARCHAR(200) NULL DEFAULT NULL COMMENT 'ที่อยู่',
  `zipcode` VARCHAR(50) NULL DEFAULT NULL COMMENT 'รหัสไปรษณีย์',
  `driverImage` VARCHAR(150) NULL DEFAULT NULL COMMENT 'รูปผู้ขับขี่',
  `mobilePhone` VARCHAR(20) NULL DEFAULT NULL COMMENT 'มือถือ',
  `telephone` VARCHAR(20) NULL DEFAULT NULL COMMENT 'เบอร์บ้าน',
  `driverHistory` TEXT NULL DEFAULT NULL COMMENT 'ประวัติผู้ขับขี่',
  `dateAdd` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่เพิ่ม',
  `dateUpdate` DATETIME NULL DEFAULT NULL COMMENT 'วันที่ปรับปรุง',
  `garageId` INT(10) NOT NULL,
  `districtId` INT(5) NOT NULL,
  `amphurId` INT(5) NOT NULL,
  `provinceId` INT(5) NOT NULL,
  PRIMARY KEY (`driverId`),
  INDEX `fk_driverTaxi_garageList1_idx` (`garageId` ASC),
  INDEX `fk_driverTaxi_district1_idx` (`districtId` ASC),
  INDEX `fk_driverTaxi_amphur1_idx` (`amphurId` ASC),
  INDEX `fk_driverTaxi_province1_idx` (`provinceId` ASC))
ENGINE = MyISAM
COMMENT = '<double-click to overwrite multiple objects>';


-- -----------------------------------------------------
-- Table `mydb`.`majorType`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`majorType` (
  `majorTypeId` INT(10) NOT NULL AUTO_INCREMENT,
  `majorType` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`majorTypeId`))
ENGINE = MyISAM
AUTO_INCREMENT = 3
COMMENT = '<double-click to overwrite multiple objects>';


-- -----------------------------------------------------
-- Table `mydb`.`majorAdmin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`majorAdmin` (
  `majorId` INT(20) NOT NULL AUTO_INCREMENT,
  `thaiCompanyName` VARCHAR(255) NOT NULL,
  `englishCompanyName` VARCHAR(255) NOT NULL,
  `managerName` VARCHAR(100) NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `businessType` VARCHAR(50) NOT NULL,
  `address` VARCHAR(50) NOT NULL,
  `zipcode` VARCHAR(20) NOT NULL,
  `mobilePhone` VARCHAR(20) NOT NULL,
  `telephone` VARCHAR(20) NOT NULL,
  `fax` VARCHAR(20) NOT NULL,
  `callCenter` VARCHAR(20) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `dateAdded` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` DATETIME NOT NULL,
  `majorTypeId` INT(10) NOT NULL,
  `garageId` INT(10) NOT NULL,
  `provinceId` INT(5) NOT NULL,
  `amphurId` INT(5) NOT NULL,
  `districtId` INT(5) NOT NULL,
  PRIMARY KEY (`majorId`),
  INDEX `fk_majorAdmin_garageList1_idx` (`garageId` ASC),
  INDEX `fk_majorAdmin_province1_idx` (`provinceId` ASC),
  INDEX `fk_majorAdmin_amphur1_idx` (`amphurId` ASC),
  INDEX `fk_majorAdmin_district1_idx` (`districtId` ASC),
  INDEX `fk_majorAdmin_majorType1_idx` (`majorTypeId` ASC))
ENGINE = MyISAM
COMMENT = '<double-click to overwrite multiple objects>';


-- -----------------------------------------------------
-- Table `mydb`.`menuList`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`menuList` (
  `menuId` INT(10) NOT NULL AUTO_INCREMENT,
  `menuName` VARCHAR(100) NOT NULL,
  `majorAllowed` VARCHAR(10) NOT NULL,
  `minorAllowed` VARCHAR(10) NOT NULL,
  `dateAdded` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` DATETIME NOT NULL,
  PRIMARY KEY (`menuId`))
ENGINE = MyISAM
COMMENT = '<double-click to overwrite multiple objects>';


-- -----------------------------------------------------
-- Table `mydb`.`minorType`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`minorType` (
  `minorTypeId` INT(10) NOT NULL,
  `garageId` INT(10) NOT NULL DEFAULT '0',
  `minorType` VARCHAR(50) NOT NULL DEFAULT '0',
  `dateAdded` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` DATETIME NOT NULL,
  `menuId` INT(10) NOT NULL,
  PRIMARY KEY (`minorTypeId`),
  INDEX `fk_minorType_menuList1_idx` (`menuId` ASC))
ENGINE = MyISAM
COMMENT = '<double-click to overwrite multiple objects>';


-- -----------------------------------------------------
-- Table `mydb`.`minorAdmin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`minorAdmin` (
  `minorId` INT(20) NOT NULL AUTO_INCREMENT,
  `firstName` VARCHAR(100) NOT NULL DEFAULT '0',
  `lastName` VARCHAR(100) NOT NULL DEFAULT '0',
  `address` VARCHAR(150) NOT NULL DEFAULT '0',
  `zipcode` VARCHAR(20) NOT NULL,
  `mobilePhone` VARCHAR(20) NOT NULL DEFAULT '0',
  `email` VARCHAR(100) NOT NULL DEFAULT '0',
  `username` VARCHAR(100) NOT NULL DEFAULT '0',
  `password` VARCHAR(255) NOT NULL DEFAULT '0',
  `dateAdded` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` DATETIME NOT NULL,
  `garageId` INT(10) NOT NULL,
  `province_provinceId` INT(5) NOT NULL,
  `amphur_amphurId` INT(5) NOT NULL,
  `district_districtId` INT(5) NOT NULL,
  `minorTypeId` INT(10) NOT NULL,
  PRIMARY KEY (`minorId`),
  INDEX `fk_minorAdmin_garageList1_idx` (`garageId` ASC),
  INDEX `fk_minorAdmin_province1_idx` (`province_provinceId` ASC),
  INDEX `fk_minorAdmin_amphur1_idx` (`amphur_amphurId` ASC),
  INDEX `fk_minorAdmin_district1_idx` (`district_districtId` ASC),
  INDEX `fk_minorAdmin_minorType1_idx` (`minorTypeId` ASC))
ENGINE = MyISAM
COMMENT = '<double-click to overwrite multiple objects>';


-- -----------------------------------------------------
-- Table `mydb`.`mobileNetwork`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`mobileNetwork` (
  `mobileNetworkId` INT(11) NOT NULL AUTO_INCREMENT,
  `mobileNetworName` VARCHAR(50) NOT NULL DEFAULT '',
  `dateAdd` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY (`mobileNetworkId`))
ENGINE = MyISAM
COMMENT = '<double-click to overwrite multiple objects>'
ROW_FORMAT = DYNAMIC;


-- -----------------------------------------------------
-- Table `mydb`.`mobile`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`mobile` (
  `mobileId` INT(10) NOT NULL AUTO_INCREMENT,
  `mobileNumber` INT(20) NULL DEFAULT '0' COMMENT 'หมายเลขโทรศัพท์',
  `mobileBanner` VARCHAR(50) NULL DEFAULT '0' COMMENT 'ยี่ห้อโทรศัพท์',
  `mobileModel` VARCHAR(20) NULL DEFAULT '0' COMMENT 'รุ่นโทรศัพท์',
  `EmiMsi` VARCHAR(50) NULL DEFAULT '0' COMMENT 'หมายเลข EMI/ MSI',
  `dateAdd` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่เพิม',
  `dateUpdate` DATETIME NULL COMMENT 'วันที่ปรับปรุง',
  `mobileNetworkId` INT(11) NOT NULL,
  `garageId` INT(10) NOT NULL,
  PRIMARY KEY (`mobileId`),
  INDEX `fk_mobile_mobileNetwork1_idx` (`mobileNetworkId` ASC),
  INDEX `fk_mobile_garageList1_idx` (`garageId` ASC))
ENGINE = MyISAM
COMMENT = '<double-click to overwrite multiple objects>';


-- -----------------------------------------------------
-- Table `mydb`.`timeSchedule`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`timeSchedule` (
  `timeScheduleId` INT(10) NOT NULL AUTO_INCREMENT,
  `scheduleName` VARCHAR(50) NOT NULL,
  `timeStart` DATETIME NOT NULL,
  `timeEnd` DATETIME NOT NULL,
  `garageId` INT(10) NOT NULL,
  PRIMARY KEY (`timeScheduleId`),
  INDEX `fk_timeSchedule_garageList1_idx` (`garageId` ASC))
ENGINE = MyISAM
COMMENT = '<double-click to overwrite multiple objects>';


-- -----------------------------------------------------
-- Table `mydb`.`transportSection`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`transportSection` (
  `transportSectionId` INT(10) NOT NULL AUTO_INCREMENT,
  `detail` TEXT NULL DEFAULT NULL COMMENT 'รายละเอียด',
  `dateAdd` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่เพิ่ม',
  `driverId` INT(10) NOT NULL,
  `mobileId` INT(10) NOT NULL,
  `carId` INT(10) NOT NULL,
  `garageId` INT(10) NOT NULL,
  `timeScheduleId` INT(10) NOT NULL,
  PRIMARY KEY (`transportSectionId`),
  INDEX `fk_transportSection_driverTaxi_idx` (`driverId` ASC),
  INDEX `fk_transportSection_mobile1_idx` (`mobileId` ASC),
  INDEX `fk_transportSection_car1_idx` (`carId` ASC),
  INDEX `fk_transportSection_garageList1_idx` (`garageId` ASC),
  INDEX `fk_transportSection_timeSchedule1_idx` (`timeScheduleId` ASC))
ENGINE = MyISAM
COMMENT = '<double-click to overwrite multiple objects>';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
