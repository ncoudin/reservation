<?php
class utilisateur {
	public $pseudo;
	public $mdp;
	public $admin;

	function utilisateur($pseudo=null, $mdp=null, $admin=null) {
		if($pseudo!=null)$this->pseudo=$pseudo;
		if($mdp!=null)$this->mdp=$mdp;
		if($admin!=null)$this->admin=$admin;
	}

	function saveUtilisateur($bdd) {
		$bdd->exec("UPDATE utilisateur SET mdp='$this->mdp', admin=$this->admin where pseudo='$this->pseudo'");
	}

	function insUtilisateur($bdd) {
		$bdd->query("INSERT INTO utilisateur values('$this->pseudo', '$this->mdp', $this->admin)");
	}
	function delUtilisateur($bdd) {
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
}

class aeroport {
	public $refAeroport;
	public $nomAeroport;

	function aeroport($refAeroport=null, $nomAeroport=null) {
		if($refAeroport!=null)$this->refAeroport=$refAeroport;
		if($nomAeroport!=null)$this->nomAeroport=$nomAeroport;
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
}

?>