<?php
# Configuration
require_once 'config.php';

?>

<!DOCTYPE html>
<html lang="fi">
<head>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Müesli</title>
</head>
<body>


<html>
<head>
<title>
Müesli
</title>
</head>
<body>
<h1>Müesli</h1>

<?php
	// Create MySQL PDO connection

	try {
		$oCon = new PDO('mysql:host='.$mHost.';dbname='.$mDb, $mUser, $mPass);
		// set the PDO error mode to exception
		$oCon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$oCon->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		echo "MySQL PDO Connected successfully"; 
		}

	catch(PDOException $e)
		{
		echo "MySQL PDO Connection failed: " . $e->getMessage();
		}
	
	

	// Select something
	$sql = "SELECT * FROM user_info";
	$stmt = $oCon->prepare($sql);
	$stmt->execute();

	while ($row = $stmt->fetchObject()) {
		print("<p>Käyttäjä: " . utf8_encode($row->kommentti));

	}
	print("<br> Yhteensä " . $stmt->rowCount() . " käyttäjää"); 

	
	// Katkaise yhteys
	$oCon = null;


?>

</body>
</html>



