<html>
<head>
    <title> Items Table Insert </title>
    <style>
    h1 {color:white;}

    table {border-collapse:collapse;}
        
    body {
        background-color: white;
        font-family:Georgia;
    }

    .box1 {
        width: 1000px;
        padding: 10px;
        border: 2px solid #000;
        border-radius: 15px;
        -moz-border-radius: 15px;
        background-color: #c23b22;
    }

    .box2 {
        width: 350px;
        padding: 1px;
        border: 2px solid #000;
        border-radius: 15px;
        -moz-border-radius: 15px;
        background-color: #c23b22;
        
    }

    .box3 {
        width: 350px;
        padding: 1px;
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
    <!--This section is putting two small images of the logo into both corners of the page-->
	<img src= "FoxHuntLogo.png" width="110" height ="100" align=left alt="Fox Hunt Logo">
	<img src= "FoxHuntLogo.png" width="110" height ="100" align=right alt="Fox Hunt Logo">

	<div align="center">
		<!--Creating a div with a class called box1 to be able to apply the box and style-->
			
		<div class="box1">
				<h1> Items Table Form </h1>
		</div>
		<p></p>

    <div class = "box3">	
    <?php
    # set up the passed arguments to variables we can use 
    $ItemName=$ItemType=$ItemDescription=$ItemStatus=$buildingFound="";    
    if (isset($_POST['ItemName']))
        {$ItemName=$_POST['ItemName'];}
    if (isset($_POST['ItemType']))
        {$ItemType=$_POST['ItemType'];} 		
    if (isset($_POST['ItemDescription']))
        {$ItemDescription=$_POST['ItemDescription'];}
	if (isset($_POST['buildingFound']))
        {$buildingFound=$_POST['buildingFound'];}
    if (isset($_POST['ItemStatus']))
        {$ItemStatus=$_POST['ItemStatus'];}

    $autofocus = array( 1=>"",2=>"", 3=>"");
    
    # Check input fields for  errors 
    $errormessage = "";

    if(empty($_POST['ItemName']))
	    {$errormessage="<br>Please Enter the Following Information About the Item Table for the Item :</br><br></br>"; $autofocus[1] = "autofocus";}
	else if(ctype_alpha($ItemName) == false)
		{$errormessage = "Item Name May Only Contain Alphabetical Characters";}
    
    else if(empty($_POST['ItemType']) OR ($ItemType=="--Select--"))
	    {$errormessage="<br>Please Select an Item Type :</br><br></br>";}
    
    else if(empty($_POST['ItemDescription']) )
        {$errormessage="<br>The Text You Have Entered is Not a Valid Input :</br><br></br>"; $autofocus[3] = "autofocus";}
        
        // preg_match will return true if it finds 
        // a character *other than* a-z, 0-9, space and _
        // *anywhere* inside the string
    else if (preg_match('/[^a-z0-9@ _]+/i', $ItemDescription))
        {$errormessage = "<br>Item Description May Only Contain Letters, Numbers, and Spaces</br>";}

	
	else if (empty($_POST['buildingFound']) OR ($buildingFound=="--Select--"))
	   {$errormessage = "<br>Please Select a Building</br>";}
    
    else if(empty($_POST['ItemStatus']) OR ($ItemStatus=="--Select--"))
	    {$errormessage="<br>Please Select an Item Status :</br><br></br>";}
    
    if ($errormessage!="")
        {Echo $errormessage;}

	#Query for building Names
     include "../../connect_db.php"; 
	 $q = "SELECT buildingName FROM 8building";
	 $r = mysqli_query($dbc, $q );
        while($row = mysqli_fetch_array($r,MYSQLI_NUM))
        {
            $buildingSelection[]=$row[0];
        }
            
    # here is where we display a form
    If (  ($_SERVER['REQUEST_METHOD'] != 'POST') OR ($errormessage<>""))
    {
    echo "<form action='ItemsTableForm.php' method='POST'>"; 
    echo "<fieldset>";
    echo "<p> Item Name: <input type='text' name='ItemName' value='$ItemName' maxlength='50' autofocus></p>";
    
    echo "<p>Item Type: <select name = 'ItemType' value='$ItemType'></p>";
        echo "<option value = '--Select--'>--Select--</option>";
        echo "<option value = 'Clothing'>Clothing</option>";
        echo "<option value = 'Electronics'>Electronics</option>";
        echo "<option value = 'Books'>Books</option>";
        echo "<option value = 'Wallet/Key/ID'>Wallet/Key/ID</option>";
        echo "<option value = 'Other'>Other</option>";
    echo "</select>";
    
    echo "<p> Item Description: <textarea rows='4' cols='50' name='ItemDescription' value='$ItemDescription'>".$ItemDescription."</textarea></p>";
   
    echo "<p> Building Found In : <select name='buildingFound'></p>";
	echo "<option value = '$buildingSelection'>--Select--</option>";
        for ($i=0;$i<count($buildingSelection);$i++)
		{	 
			echo "<option value='".$buildingSelection[$i]."'>".$buildingSelection[$i]."</option>";
		}
	echo "<p></select></p>";  
    echo "<p>Item Status: <select name = 'ItemStatus' value='$ItemStatus'></p>";
        echo "<option value = '--Select--'>--Select--</option>";
        echo "<option value = 'Lost'>Lost</option>";
        echo "<option value = 'Found'>Found</option>";
    echo "</select>";

    echo "<p><input type='submit'></p>";
    echo "</fieldset>";
    echo "</form>";
    }

    # here is where we handle the form!
    Else  
    {
    include ("..\..\connect_db.php");
    
    $buildingFound = trim($_POST['buildingFound']);
    # Update specific row 
    $q = "INSERT INTO 8Items (ItemName, ItemType, ItemDescription, buildingFound, ItemStatus, timeMatched) VALUES ('$ItemName','$ItemType', '$ItemDescription', '$buildingFound', '$ItemStatus', '0000-00-00 00:00:00')";
    $r = mysqli_query($dbc, $q ); 

    if ($r == false) 
    { 
        echo "DBC Error " . mysqli_error($dbc); 
        echo "<br></br> Unable to insert into the table. Contact support!"; die; 
    }
        
    echo "<br> Items Table Updated: $ItemName $ItemType $buildingFound status=$ItemStatus!<br><br>";
    } 
    ?>
    </div>
    <!--Opening up a footer to put the hyperlinks, this seperates the links from the rest of the page and will keep them at the bottom and centered always-->
			
			<br></br>
        <footer>
			<!--Links back to previous pages-->
			<div class = "box2">
				<p>                   
                   <?php
                   session_start();  # Required to use session variables 
	               if (isset($_SESSION["loginstatus"]))
                        { 
                            $loginstatus=$_SESSION["loginstatus"];
                        }
                    else 
                        { 
                            $loginstatus="";
                        }
                   if ($loginstatus=="LOGGED IN")
                       { 
                        echo "<a href='admin.php' style = 'color:white' class = 'button2 button4'>Return to Administrator Functions  Page</a>";
                       }
	               else 
                       { 
                        echo "<a href='Team8.php' style = 'color:white' class = 'button2 button4'>Return to LandingPage  Page</a>";
                       }
                   ?>
				</p>
			</div>
		</footer>
        <br>
        <br>

    <?php
    	INCLUDE "version.php";
	?>

    </div>
</body>
</html>