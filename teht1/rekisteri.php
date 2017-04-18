<?php
class rekisteri {
	// Taulukko virhekoodeja varten, sekä niitä vastaavat tekstit
	private static $virhekoodit = array(
		-1 => "Virheellinen tieto",
		0 => "", // ei virhekoodi, vaan kaikki kunnossa koodi
		11 => "Etunimi on syötettävä",
		12 => "Etunimi on liian lyhyt",
		13 => "Etunimi on liian pitkä",
		21 => "Sukunimi on syötettävä",
		22 => "Sukunimi on liian lyhyt",
		23 => "Sukunimi on liian pitkä",
		31 => "Henkilötunnus on pakollinen",
		32 => "Henkilötunnuksen tarkistusmerkki ei täsmää",
		33 => "Henkilötunnuksen päivämäärä ei kelpaa",
		34 => "Henkilötunnuksen pitää olla muotoa PPKKVV[+-A]NNNX",
		41 => "Sähköposti on pakollinen",
		42 => "Epäkelpo sähköpostiosoite",
		51 => "Osoite on pakollinen",
		52 => "Osoite on liian lyhyt",
		53 => "Osoitteen maksimipituus 100 merkkiä",
		54 => "Osoitteessa ei saa olla kuin kirjaimia, numeroita ja ,.- ",
		61 => "Postinumero puuttuu",
		62 => "Suomalainen postinumero on 5 merkkiä pitkä",
		63 => "Syötä 5 numeroa",
		71 => "Lisätiedot ovat pakollisia",
		72 => "Jos kerran alat kirjottamaan niin kirjoita vähintään 10 merkkiä",
		73 => "Älä nyt innostu! Merkkejä max 4000",
		74 => "Lisätiedoissa saa olla vain kirjaimia, numeroita ja - ,.!?" 
	);
	
	// Attribuutit
	private $id;		// tietokannan primary key, tehty kannan takia, on kannassa avainkenttänä
	private $etu;		// etunimi
	private $suku;		// sukunimi
	private $hetu;		// henkilöturvatunnus
	private $sposti;	// sähköposti
	private $osoite;	// lähiosoite
	private $postinro;	// postinumero
	private $info;		// lisätiedot
	
	// Konstruktori
	function __construct($id= "", $etu = "", $suku = "", $hetu = "", $sposti = "", $osoite = "", $postinro = "", $info = "") {
		$this->id = trim($id);
		$this->etunimi = trim($etu);
		$this->sukunimi = trim($suku);
		$this->hetu = trim($hetu);
		$this->email = trim($sposti);
		$this->osoite = trim($osoite);
		$this->postinro = trim($postinro);
		$this->info = trim($info);
	}
	
	// Get- ja Set-metodit
	public function setId($id) {
		$this->id = trim($id);
	}
	public function getId() {
		return $this->id;
	}
	
	public function setEtu($etu) {
		$this->etunimi = trim($etu);
	}
	public function getEtu() {
		return $this->etunimi;
	}
	
	public function setSuku($suku) {
		$this->sukunimi = trim($suku);
	}
	public function getSuku() {
		return $this->sukunimi;
	}

	public function setHetu($hetu) {
		$this->hetu = trim($hetu);
	}
	public function getHetu() {
		return $this->hetu;
	}

	public function setEmail($sposti) {
		$this->email = trim($sposti);
	}
	public function getEmail() {
		return $this->email;
	}
	
	public function setOsoite($osoite) {
		$this->osoite = trim($osoite);
	}
	public function getOsoite() {
		return $this->osoite;
	}
	
	public function setPostinro($postinro) {
		$this->osoite = trim($postinro);
	}
	public function getPostinro() {
		return $this->postinro;
	}

	public function setInfo($info) {
		$this->info = trim($info);
	}
	public function getInfo() {
		return $this->info;
	}



