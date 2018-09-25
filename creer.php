<?php
include('connexion.php');
include('entete.php');
?>

<form action='traitement.php' method='post' style='width:30%;padding-left:5px' onSubmit="return validate()">
	<div class='form-group'>
		<label for='pseudo'>Nom d'utilisateur *</label>
		<input type='text' class='form-control' id='pseudo' name='pseudo' pattern='[a-zA-ZÀ-ÿ0-9]{1,20}' title='-Minuscule -Majuscule -Chiffres -20 caractères max' required/>
	</div>
	<div class='form-group'>
		<label for='nom'>Nom</label>
		<input type='text' class='form-control' id='nom' name='nom' pattern='[a-zA-ZÀ-ÿ0-9]{1,20}' title='-Minuscule -Majuscule -Chiffres -20 caractères max' />
	</div>
	<div class='form-group'>
		<label for='prenom'>Prénom</label>
		<input type='text' class='form-control' id='prenom' name='prenom' pattern='[a-zA-ZÀ-ÿ0-9]{1,20}' title='-Minuscule -Majuscule -Chiffres -20 caractères max' />
	</div>
	<div class='form-group'>
		<label for='rue'>Rue</label>
		<input type='text' class='form-control' id='rue' name='rue' pattern='[a-zA-ZÀ-ÿ0-9]{1,50}' title='-Minuscule -Majuscule -Chiffres -50 caractères max' />
	</div>
	<div class='form-group'>
		<label for='cp'>Code postal</label>
		<input type='text' class='form-control' id='cp' name='cp' pattern='[0-9]{5}' title='-5 chiffres' />
	</div>
	<div class='form-group'>
		<label for='email'>Email</label>
		<input type='email' class='form-control' name='email' />
	</div>
	<div class='form-group'>
		<label for='mdp'>Mot de passe *</label>
		<input type='password' id='mdp' class='form-control' name='mdp' pattern='[a-zA-ZÀ-ÿ0-9]{4,20}' title='-Minuscule -Majuscule -Chiffres -entre 4 et 20 caractères' required/>
	</div>
	<div class='form-group'>
		<label for='mdp'>Confirmation mot de passe *</label>
		<input type='password' id='confirm_mdp' class='form-control' name='mdp' pattern='[a-zA-ZÀ-ÿ0-9]{4,20}' title='-Minuscule -Majuscule -Chiffres -entre 4 et 20 caractères' required/>
	</div>
	<p id='verif'></p>
	<input type='submit' value='Créer' name='choix' class='btn btn-default'/>
</form>
<script>
	function validate() {
 
            var a = document.getElementById("mdp").value;
            var b = document.getElementById("confirm_mdp").value;
 
            if (a!=b) {
            	document.getElementById("verif").innerHTML="Les mots de passes doivent correspondre !";
            	return false; }
            else {
            	return true; }
	}
</script>