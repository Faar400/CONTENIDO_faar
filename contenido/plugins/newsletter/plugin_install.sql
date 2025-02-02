CREATE TABLE IF NOT EXISTS !PREFIX!_news
(
    `idnews`
    int
(
    10
) NOT NULL AUTO_INCREMENT, `idclient` int
(
    10
) NOT NULL default '0', `idlang` int
(
    10
) NOT NULL default '0', `idart` int
(
    10
) NOT NULL default '0', `template_idart` int
(
    10
) NOT NULL default '0', `type` varchar
(
    10
) NOT NULL default 'text', `name` varchar
(
    255
) NOT NULL, `subject` text, `message` longtext, `newsfrom` varchar
(
    255
) NOT NULL, `newsfromname` varchar
(
    255
) default NULL, `newsdate` datetime default NULL, `welcome` tinyint
(
    1
) NOT NULL default '0', `use_cronjob` tinyint
(
    1
) NOT NULL default '0', `send_to` varchar
(
    32
) NOT NULL default 'all', `send_ids` text, `dispatch` tinyint
(
    1
) NOT NULL default '0', `dispatch_count` int
(
    5
) NOT NULL default '50', `dispatch_delay` int
(
    5
) NOT NULL default '5', `author` varchar
(
    32
) NOT NULL, `created` datetime NOT NULL default '0000-00-00 00:00:00', `modified` datetime NOT NULL default '0000-00-00 00:00:00', `modifiedby` varchar
(
    32
) NOT NULL, PRIMARY KEY
(
    `idnews`
)) ENGINE=!ENGINE! CHARSET=!CHARSET!;
CREATE TABLE IF NOT EXISTS !PREFIX!_news_groupmembers
(
    idnewsgroupmember
    int
(
    10
) NOT NULL AUTO_INCREMENT, idnewsgroup int
(
    10
) NOT NULL DEFAULT 0, idnewsrcp int
(
    10
) NOT NULL DEFAULT 0, PRIMARY KEY
(
    idnewsgroupmember
)) ENGINE=!ENGINE! CHARSET=!CHARSET!;
CREATE TABLE IF NOT EXISTS !PREFIX!_news_groups
(
    idnewsgroup
    int
(
    10
) NOT NULL AUTO_INCREMENT, idclient int
(
    10
) NOT NULL DEFAULT 0, idlang int
(
    10
) NOT NULL DEFAULT 0, groupname varchar
(
    32
) NOT NULL, defaultgroup tinyint
(
    1
) NOT NULL DEFAULT 0, PRIMARY KEY
(
    idnewsgroup
)) ENGINE=!ENGINE! CHARSET=!CHARSET!;
CREATE TABLE IF NOT EXISTS !PREFIX!_news_jobs
(
    `idnewsjob`
    int
(
    10
) NOT NULL auto_increment, `idclient` int
(
    10
) NOT NULL default '0', `idlang` int
(
    10
) NOT NULL default '0', `idnews` int
(
    10
) NOT NULL default '0', `status` tinyint
(
    1
) NOT NULL default '0', `use_cronjob` tinyint
(
    1
) NOT NULL default '0', `started` datetime NOT NULL default '0000-00-00 00:00:00', `finished` datetime NOT NULL default '0000-00-00 00:00:00', `name` varchar
(
    255
) NOT NULL, `type` varchar
(
    10
) NOT NULL default 'text', `encoding` varchar
(
    32
) NOT NULL default 'iso-8859-1', `newsfrom` varchar
(
    255
) NOT NULL, `newsfromname` varchar
(
    255
) NOT NULL, `newsdate` datetime default '0000-00-00 00:00:00', `subject` text, `idart` int
(
    10
) NOT NULL default '0', `message_text` longtext NOT NULL, `message_html` longtext, `send_to` text NOT NULL, `dispatch` tinyint
(
    1
) NOT NULL default '0', `dispatch_count` int
(
    5
) NOT NULL default '50', `dispatch_delay` int
(
    5
) NOT NULL default '5', `author` varchar
(
    32
) NOT NULL, `authorname` varchar
(
    32
) NOT NULL, `rcpcount` int
(
    10
) NOT NULL default '0', `sendcount` int
(
    10
) NOT NULL default '0', `created` datetime NOT NULL default '0000-00-00 00:00:00', `modified` datetime NOT NULL default '0000-00-00 00:00:00', `modifiedby` varchar
(
    32
) NOT NULL, PRIMARY KEY
(
    `idnewsjob`
)) ENGINE=!ENGINE! CHARSET=!CHARSET!;
CREATE TABLE IF NOT EXISTS !PREFIX!_news_log
(
    idnewslog
    int
(
    10
) NOT NULL AUTO_INCREMENT, idnewsjob int
(
    10
) NOT NULL DEFAULT 0, idnewsrcp int
(
    10
) NOT NULL DEFAULT 0, rcpname varchar
(
    255
) NOT NULL, rcpemail varchar
(
    255
) NOT NULL, rcphash varchar
(
    32
) NOT NULL, rcpnewstype tinyint
(
    1
) NOT NULL DEFAULT 0, status varchar
(
    255
) NOT NULL, sent datetime NOT NULL, created datetime NOT NULL, PRIMARY KEY
(
    idnewslog
)) ENGINE=!ENGINE! CHARSET=!CHARSET!;
CREATE TABLE IF NOT EXISTS !PREFIX!_news_rcp
(
    idnewsrcp
    int
(
    10
) NOT NULL AUTO_INCREMENT, idclient int
(
    10
) NOT NULL DEFAULT 0, idlang int
(
    10
) NOT NULL DEFAULT 0, email varchar
(
    255
) DEFAULT NULL, confirmed tinyint
(
    1
) NOT NULL DEFAULT 0, confirmeddate datetime NOT NULL, lastaction varchar
(
    32
) DEFAULT NULL, name varchar
(
    255
) DEFAULT NULL, hash varchar
(
    32
) NOT NULL, deactivated tinyint
(
    1
) NOT NULL DEFAULT 0, news_type tinyint
(
    1
) NOT NULL DEFAULT 0, author varchar
(
    32
) NOT NULL, created datetime NOT NULL, lastmodified datetime NOT NULL, modifiedby varchar
(
    32
) NOT NULL, PRIMARY KEY
(
    idnewsrcp
)) ENGINE=!ENGINE! CHARSET=!CHARSET!;