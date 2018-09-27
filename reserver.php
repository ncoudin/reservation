<?php
include('connexion.php');
include('entete.php');
?>
<h2 style='padding-left:5px;'>Réserver</h2><br/>
<?php
$req=$bdd->query("SELECT * FROM vol");
	if($req->rowCount()==0)
		echo "<p style='padding-left:5px'>Aucun vol n'est organisé...</p>";
	else {
		echo"<div class='panel panel-default'>
				<div class='panel-heading'>Vols organisés</div>
			 <table class='table'>
			 	<thead>
			 		<tr>
			 			<td>Modèle</td>
			 			<td>Départ</td>
			 			<td>Destination</td>
			 			<td colspan='2'>Prix</td>
			 		</tr>
			 	</thead>
			 	<tbody>";
		$vols=getVols($req);
		foreach($vols as $vol) {
			$typeAvion=getTypeAvion($bdd->query("SELECT numType, nomType, nbSiege FROM typeAvion, avion WHERE typeAvion = numType AND refAvion='$vol->avion'"));
			$dateDepart = new DateTime($vol->dateDepart);
			$dateDepart = $dateDepart->format('d/m/Y à H:i');
			$dateArrivee = new DateTime($vol->dateArrivee);
			$dateArrivee = $dateArrivee->format('d/m/Y à H:i');
			$aeroport1=getAeroport($bdd->query("SELECT * FROM aeroport WHERE refAeroport='$vol->aeroport1'"));
			$aeroport2=getAeroport($bdd->query("SELECT * FROM aeroport WHERE refAeroport='$vol->aeroport2'"));
			echo"<tr>
					<form method='post' action='traitement.php'>
						<input type='hidden' name='refVol' value='$vol->refVol'/>
						<td>$typeAvion->nomType</td>
						<td>$aeroport1->nomAeroport le $dateDepart</td>
						<td>$aeroport2->nomAeroport le $dateArrivee</td>
						<td>$vol->prix €</td>
						<td>Nombre de places à réserver : <select name='siegeReserve'/><option>1<option>2<option>3<option>4</select> <input class='btn btn-default' type='submit' name='choix' value='Réserver'/></td>
					</form>
				 </tr>
				</tbody>
			 </table>";
		}
	}

?>