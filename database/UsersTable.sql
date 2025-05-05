CREATE TABLE IF NOT EXISTS Users (
    UserID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    userName varchar(255)  NOT NULL,
    userEmail varchar(255)  NOT NULL,
    loginName varchar(255)  NOT NULL,
    userPassword varchar(255)  NOT NULL
);