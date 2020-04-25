/*------------------------------------------------------
				Prologue - Team8Tables.sql		
This is the SQL doc containing the SQL code for creating the user, building, and item's tables 
Uses site_db
as well as making sure that the user is able to properly connect to site_db

				Change Log - CheckConnections.php
V0.1 : 9/25/19 : Original code created 
V0.2 : 10/7/19 : Added prologue and changelog, added ENUM characteristic to users table to new Status field as found or lost or matched,
				added a 'matched item' field which would be an integer, and set to the id of matched item

--------------------------------------------------------*/


/*
Making sure that the local host is used.
*/
USE site_db;

/*
Dropping the tables that are being added to prevent the creation of duplicates.
*/

DROP TABLE IF EXISTS 8Users;
DROP TABLE IF EXISTS 8Building;
DROP TABLE IF EXISTS 8Items;

/*Creating and Inserting Data into Users Table*/

CREATE TABLE IF NOT EXISTS 8Users(id INT AUTO_INCREMENT PRIMARY KEY, 
CWID INT NOT NULL, 
First_Name TEXT NOT NULL, 
Last_Name TEXT NOT NULL, 
email TEXT NOT NULL, 
pass TEXT NOT NULL);

/*
Nicholas Ruiz's CWID, email, and password
*/
INSERT INTO 8Users (CWID, First_Name, Last_Name,email,pass) VALUES (20090158,"Nicholas","Ruiz",
"Nicholas.Ruiz1@Marist.edu", "password");

/*
Robert Perrone's CWID, email, and password
*/

INSERT INTO 8Users (CWID, First_Name, Last_Name,email,pass) VALUES (20095516,"Robert","Perrone",
"Robert.Perrone1@Marist.edu", "password");

/*
Charles Schmitz's CWID, email, and password
*/

INSERT INTO 8Users (CWID, First_Name, Last_Name,email,pass) VALUES (20097132,"Charles","Schmitz",
"Charles.Schmitz2@Marist.edu", "password");

/*
Andrew Tokash's CWID, email, and password
*/

INSERT INTO 8Users (CWID, First_Name, Last_Name,email,pass) VALUES (10097162,"Andrew","Tokash",
"Andrew.Tokash@Marist.edu","password");

/*Creating and Inserting Data into Building Table*/

CREATE TABLE IF NOT EXISTS 8Building( numFloors INT NOT NULL, buildingName TEXT NOT NULL);

/*Cannavino Library(3), Donnely Hall(2), Dyson Center(2), Fontaine Hall(2), Hancock Center (3), Lowell Thomas(2), McCann Center(2), Steel Plant Studios and Gallery (?),
Murray Student Center(3) are all created as buildings for the database*/

INSERT INTO 8Building (numFloors, buildingName) VALUES (3, "Hancock");
INSERT INTO 8Building (numFloors, buildingName) VALUES (3, "Cannavino Library");
INSERT INTO 8Building (numFloors, buildingName) VALUES (2, "Donnely Hall");
INSERT INTO 8Building (numFloors, buildingName) VALUES (2, "Dyson Center");
INSERT INTO 8Building (numFloors, buildingName) VALUES (2, "Fontaine Hall");
INSERT INTO 8Building (numFloors, buildingName) VALUES (2, "Lowell Thomas");
INSERT INTO 8Building (numFloors, buildingName) VALUES (2, "McCann Center");
INSERT INTO 8Building (numFloors, buildingName) VALUES (2,"Steel Plant Studios and Gallery");
INSERT INTO 8Building (numFloors, buildingName) VALUES (3, "Murray Student Center");


/*Creating and Inserting Data into Items Table*/
CREATE TABLE IF NOT EXISTS 8Items (ItemNumber INT AUTO_INCREMENT PRIMARY KEY, ItemName VARCHAR(30) NOT NULL, ItemType VARCHAR(30) NOT NULL, ItemDescription VARCHAR(280) NOT NULL, BuildingFound VARCHAR(25), ItemStatus ENUM('Found', 'Lost', 'Lost-Matched','Found-Matched') NOT NULL, timeMatched TEXT NOT NULL);

/*
Some example descriptions of possible items that could be in this table.
*/

INSERT INTO 8Items (ItemName, ItemType, ItemDescription, BuildingFound, ItemStatus, timeMatched) VALUES ("Dorito Bag","Other","Blue, family sized bag of doritos. Has writing on the back that reads 'Have a good day, sweetie'.", "Dyson Center", "Lost", "0000-00-00 00:00:00");
INSERT INTO 8Items (ItemName, ItemType, ItemDescription, BuildingFound, ItemStatus, timeMatched) VALUES ("iPhone", "Electronic", "iPhone XR model.  It is blue with a clear case and a lockscreen of a puppy.", "Hancock", "Lost", "0000-00-00 00:00:00");
INSERT INTO 8Items (ItemName, ItemType, ItemDescription, BuildingFound, ItemStatus,timeMatched) VALUES ("iPhone", "Electronic", "iPhone XR model.  It is blue with a clear case and a lockscreen of a puppy.", "Hancock", "Found", "0000-00-00 00:00:00");
INSERT INTO 8Items (ItemName, ItemType, ItemDescription, BuildingFound, ItemStatus,timeMatched) VALUES ("Laptop", "Electronic","A Lenovo ThinkPad T480s.  It has no stickers and a blue lockscreen that requires a password.", "Donnely Hall", "Lost", "0000-00-00 00:00:00");
INSERT INTO 8Items (ItemName, ItemType, ItemDescription, BuildingFound, ItemStatus,timeMatched) VALUES ("Pen", "Other","I lost my favorite pen, it has my name 'Andrew Tokash' engraved on it. It is my favorite pen and I miss it dearly.", "Hancock", "lost", "0000-00-00 00:00:00");
INSERT INTO 8Items (ItemName, ItemType, ItemDescription, BuildingFound, ItemStatus,timeMatched) VALUES ("Pen", "Other","A fancy pen (probably someone's favorite pen) that has the name 'Andrew Tokash' engraved on it.", "Hancock", "Found", "0000-00-00 00:00:00");
