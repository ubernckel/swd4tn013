<?php
# Configuration
require_once 'lomake_config.php';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link href="lomake.css" rel="stylesheet">

        <title>Sign up to be bad-ass!</title>

    </head>
    <body>

	<div class="center">
		<img class="titleimg" src="badass.jpg">	
	</div>
	
	
	
	
	
	

<h1>Badass registration form</h1>

<h2>Now it's easier than ever to become mothafuckin' badass!</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

	<p>Please fill all fields marked with <span class="error">*</span></p>


        <div class="divtable">
            <div class="divcol1"></div>
            <div class="divcol2"></div>

            <div class="divrow">
                <div class="divcell">First Name:</div>
                <div class="divcell">
					<input type="text" name="lname" value="<?php echo $fname;?>">
					<span class="error">* <?php echo $fNameErr;?></span>
				</div>
            </div>
			
            <div class="divrow">
                <div class="divcell">Last Name:</div>
                <div class="divcell">
					<input type="text" name="lname" value="<?php echo $lname;?>">
					<span class="error">* <?php echo $lNameErr;?></span>
				</div>
            </div>
		</div>
	

        <input type="submit" name="submit" value="Submit"> 


    </form>

    <br>

    <?php
        echo "<h2>Input was:</h2>";
        echo "Last ".$lname;
        echo "<br>";
        echo "First ".$fname;
        echo "<br>";
       // echo "Pass ".$passcode;
        echo "<br>";

		
		