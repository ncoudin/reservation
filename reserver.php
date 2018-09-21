<?php
include('connexion.php');
include('entete.php');
?>
<h2>Réserver</h2><br/>
<?php
echo"<table class='table'>
	 	<thead>
	 		<tr>
	 			<td>Modèle</td>
	 			<td>Départ</td>
	 			<td>Destination</td>
	 			<td colspan='2'>Prix</td>
	 		</tr>
	 	</thead>
	 	<tbody>";

$req=$bdd->query("SELECT * FROM vol");
$req->setFetchMode(PDO::FETCH_CLASS,'vol');
$vols=$req->fetchAll();
foreach($vols as $vol) {
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
	echo"<tr>
			<form method='post' action='traitement.php'>
				<input type='hidden' name='refVol' value='$vol->refVol'/>
				<td>$typeAvion->nomType</td>
				<td>$aeroport1->nomAeroport le $dateDepart</td>
				<td>$aeroport2->nomAeroport le $dateArrivee</td>
				<td>$vol->prix €</td>
				<td>Nombre de places à réserver : <select name='siegeReserve'/><option>1<option>2<option>3<option>4</select> <input class='btn btn-default' type='submit' name='choix' value='Réserver'/></td>
			</form>
		 </tr>";
}



echo"	</tbody>
	 </table>";

?>