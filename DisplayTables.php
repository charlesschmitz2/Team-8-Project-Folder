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
        .box3 {
			padding: 10px;
            background: #F5F5F5;
            -webkit-flex: 1; 
            -ms-flex: 1; 
            flex: 1; 
            border-radius: 15px;
			-moz-border-radius: 15px;
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
          background-color: #4CAF50; 
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
        .button5 {
          background-color: #c23b22;
          color: black;
          border: 1px solid transparent;
        }

        .button5:hover {background-color: #ba3720;}

	</style>

</head>
<body>
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
    ?>

<!--Inserting logo into upper corners of page-->
	<img src= "FoxHuntLogo.png" width="110" height ="100" align=left>
	<img src= "FoxHuntLogo.png" width="110" height ="100" align=right>
	
	
	<div class = "center">
	<!--Creating a div with a class called box1 to be able to apply the box and style-->
	<div class="box1">
		<h1> Database Table </h1>
	</div>
	</div>
	
	<!--Adding breaks to space things out on page-->
	<br></br>

<div align = "center">
<?php
	
	$PassedArg = $_GET["Option"];
	$TablePrimaryColumn = 0;
	if($PassedArg=="8Building")
	{
		$TablePrimaryColumn = 1;
	}
    
	
	echo "<br></br>";
	//Echo "Select * FROM".$PassedArg;
	
	include("..\..\connect_db.php");

	if (mysqli_ping($dbc))
	{	

	echo "<table>";
		echo "<table border=1>";
		
        if($PassedArg == "'Found'")
        {
            $q  = 'SELECT * FROM 8Items WHERE itemStatus = "Found"';
        }//if
        else if($PassedArg == "'Lost'")
        {
           $q  = 'SELECT * FROM 8Items WHERE itemStatus = "Lost"'; 
        }//if
        else if(($PassedArg == "'Found-Matched'") OR ($PassedArg == "'Lost-Matched'"))
        {
            $q  = 'SELECT * FROM 8Items WHERE timeMatched != "0000-00-00 00:00:00" ORDER BY timeMatched;';
        }//if
        else
        {
            $q  = 'SELECT * FROM '.$PassedArg;
        }
        
		$r = mysqli_query($dbc,$q);
	
		$row = mysqli_fetch_array($r,MYSQLI_ASSOC);
        if($row != null)
        {
            $columns = array_keys($row);
		    $column_qty=count($columns);
            for($x=0;$x<$column_qty;$x++)
            {
                echo "<th>".$columns[$x]."</th>";
            }//for  
        }
        else 
        {
            echo"ERROR : Unable to Display Matched Items Table <br></br> No Matched Items Exist";
        }
		
        //color coding tables for matched items only and leaving white for every other table
		$rowColor[0] = 'white';
        if($PassedArg == "'Lost-Matched'")
        {
            $rowColor[1] = '#ffe6e6';
        }
        else 
        {
            $rowColor [1] = 'white';
        }
        
        if(($PassedArg ==  "'Found'") OR ($PassedArg == "'Lost'") OR ($PassedArg == "'Found-Matched'") OR ($PassedArg == "'Lost-Matched'"))
        {
            $PassedArg = "8Items";
        }
		$r = mysqli_query($dbc,$q);
		//looping through data 
        

        $RowX=0;
		while($row = mysqli_fetch_array($r,MYSQLI_NUM ))
				{
					
					echo "<tr bgcolor=".$rowColor[$RowX/2].">";
            
						for($i = 0; $i<count($row);$i++)
						{
							echo'<td>'.$row[$i].'</td>';
                            
						}
            
						echo "</td><td> <a href='lab10delete.php?rowID=".$row[$TablePrimaryColumn]."&tableName=".$PassedArg."'class='button button4'> DELETE </a></td>";
            
						if(($PassedArg=="8Items") OR ($PassedArg == "'Found'") OR ($PassedArg == "'Lost'") OR ($PassedArg == "'Found-Matched'") OR ($PassedArg == "'Lost-Matched'"))
						{
							echo "</td><td> <a href='lab10update.php?rowID=".$row[$TablePrimaryColumn]."&tableName=".$PassedArg."' class='button button4'> UPDATE </a></td>";
                            
                            $RowX++;
                            if($RowX==4)
                            {
                                $RowX = 0;
                            }
						}            
                    
					echo "</tr>";
				}
	echo"</table>";
    //Displaying Instructions to the Users
        if($PassedArg=="8Items")
           {
               echo "<br></br><div class = 'box3'>The Delete Button Erases Completely The Selected Item From the Database</div>
                     <br></br><div class = 'box3'>The Update Button Marks The Selected Item as 'Matched', Admins Also Have the Choice to Input a Second Item Number in Order to Have a Matched TimeStamp Bewtween the Two Items</div>";
           }
        else
        {
            echo "<br></br><div class = 'box3'>The Delete Button Erases Completely The Selected Item From the Database</div>";
        }
	}//if
	
	else 
	{
		echo "ERROR : Unable to Display".$PassedArg."Table";
	}//if
	
?>
</div>

<br></br><br></br>

<!--footer-->
<div class = "center">
		<div class = "box2">
			<p>
                <a style = "color:white" class = "button2 button5" onclick = "goBack()"><script>function goBack() {window.history.back();}</script>Return to Database Tables</a>
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
