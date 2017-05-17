<?php
// Haetaan lomaketietojen käsittelyt
require_once ("rekisteri.php");

# Get DB Configuration
require_once 'dbconf.php';

class tietokantaOLIO {
	private static $virhelista = array (
			- 1 => "Virheellinen tieto",
			0 => "",
			1 => "Yhteys ei onnistu",
			6 => "Kaikkien haku ei onnistunut",
			7 => "Lisäys ei onnistunut",
			8 => "Haku ei onnistunut",
			9 => "Poisto ei onnistunut" 
	);
	
	private $connection;
	private $lkm;
	
		
	function __construct($dsn = "mysql:host=" . $mHost . "; dbname=" . $mDb , $user = $mUser, $password = $mPass) {
		// Ota yhteys kantaan
		if (! $this->connection = new PDO ( $dsn, $user, $password ))
			throw new Exception ( $virhelista [1], 1 );
			
		// Virheiden jäljitys kehitysaikana
		$this->connection->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$this->connection->setAttribute ( PDO::ATTR_EMULATE_PREPARES, false );
		
		// Tulosrivien määrä
		$this->lkm = 0;
	}
	
	function getLkm() {
		return $this->lkm;
	}
	
	
	public function kaikkiHenkilot() {
		$sql = "SELECT id, etunimi, sukunimi, osoite, postinr, sposti FROM jasenet";
		
		// Valmistellaan lause
		if (! $stmt = $this->connection->prepare ( $sql ))
			throw new Exception ( $virhelista [6], 6 );
			
			// Laita parametrit (ei tässä)
			
		// Aja lauseke
		if (! $stmt->execute ())
			throw new Exception ( $virhelista [6], 6 );
			
		// Käsittele hakulausekkeen tulos
		$tulos = array ();
		while ( $row = $stmt->fetchObject () ) {
			$hen = new Henkilo ();
			$hen->setId ( $row->id );
			$hen->setEtunimi ( utf8_encode ( $row->etunimi ) );
			$hen->setSukunimi ( utf8_encode ( $row->sukunimi ) );
			$hen->setLahiosoite ( utf8_encode ( $row->lahiosoite ) );
			$hen->setPostinumero ( $row->postinumero );
			$hen->setPostitoimipaikka ( utf8_encode ( $row->postitoimipaikka ) );
			$hen->setPuhelinnumero ( utf8_encode ( $row->puhelin ) );
			$hen->setPalkka ( $row->palkka );
			$hen->setTyohontulo ( $row->alku );
			$hen->setLisatieto ( utf8_encode ( $row->lisatieto ) );
			
			$tulos [] = $hen;
		}
		
		$this->lkm = $stmt->rowCount ();
		
		return $tulos;
	}
	

	public function haeHenkilotNimella($nimi) {
		$sql = "SELECT id, etunimi, sukunimi, lahiosoite, postinumero, postitoimipaikka, puhelin, palkka, alku, lisatieto FROM henkilo WHERE sukunimi like :nimi";
		
		// Valmistellaan lause
		if (! $stmt = $this->connection->prepare ( $sql ))
			throw new Exception ( $virhelista [8], 8 );
			
			// Laita parametrit
		$ni = "%" . utf8_decode ( $nimi ) . "%";
		$stmt->bindValue ( ":nimi", $ni );
		
		// Aja lauseke
		if (! $stmt->execute ())
			throw new Exception ( $virhelista [8], 8 );
			
			// Käsittele hakulausekkeen tulos
		$tulos = array ();
		while ( $row = $stmt->fetchObject () ) {
			$hen = new Henkilo ();
			
			$hen->setId ( $row->id );
			$hen->setEtunimi ( utf8_encode ( $row->etunimi ) );
			$hen->setSukunimi ( utf8_encode ( $row->sukunimi ) );
			$hen->setLahiosoite ( utf8_encode ( $row->lahiosoite ) );
			$hen->setPostinumero ( $row->postinumero );
			$hen->setPostitoimipaikka ( utf8_encode ( $row->postitoimipaikka ) );
			$hen->setPuhelinnumero ( utf8_encode ( $row->puhelin ) );
			$hen->setPalkka ( $row->palkka );
			$hen->setTyohontulo ( $row->alku );
			$hen->setLisatieto ( utf8_encode ( $row->lisatieto ) );
			
			$tulos [] = $hen;
		}
		
		$this->lkm = $stmt->rowCount ();
		
		return $tulos;
	}
	
