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

<!--Adding title "Miscellaneous Page" to the page-->
<title>
	Adminstrator Functions Login
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

        .box5 {
			width: 225px;
			padding: 0.5px;
			border: 1px solid #000;
			border-radius: 15px;
			-moz-border-radius: 15px;
			background-color: none;
			display: inline-block;
		}

	</style>


</head>

<body>

	<!--This section is putting two small images of the logo into both corners of the page-->
	<img src= "FoxHuntLogo.png" width="110" height ="100" align=left>
	<img src= "FoxHuntLogo.png" width="110" height ="100" align=right>

	<div class = "center">
		<!--Creating a div with a class called box1 to be able to apply the box and style-->
		<div class="box1">
			<h1> Adminstrator Functions Login </h1>
		</div>
	</div>

	<p> </p>
	<div class = "box3">
			<?php
			# Required to use session variables
		   session_start();
		   $_SESSION["loginstatus"]="NOT LOGGED IN";

		   if (isset($_SESSION["loginstatus"]))
			{ $loginstatus=$_SESSION["loginstatus"];
			}
			else
			{ $loginstatus="";
			}
			Echo "<div class = 'box5'><p style = 'color:black'>Login Status: $loginstatus <p></div><br><br>";

			$email=$pass="";

			if (isset($_POST['email']))
				{$email=$_POST['email'];}

            /*COOKIE CODE*********/
            else if(isset($_COOKIE['emailSD']))
                {$email=$_COOKIE['emailSD'];}
			if (isset($_POST['pass']))
				{$pass=$_POST['pass'];}
            /*COOKIE CODE*********/
            //else if(isset($_COOKIE['pass']))
                //{$pass=$_COOKIE['pass'];}


		  # Check input fields for  errors
		  if ($email.$pass == "")
			{
              $errormessage="Login Below With Valid Admin Credentials : ";
      }
		   else if (empty($_POST['email']))
		   {
				 $errormessage="Enter the email address";
		   }
       else if (preg_match('/[^a-z0-9@. _]+/i', $email))
            {$errormessage = "<br>Incorrect Email Or Password</br>";}
		   else if (empty($_POST['pass']))
		   { $errormessage="Enter the password";
		   }
		   else if (preg_match('/[^a-z0-9 _]+/i', $pass))
           {$errormessage = "<br>Incorrect Email Or Password</br>";
           }
		   else
		   {
			   $errormessage="";
		   }
		   $hashpass = hash('SHA256',$pass);
		   include ("..\..\connect_db.php");
		   $q = "SELECT * FROM 8users  WHERE email = '$email' AND (pass = '$hashpass' OR pass = '$pass')";
		   $r = mysqli_query($dbc,$q);


		   if ($errormessage =="")
			{
			 if (mysqli_num_rows($r) > 0)     #count # of matches
			 {
			 $errormessage="";
			 }
			 else
			 {
				 $errormessage="PASSWORD/EMAIL DOES MATCH USER IN DATABASE";
			 }
			}
			echo "$errormessage<br></br>";


		  # here is where we display a form
			If (	($_SERVER['REQUEST_METHOD'] != 'POST') OR ($errormessage<>""))
			 {
				 echo "<form action='adminLogin.php' method='POST'>";
				 echo "<fieldset>";
				 echo "<p> Email 	  <input type='text' name='email' value='$email' ></p>";
				 echo "<p> Password	  <input type='password' name='pass' value='$pass' ></p>";
				 echo "<p><input type='submit'></p>";
				 echo "</fieldset>";
				 echo "</form>";
			 }

			# here is where we handle the form!
			else
			 {
                /*COOKIE CODE**************************/
				if ($errormessage==""){
                    setcookie("emailSD",$email);
                    include("..\..\connect_db.php");
                    $q = "SELECT * FROM lab9 WHERE pass = '$pass'";
                    $r = mysqli_query($dbc,$q);
                    echo $errormessage;
                }
                /*if ($errormessage==""){
                    setcookie("pass",$pass);
                    include("..\..\connect_db.php");
                    $q = "SELECT * FROM lab9 WHERE pass = '$pass'";
                    $r = mysqli_query($dbc,$q);
                    echo $errormessage;
                }*/

                $_SESSION["loginstatus"]="LOGGED IN";
				header("Location: admin.php");
			}

			?>
	</div>
	<!--Opening up a footer to put the hyperlinks, this seperates the links from the rest of the page and will keep them at the bottom and centered always-->
	<div class = "center">
		<footer>

			<br></br>


			<br></br>
			<br></br>
			<br></br>

			<!--Links back to previous pages-->
			<div class = "box2">
				<p>
					<a href="Team8.php" style="color:white" class = "button2 button4">View Landing Page</a>
					<a href="CheckConnections.php" style="color:white" class = "button2 button4">View Check Connection Page</a>
				</p>
			</div>
		</footer>
	</div>

	<?php
		INCLUDE "version.php";
	?>

</body>

</html>
