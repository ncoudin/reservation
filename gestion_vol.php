<?php
include('connexion.php');
include('entete.php');
?>
<body>
	<h2>Gestion des vols</h2><br/>
<?php
if(isset($_SESSION['utilisateur'])) {
	$utilisateur=$_SESSION['utilisateur'];
	if($utilisateur->admin == 1) {
		echo"<table class='table'>
			 	<thead>
			 		<tr>
				 		<td><b>Vol n°</b></td>
				 		<td><b>Avion n°</b></td>
				 		<td><b>Aéroport départ</b></td>
				 		<td><b>Aéroport arrivée</b></td>
				 		<td><b>Date départ</b></td>
				 		<td><b>Date arrivée</b></td>
				 		<td colspan='3'><b>Prix/place</b></td>
			 		</tr>
			 	</thead>";
		$vols=getVols($bdd->query("SELECT * FROM vol"));
		foreach($vols as $vol) {
			echo"<tr>
					<form method='post' action='traitement.php'>
					 	<td><input type='hidden' name='refVol' value='$vol->refVol'/>$vol->refVol</td>
					 	<td><select name='avion'>";
			$avions=getAvions($bdd->query("SELECT * FROM avion"));
			foreach($avions as $avion) {
				$typeAvion=getTypeAvion($bdd->query("SELECT * FROM typeAvion WHERE numType='$avion->typeAvion'"));
				echo"<option value='$avion->refAvion' ";
				if($vol->avion==$avion->refAvion)
					echo"selected";
				echo">$avion->refAvion modèle $typeAvion->nomType</option>";
			}
				   echo"</select></td>
				   		<td><select name='aeroport1'>";
			$aeroports=getAeroports($bdd->query("SELECT * FROM aeroport"));
			foreach($aeroports as $aeroport) {
				echo"<option value='$aeroport->refAeroport' ";
				if($vol->aeroport1==$aeroport->refAeroport)
					echo"selected";
				echo">$aeroport->nomAeroport</option>";
			}
				   echo"</select></td>
				   		<td><select name='aeroport2'>";
			$aeroports=getAeroports($bdd->query("SELECT * FROM aeroport"));
			foreach($aeroports as $aeroport) {
				echo"<option value='$aeroport->refAeroport' ";
				if($vol->aeroport2==$aeroport->refAeroport)
					echo"selected";
				echo">$aeroport->nomAeroport</option>";
			}
			$vol->dateDepart =  str_replace(' ', 'T', $vol->dateDepart);
			$vol->dateArrivee =  str_replace(' ', 'T', $vol->dateArrivee);
				   echo"</select></td>
				   		<td><input type='datetime-local' name='dateDepart' value='$vol->dateDepart' /></td>
				   		<td><input type='datetime-local' name='dateArrivee' value='$vol->dateArrivee' /></td>
				   		<td><input type='number' step='0.01' name='prix' value='$vol->prix' />€</td>
				   		<td><button type='submit' name='choix' value='ModifierVol'>Modifier</button></td>
					</form>
				 </tr>";
		}
		echo"</table>";
	}
	else
		echo"<p>Vous n'êtes pas administrateur !</p>";
}
else
	echo"<p>Veuillez vous connecter !</p>";
?>
</body>