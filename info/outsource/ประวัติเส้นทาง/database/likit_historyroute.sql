-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- โฮสต์: localhost
-- เวลาในการสร้าง: 
-- รุ่นของเซิร์ฟเวอร์: 5.0.51
-- รุ่นของ PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- ฐานข้อมูล: `job_taxi`
-- 

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `likit_historyroute`
-- 

CREATE TABLE `likit_historyroute` (
  `id` int(11) NOT NULL,
  `latitude` varchar(255) collate utf8_unicode_ci NOT NULL,
  `longitude` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- dump ตาราง `likit_historyroute`
-- 

INSERT INTO `likit_historyroute` VALUES (1, '18.865688', '99.007065');
INSERT INTO `likit_historyroute` VALUES (2, '18.791252', '98.661442');
INSERT INTO `likit_historyroute` VALUES (3, '18.734303 ', '99.313484');
