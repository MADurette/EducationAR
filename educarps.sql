-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 13, 2021 at 03:36 PM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.6


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS `educarps`;

CREATE DATABASE `educarps`;



DROP TABLE IF EXISTS `educarps`.`DisplayFiles`;

CREATE TABLE `educarps`.`DisplayFiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fileName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extension` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'For verification',
  `filePath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `projectionType` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'For Differentiating between marker and location-based.',
  `sequenceNum` int(11) DEFAULT NULL COMMENT 'Set for if part of a sequence, NULL otherwise',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `educarps`.`DisplayFiles` (`id`, `fileName`, `extension`, `filePath`, `projectionType`, `sequenceNum`) VALUES
(1, 'BaseBinary-HexProblem1.png', 'png', '/materials/imgs/', 'marker', NULL),
(2, 'BaseBinary-HexProblem1Transparent.png', 'png', 'materials/imgs/', 'marker', NULL),
(3, 'BaseBinary-HexProblem1TransparentANS.png', 'png', '/materials/imgs/', 'marker', NULL),
(4, 'dna.mtl', 'mtl', '/materials/models/', 'marker', NULL),
(5, 'dna.obj', 'obj', '/materials/models', 'marker', NULL),
(6, 'Digital.mp4', 'mp4', '/materials/videos/', 'marker', NULL);

------------------------------------------------------------------------------------------

DROP TABLE IF EXISTS `educarps`.`ControlData`;

CREATE TABLE `educarps`.`ControlData` (
  `MarkerArea` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `DisplayToggle` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `XPos` int(11) NOT NULL,
  `YPos` int(11) NOT NULL,
  `Source` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `educarps`.`ControlData` (`MarkerArea`, `XPos`, `YPos`, `Source`) VALUES
('Task', 0, 0, 'materials/imgs/BaseBinary-HexProblem1.png'),
('Model', 0, 0, 'materials/imgs/BaseBinary-HexProblem1TransparentANS.png');