CREATE TABLE IF NOT EXISTS `!PREFIX!_user_forum`
(
    `id_user_forum`
    int
(
    11
) NOT NULL auto_increment,`id_user_forum_parent` int
(
    11
) NOT NULL,`idart` int
(
    11
) NOT NULL default '0',`idcat` int
(
    11
) NOT NULL default '0',`idlang` int
(
    5
) NOT NULL default '0',`userid` int
(
    6
) NOT NULL default '0',`email` varchar
(
    100
) NOT NULL default '',`realname` varchar
(
    50
) NOT NULL default '',`forum` mediumtext NOT NULL,`forum_quote` mediumtext NOT NULL,`idclient` int
(
    11
) NOT NULL,`like` int
(
    11
) NOT NULL,`dislike` int
(
    11
) NOT NULL,`editedat` datetime NOT NULL default '0000-00-00 00:00:00',`editedby` varchar
(
    50
) NOT NULL default '',`timestamp` datetime NOT NULL default '0000-00-00 00:00:00',`online` tinyint
(
    1
) NOT NULL,`moderated` tinyint
(
    1
) NOT NULL DEFAULT '0', PRIMARY KEY
(
    `id_user_forum`
)) ENGINE=!ENGINE! CHARSET=!CHARSET!;
