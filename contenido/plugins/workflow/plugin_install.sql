CREATE TABLE IF NOT EXISTS !PREFIX!wf_actions
(
    idworkflowaction
    int
(
    10
) NOT NULL auto_increment, idworkflowitem int
(
    10
) NOT NULL default 0, action varchar
(
    255
) NOT NULL, PRIMARY KEY
(
    idworkflowaction
)) ENGINE=!ENGINE! CHARSET=!CHARSET!;
CREATE TABLE IF NOT EXISTS !PREFIX!wf_allocation
(
    idallocation
    int
(
    10
) NOT NULL auto_increment, idworkflow int
(
    10
) NOT NULL default 0, idcatlang int
(
    10
) NOT NULL default 0, PRIMARY KEY
(
    idallocation
)) ENGINE=!ENGINE! CHARSET=!CHARSET!;
CREATE TABLE IF NOT EXISTS !PREFIX!wf_art_allocation
(
    idartallocation
    int
(
    10
) NOT NULL auto_increment, idartlang int
(
    10
) NOT NULL default 0, idusersequence int
(
    10
) NOT NULL default 0, starttime datetime NOT NULL, laststatus varchar
(
    32
) default NULL, lastusersequence int
(
    10
) NOT NULL default 0, PRIMARY KEY
(
    idartallocation
)) ENGINE=!ENGINE! CHARSET=!CHARSET!;
CREATE TABLE IF NOT EXISTS !PREFIX!wf_items
(
    idworkflowitem
    int
(
    10
) NOT NULL auto_increment, idworkflow int
(
    10
) NOT NULL default 0, position int
(
    10
) NOT NULL default 0, name varchar
(
    255
) NOT NULL default 0, description text NOT NULL, idtask int
(
    10
) NOT NULL default 0, PRIMARY KEY
(
    idworkflowitem
)) ENGINE=!ENGINE! CHARSET=!CHARSET!;
CREATE TABLE IF NOT EXISTS !PREFIX!wf_user_sequences
(
    idusersequence
    int
(
    10
) NOT NULL auto_increment, idworkflowitem int
(
    10
) NOT NULL default 0, iduser varchar
(
    32
) NOT NULL, position int
(
    10
) NOT NULL default 0, timelimit int
(
    10
) NOT NULL default 0, timeunit varchar
(
    32
) NOT NULL, emailnoti int
(
    10
) NOT NULL default 0, escalationnoti int
(
    10
) NOT NULL default 0, PRIMARY KEY
(
    idusersequence
)) ENGINE=!ENGINE! CHARSET=!CHARSET!;
CREATE TABLE IF NOT EXISTS !PREFIX!wf_workflow
(
    idworkflow
    int
(
    10
) NOT NULL auto_increment, idclient int
(
    10
) NOT NULL default 0, idlang int
(
    10
) NOT NULL default 0, idauthor varchar
(
    32
) NOT NULL, name varchar
(
    255
) NOT NULL, description text NOT NULL, created datetime NOT NULL, PRIMARY KEY
(
    idworkflow
)) ENGINE=!ENGINE! CHARSET=!CHARSET!;