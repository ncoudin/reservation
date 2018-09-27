<?php
include('connexion.php');
include('entete.php');
?>
<body>
	<h2 style='padding-left:5px;'>Gestion des avions</h2><br/>
<?php
if(isset($_SESSION['utilisateur'])) {
	$utilisateur=$_SESSION['utilisateur'];
	if($utilisateur->admin == 1) {
		echo"<div class='panel panel-default'>
		<div class='panel-heading'>Table de gestion des avions</div>
		<table class='table' style='width:auto;'>
			 	<thead>
			 		<tr>
				 		<td><b>Avion n°</b></td>
				 		<td><b>Type de l'avion</b></td>
			 		</tr>
			 	</thead>";
		$avions=getAvions($bdd->query("SELECT * FROM avion ORDER by refAvion"));
		foreach($avions as $avion) {
			echo"<tr>
					<form method='post' action='traitement.php'>
					 	<td><input type='hidden' name='refAvion' value='$avion->refAvion'/>$avion->refAvion</td>
					 	<td><select name='typeAvion'>";
			$typeAvions=getTypeAvions($bdd->query("SELECT * FROM typeAvion"));
			foreach($typeAvions as $typeAvion) {
				echo"<option value='$avion->typeAvion' ";
				if($avion->typeAvion==$typeAvion->numType)
					echo"selected";
				echo">$typeAvion->nomType</option>";
			}
			echo"</select></td>
					 	<td><button class='btn btn-default' type='submit' name='choix' value='ModifierAvion'>Modifier</button></td>
					 	<td><button class='btn btn-default' type='submit' name='choix' value='SupprimerAvion'>Supprimer</button></td>
					</form>
				 </tr>";
		}
		echo"<tr>
						<form method='post' action='traitement.php'>
						 	<td style='background-color:grey'></td>
						 	<td><select name='typeAvion'><option></option>";
						$typeAvions=getTypeAvions($bdd->query("SELECT * FROM typeAvion"));
						foreach($typeAvions as $typeAvion) {
							echo"<option value='$typeAvion->numType'>$typeAvion->nomType</option>";
						}
						echo"</td>
						 	<td colspan='2'><button class='btn btn-default' type='submit' name='choix' value='CreerAvion'>Ajouter</button></td>
						</form>
				 	</tr>
			 </table></div>";







	}
	else
		echo"<p style='padding-left:5px'>Vous n'êtes pas administrateur !</p>";
}
else
	echo"<p style='padding-left:5px'>Veuillez vous connecter !</p>";
?>
</body>