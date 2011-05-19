
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- ability
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `ability`;


CREATE TABLE `ability`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`textIT` TEXT  NOT NULL,
	`textEN` TEXT  NOT NULL,
	`RegEx` TEXT  NOT NULL,
	`descriptionIT` VARCHAR(255)  NOT NULL,
	`descriptionEN` VARCHAR(255)  NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM;

#-----------------------------------------------------------------------------
#-- abscript
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `abscript`;


CREATE TABLE `abscript`
(
	`ability` VARCHAR(1000)  NOT NULL,
	`sample` TEXT  NOT NULL,
	PRIMARY KEY (`ability`)
) ENGINE=MyISAM;

#-----------------------------------------------------------------------------
#-- books
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `books`;


CREATE TABLE `books`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`playerid` INTEGER(11)  NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM;

#-----------------------------------------------------------------------------
#-- cardabilities
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `cardabilities`;


CREATE TABLE `cardabilities`
(
	`cardcode` VARCHAR(255)  NOT NULL,
	`abilityid` INTEGER(11)  NOT NULL,
	PRIMARY KEY (`cardcode`,`abilityid`)
) ENGINE=MyISAM;

#-----------------------------------------------------------------------------
#-- cards
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `cards`;


CREATE TABLE `cards`
(
	`id` VARCHAR(255)  NOT NULL,
	`setid` VARCHAR(255)  NOT NULL,
	`nameEN` VARCHAR(255)  NOT NULL,
	`nameIT` VARCHAR(255)  NOT NULL,
	`color` VARCHAR(255)  NOT NULL,
	`textEN` TEXT  NOT NULL,
	`typeIT` VARCHAR(255)  NOT NULL,
	`cost` VARCHAR(255)  NOT NULL,
	`convertedCost` VARCHAR(255)  NOT NULL,
	`typeEN` VARCHAR(255)  NOT NULL,
	`textIT` TEXT  NOT NULL,
	`FC` VARCHAR(255)  NOT NULL,
	`rarity` VARCHAR(255)  NOT NULL,
	`flavor` TEXT  NOT NULL,
	`artist` VARCHAR(255)  NOT NULL,
	`script` TEXT  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `cardNameIT`(`nameIT`),
	KEY `cardNameEN`(`nameEN`),
	KEY `cost`(`cost`),
	KEY `textIT`(`textIT`)
) ENGINE=MyISAM;

#-----------------------------------------------------------------------------
#-- cards_copy
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `cards_copy`;


CREATE TABLE `cards_copy`
(
	`id` VARCHAR(255)  NOT NULL,
	`setid` VARCHAR(255)  NOT NULL,
	`nameEN` VARCHAR(255)  NOT NULL,
	`nameIT` VARCHAR(255)  NOT NULL,
	`color` VARCHAR(255)  NOT NULL,
	`typeIT` VARCHAR(255)  NOT NULL,
	`cost` VARCHAR(255)  NOT NULL,
	`textEN` TEXT  NOT NULL,
	`textIT` TEXT  NOT NULL,
	`FC` VARCHAR(255)  NOT NULL,
	`rarity` VARCHAR(255)  NOT NULL,
	`flavor` TEXT  NOT NULL,
	`artist` VARCHAR(255)  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `cardNameIT`(`nameIT`),
	KEY `cardNameEN`(`nameEN`),
	KEY `cost`(`cost`),
	KEY `textIT`(`textIT`)
) ENGINE=MyISAM;

#-----------------------------------------------------------------------------
#-- cardsbook
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `cardsbook`;


CREATE TABLE `cardsbook`
(
	`id` INTEGER(11)  NOT NULL,
	`bookid` INTEGER(11)  NOT NULL,
	`cardid` CHAR(255)  NOT NULL,
	`qta` INTEGER(11)  NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM;

#-----------------------------------------------------------------------------
#-- magic_cards
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `magic_cards`;


CREATE TABLE `magic_cards`
(
	`Nome_Carta` VARCHAR(255)  NOT NULL,
	`Colore` VARCHAR(255)  NOT NULL,
	`Tipo` VARCHAR(255)  NOT NULL,
	`Costo` VARCHAR(255)  NOT NULL,
	`F_C` VARCHAR(255)  NOT NULL,
	`Testo` TEXT  NOT NULL,
	`Set` VARCHAR(255)  NOT NULL,
	`Rarita` VARCHAR(255)  NOT NULL,
	`Cod_Carta` VARCHAR(255)  NOT NULL,
	`English` VARCHAR(255)  NOT NULL,
	PRIMARY KEY (`Cod_Carta`)
) ENGINE=MyISAM;

#-----------------------------------------------------------------------------
#-- players
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `players`;


CREATE TABLE `players`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`username` CHAR(255)  NOT NULL,
	`password` CHAR(255)  NOT NULL,
	`email` CHAR(255)  NOT NULL,
	`exp` DECIMAL(20,0) default 0 NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `username` (`username`),
	UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM;

#-----------------------------------------------------------------------------
#-- sets
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sets`;


CREATE TABLE `sets`
(
	`id` VARCHAR(10)  NOT NULL,
	`name` VARCHAR(255)  NOT NULL,
	`date` DECIMAL(6,0)  NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
