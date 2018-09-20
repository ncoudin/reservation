<?php
include('connexion.php');
include('entete.php');

echo"<table class='table'>
	 	<thead>
	 		<tr>
	 			<td>Vol n°</td>
	 			<td>Avion n°</td>
	 			<td>Départ</td>
	 			<td colspan='2'>Destination</td>
	 		</tr>
	 	</thead>
	 	<tbody>";

$req=$bdd->query("SELECT * FROM vol");
$req->setFetchMode(PDO::FETCH_CLASS,'vol');
$vols=$req->fetchAll();
foreach($vols as $vol) {
	$req=$bdd->query("SELECT * FROM typeAvion,avion WHERE typeAvion.avion=avion.refAvion AND refAvion='vol->avion'");
	$req->setFetchMode(PDO::FETCH_CLASS,'typeAvion');
	$vols=$req->fetch();
	
	echo"<tr>
			<td>$vol->refVol</td>
			<td>$vol->avion";
}



echo"	</tbody>
	 </table>";

?>