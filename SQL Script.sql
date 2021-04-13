
CREATE SCHEMA IF NOT EXISTS billboard;
USE billboard;

DROP TABLE IF EXISTS students ;
DROP TABLE IF EXISTS major ;
DROP TABLE IF EXISTS faculty ;
DROP TABLE IF EXISTS department ;
DROP TABLE IF EXISTS user_Messages ;
DROP TABLE IF EXISTS login ;
DROP TABLE IF EXISTS all_users;

CREATE TABLE `all_users` (
  `starID` varchar(8) PRIMARY KEY UNIQUE,
  `lastName` varchar(255),
  `firstName` varchar(255),
  `role` varchar(14),
  `email` varchar(255)
);


CREATE TABLE `students` (
  `ID` int PRIMARY KEY AUTO_INCREMENT,
  `majorID` int,
  `starID` varchar(8)
);

CREATE TABLE `major` (
  `ID` int PRIMARY KEY AUTO_INCREMENT,
  `majorName` varchar(255) UNIQUE,
  `departmentID` int
);


CREATE TABLE `faculty` (
  `ID` int PRIMARY KEY AUTO_INCREMENT,
  `departmentID` int,
  `starID` varchar(8)
);


CREATE TABLE `department` (
  `ID` int PRIMARY KEY AUTO_INCREMENT UNIQUE,
  `departmentName` varchar(255) UNIQUE
);

CREATE TABLE `user_Messages` (
  `ID` int PRIMARY KEY AUTO_INCREMENT,
  `messageTop` varchar(1000),
  `messageMiddle` varchar(1000),
  `messageBottom` varchar(1000),
  `starID` varchar(8),
  `date_Time` timestamp
);


CREATE TABLE `login` (
	`ID` int PRIMARY KEY AUTO_INCREMENT,
	`starID` varchar(8),
	`userName` varchar(255) UNIQUE,
	`password` varchar(500),
	`datetime` timestamp
);


ALTER TABLE `students` ADD FOREIGN KEY (`majorID`) REFERENCES `major` (`ID`);

ALTER TABLE `major` ADD FOREIGN KEY (`departmentID`) REFERENCES `department` (`ID`);

ALTER TABLE `faculty` ADD FOREIGN KEY (`departmentID`) REFERENCES `department` (`ID`);

ALTER TABLE `students` ADD FOREIGN KEY (`starID`) REFERENCES `all_users` (`starID`);

ALTER TABLE `faculty` ADD FOREIGN KEY (`starID`) REFERENCES `all_users` (`starID`);

ALTER TABLE `user_Messages` ADD FOREIGN KEY (`starID`) REFERENCES `all_users` (`starID`);

ALTER TABLE `login` ADD FOREIGN KEY (`starID`) REFERENCES `all_users` (`starID`);

DELIMITER $$
CREATE PROCEDURE `insertAUser`(
IN star_ID VARCHAR(8), 
IN lName VARCHAR (255), 
IN fName VARCHAR (255), 
IN role VARCHAR (14), 
IN email VARCHAR (255),
IN uName VARCHAR (255), 
IN pWord VARCHAR(255)
)
BEGIN

SET time_zone = '-05:00';
    INSERT INTO billboard.all_users (starID, lastName, firstName, role, email )
    VALUES (star_ID, lName, fName, role, email);

    INSERT INTO billboard.login (starID, userName, password, datetime)
    VALUES (star_ID, uName, pWord, NOW());
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `insertDepartment`(IN department VARCHAR(255))
BEGIN
    INSERT INTO billboard.department (departmentName) VALUES (department);
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `insertFaculty`(IN deptName VARCHAR (255),IN star_ID VARCHAR (8))
BEGIN

INSERT INTO billboard.faculty (departmentID, starID) 
VALUES ((SELECT ID FROM billboard.department WHERE departmentName = deptName), star_ID);


END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `insertMajor`(IN mName VARCHAR (255), IN deptID INT)
BEGIN

INSERT INTO billboard.major (majorName, departmentID)
VALUES (mName, deptID);

END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `insertStudent`(IN mName VARCHAR (255), IN star_ID VARCHAR (8))
BEGIN

INSERT INTO billboard.students (majorID, starID)
VALUES ((SELECT ID FROM billboard.major WHERE majorName = mName), star_ID);

END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `insertUser`(
IN star_ID VARCHAR(8), 
IN lName VARCHAR (255), 
IN fName VARCHAR (255), 
IN role VARCHAR (14), 
IN email VARCHAR (255),
IN uName VARCHAR (255), 
IN pWord VARCHAR(255)
)
BEGIN

SET time_zone = '-05:00';
    INSERT INTO billboard.all_users (starID, lastName, firstName, role, email )
    VALUES (star_ID, lName, fName, role, email);

    INSERT INTO billboard.login (starID, userName, password, datetime)
    VALUES (star_ID, uName, pWord, NOW());
END$$
DELIMITER ;

DELIMITER $$

CREATE PROCEDURE `insertUserMessages`(IN messageTop VARCHAR (1000),IN messageMiddle VARCHAR (1000),IN messageBottom VARCHAR (1000),IN star_ID VARCHAR(8))
BEGIN
SET time_zone = '-05:00';
INSERT INTO billboard.user_Messages (messageTop, messageMiddle, messageBottom, starID, date_Time)
VALUES (messageTop, messageMiddle, messageBottom, star_ID, NOW());

END$$
DELIMITER ;






