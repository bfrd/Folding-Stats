/*Table structure for table `fah_memberstats` */

DROP TABLE IF EXISTS `fah_memberstats`;

CREATE TABLE `fah_memberstats` (
  `frank` BIGINT DEFAULT NULL,
  `fteamrank` BIGINT DEFAULT NULL,
  `name` VARCHAR(300) NOT NULL DEFAULT '',
  `fcredit` BIGINT DEFAULT NULL,
  `ftotal` BIGINT DEFAULT NULL,
  `fupdate` INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `ffiledate` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lrank` DOUBLE DEFAULT NULL,
  `lteamrank` DOUBLE DEFAULT NULL,
  `lcredit` BIGINT DEFAULT NULL,
  `ltotal` BIGINT DEFAULT NULL,
  `lupdate` INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `lfiledate` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cmonth1` BIGINT DEFAULT '0',
  `cmonth2` BIGINT DEFAULT '0',
  `cmonth3` BIGINT DEFAULT '0',
  `cmonth4` BIGINT DEFAULT '0',
  `cmonth5` BIGINT DEFAULT '0',
  `cmonth6` BIGINT DEFAULT '0',
  `cmonth7` BIGINT DEFAULT '0',
  `cmonth8` BIGINT DEFAULT '0',
  `cmonth9` BIGINT DEFAULT '0',
  `cmonth10` BIGINT DEFAULT '0',
  `cmonth11` BIGINT DEFAULT '0',
  `cmonth12` BIGINT DEFAULT '0',
  `tmonth1` BIGINT DEFAULT '0',
  `tmonth2` BIGINT DEFAULT '0',
  `tmonth3` BIGINT DEFAULT '0',
  `tmonth4` BIGINT DEFAULT '0',
  `tmonth5` BIGINT DEFAULT '0',
  `tmonth6` BIGINT DEFAULT '0',
  `tmonth7` BIGINT DEFAULT '0',
  `tmonth8` BIGINT DEFAULT '0',
  `tmonth9` BIGINT DEFAULT '0',
  `tmonth10` BIGINT DEFAULT '0',
  `tmonth11` BIGINT DEFAULT '0',
  `tmonth12` BIGINT DEFAULT '0',
  `iline` DOUBLE DEFAULT '0',
  `CurrentDayCredit` BIGINT DEFAULT '0',
  `CurrentDayTotal` BIGINT DEFAULT '0',
  `CurrentMonthCredit` BIGINT DEFAULT '0',
  `CurrentMonthTotal` BIGINT DEFAULT '0',
  PRIMARY KEY  (`name`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

/*Table structure for table `fah_memberstats_incoming` */

DROP TABLE IF EXISTS `fah_memberstats_incoming`;

CREATE TABLE `fah_memberstats_incoming` (
  `frank` BIGINT DEFAULT NULL,
  `fteamrank` BIGINT DEFAULT NULL,
  `name` VARCHAR(300) DEFAULT NULL,
  `fcredit` BIGINT DEFAULT NULL,
  `ftotal` BIGINT DEFAULT NULL,
  `fupdate` BIGINT DEFAULT NULL,
  `ffiledate` DATETIME DEFAULT NULL,
  `lrank` BIGINT DEFAULT NULL,
  `lteamrank` BIGINT DEFAULT NULL,
  `lcredit` BIGINT DEFAULT NULL,
  `ltotal` BIGINT DEFAULT NULL,
  `lupdate` BIGINT DEFAULT NULL,
  `lfiledate` DATETIME DEFAULT NULL,
  `cmonth1` BIGINT DEFAULT '0',
  `cmonth2` BIGINT DEFAULT '0',
  `cmonth3` BIGINT DEFAULT '0',
  `cmonth4` BIGINT DEFAULT '0',
  `cmonth5` BIGINT DEFAULT '0',
  `cmonth6` BIGINT DEFAULT '0',
  `cmonth7` BIGINT DEFAULT '0',
  `cmonth8` BIGINT DEFAULT '0',
  `cmonth9` BIGINT DEFAULT '0',
  `cmonth10` BIGINT DEFAULT '0',
  `cmonth11` BIGINT DEFAULT '0',
  `cmonth12` BIGINT DEFAULT '0',
  `tmonth1` BIGINT DEFAULT '0',
  `tmonth2` BIGINT DEFAULT '0',
  `tmonth3` BIGINT DEFAULT '0',
  `tmonth4` BIGINT DEFAULT '0',
  `tmonth5` BIGINT DEFAULT '0',
  `tmonth6` BIGINT DEFAULT '0',
  `tmonth7` BIGINT DEFAULT '0',
  `tmonth8` BIGINT DEFAULT '0',
  `tmonth9` BIGINT DEFAULT '0',
  `tmonth10` BIGINT DEFAULT '0',
  `tmonth11` BIGINT DEFAULT '0',
  `tmonth12` BIGINT DEFAULT '0',
  `iline` BIGINT DEFAULT NULL
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

/*Table structure for table `fah_team` */

DROP TABLE IF EXISTS `fah_team`;

CREATE TABLE `fah_team` (
  `teamid` INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `fteamrank` BIGINT DEFAULT NULL,
  `teamname` VARCHAR(100) NOT NULL DEFAULT '',
  `fscore` BIGINT DEFAULT NULL,
  `fwu` BIGINT DEFAULT NULL,
  `fupdate` INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `ffiledate` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lteamrank` INT(10) DEFAULT NULL,
  `lscore` BIGINT UNSIGNED DEFAULT NULL,
  `lwu` BIGINT DEFAULT NULL,
  `lupdate` INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `lfiledate` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY  (`teamid`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `fah_userXref`;

CREATE TABLE fah_userXref ( 
	`userid` INT, 
	`foldingname` MEDIUMTEXT 
) ENGINE=MYISAM DEFAULT CHARSET=latin1;
