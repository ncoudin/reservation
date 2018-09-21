<?php
include('connexion.php');
include('entete.php');
?>

<fieldset>
	<legend>Créer un compte</legend>
	<form method='post' action='traitement.php'>
		<p><label>Pseudo : </label> <input type='text' name='pseudo'/></p>
		<p><label>Mot de passe : </label> <input type='password' name='mdp'/> <input class='btn btn-default' type='submit' name='choix' value='Créer'/></p>
	</form>
</fieldset>