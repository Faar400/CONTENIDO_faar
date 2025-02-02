CREATE TABLE IF NOT EXISTS !PREFIX!ca_alloc
(
    idpica_alloc
    int
(
    10
) NOT NULL auto_increment, parentid int
(
    10
) default NULL, sortorder int
(
    10
) NOT NULL default 0, PRIMARY KEY
(
    idpica_alloc
)) ENGINE=!ENGINE! CHARSET=!CHARSET!;
CREATE TABLE IF NOT EXISTS !PREFIX!ca_alloc_con
(
    idpica_alloc
    int
(
    10
) NOT NULL default 0, idartlang int
(
    10
) NOT NULL default 0, PRIMARY KEY
(
    idpica_alloc,
    idartlang
)) ENGINE=!ENGINE! CHARSET=!CHARSET!;
CREATE TABLE IF NOT EXISTS !PREFIX!ca_lang
(
    idpica_alloc
    int
(
    10
) NOT NULL default 0, idlang int
(
    10
) NOT NULL default 0, name varchar
(
    255
) default NULL, online tinyint
(
    1
) NOT NULL default 0, PRIMARY KEY
(
    idpica_alloc,
    idlang
)) ENGINE=!ENGINE! CHARSET=!CHARSET!;