	// Käsitellään etunimi, $required määrittää, onko kenttä vaadittu
	public function checkEtu( $required=true, $min=2, $max=50) {
		
		// Jos etunimi ei ole vaadittu, ja on tyhjä, palautetaan kaikki ok
		if ($required == false && strlen ( $this->etunimi ) == 0) {
			return 0;
		}
			
		// Jos etunimi on vaadittu, mutta se on tyhjä, palautetaan puuttuva etunimi
		if ($required == true && strlen ( $this->etunimi ) == 0) {
			return 11;
		}
		
		// Jos etunimi on liian lyhyt, palauta liian lyhyen etunimen virhekoodi
		if(strlen($this->etunimi) < $min) {
			return 12; 	
		}
		
		// Jos etunimi on liian pitkä, palauta liian pitkän etunimen virhekoodi
		if(strlen($this->etunimi) > $max){
			return 13;
		}
		
		// Etunimellä ei enempää tarkistuksia
		return 0;
		
	}
	

	// Käsitellään sukunimi, $required määrittää, onko kenttä vaadittu
	public function checkSuku( $required=true, $min=2, $max=70) {
		
		// Jos ei ole vaadittu, ja on tyhjä, palautetaan kaikki ok
		if ($required == false && strlen ( $this->sukunimi ) == 0) {
			return 0;
		}
			
		// Jos on vaadittu, mutta se on tyhjä, palautetaan puuttuva sukunimi
		if ($required == true && strlen ( $this->sukunimi ) == 0) {
			return 21;
		}
		
		// Jos sukunimi on liian lyhyt, palauta liian lyhyen sukunimen virhekoodi
		if(strlen($this->sukunimi) < $min) {
			return 22; 	
		}
		
		// Jos sukunimi on liian pitkä, palauta liian pitkän sukunimen virhekoodi
		if(strlen($this->sukunimi) > $max){
			return 23;
		}
		
		// Sukunimellä ei enempää tarkistuksia
		return 0;
		
	}
	
	
	
	// Käsitellään hetu, $required määrittää, onko kenttä vaadittu
	public function checkHetu( $required=true ) {
		
		// Jos ei ole vaadittu, ja on tyhjä, palautetaan kaikki ok
		if ($required == false && strlen ( $this->hetu ) == 0) {
			return 0;
		}
			
		// Jos on vaadittu, mutta se on tyhjä, palautetaan puuttuva hetu
		if ($required == true && strlen ( $this->hetu ) == 0) {
			return 31;
		}
		
		// Määritellään hetukuvio ja annetaan ehdotussyöte
		$kuvio = '/(^[0-2][0-9]|3[0-1])(0[0-9]|1[0-2])([0-9][0-9])([+A-])([[:digit:]]{3})([A-Z]|[[:digit:]])/';
		$ehdotus = $this->hetu;
		
		// Tehdään hetu-vertailu, $tulos on syötteestä koostettu array
		if (preg_match($kuvio, $ehdotus, $tulos)) {

			$day = (int)$tulos[1];
			$month = (int)$tulos[2];
			
			//Nollataan muuttuja
			$vuosisata = "";	//Initialization value; Examples
								//"" When you want to append stuff later
								//0  When you want to add numbers later
			if ($tulos[4]=='+') {
				$vuosisata='18';
			} elseif ($tulos[4]=='-') {
				$vuosisata='19';
			} elseif ($tulos[4]=='A') {
				$vuosisata='20';
			} else {
				error_log("Vuosisataa ei saatu kiinni " . $vuosisata, 0);
			}
			
			$vuosi=$vuosisata.$tulos[3];
			$year=(int)$vuosi;
			
			if (checkdate($month, $day, $year)){
				$numerot=$tulos[1].$tulos[2].$tulos[3].$tulos[5];
				$luku = (int)$numerot;
				$jaannos=$luku % 31;
				$lista=array (10=>'A', 11=>'B', 12=>'C', 13=>'D',
							14=>'E', 15=>'F', 16=>'H', 17=>'J',
							18=>'K', 19=>'L', 20=>'M', 21=>'N',
							22=>'P', 23=>'R', 24=>'S', 25=>'T',
							26=>'U', 27=>'V', 28=>'W', 29=>'X', 30=>'Y');
		
				if ($jaannos<10)
					$tarkistus = $jaannos;
				else $tarkistus=$lista[$jaannos];
				
				// Verrataan hetun syötteen viimeistä nroa tarkistussummaan,
				// jos täsmää, hetu on ok
				if ($tulos[6]==$tarkistus) {
					return 0;
				}

				// Muussa tapauksessa tarkistussumma lienee väärin
				else return 32;
			}
			// Päivämäärävirhe
			else return 33;
		}
		
		// Regex ei menny läpi laisinkaan, muu muotovirhe
		else {
			error_log("Regex epätosi", 0);
			return 34;
		}
	}

	
	
	
	// Käsitellään email, $required määrittää, onko kenttä vaadittu
	public function checkSposti( $required=true ) {
		
		// Jos email ei ole vaadittu, ja on tyhjä, palautetaan kaikki ok
		if ($required == false && strlen ( $this->email ) == 0) {
			return 0;
		}
			
		// Jos email on vaadittu, mutta se on tyhjä, palautetaan puuttuva etunimi
		if ($required == true && strlen ( $this->email ) == 0) {
			return 41;
		}
		
		// Tutkitaan onko sähköposti oikean muotoinen
		$eemeli = $this->email;
		if (!filter_var($eemeli, FILTER_VALIDATE_EMAIL)) {
			return 42;
		}
		
		// Sähköpostistin tarkistukset läpäisty
		return 0;
	}




	

