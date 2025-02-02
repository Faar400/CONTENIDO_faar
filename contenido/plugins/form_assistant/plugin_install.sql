CREATE TABLE IF NOT EXISTS !PREFIX!fa_form
(
    idform
    int
(
    10
) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique identifier for a ConForm form', idclient int
(
    10
) unsigned NOT NULL DEFAULT '0' COMMENT 'id of form client', idlang int
(
    10
) unsigned NOT NULL DEFAULT '0' COMMENT 'id of form language', name varchar
(
    1023
) NOT NULL DEFAULT 'new form' COMMENT 'human readable name of form', data_table varchar
(
    64
) NOT NULL DEFAULT 'con_pifa_data' COMMENT 'unique name of data table', method enum
(
    'get',
    'post'
) NOT NULL DEFAULT 'post' COMMENT 'method to be used for form submission', with_timestamp BOOLEAN NOT NULL DEFAULT '1' COMMENT 'if data table records have a timestamp', PRIMARY KEY
(
    idform
)) ENGINE=!ENGINE! CHARSET=!CHARSET! COMMENT='contains meta data of PIFA forms' AUTO_INCREMENT=1;
CREATE TABLE IF NOT EXISTS !PREFIX!fa_field
(
    idfield
    int
(
    10
) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique identifier for a ConForm field', idform int
(
    10
) unsigned NOT NULL DEFAULT '0' COMMENT 'foreign key for the ConForm form', field_rank int
(
    10
) unsigned NOT NULL DEFAULT '0' COMMENT 'rank of a field in a form', field_type int
(
    10
) unsigned NOT NULL DEFAULT '0' COMMENT 'id which defines type of form field', column_name varchar
(
    64
) NOT NULL COMMENT 'name of data table column to store values', label varchar
(
    1023
) DEFAULT NULL COMMENT 'label to be shown in frontend', display_label int
(
    1
) NOT NULL DEFAULT '0' COMMENT '1 means that the label will be displayed', default_value varchar
(
    1023
) DEFAULT NULL COMMENT 'default value to be shown for form field', option_labels varchar
(
    1023
) DEFAULT NULL COMMENT 'CSV of option labels', option_values varchar
(
    1023
) DEFAULT NULL COMMENT 'CSV of option values', option_class varchar
(
    1023
) DEFAULT NULL COMMENT 'class implementing external datasource', help_text text DEFAULT NULL COMMENT 'help text to be shown for form field', obligatory int
(
    1
) NOT NULL DEFAULT '0' COMMENT '1 means that a value is obligatory', rule varchar
(
    1023
) DEFAULT NULL COMMENT 'regular expression to validate value', error_message varchar
(
    1023
) DEFAULT NULL COMMENT 'error message to be shown for an invalid value', css_class varchar
(
    1023
) DEFAULT NULL COMMENT 'CSS classes to be used for field wrapper', `uri` VARCHAR
(
    1023
) DEFAULT NULL COMMENT 'URI for image buttons', PRIMARY KEY
(
    idfield
)) ENGINE=!ENGINE! CHARSET=!CHARSET! COMMENT='contains meta data of PIFA fields' AUTO_INCREMENT=1;
