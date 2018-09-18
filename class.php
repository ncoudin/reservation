<?php
include('connexion.php');

class utilisateur {
	var $pseudo;
	var $mdp;
	var $admin;

	function utilisateur($pseudo, $mdp, $admin) {
		$this->pseudo=$pseudo;
		$this->mdp=$mdp;
		$this->admin=$admin;
	}

	function insUtilisateur($bdd) {
		$bdd->query("INSERT INTO utilisateur values('$this->pseudo', '$this->mdp', $this->admin)");
	}
	function delUtilisateur($bdd) {
		$bdd->exec("DELETE FROM utilisateur where pseudo='$this->pseudo'");
	}

}

$utilisateur = new utilisateur('testpseudo','testmdp',0);
$utilisateur->delUtilisateur($bdd);
?>