	public function haeHenkilo($id) {
		$sql = "SELECT id, etunimi, sukunimi, lahiosoite, postinumero, postitoimipaikka, puhelin, palkka, alku, lisatieto FROM henkilo WHERE id = :id";
	
		// Valmistellaan lause
		if (! $stmt = $this->connection->prepare ( $sql ))
			throw new Exception ( $virhelista [8], 8 );
			
		// Laita parametrit
		$stmt->bindValue ( ":id", $id );
	
		// Aja lauseke
		if (! $stmt->execute ())
			throw new Exception ( $virhelista [8], 8 );
			
		// Käsittele hakulausekkeen tulos
		$row = $stmt->fetchObject ();
		if ($stmt->rowCount() == 1) {
			$hen = new Henkilo ();
				
			$hen->setId ( $row->id );
			$hen->setEtunimi ( utf8_encode ( $row->etunimi ) );
			$hen->setSukunimi ( utf8_encode ( $row->sukunimi ) );
			$hen->setLahiosoite ( utf8_encode ( $row->lahiosoite ) );
			$hen->setPostinumero ( $row->postinumero );
			$hen->setPostitoimipaikka ( utf8_encode ( $row->postitoimipaikka ) );
			$hen->setPuhelinnumero ( utf8_encode ( $row->puhelin ) );
			$hen->setPalkka ( $row->palkka );
			$hen->setTyohontulo ( $row->alku );
			$hen->setLisatieto ( utf8_encode ( $row->lisatieto ) );
		} else {
			$hen = null;
		}
	
		$this->lkm = $stmt->rowCount ();
	
		return $hen;
	}
	
	function lisaaHenkilo($hen) {
		$sql = "insert into henkilo (etunimi, sukunimi, lahiosoite, postinumero, postitoimipaikka, puhelin, palkka, alku, lisatieto) " . "values (:etunimi, :sukunimi, :lahiosoite, :postinumero, :postitoimipaikka, :puhelin, :palkka, :alku, :lisatieto)";
		
		// Valmistellaan SQL-lause
		if (! $stmt = $this->connection->prepare ( $sql ))
			throw new Exception ( $virhelista [7], 7 );
			
			// Parametrien sidonta
		$stmt->bindValue ( ":etunimi", utf8_decode ( $hen->getEtunimi () ) );
		$stmt->bindValue ( ":sukunimi", utf8_decode ( $hen->getSukunimi () ) );
		$stmt->bindValue ( ":postinumero", utf8_decode ( $hen->getPostinumero () ) );
		$stmt->bindValue ( ":postitoimipaikka", utf8_decode ( $hen->getPostitoimipaikka () ) );
		$stmt->bindValue ( ":lahiosoite", utf8_decode ( $hen->getLahiosoite () ) );
		$stmt->bindValue ( ":puhelin", utf8_decode ( $hen->getPuhelinnumero () ) );
		$stmt->bindValue ( ":palkka", $hen->getPalkka () );
		$stmt->bindValue ( ":alku", $hen->getTyohontulo () );
		$stmt->bindValue ( ":lisatieto", utf8_decode ( $hen->getLisatieto () ) );
		
		// Suoritetaan SQL-lause (insert)
		if (! $stmt->execute ())
			throw new Exception ( $virhelista [7], 7 );
		
		$this->lkm = $stmt->rowCount ();
		
		return $this->connection->lastInsertId ();
	}
	
	public function poistaHenkilo($id) {
		$sql = "DELETE FROM henkilo WHERE id=:id";
		
		// Valmistellaan lause
		if (! $stmt = $this->connection->prepare ( $sql ))
			throw new Exception ( $virhelista [9], 9 );
			
			// Laita parametrit
		$stmt->bindValue ( ":id", $id );
		
		// Aja lauseke
		if (! $stmt->execute ())
			throw new Exception ( $virhelista [9], 9 );
			
			// Suoritetaan SQL-lause
		if (! $stmt->execute ())
			throw new Exception ( $virhelista [9], 9 );
		
		$this->lkm = $stmt->rowCount ();
	}
}
?>



	
	
	
	
	
	
	
	
	
	
	
	
	
	
	