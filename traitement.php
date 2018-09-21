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
		if($req->rowCount()>0)
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

	case 'Réserver':
		if(isset($_SESSION['utilisateur'])) {
			$refVol=$_POST['refVol'];
			$siegeReserve=$_POST['siegeReserve'];
			$req=$bdd->query("SELECT * FROM vol WHERE refVol='$refVol'");
			$req->setFetchMode(PDO::FETCH_CLASS,'vol');
			$vol=$req->fetch();
			$prix=$vol->prix;
			$req=$bdd->query("SELECT numType, nomType, nbSiege FROM typeAvion, avion WHERE typeAvion = numType AND refAvion='$vol->avion'");
			$req->setFetchMode(PDO::FETCH_CLASS,'typeAvion');
			$typeAvion=$req->fetch();
			$dateDepart = new DateTime($vol->dateDepart);
			$dateDepart = $dateDepart->format('d/m/Y à H:i');
			$dateArrivee = new DateTime($vol->dateArrivee);
			$dateArrivee = $dateArrivee->format('d/m/Y à H:i');
			$req=$bdd->query("SELECT * FROM aeroport WHERE refAeroport='$vol->aeroport1'");
			$req->setFetchMode(PDO::FETCH_CLASS,'aeroport');
			$aeroport1=$req->fetch();
			$req=$bdd->query("SELECT * FROM aeroport WHERE refAeroport='$vol->aeroport2'");
			$req->setFetchMode(PDO::FETCH_CLASS,'aeroport');
			$aeroport2=$req->fetch();
			$total=$prix*$siegeReserve;
			echo"<table class='table'>
					<form method='post' action='traitement.php'><input type='hidden' name='refVol' value='$refVol'/><input type='hidden' name='siegeReserve' value='$siegeReserve'/>
					<tr>
						<td><b>Avion</b></td>
						<td>n°$vol->avion, modèle $typeAvion->nomType</td>
					</tr>
					<tr>
						<td><b>Trajet</b></td>
						<td>Départ : le <b>$dateDepart</b> à <b>$aeroport1->nomAeroport</b> | Arrivée : le <b>$dateArrivee</b> à <b>$aeroport2->nomAeroport</b></td>
					</tr>
					<tr>
						<td><b>Prix</b></td>
						<td><b>$siegeReserve</b> place(s) à <b>$prix €</b> | <b><u>TOTAL : $total €</u></b> <input class='btn btn-default' type='submit' name='choix' value='Confirmer achat'/></td>
					</tr>
					</form>
				 </table>
					";
		}
		else
			echo"Veuillez vous connecter !";
	break;

	case 'Confirmer achat':
		$refVol=$_POST['refVol'];
		$siegeReserve=$_POST['siegeReserve'];
		$utilisateur=$_SESSION['utilisateur'];
		$req=$bdd->query("SELECT * FROM reservation WHERE utilisateur='$utilisateur->pseudo' AND vol='$refVol'");
		if($req->rowCount()>0) {
			$req->setFetchMode(PDO::FETCH_CLASS,'reservation');
			$reservation=$req->fetch();
			$reservation->placeReserve+=$siegeReserve;
			$bdd->exec("UPDATE reservation SET placeReserve=$reservation->placeReserve");
		}
		else {
		$reservation = new reservation($utilisateur->pseudo,$refVol,$siegeReserve);
		$req=$bdd->query("INSERT INTO reservation values('$reservation->utilisateur','$reservation->vol',$reservation->placeReserve)");
		}
		header('Location: place.php');
  		exit();
	break;

	case 'Annuler achat':
		$refVol=$_POST['refVol'];
		$bdd->exec("DELETE FROM reservation WHERE vol='$refVol' AND utilisateur='$utilisateur->pseudo'");
		header('Location: place.php');
  		exit();
	break;
	}
}

?>