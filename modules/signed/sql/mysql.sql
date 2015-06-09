CREATE TABLE `signed_signatures` (
  `signid`      mediumint(16) unsigned  NOT NULL auto_increment,
  `state`   	enum('active', 'inactive', 'progress') NOT NULL default 'progress',
  `type`      	varchar(128)            NOT NULL default '',
  `serial`    	varchar(42)             NOT NULL default '',
  `bytes`     	int(24) unsigned        NOT NULL default '0',
  `entity`      varchar(255)            NOT NULL default '',
  `name`      	varchar(255)            NOT NULL default '',
  `file`      	varchar(255)            NOT NULL default '',
  `expires`   	int(13) unsigned     	NOT NULL default '0',
  `expired`   	int(13) unsigned     	NOT NULL default '0',
  `saved`     	int(13) unsigned     	NOT NULL default '0',
  `issued`     	int(13) unsigned     	NOT NULL default '0',
  `used`   	int(13) unsigned     	NOT NULL default '0',
  `flagged`   	int(13) unsigned     	NOT NULL default '0',
  PRIMARY KEY  (`signid`)
) ENGINE=INNODB;

CREATE TABLE `signed_events` (
  `eventid`        	mediumint(19) unsigned  NOT NULL auto_increment,
  `system`      	varchar(128)            NOT NULL default '',
  `type`      		varchar(128)            NOT NULL default '',
  `comment`    		text,
  `group`    		varchar(42)             NOT NULL default '',
  `uid`     		int(13) unsigned        NOT NULL default '0',
  `began`   		int(13) unsigned     	NOT NULL default '0',
  `micro`     		int(13) unsigned     	NOT NULL default '0',
  `log_storage`   	enum('json', 'serial', 'xml') NOT NULL default 'json',
  `log_path`      	varchar(255)            NOT NULL default '',
  `log_file`      	varchar(255)            NOT NULL default '',
  PRIMARY KEY  (`eventid`)
) ENGINE=INNODB;

CREATE TABLE `signed_event_links` (
  `linkid`        	mediumint(33) unsigned  NOT NULL auto_increment,
  `group`    		varchar(42)             NOT NULL default '',
  `when`     		int(13) unsigned        NOT NULL default '0',
  `signid`      	mediumint(12) unsigned  NOT NULL default '0',
  `eventid`        	mediumint(19) unsigned  NOT NULL default '0',
  PRIMARY KEY  (`linkid`)
) ENGINE=INNODB;

