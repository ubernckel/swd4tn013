<?php
// Haetaan luokkamoottori
require_once "rekisteri.php";

// Avataan sessio
session_start ();

// Jos sessiossa on olio, alustetaan luokan olio sessiosta,
// muuten luodaan luokan olio oletusarvoilla (tyhjänä)
if (isset ( $_SESSION ["rekisterointi"] )) {
	$rekisteri= $_SESSION ["rekisterointi"];
} else {
	$rekisteri = new Rekisteri ();
}

// Poistetaan luokan olio sessiosta
//unset($_SESSION["rekisteröinti"]);


?>


<!DOCTYPE html>
<html lang="fi">
<head>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Lomakkeen tiedot</title>
	<link href="tyylitaju.css" rel="stylesheet">
</head>
<body>


<?php
require_once "navi.php";
?>

  <h1>Vahvistus</h1>

  <p>
	Kumma kyllä, osasit ilmeisesti täyttää kaikki kentät, koska emme ensihätään löytäneet mitään vikaa syötetyistä tiedoista.
	<h4>Syötit seuraavat tiedot:</h4>
	
	<?php
	print ("<p>Nimi: " . $rekisteri->getEtu () . " " . $rekisteri->getSuku ()) ;
	print ("<br>Osoite: " . $rekisteri->getOsoite () . ", " . $rekisteri->getPostinro () . " KAUPUNKI (todo)") ;
	print ("<br>Henkilötunnus: " . $rekisteri->getHetu ()) ;
	print ("<br>Sähköposti: " . $rekisteri->getEmail ()) ;

	// Lisätiedot olivat valinnaisia
	if (strlen ( $rekisteri->getInfo () ) > 0)
		print ("<br >Lisätieto: " . $rekisteri->getInfo () . "</p>") ;
	else
		print ("<br >Lisätieto: -</p>") ;
	?>

	<form action="uusiJasen.php" method="post">
		<p>
			<input type="submit" name="korjaa" value="Korjaa">
			<input type="submit" name="talleta" value="Talleta">
			<input type="submit" name="peruuta" value="Peruuta">
		</p>
	</form>


</body>
</html>






