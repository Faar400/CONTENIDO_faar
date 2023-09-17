DROP TABLE IF EXISTS `!PREFIX!_cat`;

CREATE TABLE `!PREFIX!_cat` (
  `idcat` int(11) NOT NULL auto_increment,
  `idclient` int(11) NOT NULL default '0',
  `parentid` int(11) NOT NULL default '0',
  `preid` int(11) NOT NULL default '0',
  `postid` int(11) NOT NULL default '0',
  `status` int(11) NOT NULL default '0',
  `author` varchar(32) NOT NULL,
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastmodified` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (`idcat`),
  KEY `idclient` (`idclient`),
  KEY `idclient_2` (`idclient`,`parentid`),
  KEY `parentid` (`parentid`,`preid`),
  KEY `preid` (`preid`)
) ENGINE=MyISAM DEFAULT CHARSET=!CHARSET! AUTO_INCREMENT=0;

INSERT INTO `!PREFIX!_cat` (`idcat`, `idclient`, `parentid`, `preid`, `postid`, `status`, `author`, `created`, `lastmodified`) VALUES
(1, 1, 0, 0, 39, 0, 'sysadmin', NOW(), NOW()),
(2, 1, 0, 4, 0, 0, 'sysadmin', NOW(), NOW()),
(45, 1, 6, 43, 0, 0, 'sysadmin', NOW(), NOW()),
(4, 1, 0, 39, 2, 0, 'sysadmin', NOW(), NOW()),
(5, 1, 1, 0, 6, 0, 'sysadmin', NOW(), NOW()),
(6, 1, 1, 5, 8, 0, 'sysadmin', NOW(), NOW()),
(8, 1, 1, 6, 46, 0, 'sysadmin', NOW(), NOW()),
(9, 1, 8, 0, 10, 0, 'sysadmin', NOW(), NOW()),
(10, 1, 8, 9, 63, 0, 'sysadmin', NOW(), NOW()),
(11, 1, 10, 12, 48, 0, 'sysadmin', NOW(), NOW()),
(12, 1, 10, 13, 11, 0, 'sysadmin', NOW(), NOW()),
(13, 1, 10, 0, 12, 0, 'sysadmin', NOW(), NOW()),
(43, 1, 6, 44, 45, 0, 'sysadmin', NOW(), NOW()),
(44, 1, 6, 0, 43, 0, 'sysadmin', NOW(), NOW()),
(25, 1, 2, 0, 26, 0, 'sysadmin', NOW(), NOW()),
(26, 1, 2, 25, 28, 0, 'sysadmin', NOW(), NOW()),
(63, 1, 8, 10, 0, 0, 'sysadmin', NOW(), NOW()),
(28, 1, 2, 26, 29, 0, 'sysadmin', NOW(), NOW()),
(29, 1, 2, 28, 30, 0, 'sysadmin', NOW(), NOW()),
(30, 1, 2, 29, 68, 0, 'sysadmin', NOW(), NOW()),
(46, 1, 1, 8, 57, 0, 'sysadmin', NOW(), NOW()),
(39, 1, 0, 1, 4, 0, 'sysadmin', NOW(), NOW()),
(40, 1, 39, 0, 47, 0, 'sysadmin', NOW(), NOW()),
(41, 1, 39, 47, 0, 0, 'sysadmin', NOW(), NOW()),
(47, 1, 39, 40, 41, 0, 'sysadmin', NOW(), NOW()),
(48, 1, 10, 11, 49, 0, 'sysadmin', NOW(), NOW()),
(49, 1, 10, 48, 56, 0, 'sysadmin', NOW(), NOW()),
(51, 1, 46, 0, 52, 0, 'sysadmin', NOW(), NOW()),
(52, 1, 46, 51, 0, 0, 'sysadmin', NOW(), NOW()),
(53, 1, 5, 55, 0, 0, 'sysadmin', NOW(), NOW()),
(54, 1, 5, 0, 55, 0, 'sysadmin', NOW(), NOW()),
(55, 1, 5, 54, 53, 0, 'sysadmin', NOW(), NOW()),
(56, 1, 10, 49, 0, 0, 'sysadmin', NOW(), NOW()),
(57, 1, 1, 46, 0, 0, 'sysadmin', NOW(), NOW()),
(66, 1, 63, 65, 67, 0, 'sysadmin', NOW(), NOW()),
(65, 1, 63, 64, 66, 0, 'sysadmin', NOW(), NOW()),
(64, 1, 63, 0, 65, 0, 'sysadmin', NOW(), NOW()),
(67, 1, 63, 66, 0, 0, 'sysadmin', NOW(), NOW()),
(68, 1, 2, 30, 0, 0, 'sysadmin', NOW(), NOW());