<?php
include('connexion.php');
include('entete.php');
?>
<body>
	<h2 style='padding-left:5px;'>Gestion des aeroport</h2><br/>
<?php
if(isset($_SESSION['utilisateur'])) {
	$utilisateur=$_SESSION['utilisateur'];
	if($utilisateur->admin == 1) {
		echo"<div class='panel panel-default'>
		<div class='panel-heading'>Table de gestion des aeroports</div>
		<table class='table' style='width:auto;'>
			 	<thead>
			 		<tr>
				 		<td><b>Aeroport n°</b></td>
				 		<td><b>Nom de l'aeroport</b></td>
			 		</tr>
			 	</thead>";
		$aeroports=getAeroports($bdd->query("SELECT * FROM aeroport ORDER by refAeroport"));
		foreach($aeroports as $aeroport) {
			echo"<tr>
					<form method='post' action='traitement.php'>
					 	<td><input type='hidden' name='refAeroport' value='$aeroport->refAeroport'/>$aeroport->refAeroport</td>
					 	<td><input type='text' name='nomAeroport' value='$aeroport->nomAeroport' /></td>
					 	<td><button class='btn btn-default' type='submit' name='choix' value='ModifierAeroport'>Modifier</button></td>
					 	<td><button class='btn btn-default' type='submit' name='choix' value='SupprimerAeroport'>Supprimer</button></td>
					</form>
				 </tr>";
		}
		echo"<tr>
						<form method='post' action='traitement.php'>
						 	<td style='background-color:grey'></td>
						 	<td><input type='text' name='nomAeroport' /></td>
						 	<td colspan='2'><button class='btn btn-default' type='submit' name='choix' value='CreerAeroport'>Ajouter</button></td>
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