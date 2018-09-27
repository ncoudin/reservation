<?php
include('connexion.php');
include('entete.php');
?>
<body>
	<h2 style='padding-left:5px;'>Gestion des utilisateurs <font size='2'>(N'inclut pas les administrateurs)</font></h2><br/>
<?php
if(isset($_SESSION['utilisateur'])) {
	$utilisateur=$_SESSION['utilisateur'];
	if($utilisateur->admin == 1) {
		echo"<div class='panel panel-default'>
		<div class='panel-heading'>Table de gestion des utilisateurs</div>
		<table class='table' style='width:auto;'>
			 	<thead>
			 		<tr>
				 		<td><b>Pseudo</b></td>
				 		<td><b>Nom</b></td>
				 		<td><b>Prénom</b></td>
				 		<td><b>Rue</b></td>
				 		<td><b>Code Postal</b></td>
				 		<td><b>Email</b></td>
				 		<td colspan='3'><b>Mot de passe</b></td>
			 		</tr>
			 	</thead>";
		$users=getUtilisateurs($bdd->query("SELECT * FROM utilisateur WHERE pseudo!='$utilisateur->pseudo' AND admin=0"));
		foreach($users as $user) {
			echo"<tr>
					<form method='post' action='traitement.php'>
					 	<td><input type='hidden' name='pseudo' value='$user->pseudo'/>$user->pseudo</td>
					 	<td><input type='text' name='nom' style='width:120px;' value='$user->nom'/></td>
					 	<td><input type='text' name='prenom' style='width:120px;' value='$user->prenom'/></td>
					 	<td><input type='text' name='rue' value='$user->rue'/></td>
					 	<td><input type='text' name='cp' style='width:60px;' value='$user->cp'/></td>
					 	<td><input type='text' name='email' value='$user->email'/></td>
					 	<td><input type='text' name='mdp' value='$user->mdp'/></td>
					 	<td><button class='btn btn-default' type='submit' name='choix' value='ModifierUtilisateur'>Modifier</button></td>
					 	<td><button class='btn btn-default' type='submit' name='choix' value='SupprimerUtilisateur'>Supprimer</button></td>
					</form>
				 </tr>";
		}
		echo"<tr>
						<form method='post' action='traitement.php'>
						 	<td><input type='text' name='pseudo'  required /></td>
						 	<td><input type='text' name='nom' style='width:120px;'/></td>
						 	<td><input type='text' name='prenom' style='width:120px;'/></td>
						 	<td><input type='text' name='rue' /></td>
						 	<td><input type='text' name='cp' maxlength='5' style='width:60px;'/></td>
						 	<td><input type='text' name='email' /></td>
						 	<td><input type='text' name='mdp' required /></td>
						 	<td colspan='2'><button class='btn btn-default' type='submit' name='choix' value='CreerUtilisateur'>Creer</button></td>
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