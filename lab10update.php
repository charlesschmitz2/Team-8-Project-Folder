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
		p {color:black;}

		table {border-collapse:collapse;}
	
		body {
			background-color: white;
			text-align:center;
			font-family: Georgia;
		}

		.box1 {
			padding: 10px;
            background: #F5F5F5;
            -webkit-flex: 1; 
            -ms-flex: 1; 
            flex: 1; 
            border-radius: 15px;
			-moz-border-radius: 15px;
			display: inline-block;
		}

		.box2 {
			width: 1000px;
			padding: 10px;
			border: 2px solid #000;
			border-radius: 15px;
			-moz-border-radius: 15px;
			background-color: #c23b22;
			display: inline-block;
            
		}
			
        .box3 {
			width: 500px;
            padding: 1px;
            color: black;
            background-color: white;
            border-radius: 15px;
            -moz-border-radius: 15px;
            display: inline-block;
        }
        .box4 {
            width: 350px;
			padding: 1px;
			border: 2px solid #000;
			border-radius: 15px;
			-moz-border-radius: 15px;
			background-color: #c23b22;
			display: inline-block;
        }
        .span {
            color: black;
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
 
    
    <img src= "FoxHuntLogo.png" width="110" height ="100" align=left>
	<img src= "FoxHuntLogo.png" width="110" height ="100" align=right>
    <div class = 'box2'><h1> Update <h1></div>
        <?php   

        
    //----------------Date Update------------
    
include "../../connect_db.php"; 
            
    $itemNumber2Array=array();
    $timeMatched=$errormessage="";
    
        
    
    if (isset($_GET["rowID"]))
         {  
            $itemNumber1=$_GET["rowID"];
         }//if
    else if (isset($_POST["itemNumber1"]))
        {
            $itemNumber1=$_POST["itemNumber1"];
        }
    else
         {  
            $errormessage .= " No Row ID passed."; 
            $itemNumber1 = NULL;
         }//else
        
    if (isset($_POST["itemNumber2"]))
        {
            $itemNumber2=$_POST["itemNumber2"];
        }
    else 
    {
        $errormessage = "No Item Number 2 Selected";
        $itemNumber2 = NULL;
    }
    
           
  if ($itemNumber1==$itemNumber2 )
			{ 
              $errormessage= "Item Number 1 and 2 Cannot Match";
            }
        
    else if($itemNumber2==$itemNumber1)
        {
            $errormessage = "The Item Choice Selected is Already the Selected Item Number 1";
        }
        
    echo "<br></br>$errormessage<br></br>";  

  echo "<div class = 'box3'>";   
        
            if (($_SERVER['REQUEST_METHOD'] != 'POST') OR ($errormessage != ""))
            {
                $q = "SELECT itemNumber FROM 8Items";
                $r = mysqli_query($dbc,$q);
                
                while($row = mysqli_fetch_array($r,MYSQLI_NUM))
                {
                    $itemNumber2Array[] = $row[0];
                }
                        
                echo "<form action = 'lab10update.php' method = 'POST'>";
                echo "<fieldset style = 'width:500px'>";
                echo "<p> Selected Item Number 1 : <input type='number' name='itemNumber1' value='$itemNumber1' readonly></p>";
                echo "<p> Select Item Number 2 : <select name='itemNumber2'></p>";
                
                //Loop through for selection box of all item numbers in database
                    for($i=0;$i<count($itemNumber2Array);$i++)
                    {
                            echo "<option value='" . $itemNumber2Array[$i] . "'>" . $itemNumber2Array[$i] ."</option>";                       
                    }
                
                echo "<p></select></p>";
                echo "<p><input type = 'submit'></p>";
                echo "</fieldset>";
                echo "</form>";
            }
        
            else
            {
              
    
              $datetime = date("Y-m-d H:i:s");
              $itemNumber2 = $_POST['itemNumber2'];

            //Query to match date/times of both items together
              $q = "UPDATE 8Items SET timeMatched = '$datetime' WHERE itemNumber = '$itemNumber1' OR itemNumber = '$itemNumber2'";
              $r = mysqli_query($dbc, $q );
                
                if ($r == false)
                { echo "DBC Error " . mysqli_error($dbc);
                  echo "Unable to insert into the table."; die;
                }
                else 
                {
                    echo "Items Updated Sucessfully";
                }
           
            }
echo "</div>";
    
    ?>
    
<br></br><br></br>

<!--footer-->
<div class = "center">
		<div class = "box4">
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

