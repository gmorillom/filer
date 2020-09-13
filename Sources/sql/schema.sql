CREATE DATABASE IF NOT EXISTS `filer2`;
USE `filer2`;

CREATE TABLE IF NOT EXISTS `Users`(
	`id` INT(8) NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(45) NOT NULL UNIQUE,
	`email` VARCHAR(45) NOT NULL UNIQUE,
	`password` VARCHAR(150) NOT NULL,
	`level` ENUM("Root","Admin","Client") NOT NULL,
	`dirname` VARCHAR(50) UNIQUE,
	PRIMARY KEY(id)
) ENGINE=InnoDB CHARSET=UTF8;

CREATE TABLE IF NOT EXISTS `AccessBooking`(
	`id` INT(14) NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(45) NOT NULL,
	`access` DATETIME NOT NULL,
	PRIMARY KEY(id)
) ENGINE=InnoDB CHARSET=UTF8;

CREATE TABLE IF NOT EXISTS `Files`(
	`id` INT(20) NOT NULL AUTO_INCREMENT,
	`filename` VARCHAR(100) NOT NULL,
	`dirname` VARCHAR(50) NOT NULL,
	`created` DATE NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(dirname) REFERENCES Users(dirname) ON DELETE CASCADE 
) ENGINE=InnoDB CHARSET=UTF8;

INSERT INTO Users(username,email,password,level,dirname) VALUES ("Shinigami","shinigami@gmail.com","$argon2i$v=19$m=65536,t=4,p=1$dVU2MFp5VjVVeUJuaHpmWg$gdiiqvZfBxVqxzrqhaqPzmqoswqTZAPbLYVJEKBpDi0",1,"ude3921bde19ue");

