CREATE TABLE IF NOT EXISTS !PREFIX!_shorturl
(
    `idshorturl`
    int
(
    11
) NOT NULL auto_increment, `shorturl` varchar
(
    32
) NOT NULL, `idart` int
(
    11
) NOT NULL, `idlang` int
(
    11
) NOT NULL, `idclient` int
(
    11
) NOT NULL, `created` datetime NOT NULL, PRIMARY KEY
(
    `idshorturl`
)) ENGINE=!ENGINE! CHARSET=!CHARSET!;