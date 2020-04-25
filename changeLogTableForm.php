<!Doctype HTML>

<html>
<title>
	Change Log Table Form
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
		<h1> Change Log Table Form</h1>
	</div>
	</div>
	
	<!--Adding breaks to space things out on page-->
	<br></br>

<div align = "center">
<div class = "box3">
<?php


# set up the arguements to variables we can use 		
$changer="";
$dateOfChange="";
$changeText="";
$version = null;
if(isset($_POST['dateOfChange']))
	{$dateOfChange=$_POST['dateOfChange'];}
if(isset($_POST['changer']))
	{$changer=$_POST['changer'];}
if(isset($_POST['changeText']))
	{$changeText=$_POST['changeText'];}
if(isset($_POST['version']))
	{$version=$_POST['version'];}

$autofocus = array( 1=>"",2=>"", 3=>"", 4=>"");
	
# Check input fields for errors
$errormessage="";
//echo"$changer $dateOfChange $changeText $version";
if(($changer.$dateOfChange.$changeText=="") AND ($version == 0))
	{$errormessage = "<br>Please Enter the Following Information About the Change Log Table :</br><br></br>"; $autofocus[1] = "autofocus";}
else if (ctype_alpha($changer) == false)
	{$errormessage = "<br>Changer Name May Only Contain Alphabetical Characters</br>";}
else if(empty($_POST['dateOfChange']))
	{$errormessage="<br>The Date you have entered is not a valid input</br><br></br>"; $autofocus[3] = "autofocus";}
else if( empty($_POST['changer']))
	{$errormessage = "<br>The Changer you have entered is not a valid input</br><br></br>"; $autofocus[1] = "autofocus";}
else if(empty($_POST['changeText']))
	{$errormessage = "<br>The Text you have entered is not a valid input</br><br></br>"; $autofocus[2] = "autofocus";}
    else if (preg_match('/[^a-z0-9 _]+/i', $changeText))
        {$errormessage = "<br>Change Description May Only Contain Letters, Numbers, and Spaces</br>";}
else if(($version == null) OR ($version < 0)) //Future update since I can't get it to work, but validate that not a duplicate value
	{$errormessage = "<br>The Version you have entered is not a valid input</br><br></br>"; $autofocus[4] = "autofocus";}

if($errormessage != "")
{echo $errormessage;}

include ("../../connect_db.php");
$q = "SELECT * FROM 1VERSIONS WHERE version = '$version'";
$r = mysqli_query($dbc,$q);

if ($errormessage =="")
  {
    if (mysqli_num_rows($r) <= 0)
      {$errormessage="";}
    else
      {echo $errormessage="That version already exists.";}
  }

#here is where we display a form
if(($_SERVER['REQUEST_METHOD']!= 'POST') OR ($errormessage != ""))
{
 echo "<form action='changeLogTableForm.php' method='Post'>";
 echo "<fieldset>";
 echo "<p> Name of Person(s) Making Change : <input type = 'text' name = 'changer' value='$changer'".$autofocus[1]."></p>";
 echo "<p> Text Describing Change(s) : <textarea rows='4' cols='50' name = 'changeText' maxlength = 208>".$changeText."</textarea></p>";
 echo "<p> Date Change(s) Made On : <input type = 'date'  name= 'dateOfChange' value= '$dateOfChange'".$autofocus[3]."></p>";
 echo "<p> Updated Version Number : <input type = 'number'placeholder = '5' step = '1'  name= 'version' value= '$version'".$autofocus[4]."></p>";
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
   $q = "INSERT  INTO changeLogTable (version, dateOfChange, changer, changeText)
         VALUES($version, '$dateOfChange', '$changer', '$changeText')";
   $r = mysqli_query($dbc,$q);
   
   if($r==false)
   { echo "DBC Error ".mysqli_error($dbc);
   echo "Unable to insert into the table. Contact Support!"; die;}
   
   echo "<br> User Table updated; added $changer $dateOfChange $changeText Version $version <br><br>";
   
   
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