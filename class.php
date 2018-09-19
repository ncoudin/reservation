<?php
include('connexion.php');

class utilisateur {
	public $pseudo;
	public $mdp;
	public $admin;

/*	function utilisateur($pseudo=null, $mdp=null, $admin=null) {
		if($pseudo!=null)$this->pseudo=$pseudo;
		if($mdp!=null)$this->mdp=$mdp;
		if($admin!=null)$this->admin=$admin;
	}*/

	function saveUtilisateur($bdd) {
		$bdd->exec("UPDATE utilisateur SET mdp='$this->mdp', admin=$this->admin where pseudo='$this->pseudo'");
	}

	function insUtilisateur($bdd) {
		$bdd->query("INSERT INTO utilisateur values('$this->pseudo', '$this->mdp', $this->admin)");
	}
	function delUtilisateur($bdd) {
		$bdd->exec("DELETE FROM utilisateur where pseudo='$this->pseudo'");
	}

	function reqUtilisateur($bdd,$req) {
		$req=$bdd->query($req);
		$req->setFetchMode(PDO::FETCH_CLASS, 'utilisateur');
		$res=$req->fetchAll();
		return $res;
	}

}

?>