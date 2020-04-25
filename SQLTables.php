<!DOCTYPE HTML>

<!------------------------------------------------------
				Prologue - SQLTables.php		
This is the php doc for the tables page of the FoxHunt Lost and Found website 
It contains simple functionality that links it back to the Miscellaneous page
and contains the logo in the upper corners as well.

				Change Log - Misc.php
V0.1 : 10/7/19 : Original code created 
V0.2 : 10/21/19 : Updated code with display table function


-------------------------------------------------------->

<! Showing MySQL tables for Team 8  >

<html lang = "en">
<head>
	<meta charset = "UTF-8">

	<title> Database Tables </title>
	
	<style>
		h1 {color:white;}
		
		body {
			background-color: white;
			text-align:center;
			font-family: Georiga;
		}
		
		.box1 {
			width: 1200px;
			padding: 10px;
			border: 2px solid #000;
			border-radius: 15px;
			-moz-border-radius: 15px;
			background-color: #c23b22;
			display: inline-block				
		}
		
		.box2 {
			width: 350px;
			padding: 1px;
			border: 2px solid #000;
			border-radius: 15px;
			-moz-border-radius: 15px;
			background-color: #c23b22;
			display: inline-block;
			}
			
		.box4 {
			width: 350px;
			padding: 1px;	
			display: inline-block;
			}
		
		.center {
			text-align: center;
		}
        .button2 {
          background-color: #4CAF50; /* Green */
          border: none;
          color: white;
          padding: 16px 32px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 15px;
          margin: 4px 2px;
          -webkit-transition-duration: 0.4s; 
          transition-duration: 0.4s;
          cursor: pointer;
        }
        .button4 {
          background-color: #c23b22;
          color: black;
          border: 1px solid transparent;
        }

        .button4:hover {background-color: #ba3720;}
        
        
         .button {
            background-color: #4CAF50; 
            border: none;
            color: white;
              padding: 10px 20px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 15px;
              margin: 4px 2px;
              -webkit-transition-duration: 0.4s; 
              transition-duration: 0.4s;
              cursor: pointer;
        }
        .button5 {
            background-color: white;
            color: black;
            border: 2px solid #e7e7e7;
        }
        .button5:hover {background-color: #e7e7e7;}
	</style>
</head>

<body>

	<!--This section is putting two small images of the logo into both corners of the page-->
	<img src= "FoxHuntLogo.png" width="110" height ="100" align=left>
	<img src= "FoxHuntLogo.png" width="110" height ="100" align=right>

	<div class="box1">
		<h1 > Database Tables </h1>
	</div>
	
	<br></br>
	
	<div align = "center">
	
	
	<?php

/****************NEW CODE FOR DISPLAYING ALL THE TABLES FOR SITE_DB*************************************/

	/* First just connect to the database. */
	require ("..\..\connect_db.php");
	
	
	
	//Variable array cotaining tables we need for project
	$tables = array('8Users','8Building','8Items','changeLogTable');

	//$tables = $_.Get["option"];
	
	
	
	//for loop for displaying all tables in array
	for($i = 0; $i < count($tables); $i++) 
	{
		display_table($tables[$i],$dbc);
	}
	
	
	
	//Display the format of each table by running a function for row
	function display_table($tables,$dbc)
	{
		
		$q  = 'EXPLAIN '.$tables.";";
		$r2 = mysqli_query($dbc,$q);
		

		if($r2)
		{
			/* Gathering all the info for table and creating table to put explain data into HTML style table */
			echo "<ul>";		
			echo"<table>";
		
			/* Format the table headers and also the table itself and the data going into the table */
				echo '<a class = "button button5" href = DisplayTables.php?Option='.$tables.'>'.$tables.' :</a>';
				echo "<br></br>";
			
				echo "<table border=1>";
				echo "<tr>";
				echo "<th>Column Name </th>";
				echo "<th>Data Type</th>";
				echo "<th>Modifiers</th>";
				echo "</tr>";
			
				while($row2 = mysqli_fetch_array($r2,MYSQLI_BOTH ))
				{
					echo "<tr>";
					echo '<td>'.$row2[0].'</td>';
					echo '<td>'.$row2[1].'</td>';
					echo '<td>'.$row2[2].'';
					echo ' '.$row2[3].' ';
					echo ' '.$row2[4].' ';
					echo ' '.$row2[5].'</td>';
					echo "</tr>";
				}
		
			echo "</table>";
			echo"</ul>";
		}//if
	}//display_table

/*****************************************************/
	
	?>
	</div>
    <br></br>
	<!--Creating a div with a class called box2 to be able to apply the box and style-->
	<div class = "center">
		<div class = "box2">
			<p>
				<a href="admin.php" style = "color:white" class = "button2 button4">Return to Adminstrator Functions  Page</a>
			</p>
		</div>
			<p>
				<?php
					INCLUDE "version.php";
				?>
			</p>
	</div>
	




	
	
</body>

</html>