CREATE TABLE IF NOT EXISTS !PREFIX!_linkwhitelist
(
    `url`
    varchar
(
    255
) NOT NULL default 0, `lastview` int
(
    11
) NOT NULL default 0, PRIMARY KEY
(
    `url`
)) ENGINE=!ENGINE! CHARSET=!CHARSET!;