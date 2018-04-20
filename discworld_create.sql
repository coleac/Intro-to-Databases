

DROP TABLE IF EXISTS `Locations_Characters`;
DROP TABLE IF EXISTS `Books_Characters`;
DROP TABLE IF EXISTS `Characters`;
DROP TABLE IF EXISTS `Vocations`;
DROP TABLE IF EXISTS `Species`;
DROP TABLE IF EXISTS `Locations`;
DROP TABLE IF EXISTS `Books`;




CREATE TABLE Vocations (
 Id int(11) NOT NULL AUTO_INCREMENT,
 Title varchar(255) NOT NULL,
 Duties text,
 PRIMARY KEY(Id),
 UNIQUE KEY(Title)
)ENGINE=InnoDB;

CREATE TABLE Species (
 Id int(11) NOT NULL AUTO_INCREMENT,
 Name varchar(255) NOT NULL,
 Characteristics text,
 PRIMARY KEY(Id),
 UNIQUE KEY(Name)
)ENGINE=InnoDB;

CREATE TABLE Characters (
 Id int(11) NOT NULL AUTO_INCREMENT,
 Fname varchar(255) NOT NULL,
 Lname varchar(255),
 Species int(11) NOT NULL,
 Vocation int(11) NOT NULL,
 PRIMARY KEY(Id),
 FOREIGN KEY(Species) REFERENCES Species(Id),
 FOREIGN KEY(Vocation) REFERENCES Vocations(Id)
)ENGINE=InnoDB;

CREATE TABLE Locations (
 Id int(11) NOT NULL AUTO_INCREMENT,
 Name varchar(255) NOT NULL,
 Ruler varchar(255) NOT NULL,
 PRIMARY KEY(Id),
 UNIQUE KEY(Name)
)ENGINE=InnoDB;

CREATE TABLE Books (
 Id int(11) NOT NULL AUTO_INCREMENT,
 Title varchar(255) NOT NULL,
 Date year NOT NULL,
 PRIMARY KEY(Id),
 UNIQUE KEY(Title)
)ENGINE=InnoDB;

CREATE TABLE Books_Characters (
 BId int(11) NOT NULL,
 CId int (11) NOT NULL,
 PRIMARY KEY(BId, CId),
 FOREIGN KEY(BId) REFERENCES Books(Id),
 FOREIGN KEY(CId) REFERENCES Characters(Id)
 ON DELETE CASCADE
)ENGINE=InnoDB;

CREATE TABLE Locations_Characters (
 LId int(11) NOT NULL,
 CId int(11) NOT NULL,
 PRIMARY KEY(LId, CId),
 FOREIGN KEY(LId) REFERENCES Locations(Id),
 FOREIGN KEY(CId) REFERENCES Characters(Id)
 ON DELETE CASCADE
)ENGINE=InnoDB;
 
 
 

