<?php
include('class.php');
session_start();
?>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>Réservation</title>
<nav class="navbar navbar-default">
  <div class="container-fluid">
  	<h2 style='text-align:center;'>Réservation</h2>
    <ul class="nav navbar-nav">
      <li><a href="index.php">Accueil</a></li>
      <li><a href="reserver.php">Réserver</a></li>
      <li><a href="place.php">Vos places</a></li>

<?php
	if(isset($_SESSION['utilisateur'])) {
		$utilisateur=$_SESSION['utilisateur'];
		if($utilisateur->admin==1)
		echo"<li><a href='gestion_utilisateur.php'>Gestion des utilisateurs</a></li>
			 <li><a href='gestion_vol.php'>Gestion des vols</a></li>";
		echo"</ul>
	    	 <ul class='nav navbar-nav navbar-right'>
		    	 <li><a href=''><span class='glyphicon glyphicon-user'></span> $utilisateur->pseudo</a></li>
				 <li><form class='navbar-form navbar-left' method='post' action='traitement.php'><input class='btn btn-default' type='submit' name='choix' value='Se déconnecter'/></form></li>";
	}
	else
		echo"</ul>
	    	 <ul class='nav navbar-nav navbar-right'>
				 <li><a href='creer.php'><span class='glyphicon glyphicon-user'></span> Créer un compte</a></li>
				 <li><form class='navbar-form navbar-left' method='post' action='traitement.php'>
				 <div class='form-group'>
					 <input type='text' class='form-control' placeholder='Pseudo' name='pseudo'/>
					 <input type='password' class='form-control' placeholder='Mot de passe' name='mdp'/>
				 </div>
				 <input class='btn btn-default' type='submit' name='choix' value='Se connecter'/></form></li>";
?>
    </ul>
  </div>
</nav>
