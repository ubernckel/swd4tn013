<?php
if (isset ( $_POST ["aseta"] )) {
	setcookie ( "keksi", $_POST ["user"], time () + 60 * 60 * 24 * 7 );
	header ( "location: index.php" );
	exit ();
} else {
	if (isset ( $_COOKIE ["keksi"] )) {
		$tallenne = $_COOKIE ["keksi"];
	} else {
		$tallenne = "";
	}
}
?>


<!DOCTYPE html>
<html lang="fi">
<head>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Asetukset</title>
	<link href="tyylitaju.css" rel="stylesheet">
</head>
<body>


<?php
require_once "navi.php";
?>

  <h1>Asetukset</h1>

  <p>
   Voit syöttää nimesi, jotta tunnistamme sinut myös ensi kerralla.
  </p>
  
	<form action="" method="post">
		<p>
		Nimesi:
		<input type="text" name="user" value="<?php print(htmlentities($tallenne, ENT_QUOTES, "UTF-8"));?>">
		<input type="submit" name="aseta" value="Aseta nimi">
		</p>
	</form>
  
  


</body>
</html>
