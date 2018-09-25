<?php
include('connexion.php');
include('entete.php');
?>
<body>
<h2>Vos places</h2><br/>

<?php
if(isset($_SESSION['utilisateur']))
{
	$req=$bdd->query("SELECT * FROM reservation WHERE utilisateur='$utilisateur->pseudo'");
	if($req->rowCount()==0)
		echo "<p>Vous n'avez aucune place de réservée :(</p>";
	else {
		$reservations=getReservations($req);
		foreach($reservations as $reservation) {
			$vol=getVol($bdd->query("SELECT * FROM vol WHERE refVol='$reservation->vol'"));
			$typeAvion=getTypeAvion($bdd->query("SELECT numType, nomType, nbSiege FROM typeAvion, avion WHERE typeAvion = numType AND refAvion='$vol->avion'"));
			$aeroport1=getAeroport($bdd->query("SELECT * FROM aeroport WHERE refAeroport='$vol->aeroport1'"));
			$aeroport2=getAeroport($bdd->query("SELECT * FROM aeroport WHERE refAeroport='$vol->aeroport2'"));
			$dateDepart = new DateTime($vol->dateDepart);
			$dateDepart = $dateDepart->format('d/m/Y à H:i');
			$dateArrivee = new DateTime($vol->dateArrivee);
			$dateArrivee = $dateArrivee->format('d/m/Y à H:i');
			$prix=$vol->prix;
			$total=$prix*$reservation->placeReserve;
			echo"<table class='table'>
						<form method='post' action='traitement.php'>
						<input type='hidden' name='refVol' value='$vol->refVol'/>
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
							<td><b>$reservation->placeReserve</b> place(s) à <b>$prix €</b> | <b><u>TOTAL : $total €</u></b> <input class='btn btn-default' type='submit' name='choix' value='Annuler achat'/></td>
						</tr>
						</form>
					 </table><br/>";
		}
	}
}
else
	echo"<p>Veuillez vous connecter !</p>";
?>
</body>