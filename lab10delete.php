<!Doctype HTML>

<html>
<title>
	Database Table
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
        .button {
            background-color: #4CAF50; 
            border: none;
            color: white;
              padding: 16px 32px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 16px;
              margin: 4px 2px;
              -webkit-transition-duration: 0.4s; 
              transition-duration: 0.4s;
              cursor: pointer;
        }
        .button4 {
            background-color: white;
            color: black;
            border: 2px solid #e7e7e7;
        }
        .button4:hover {background-color: #e7e7e7;}
        
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

$errorMessage = "";
//delete
 if (isset($_GET["rowID"]))
 {  
	$rowID=$_GET["rowID"];
 }//if
 else
 {  
	$errorMessage .= " No Row ID passed."; 	 
 }//else
	 
if (isset($_GET["tableName"]))
 {  
	include("..\..\connect_db.php");
	$tableName=$_GET["tableName"];
 }//if
 else
 {  
	$errorMessage .= " No Table Name passed."; 	 
 }//else
	 
$column = "";
if ($tableName == "8Users")
{$column = "id";}//if
else if ($tableName == "8Building")
{$column = "buildingName";}//if
else if ($tableName == "8Items")
{$column = "ItemNumber";}//if
else if ($tableName == "changeLogTable")
{$column = "version";}//if

if ($errorMessage=="")
{
	include("..\..\connect_db.php");
	$q = 'DELETE FROM '.$tableName.' WHERE '.$column.'= "'.$rowID.'"';
	$r = mysqli_query($dbc,$q);
	if ($r != false) 
		{
			echo "<br></br>  Row Deleted From Table: - $tableName  - $column - $rowID! <br></br> The Item has Been Deleted From the Database";
		} 
		else
		{
			echo "DBC Error " . mysqli_error($dbc);
		}
}//if
else
{
	echo "$errorMessage";
}//else
 
?>
<br></br><br></br>

<!--footer-->
<div class = "center">
		<div class = "box2">
			<p>
                <a href="SQLTables.php" style="color:white" class = "button2 button4">Return to Display Tables Page</a>
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