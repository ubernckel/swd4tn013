<?php   

// define variables and set to empty values
$lNameErr = $fNameErr = $passErr = "";
$lname = $fname = $passcode = "";

//lastname
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["lname"])) {
	$lNameErr = "Last Name is required";
  } else {
	$lname = test_input($_POST["lname"]);
	// check if name only contains letters and whitespace
	if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
	  $lNameErr = "Only letters and white space allowed in last name"; 
	}
  }

  //firstname
  if (empty($_POST["fname"])) {
	$fNameErr = "First Name is required";
  } else {
	$fname = test_input($_POST["fname"]);
	// check if name only contains letters and whitespace
	if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
	  $fNameErr = "Only letters and white space allowed in first name"; 
	}
  }

  //passcode
  if (empty($_POST["passcode"])) {
	$passErr = "Passcode is required";
  } else {
	$passcode = test_input($_POST["passcode"]);
	// check if name only contains letters and whitespace
	if (!preg_match("/^[a-zA-Z ]*$/",$passcode)) {
	  $passErr = "Only letters and white space allowed in passcode"; 

	} 
	
  }

}


function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}


?>
