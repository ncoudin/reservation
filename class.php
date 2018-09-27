<?php
class utilisateur {
	public $pseudo;
	public $nom;
	public $prenom;
	public $rue;
	public $cp;
	public $email;
	public $mdp;
	public $admin;

	function utilisateur($pseudo=null, $nom=null, $prenom=null, $rue=null, $cp=null, $email=null ,$mdp=null, $admin=null) {
		if($pseudo!=null)$this->pseudo=$pseudo;
		if($nom!=null)$this->nom=$nom;
		if($prenom!=null)$this->prenom=$prenom;
		if($rue!=null)$this->rue=$rue;
		if($cp!=null)$this->cp=$cp;
		if($email!=null)$this->email=$email;
		if($mdp!=null)$this->mdp=$mdp;
		if($admin!=null)$this->admin=$admin;
	}

	function majUtilisateur($bdd) {
		if($this->cp==null)
			$this->cp='null';
		$bdd->exec("UPDATE utilisateur SET nom='$this->nom', prenom='$this->prenom', rue='$this->rue', cp=$this->cp, email='$this->email', mdp='$this->mdp', admin=$this->admin where pseudo='$this->pseudo'");
	}

	function insererUtilisateur($bdd) {
		if($this->cp==null)
			$this->cp='null';
		$bdd->query("INSERT INTO utilisateur values('$this->pseudo', '$this->nom', '$this->prenom', '$this->rue', $this->cp, '$this->email', '$this->mdp', $this->admin)");
	}
	function supprimerUtilisateur($bdd) {
		$bdd->exec("DELETE FROM utilisateur where pseudo='$this->pseudo'");
	}
}

class typeAvion {
	public $numType;
	public $nomType;
	public $nbSiege;

	function typeAvion($numType=null, $nomType=null, $nbSiege=null) {
		if($numType!=null)$this->numType=$numType;
		if($nomType!=null)$this->nomType=$nomType;
		if($nbSiege!=null)$this->nbSiege=$nbSiege;
	}
}

class avion {
	public $refAvion;
	public $typeAvion;

	function avion($refAvion=null, $typeAvion=null) {
		if($refAvion!=null)$this->refAvion=$refAvion;
		if($typeAvion!=null)$this->typeAvion=$typeAvion;
	}

	function majAvion($bdd) {
		$bdd->exec("UPDATE avion SET typeAvion='$this->typeAvion'");
	}

	function insererAvion($bdd) {
		$bdd->exec("INSERT INTO avion(typeAvion) values('$this->typeAvion')");
	}

	function supprimerAvion($bdd) {
		$bdd->exec("DELETE FROM avion WHERE refAvion='$this->refAvion'");
	}
}

class aeroport {
	public $refAeroport;
	public $nomAeroport;

	function aeroport($refAeroport=null, $nomAeroport=null) {
		if($refAeroport!=null)$this->refAeroport=$refAeroport;
		if($nomAeroport!=null)$this->nomAeroport=$nomAeroport;
	}

	function majAeroport($bdd) {
		$bdd->exec("UPDATE aeroport SET nomAeroport='$this->nomAeroport'");
	}

	function insererAeroport($bdd) {
		$bdd->exec("INSERT INTO aeroport(nomAeroport) values('$this->nomAeroport')");
	}

	function supprimerAeroport($bdd) {
		$bdd->exec("DELETE FROM aeroport WHERE refAeroport='$this->refAeroport'");
	}
}

class vol {
	public $refVol;
	public $avion;
	public $aeroport1;
	public $aeroport2;
	public $dateDepart;
	public $dateArrivee;
	public $prix;

	function vol($refVol=null, $avion=null, $aeroport1=null, $aeroport2=null, $dateDepart=null, $dateArrivee=null, $prix=null) {
		if($refVol!=null)$this->refVol=$refVol;
		if($avion!=null)$this->avion=$avion;
		if($aeroport1!=null)$this->aeroport1=$aeroport1;
		if($aeroport2!=null)$this->aeroport2=$aeroport2;
		if($dateDepart!=null)$this->dateDepart=$dateDepart;		
		if($dateArrivee!=null)$this->dateArrivee=$dateArrivee;
		if($prix!=null)$this->prix=$prix;
	}

	function majVol($bdd) {
		$bdd->exec("UPDATE vol SET avion='$this->avion', aeroport1='$this->aeroport1', aeroport2='$this->aeroport2', dateDepart='$this->dateDepart', dateArrivee='$this->dateArrivee', prix='$this->prix' where refVol='$this->refVol'");
	}

	function supprimerVol($bdd) {
		$bdd->exec("DELETE FROM vol WHERE refVol='$this->refVol'");
	}

	function insererVol($bdd) {
		$bdd->exec("INSERT INTO vol(avion, aeroport1, aeroport2, dateDepart, dateArrivee, prix) values ('$this->avion','$this->aeroport1','$this->aeroport2', '$this->dateDepart', '$this->dateArrivee', '$this->prix')");
	}
}

class reservation {
	public $utilisateur;
	public $vol;
	public $placeReserve;

	function reservation($utilisateur=null, $vol=null, $placeReserve=null) {
		if($utilisateur!=null)$this->utilisateur=$utilisateur;
		if($vol!=null)$this->vol=$vol;
		if($placeReserve!=null)$this->placeReserve=$placeReserve;
	}

	function majReservation($bdd) {
		$bdd->exec("UPDATE reservation SET placeReserve=$this->placeReserve WHERE utilisateur='$this->utilisateur' AND vol='$this->vol'");
	}

	function insererReservation($bdd) {
		$bdd->exec("INSERT INTO reservation values('$this->utilisateur','$this->vol',$this->placeReserve)");
	}

	function supprimerReservation($bdd) {
		$bdd->exec("DELETE FROM reservation WHERE vol='$this->vol' AND utilisateur='$this->utilisateur'");
	}
}






function getUtilisateur($req)
{
	$req->setFetchMode(PDO::FETCH_CLASS,'utilisateur');
	return $req->fetch();
}

function getTypeAvion($req)
{
	$req->setFetchMode(PDO::FETCH_CLASS,'typeAvion');
	return $req->fetch();
}

function getAvion($req)
{
	$req->setFetchMode(PDO::FETCH_CLASS,'avion');
	return $req->fetch();
}

function getAeroport($req)
{
	$req->setFetchMode(PDO::FETCH_CLASS,'aeroport');
	return $req->fetch();
}

function getVol($req)
{
	$req->setFetchMode(PDO::FETCH_CLASS,'vol');
	return $vol=$req->fetch();
}

function getReservation($req)
{
	$req->setFetchMode(PDO::FETCH_CLASS,'reservation');
	return $req->fetch();

}





function getUtilisateurs($req)
{
	$req->setFetchMode(PDO::FETCH_CLASS,'utilisateur');
	return $req->fetchAll();
}

function getTypeAvions($req)
{
	$req->setFetchMode(PDO::FETCH_CLASS,'typeAvion');
	return $req->fetchAll();
}

function getAvions($req)
{
	$req->setFetchMode(PDO::FETCH_CLASS,'avion');
	return $req->fetchAll();
}

function getAeroports($req)
{
	$req->setFetchMode(PDO::FETCH_CLASS,'aeroport');
	return $req->fetchAll();
}

function getVols($req)
{
	$req->setFetchMode(PDO::FETCH_CLASS,'vol');
	return $vol=$req->fetchAll();
}

function getReservations($req)
{
	$req->setFetchMode(PDO::FETCH_CLASS,'reservation');
	return $req->fetchAll();
}

?>