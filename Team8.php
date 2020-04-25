<!DOCTYPE html>

<!------------------------------------------------------
				Prologue - Team8.php			
This is the html doc for the landing page of the FoxHunt Lost and Found website 
It contains simple functionality that links it to the other pages of the site
and contains the logo and welcome text.

				Change Log - Team8.php
V01 : 10/1/19 : Original code created 
V02 : 10/8/19 : Change log and Prologue added, font changed, center changed to text-align

-------------------------------------------------------->


<html>

<!--Adding title "FoxHunt" to the page-->
<title> 
	FoxHunt
</title>

<head>
	<!--Section that contains all the stlye/formats of the page NOTE ADDING COMMENTS TO STYLE SECTION MESSES IT UP-->
	<style>
		h1 {color:white;}

		table {border-collapse:collapse;}
	
		body {
			background-color: white;
			text-align:center;
			font-family: Georiga; 
		}
	
		.box1 {
			width: 1450px;
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
		.box3 {
			width: 350px;
			padding: 1px;
			border: 2px solid #000;
			border-radius: 15px;
			-moz-border-radius: 15px;
			background-color: #696969;
			display: inline-block;
		}
		
		.center {
			text-align: center;
		}
        .button {
              border-radius: 4px;
              background-color: ;
              border: 1px solid #e7e7e7;
              color: black;
              text-align: center;
              font-size: 20px;
              padding: 10px;
              width: 200px;
              transition: all 0.5s;
              cursor: pointer;
              margin: 5px;
         }

        .button span {
              cursor: pointer;
              display: inline-block;
              position: relative;
              transition: 0.5s;
        }

        .button span:after {
              content: '\00bb';
              position: absolute;
              opacity: 0;
              top: 0;
              right: -20px;
              transition: 0.5s;
        }

        .button:hover span {
              padding-right: 25px;
         }

        .button:hover span:after {
              opacity: 1;
              right: 0;
        }
        .menuBox {
			width: 250px;
			padding: 1px;
			border: 1px solid transparent;
			border-radius: 15px;
			-moz-border-radius: 15px;
			display: inline-block;
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
    //Loading Source file and building tables?
    ?>
	<!--Creating a div with a class called box1 to be able to apply the box and style-->
	<div class="box1">
		<h1 > FoxHunt Lost & Found Service </h1>
	</div>

	<!--Welcome message paragraph for landing page-->
	<p> 
		Welcome to the Foxhunt Lost & Found System! 
		Here you can request a search for a lost item, or you may report/turn in lost items that you have found. 
	</p>

	<!--Inserting logo into page-->
	<img src= "FoxHuntLogo.png" width="500" height ="400">
	<br></br>
	<div>
		<p>
            <a href = "ItemsTableForm.php" class = "button"> <span>Report A Lost/Found Item</span></a>
		<p>
	</div>
	<br></br>
    <br></br>
	<div class = "center">
		<!--Opening up a footer to put the hyperlinks, this seperates the links from the rest of the page and will keep them at the bottom and centered always-->
		<footer>
			<div class = "box2">
				<p>
					<a href="adminLogin.php" style = "color:white" class = "button2 button4">View Adminstrator Functions Page </a>
				
				
					<a href="CheckConnections.php" style = "color:white" class = "button2 button4">View Check Connection Page</a>
                </p>
			</div>	
		</footer>
	</div>
<br></br>
	<?php
		INCLUDE "version.php";
	?>


</body>
</html>