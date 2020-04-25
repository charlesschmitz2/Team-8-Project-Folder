<!DOCTYPE HTML>

<html>

<html lang = "en">
<head>
	<meta charset = "UTF-8">

	<title> Users Table Form </title>
	
	<style>
		h1 {color:white;}
		
		body {
			background-color: white;
			text-align:center;
			font-family:Georgia
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

<!creating the header of the User Table Page >
<img src= "FoxHuntLogo.png" width="110" height ="100" align=left>
<img src= "FoxHuntLogo.png" width="110" height ="100" align=right>

<div class = "center">
<! apply the box and style>

<div class="box1">
	<h1> User Table Form</h1>
</div>

</div>

<br></br>

<body>

<div class="box3">
<?php

  # set up the passed arguments to variables we can use 
    $fname=$lname=$cwid=$email=$pass="";
	
	if (isset($_POST['cwid']))
		{$cwid =$_POST['cwid'];}
	if (isset($_POST['fname']))
		{$fname=$_POST['fname'];}
	if (isset($_POST['lname']))
		{$lname=$_POST['lname'];}
	if (isset($_POST['email']))
		{$email =$_POST['email'];}
	if (isset($_POST['pass']))
		{$pass =$_POST['pass'];}
	
  # Check input fields for  errors 
  
  if ($fname.$lname.$cwid.$email.$pass == "")
	{ $errormessage="Please Enter the Following Information About the New User :";
	}
  else if (empty($_POST['fname']))	
   { $errormessage="Enter the first name";
   } 
   elseif (ctype_alpha($fname) == false) 
   { $errormessage="First name can only contain letters"; 
   }
   else if (empty($_POST['lname']))	
   { $errormessage="Enter the last name"; 
   }
   elseif (ctype_alpha($lname) == false) 
   { $errormessage="Last name can only contain letters"; 
   }   
   else if (empty($_POST['cwid']))	
   { $errormessage="Enter the CWID";
   } 
   elseif (ctype_digit($cwid) == false) 
   { $errormessage="The CWID can only contain numbers";
   }   
   else if (empty($_POST['email']))	
   { $errormessage="Enter the email address";
   }   
   else if (preg_match('/[^a-z0-9 _]+/i', $email))
        {$errormessage = "<br>Email May Only Contain Letters, Numbers, and Spaces</br>";}
   else if (empty($_POST['pass']))	
   { $errormessage="Enter the password";
   } 
   else if (preg_match('/[^a-z0-9 _]+/i', $pass))
        {$errormessage = "<br>Password May Only Contain Letters, Numbers, and Spaces</br>";}
   else
   {
	   $errormessage="";
   }
   
   include ("..\..\connect_db.php");
   $q = "SELECT * FROM 8users WHERE email = '$email'";
   $r = mysqli_query($dbc,$q);
   if ($errormessage =="")		
			{   
			 if (mysqli_num_rows($r) <= 0)     #count # of matches
			 { 
			 $errormessage="";
			 } 
			 else 
			 {
				 $errormessage="EMAIL ALREADY IN USE";
			 }
			}  
   echo "$errormessage<br></br>";
  
  # here is where we display a form
If (	($_SERVER['REQUEST_METHOD'] != 'POST') OR ($errormessage<>""))
 {
	 echo "<form action='UserTableForm.php' method='POST'>"; 
	 echo "<fieldset>";
	 echo "<p> CWID 	  <input type='text' name='cwid' value='$cwid' ></p>";
	 echo "<p> First Name <input type='text' name='fname' value='$fname' ></p>";
	 echo "<p> Last Name <input type='text' name='lname' value='$lname' ></p>";
	 echo "<p> Email 	  <input type='text' name='email' value='$email' ></p>";
	 echo "<p> Password	  <input type='password' name='pass' value='$pass' ></p>";
	 echo "<p><input type='submit'></p>";
	 echo "</fieldset>";
	 echo "</form>";
 }

# here is where we handle the form!
else  
 {
	echo " Inside the handler code!";
    echo   " There are ".count($_POST)." elements in the \$_POST array";
	
	# Connect to the database
	echo "<br>Connecting to database <br>";
	include ("..\..\connect_db.php");
	
	$pass = hash('SHA256',$pass);
	# Update specific row 
	$q = "INSERT INTO 8Users (CWID, First_Name, Last_Name, Email, Pass)
		  VALUES ('$cwid','$fname','$lname','$email','$pass')";
	$r = mysqli_query($dbc, $q ); 

	if ($r == false) 
	{ echo "DBC Error " . mysqli_error($dbc); 
	  echo "<br>Unable to insert into the table. Contact support!"; die; 
	}
		
	echo "<br> User Table updated; added $fname $lname <br></br>       
			   cwid= $cwid!<br><br>
			   email= $email!<br></br>
			   pass= $pass!<br><br>";

 }
 
?>
</div>

<br></br>
<br></br>

 <footer>

	<div class = "box2">

			<p>
				<a href="Admin.php" style = "color:white" class = "button2 button4">Return to Administrator Function Page</a>
			</p>
		</div>

</footer>
<?php
	include "Version.php";
?>
</body>

</html>