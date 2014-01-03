CREATE TABLE robots (
  id int(200) NOT NULL auto_increment,
  titre varchar(200) NOT NULL default '',
  description text NOT NULL,
  adresse text NOT NULL,
  `key` text NOT NULL,
  `date` varchar(100) NOT NULL default '',
  ps varchar(200) NOT NULL default '',
  KEY id (id)
) 