<?php

if(isset($_SESSION['pseudo']))
{

$pseudo=$_SESSION['pseudo'];
echo"<div class='utilisateur'>
	 		<p>$pseudo, vous êtes connecté</p>
	 	<form method='post' action='traitement.php'>
	 		<input type='submit' value='Se déconnecter' name='choix'/>
	 	</form>
	 </div>";
}
else
{
echo"<div class='utilisateur'>
	 		<form method='post' action='traitement.php'>
	 			<p><a href='creer.php'>Créer un compte</a></p> 
	 			<p><label>Utilisateur : </label><input type='text' name='pseudo'/></p>
	 			<p><label>Mot de passe : </label><input type='password' name='mdp'/> <input type='submit' value='Se connecter' name='choix'/> </p>
	 		</form>
	 </div>";
}
?>