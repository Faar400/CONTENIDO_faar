CREATE TABLE IF NOT EXISTS !PREFIX!_siwecos
(
    `idsiwecos`
    int
(
    10
) NOT NULL AUTO_INCREMENT, `idclient` int
(
    10
), `idlang` int
(
    10
) NOT NULL default '0', `domain` varchar
(
    255
) NOT NULL, `email` varchar
(
    255
) NOT NULL, `userToken` varchar
(
    255
) NOT NULL, `domainToken` varchar
(
    255
) NOT NULL, `dangerLevel` int
(
    10
) NOT NULL default '10', `author` varchar
(
    32
) NOT NULL, `created` datetime NOT NULL default '0000-00-00 00:00:00', PRIMARY KEY
(
    `idsiwecos`
)) ENGINE=!ENGINE! CHARSET=!CHARSET!;