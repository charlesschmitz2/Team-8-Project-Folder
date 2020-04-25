<!Doctype HTML>

<html>
<title>
	Building's Table Form
</title>
	
<head> 
	
	<!--Section that contains all the stlye/formats of the page NOTE ADDING COMMENTS TO STYLE SECTION MESSES IT UP-->
	<style>
		h1 {
			color:white;
		}
		p {color:black;}

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
		.box3 {
			width: 350px;
			padding: 1px;
			border-radius: 15px;
			-moz-border-radius: 15px;
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

<!--Inserting logo into upper corners of page-->
	<img src= "FoxHuntLogo.png" width="110" height ="100" align=left>
	<img src= "FoxHuntLogo.png" width="110" height ="100" align=right>
	
	
	<div class = "center">
	<!--Creating a div with a class called box1 to be able to apply the box and style-->
	<div class="box1">
		<h1> Building's Table Form</h1>
	</div>
	</div>
	
	<!--Adding breaks to space things out on page-->
	<br></br>

<div align = "center">
<div class = "box3">
<?php


# set up the arguements to variables we can use ​
$min = 1;
$max = 15;		
$numFloors= null;
$buildingName="";
if(isset($_POST['numFloors']))
	{$numFloors=$_POST['numFloors'];}
if(isset($_POST['buildingName']))
	{$buildingName=$_POST['buildingName'];}
	
# Check input fields for errors

if(empty($_POST['buildingName']))
	{$errormessage="<br>Please Enter the Following Information About the Building Table for the Lost Item :</br><br></br>";}
elseif (ctype_alpha($buildingName) == false)
	{$errormessage = "<br>Building Name Can Only Contain Alphabetical Characters</br>";}
else if ((filter_var($numFloors, FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min, "max_range"=>$max))) === false) OR (empty($_POST['buildingName'])) )
	{$errormessage = "<br>The Floor Number you have entered is not a valid input</br><br></br>";}

else
	{
		$errormessage="";
    }
	
include ("..\..\connect_db.php");
$q = "SELECT * FROM 8building WHERE buildingName = '$buildingName'";
$r = mysqli_query($dbc,$q);
		   
if ($errormessage =="")		
	{   
		if (mysqli_num_rows($r) <= 0)     #count # of matches
		{ 
		$errormessage="";
		 } 
		else 
		{
		 $errormessage="Building Already Exists";
		}
	}  
echo "$errormessage<br></br>";

#here is where we display a form
if(($_SERVER['REQUEST_METHOD']!= 'POST') OR ($errormessage != ""))
{
 echo "<form action='buildingTableForm.php' method='Post'>";
 echo "<fieldset>";
 echo "<p> Name of Building : <input type = 'text' name = 'buildingName' value='$buildingName'></p>";
 echo "<p> Floor Number(s) : <input type = 'text' name = 'numFloors' value='$numFloors'></p>";
 echo "<p><input type = 'submit'></p>";
 echo "</fieldset>";
 echo "</form>";
}

#here is where we handle the form!
else
{
	echo "<br>There are ".count($_POST)."elements in the \$_POST array";
	
	
	# Connect to the database
   ECHO "Connecting to database <br>";
   include ("..\..\connect_db.php");
   
# Insert a single row intgo the Buildings Table
   $q = "INSERT  INTO 8Building (numFloors, buildingName)
         VALUES($numFloors,'$buildingName')";
   $r = mysqli_query($dbc,$q);
   
   if($r==false)
   { echo "DBC Error ".mysqli_error($dbc);
   echo "Unable to insert into the table. Contact Support!"; die;}
   
   echo "<br> User Table updated; added $numFloors $buildingName <br><br>";
   
   
}


?>
</div>
</div>

<br></br><br></br>

<!--footer-->
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