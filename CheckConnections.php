<!DOCTYPE HTML>

<!------------------------------------------------------
				Prologue - CheckConnections.php			
This is the html doc for the Check Connections page of the FoxHunt Lost and Found website 
It contains simple functionality that links it to the other pages of the site
as well as making sure that the user is able to properly connect to site_db

				Change Log - CheckConnections.php
V01 : 10/1/19 : Original code created 
V02 : 10/8/19 : Change log and Prologue added

-------------------------------------------------------->

<html>

<!--Here I am adding a title for the page-->
<title>
	Checking Connection
</title>
	
<head> 
	
	<!--Section that contains all the stlye/formats of the page NOTE ADDING COMMENTS TO STYLE SECTION MESSES IT UP-->
	<style>
		h1 {
			color:white;
		}
		p {color:white;}

		table {border-collapse:collapse;}
	
		body {
			background-color: white;
			text-align:center;
			font-family: Georgia;
		}

		.box1 {
			width: 1000px;
			padding: 10px;
			border: 2px solid #000;
			border-radius: 15px;
			-moz-border-radius: 15px;
			background-color: #c23b22;
			display: inline-block;
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

	</style>

</head>


<body>
    <?php
    session_start();   
    $_SESSION["loginstatus"]="NOT LOGGED IN";
    ?>
    
	<!--Inserting logo into upper corners of page-->
	<img src= "FoxHuntLogo.png" width="110" height ="100" align=left>
	<img src= "FoxHuntLogo.png" width="110" height ="100" align=right>
	
	
	<div class = "center">
	<!--Creating a div with a class called box1 to be able to apply the box and style-->
	<div class="box1">
		<h1> Testing Connections Page </h1>
	</div>
	</div>

	<!--Adding breaks to space things out on page-->
	<br></br>

	<!--PhP code to run the connection_db.php file and test if the user can connect to the server-->
	<?php #attempting to connect to the database.

		echo"<sl>";
	
		require ("..\..\connect_db.php");
		
		echo "You are Connected";
	
	?>

	<!--Inserting breaks to create space for appearance on page-->
	<br>
	</br>
	<br>
	</br>

	<div class = "center">
	
	
	<!--Opening up a footer to put the hyperlinks, this seperates the links from the rest of the page and will keep them at the bottom and centered always-->
	<footer>
		<!--Creating a div with a class called box2 to be able to apply the box and style-->
		<div class = "box2">
				<p>
					<a href="Team8.php" style = "color:white" class = "button2 button4">View Landing Page</a>

					<a href="adminLogin.php" style = "color:white" class = "button2 button4">View Adminstrator Functions Page</a>
				</p>	
		</div>
	</footer>
	</div>
	
	<?php
		INCLUDE "version.php";
	?> 
</body>

</html>

