<?php
include('connexion.php');
include('entete.php');

if(isset($_POST['choix']))
{
	if($_POST['choix']!= 'Se connecter' and $_POST['choix']!='Se déconnecter')
		include('utilisateur.php');
	switch($_POST['choix']){

	case 'Se connecter':
		$pseudo=$_POST['pseudo'];
		$mdp=$_POST['mdp'];
		$res=$bdd->query("select * from utilisateur where pseudo='$pseudo' and mdp='$mdp'");
		if($res->rowCount()>0)
		{
			$_SESSION['pseudo']=$pseudo;
			echo"$pseudo, vous êtes connecté ! <a href='index.php'>Retour à l'accueil</a>";
		}
		else
			echo"<p> Pseudo ou mot de passe invalide ! <a href='index.php'>Retour à l'accueil</a></p>";
	break;

	case 'Se déconnecter':
		$_SESSION['pseudo']=null;
		echo"Vous êtes déconnecté ! <a href='index.php'>Retour à l'accueil</a>";
	break;

	case 'Créer':
		$pseudo=$_POST['pseudo'];
		$mdp=$_POST['mdp'];
		$req=$bdd->query("select * from utilisateur");
		$req->setFetchMode(PDO::FETCH_CLASS, 'utilisateur');
		$res=$req->fetchAll();
		foreach($res as $utilisateur)
		{
		}
	}
}

?>