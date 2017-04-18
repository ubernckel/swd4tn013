<?php
require_once "rekisteri.php";	// hae tarkistuskoodi


//Onko painettu Tallenna -namiskuukkelia
if (isset($_POST["tallenna"])){
	$rekisteri = new Rekisteri($_POST["id"], $_POST["etunimi"], $_POST["sukunimi"], $_POST["hetu"], $_POST["email"], $_POST["osoite"], $_POST["postinro"], $_POST["info"]);
		
	// Tarkistetaan kentät
	$etunimiVirhe = $rekisteri->checkEtu();
	$sukunimiVirhe = $rekisteri->checkSuku();
	$hetuVirhe = $rekisteri->checkHetu();
	$emailVirhe = $rekisteri->checkSposti();
	$osoiteVirhe = $rekisteri->checkOsoite();
	$postinroVirhe = $rekisteri->checkPostinro();
	// Lisätietoja kenttä vapaaehtoinen, kerrotaan tarkistusfunktiolle false
	$infoVirhe = $rekisteri->checkInfo(false);
}

// Onko painettu Palaa tallentamatta -namiskuukkelia
elseif(isset($_POST["peruuta"])) {
	header("location: index.php");
	exit();
}

// Sivulle tultiin muualta, oletettavasti ilman POST-kuormaa...
else {
	$rekisteri = new Rekisteri();
	
	// ... ja voidaan alustaa virhemuuttujat
	$etunimiVirhe = 0;
	$sukunimiVirhe = 0;
	$hetuVirhe = 0;
	$emailVirhe = 0;
	$osoiteVirhe = 0;
	$postinroVirhe = 0;
	$infoVirhe = 0;
}


?>


<!DOCTYPE html>
<html lang="fi">
<head>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Rekisteröityminen</title>
	<link href="tyylitaju.css" rel="stylesheet">
</head>
<body>

<?php
require_once "navi.php";
?>


  <h1>Jäsenlomake</h1>
  <h2>Kuvitteellinen ry jäseneksi rekisteröitymislomake</h2>
  <p>
   Täytä kaikki kentät ja lähetä tiedot jäsenrekisteriin. Tietoja käsitellään vastuuttomasti, tietoturvasta piittaamatta ja iltapäivälehtien juorupalstoille vuotaen. Koska haluamme kerätä jäsenistämme tarpeettoman paljon henkilötietoja, jätimme vain lisätietokentän valinnaiseksi.
  </p>
  
  
  <form action="lomake.php" method="POST">
  <input type="hidden" name="id" value="0">
  
  <table>
	<tr>
		 <td>
		  Etunimi
		 </td>
		 <td>
		  <input type="text" name="etunimi" value="<?php print(htmlentities($rekisteri->getEtu(), ENT_QUOTES, "UTF-8")); ?>">
		 </td>
		 <td>
		  <?php
			print ("<span class='error'>" . $rekisteri->getError ( $etunimiVirhe ) . "</span>") ;
		  ?> 
		 </td>
	</tr>
	<tr>
		 <td>
		  Sukunimi
		 </td>
		 <td>
		  <input type="text" name="sukunimi" value="<?php print(htmlentities($rekisteri->getSuku(), ENT_QUOTES, "UTF-8")); ?>">
		 </td>
		 <td>
		  <?php
			print ("<span class='error'>" . $rekisteri->getError ( $sukunimiVirhe ) . "</span>") ;
		  ?> 
		 </td>
	</tr>
	<tr>
		 <td>
		  Henkilötunnus
		 </td>
		 <td>
		  <input type="text" name="hetu" value="<?php print(htmlentities($rekisteri->getHetu(), ENT_QUOTES, "UTF-8")); ?>">
		 </td>
		 <td>
		  <i>
			(muodossa PPKKVV[+-A]NNNX)
			<?php
			print ("<span class='error'>" . $rekisteri->getError ( $hetuVirhe ) . "</span>") ;
			?> 
		  </i>
		 </td>
	</tr>
	<tr>
		 <td>
		  Sähköposti
		 </td>
		 <td>
		  <input type="text" name="email" value="<?php print(htmlentities($rekisteri->getEmail(), ENT_QUOTES, "UTF-8")); ?>">
		 </td>
		 <td>
		  <i>
			(muodossa osoite@domain.com)
			<?php
			print ("<span class='error'>" . $rekisteri->getError ( $emailVirhe ) . "</span>") ;
			?> 
		  </i>
		 </td>
	</tr>
	<tr>
		 <td>
		  Osoite
		 </td>
		 <td>
		  <input type="text" name="osoite" value="<?php print(htmlentities($rekisteri->getOsoite(), ENT_QUOTES, "UTF-8")); ?>">
		 </td>
		 <td>
		  <?php
			print ("<span class='error'>" . $rekisteri->getError ( $osoiteVirhe ) . "</span>") ;
		  ?> 
		 </td>
	</tr>
	<tr>
		 <td>
		  Postinumero<br>
		 </td>
		 <td>
		  <input type="text" name="postinro" value="<?php print(htmlentities($rekisteri->getPostinro(), ENT_QUOTES, "UTF-8")); ?>">
		 </td>
		 <td>
		  <i>
			(vain numeroita)
			<?php
			print ("<span class='error'>" . $rekisteri->getError ( $postinroVirhe ) . "</span>") ;
			?> 
		  </i>
		 </td>
	</tr>
	<tr>
		 <td>
		  Lisätietoja
		 </td>
		 <td>
		  <textarea rows="5" name="info">
			<?php print(htmlentities($rekisteri->getInfo(), ENT_QUOTES, "UTF-8"));?>
		  </textarea>
		 </td>
		 <td>
		  <i>
			(valinnainen)
			<?php
			print ("<span class='error'>" . $rekisteri->getError ( $infoVirhe ) . "</span>") ;
			?> 
		  </i>
		 </td>
	</tr>
	<tr>
		 <td>
		 </td>
		 <td>
			<input type="submit" name="peruuta" value="Palaa tallentamatta">
		 </td>
		 <td>
			<input type="submit" name="tallenna" value="Tallenna ja lähetä">
		 </td>
	</tr>
   </table>
  </form>
<br>

  
  <p>
  <b>Debuggi:</b>
  <br>
  
  	<?php
	print_r($rekisteri);
	?>
	
  </p>


</body>
</html>
