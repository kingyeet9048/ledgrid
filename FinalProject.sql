
CREATE SCHEMA IF NOT EXISTS BillBoard;
USE BillBoard;

-- DROP TABLE IF EXISTS students ;
-- DROP TABLE IF EXISTS major ;
-- DROP TABLE IF EXISTS faculty ;
-- DROP TABLE IF EXISTS department ;
-- DROP TABLE IF EXISTS administrator ;
-- DROP TABLE IF EXISTS user_Messages ;
-- DROP TABLE IF EXISTS last_SignIn ;
-- DROP TABLE IF EXISTS all_users;

CREATE TABLE `all_users` (
  `starID` varchar(255) PRIMARY KEY,
  `lastName` varchar(255),
  `firstName` varchar(255),
  `email` varchar(255)
);


CREATE TABLE `students` (
  `ID` int PRIMARY KEY AUTO_INCREMENT,
  `majorID` int,
  `starID` varchar(255)
);

CREATE TABLE `major` (
  `ID` int PRIMARY KEY,
  `majorName` varchar(255),
  `departmentID` int
);


CREATE TABLE `faculty` (
  `ID` int PRIMARY KEY AUTO_INCREMENT,
  `departmentID` int,
  `starID` varchar(255)
);


CREATE TABLE `department` (
  `ID` int PRIMARY KEY,
  `departmentName` varchar(255)
);


CREATE TABLE `administrator` (
  `ID` int PRIMARY KEY,
  `starID` varchar(255),
  `role` varchar(255)
);


CREATE TABLE `user_Messages` (
  `ID` int PRIMARY KEY AUTO_INCREMENT,
  `message` varchar(255),
  `starID` varchar(255),
  `datetime` timestamp
);


CREATE TABLE `last_SignIn` (
  `ID` int PRIMARY KEY AUTO_INCREMENT,
  `starID` varchar(255),
  `datetime` timestamp
);


ALTER TABLE `students` ADD FOREIGN KEY (`majorID`) REFERENCES `major` (`ID`);

ALTER TABLE `major` ADD FOREIGN KEY (`departmentID`) REFERENCES `department` (`ID`);

ALTER TABLE `faculty` ADD FOREIGN KEY (`departmentID`) REFERENCES `department` (`ID`);

ALTER TABLE `students` ADD FOREIGN KEY (`starID`) REFERENCES `all_users` (`starID`);

ALTER TABLE `faculty` ADD FOREIGN KEY (`starID`) REFERENCES `all_users` (`starID`);

ALTER TABLE `administrator` ADD FOREIGN KEY (`starID`) REFERENCES `all_users` (`starID`);

ALTER TABLE `user_Messages` ADD FOREIGN KEY (`starID`) REFERENCES `all_users` (`starID`);

ALTER TABLE `last_SignIn` ADD FOREIGN KEY (`starID`) REFERENCES `all_users` (`starID`);

