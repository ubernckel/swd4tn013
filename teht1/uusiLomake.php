<?php
# Get DB Configuration
require_once 'dbconf.php';

// Onko POST-loadissa tallenna kantaan komento
if (isset ( $_POST ["talleta"] )) {


		
		
		// Koita avata tietokantayhteys oliolla
		try {
			require_once "tietokantaOLIO.php";
			
			$tietokantaOLIO = new tietokantaOLIO ();
			$tulos = $henkiloPDO->lisaaHenkilo ( $_SESSION ["henkilo"] );
		} catch ( Exception $error ) {
			// print($error->getMessage());
			header ( "location: virhe.php?virhe=" . $error->getMessage () );
			exit ();
		}
		
		$_SESSION = array ();
		
		if (isset ( $_COOKIE [session_name ()] )) {
			setcookie ( session_name (), '', time () - 100, '/' );
		}
		
		session_destroy ();
		
		header ( "Location: talletettu.php" );
		exit ();
	} else {
		header ( "location: virhe.php?virhe=Ei ollut talletettavia tietoja" );
		exit ();
	}
}















?>

