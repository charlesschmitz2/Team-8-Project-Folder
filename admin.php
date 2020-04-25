<!DOCTYPE HTML>

<!------------------------------------------------------
				Prologue - Misc.php			
This is the html doc for the Miscellaneous page of the FoxHunt Lost and Found website 
It contains simple functionality that links it to the other pages of the site
and contains the logo in the upper corners as well.

				Change Log - Misc.php
V01 : 10/1/19 : Original code created 
V02 : 10/8/19 : Change log and Prologue added

-------------------------------------------------------->

<html>

<!--Adding title "Miscellaneous Page" but changed to Admin functions to the page-->
<title> 
	Adminstrator Functions 
</title>

<head>
	<!--Section that contains all the stlye/formats of the page NOTE ADDING COMMENTS TO STYLE SECTION MESSES IT UP-->
	<style>
		h1 {color:white;}

		table {border-collapse:collapse;}
		
		body {
			background-color: white;
			text-align: center;
			font-family: Georiga;
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
		.box3 {
			width: 200px;
			padding: 0.5px;
			border: 1px solid #000;
			border-radius: 15px;
			-moz-border-radius: 15px;
			background-color: none;
			display: inline-block;
		}
		
		.center {
			text-align: center;
		}
        
        .button {
              border-radius: 4px;
              background-color: none;
              border: 1px solid #e7e7e7;
              color: black;
              text-align: center;
              font-size: 15px;
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
        
        .box5 {
			width: 200px;
			padding: 0.5px;
			border: 1px solid transparent;
			border-radius: 15px;
			-moz-border-radius: 15px;
			background-color: none;
			display: inline-block;
		}
        .flex-container{
            width: 80%;
            min-height: 300px;
            margin: 0 auto;
            display: -webkit-flex;     
            display: flex; 
        }
        .flex-container .column{
            padding: 10px;
            background: #F5F5F5;
            -webkit-flex: 1; 
            -ms-flex: 1; 
            flex: 1; 
            border-radius: 15px;
			-moz-border-radius: 15px;
			display: inline-block;
        }
        .flex-container .column.bg-alt{
            background: #F5F5F5;
        }
            
	</style>


</head>

<body>

    <?php
    session_start();  # Required to use session variables
    ?>
    
	<!--This section is putting two small images of the logo into both corners of the page-->
	<img src= "FoxHuntLogo.png" width="110" height ="100" align=left>
	<img src= "FoxHuntLogo.png" width="110" height ="100" align=right>
	
	<div class = "center">
		<!--Creating a div with a class called box1 to be able to apply the box and style-->
		<div class="box1">
			<h1> Adminstrator Functions </h1>
		</div>
	</div>

	<p> </p>
	
    <div class = "box3">
	<?php
	 
	if (isset($_SESSION["loginstatus"]))
	{ $loginstatus=$_SESSION["loginstatus"];
	}
	else 
	{ $loginstatus="";
	}
	Echo "<p style = 'color:black'>Login Status: $loginstatus <p>"; 
	
	?>
    </div>
    <br></br>
	<!--Opening up a footer to put the hyperlinks, this seperates the links from the rest of the page and will keep them at the bottom and centered always-->

    <div class = "flex-container">
    <div class = "column">
        <h2> Database Information : </h2>
        <p>&nbsp;</p>
        <!--Links to the png of the functional diagram and the tables created in the SQL database-->
                    <p>
                        <a href = "Functional Diagram.png" class = "button"><span> Functional Diagram</span></a>
                    </p>

        <br></br>
                    <p>
                        <a href = "SQLTables.php" class = "button"> <span>Database Tables</span></a>
                    </p>
        
            <div class = 'box5'>
                <p>-------</p>
                <br><p><a href = "DisplayTables.php?Option='Lost'" class = "button"><span> View Lost Items </span></a></p></br>
                <br><p><a href = "DisplayTables.php?Option='Found'" class = "button"><span> View Found Items </span></a></p></br>
                <br><p><a href = "DisplayTables.php?Option='Lost-Matched'" class = "button"><span> View Matched Items </span></a></p></br>
            </div>
        <br></br>
    </div>
<P>  &nbsp; </P>
    <div class = "column bg-alt">
        <h2> Database Forms : </h2>
        <p>&nbsp;</p>
				<p>
					<a href = "userTableForm.php" class = "button"> <span>User Table Input Form</span> </a>
                </p>
			
        <br></br>
			
				<p>
					<a href = "buildingTableForm.php" class = "button"> <span>Building Table Input Form</span></a>
                </p>
			
        <br></br>
			
				<p>
					<a href = "ItemsTableForm.php" class = "button"> <span>Item Table Input Form</span></a>
                </p>
			
        <br></br>
			
				<p>
					<a href = "changeLogTableForm.php" class = "button"> <span>Change Log Table Input Form</span></a>
                </p>

    </div>
    </div>
       
        <br></br>
        
	<div class = "center">		
			<!--Links back to previous pages-->
			<div class = "box2">
				<p>
					<a href="Team8.php" style="color:white" class = "button2 button4">View Landing Page</a>

					<a href="CheckConnections.php" style="color:white" class = "button2 button4">View Check Connection Page</a>
				</p>
			</div>
		
	</div>
	
	<?php
		INCLUDE "version.php";
	?>
	
</body>

</html>

