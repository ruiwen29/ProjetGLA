-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 2019-05-29 22:22:13
-- 服务器版本： 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wego`
--

-- --------------------------------------------------------

--
-- 表的结构 `coordonnees`
--

DROP TABLE IF EXISTS `coordonnees`;
CREATE TABLE IF NOT EXISTS `coordonnees` (
  `id_coord` int(11) NOT NULL AUTO_INCREMENT,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  PRIMARY KEY (`id_coord`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `route`
--

DROP TABLE IF EXISTS `route`;
CREATE TABLE IF NOT EXISTS `route` (
  `id_route` int(11) NOT NULL AUTO_INCREMENT,
  `nomRoute` varchar(20) NOT NULL,
  `id_typeRoute` int(11) NOT NULL,
  `id_typeRoute_Avoir` int(11) NOT NULL,
  PRIMARY KEY (`id_route`),
  UNIQUE KEY `route_AK` (`id_typeRoute`),
  KEY `route_TypeRoute_FK` (`id_typeRoute_Avoir`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `trajetfavori`
--

DROP TABLE IF EXISTS `trajetfavori`;
CREATE TABLE IF NOT EXISTS `trajetfavori` (
  `id_trajet` int(11) NOT NULL AUTO_INCREMENT,
  `Trajet` varchar(1000) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_trajet`),
  KEY `TrajetFavori_User_FK` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `typeroute`
--

DROP TABLE IF EXISTS `typeroute`;
CREATE TABLE IF NOT EXISTS `typeroute` (
  `id_typeRoute` int(11) NOT NULL,
  `nomTypeRoute` varchar(20) NOT NULL,
  PRIMARY KEY (`id_typeRoute`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `typeuser`
--

DROP TABLE IF EXISTS `typeuser`;
CREATE TABLE IF NOT EXISTS `typeuser` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `typeuser`
--

INSERT INTO `typeuser` (`id_type`, `type`) VALUES
(1, 'admin'),
(2, 'client');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `passeword` varchar(30) NOT NULL,
  `id_type_TypeUser` int(11) NOT NULL,
  `id_coord` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `User_TypeUser_FK` (`id_type_TypeUser`),
  KEY `User_Coordonnees0_FK` (`id_coord`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id_user`, `nom`, `mail`, `passeword`, `id_type_TypeUser`, `id_coord`) VALUES
(1, 'toto', 'toto@gmail.com', 'toto', 2, NULL),
(6, 'aaa', 'aaa@gmail.com', 'aaa', 2, NULL),
(7, '', '', '', 2, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `ville`
--

DROP TABLE IF EXISTS `ville`;
CREATE TABLE IF NOT EXISTS `ville` (
  `id_ville` int(11) NOT NULL AUTO_INCREMENT,
  `nom_ville` varchar(20) NOT NULL,
  `touristique` int(11) NOT NULL,
  `id_typeVille` int(11) NOT NULL,
  `id_coord` int(11) NOT NULL,
  PRIMARY KEY (`id_ville`),
  UNIQUE KEY `Ville_AK` (`id_typeVille`),
  KEY `Ville_Coordonnees_FK` (`id_coord`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 限制导出的表
--

--
-- 限制表 `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `route_TypeRoute_FK` FOREIGN KEY (`id_typeRoute_Avoir`) REFERENCES `typeroute` (`id_typeRoute`);

--
-- 限制表 `trajetfavori`
--
ALTER TABLE `trajetfavori`
  ADD CONSTRAINT `TrajetFavori_User_FK` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- 限制表 `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `User_Coordonnees0_FK` FOREIGN KEY (`id_coord`) REFERENCES `coordonnees` (`id_coord`),
  ADD CONSTRAINT `User_TypeUser_FK` FOREIGN KEY (`id_type_TypeUser`) REFERENCES `typeuser` (`id_type`);

--
-- 限制表 `ville`
--
ALTER TABLE `ville`
  ADD CONSTRAINT `Ville_Coordonnees_FK` FOREIGN KEY (`id_coord`) REFERENCES `coordonnees` (`id_coord`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
