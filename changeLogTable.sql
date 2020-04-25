/*
Making sure that the local host is used.
*/
USE site_db;

/*
Dropping the tables that are being added to prevent the creation of duplicates.
*/

DROP TABLE IF EXISTS changeLogTable;


/*Creating and Inserting Data into Users Table*/

CREATE TABLE IF NOT EXISTS changeLogTable(version DOUBLE NOT NULL, 
dateOfChange DATE NOT NULL, 
changer TEXT NOT NULL,  
changeText TEXT NOT NULL);

/*
Creating and inserting data into table
*/
INSERT INTO changeLogTable(version, dateOfChange, changer, changeText) 
VALUES (1.0, "2019-10-14","Charlie", "We are Creating a Change Log Table");