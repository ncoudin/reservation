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
			$utilisateur=getUtilisateur($req);
			$_SESSION['utilisateur']=$utilisateur;
			header('Location: index.php');
  			exit();
		}
		else
			echo"<p style='padding-left:5px'> Pseudo ou mot de passe invalide ! <a href='index.php'>Retour à l'accueil</a></p>";
	break;

	case 'Se déconnecter':
		$_SESSION['utilisateur']=null;
		header('Location: index.php');
  		exit();
	break;

	case 'Créer':
		$pseudo=$_POST['pseudo'];
		$nom=$_POST['nom'];
		$prenom=$_POST['prenom'];
		$rue=$_POST['rue'];
		$cp=$_POST['cp'];
		$email=$_POST['email'];
		$mdp=$_POST['mdp'];
		$req=$bdd->query("select * from utilisateur where pseudo='$pseudo'");
		if($req->rowCount()>0)
			echo "<p>Impossible de créer un compte, le pseudo est déjà pris ! <a href='creer.php'>Retour</a></p>";
		else
		{
			$utilisateur=new utilisateur($pseudo, $nom, $prenom, $rue, $cp, $email, $mdp, '0');
			$utilisateur->insererUtilisateur($bdd);
			echo "<p style='padding-left:5px'> Compte créé avec succès ! <a href='index.php'>Retour</a></p>";
		}

	break;

	case 'Réserver':
		echo"<h2>Confirmation d'achat</h2>";
		if(isset($_SESSION['utilisateur'])) {
			$refVol=$_POST['refVol'];
			$siegeReserve=$_POST['siegeReserve'];
			$vol=getVol($bdd->query("SELECT * FROM vol WHERE refVol='$refVol'"));
			$typeAvion=getTypeAvion($bdd->query("SELECT numType, nomType, nbSiege FROM typeAvion, avion WHERE typeAvion = numType AND refAvion='$vol->avion'"));
			$aeroport1=getAeroport($bdd->query("SELECT * FROM aeroport WHERE refAeroport='$vol->aeroport1'"));
			$aeroport2=getAeroport($bdd->query("SELECT * FROM aeroport WHERE refAeroport='$vol->aeroport2'"));
			$dateDepart = new DateTime($vol->dateDepart);
			$dateDepart = $dateDepart->format('d/m/Y à H:i');
			$dateArrivee = new DateTime($vol->dateArrivee);
			$dateArrivee = $dateArrivee->format('d/m/Y à H:i');
			$prix=$vol->prix;
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
			echo"<p style='padding-left:5px'> Veuillez vous connecter !</p>";
	break;

	case 'Confirmer achat':
		$refVol=$_POST['refVol'];
		$siegeReserve=$_POST['siegeReserve'];
		$utilisateur=$_SESSION['utilisateur'];
		$req=$bdd->query("SELECT * FROM reservation WHERE utilisateur='$utilisateur->pseudo' AND vol='$refVol'");
		if($req->rowCount()>0) {
			$reservation=getReservation($req);
			$reservation->placeReserve+=$siegeReserve;
			$reservation->majReservation($bdd);
		}
		else {
		$reservation = new reservation($utilisateur->pseudo,$refVol,$siegeReserve);
		$reservation->insererReservation($bdd);
		}
		header('Location: place.php');
  		exit();
	break;

	case 'Annuler achat':
		$refVol=$_POST['refVol'];
		$reservation=getReservation($bdd->query("SELECT * FROM reservation WHERE vol='$refVol' AND utilisateur='$utilisateur->pseudo'"));
		$reservation->supprimerReservation($bdd);
		header('Location: place.php');
  		exit();
	break;

	case 'CreerUtilisateur' :
		$user = new utilisateur($_POST['pseudo'], $_POST['nom'], $_POST['prenom'], $_POST['rue'], $_POST['cp'], $_POST['email'], $_POST['mdp'], '0');
		$user->insererUtilisateur($bdd);
		header('Location: gestion_utilisateur.php');
		exit();
	break;

	case 'ModifierUtilisateur':
		$user = new utilisateur($_POST['pseudo'], $_POST['nom'], $_POST['prenom'], $_POST['rue'], $_POST['cp'], $_POST['email'], $_POST['mdp'], '0');
		$user->majUtilisateur($bdd);
		header('Location: gestion_utilisateur.php');
		exit();
	break;

	case 'SupprimerUtilisateur':
		$user = new utilisateur($_POST['pseudo'], $_POST['nom'], $_POST['prenom'], $_POST['rue'], $_POST['cp'], $_POST['email'], $_POST['mdp'], '0');
		$user->supprimerUtilisateur($bdd);
		header('Location: gestion_utilisateur.php');
		exit();
	break;

	case 'CreerVol':
		$dateDepart =  str_replace('T', ' ', $_POST['dateDepart']);
		$dateArrivee =  str_replace('T', ' ', $_POST['dateArrivee']);
		$vol = new vol('null',$_POST['avion'],$_POST['aeroport1'],$_POST['aeroport2'],$dateDepart,$dateArrivee,$_POST['prix']);
		$vol->insererVol($bdd);
		header('Location: gestion_vol.php');
		exit();
	break;

	case 'ModifierVol':

		$dateDepart =  str_replace('T', ' ', $_POST['dateDepart']);
		$dateArrivee =  str_replace('T', ' ', $_POST['dateArrivee']);
		if($dateDepart>$dateArrivee) {
			header('Location: gestion_vol.php');
			exit(); }
		if($_POST['aeroport1']==$_POST['aeroport2']) {
			header('Location: gestion_vol.php');
			exit(); }
		$vol = new vol($_POST['refVol'],$_POST['avion'],$_POST['aeroport1'],$_POST['aeroport2'],$dateDepart,$dateArrivee,$_POST['prix']);
		$vol->majVol($bdd);
		header('Location: gestion_vol.php');
		exit();
	break;

	case 'SupprimerVol':
		$dateDepart =  str_replace('T', ' ', $_POST['dateDepart']);
		$dateArrivee =  str_replace('T', ' ', $_POST['dateArrivee']);
		$vol = new vol($_POST['refVol'],$_POST['avion'],$_POST['aeroport1'],$_POST['aeroport2'],$dateDepart,$dateArrivee,$_POST['prix']);
		$vol->supprimerVol($bdd);
		header('Location: gestion_vol.php');
		exit();
	break;

	}
}

?>