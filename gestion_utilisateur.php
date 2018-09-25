<?php
include('connexion.php');
include('entete.php');
?>
<body>
	<h2>Gestion des utilisateurs</h2><br/>
<?php
if(isset($_SESSION['utilisateur'])) {
	$utilisateur=$_SESSION['utilisateur'];
	if($utilisateur->admin == 1) {
		echo"<table class='table' style='width:80%;'>
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
					 	<td><input type='text' name='nom' value='$user->nom'/></td>
					 	<td><input type='text' name='prenom' value='$user->prenom'/></td>
					 	<td><input type='text' name='rue' value='$user->rue'/></td>
					 	<td><input type='text' name='cp' value='$user->cp'/></td>
					 	<td><input type='text' name='email' value='$user->email'/></td>
					 	<td><input type='text' name='mdp' value='$user->mdp'/></td>
					 	<td><button type='submit' name='choix' value='ModifierUtilisateur'>Modifier</button></td>
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