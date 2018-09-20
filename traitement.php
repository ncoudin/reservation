<?php
include('connexion.php');
include('entete.php');

if(isset($_POST['choix']))
{
	switch($_POST['choix']){

	case 'Se connecter':
		$pseudo=$_POST['pseudo'];
		$mdp=$_POST['mdp'];
		$req=$bdd->query("select * from utilisateur where pseudo='$pseudo' and mdp='$mdp'");
		if($req->rowCount()==1)
		{
			$req->setFetchMode(PDO::FETCH_CLASS,'utilisateur');
			$utilisateur=$req->fetch();
			$_SESSION['utilisateur']=$utilisateur;
			header('Location: index.php');
  			exit();
		}
		else
			echo"<p> Pseudo ou mot de passe invalide ! <a href='index.php'>Retour à l'accueil</a></p>";
	break;

	case 'Se déconnecter':
		$_SESSION['utilisateur']=null;
		header('Location: index.php');
  		exit();
	break;

	case 'Créer':
		$pseudo=$_POST['pseudo'];
		$mdp=$_POST['mdp'];
		$req=$bdd->query("select * from utilisateur where pseudo='$pseudo'");
		if($req->rowCount()>0)
			echo "<p>Impossible de créer un compte, le pseudo est déjà pris ! <a href='creer.php'>Retour</a></p>";
		else
		{
			$req=$bdd->query("INSERT INTO utilisateur(pseudo,mdp) values('$pseudo','$mdp')");
			echo "<p> Compte créé avec succès ! <a href='index.php>Retour</a></p>";
		}

	break;
	}
}

?>