	// Käsitellään osoite, $required määrittää, onko kenttä vaadittu
	public function checkOsoite( $required=true, $min=3, $max=100 ) {
		
		// Jos osoite ei ole vaadittu, ja on tyhjä, palautetaan kaikki ok
		if ($required == false && strlen ( $this->osoite ) == 0) {
			return 0;
		}
			
		// Jos osoite on vaadittu, mutta se on tyhjä, palautetaan puuttuva osoite
		if ($required == true && strlen ( $this->osoite ) == 0) {
			return 51;
		}
		
		// Jos osoite liian lyhyt
		if(strlen($this->osoite) < $min) {
			return 52; 	
		}
		
		// Jos osoite on liian pitkä
		if(strlen($this->osoite) > $max){
			return 53;
		}
		
		// Tarkistetaan ettei osoitteessa ole erikoismerkkejä
		// Toisin sanoen, osoitteessa saa olla vain kirjaimia, numeroita ja - ,.
		if (preg_match ( "/^[a-zöåä0-9,.\-\ ]$/i", $this->osoite )) {
			return 54;
		} 
	
		// Osoitetarkistukset tehty
		return 0;
	}

	
	
	
	
	// Käsitellään postinro, $required määrittää, onko kenttä vaadittu
	public function checkPostinro( $required=true, $len=5 ) {
		
		// Jos postinumero ei ole vaadittu, ja on tyhjä, palautetaan kaikki ok
		if ($required == false && strlen ( $this->postinro ) == 0) {
			return 0;
		}
			
		// Jos postinumero on vaadittu, mutta se on tyhjä, palautetaan puuttuva postinumero
		if ($required == true && strlen ( $this->postinro ) == 0) {
			return 61;
		}
		
		// Jos postinumerossa väärä määrä numeroita
		if(strlen($this->postinro) != $len) {
			return 62; 	
		}
	
		// Onko 5 numeroa
		if (! preg_match ( "/^\d{5}$/", $this->postinro )) {
			return 63;
		}
	
		// Postinumerotarkistukset tehty
		return 0;
	}
	

	
	
	
	// Käsitellään vielä lisätiedot
	public function checkInfo($required = true, $min = 10, $max = 4000) {
		// Jos saa olla tyhjä ja on tyhjä
		if ($required == false && strlen ( $this->info ) == 0) {
			return 0;
		}
			
		// Jos ei saa olla tyhjä ja on tyhjä
		if ($required == true && strlen ( $this->info ) == 0) {
			return 71;
		}
			
		// Jos kommentti on liian lyhyt
		if (strlen ( $this->info ) < $min) {
			return 72;
		}
			
		// Jos kommentti on liian pitkä
		if (strlen ( $this->info ) > $max) {
			return 73;
		}
			
		// Lisätietotarkistus
		if (preg_match ( "/^[a-zöåä0-9\-.,!?]$/i", $this->info )) {
			return 74;
		}
		
		// Muussa tapauksessa ok
		return 0;
	}
	
	
	
	
	
	
	
	
	// Funkkarilla näytetään virhekoodia vastaava teksti...
	public static function getError($koodi) {
		if (isset(self::$virhekoodit [$koodi])) {
			return self::$virhekoodit [$koodi];
		}
		// ...tai geneerisempi Virheellinen tieto -herja
		return self::$virhekoodit [- 1];
	}
}


?>
