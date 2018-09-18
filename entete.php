<?php
session_start();
echo"<head>
		<title>Réservation</title>
	 </head>";
if(isset($_POST['connexion']))
{
	if($_POST['connexion']=='Se connecter')
	{
		$pseudo=$_POST['pseudo'];
		$mdp=$_POST['mdp'];
		$res=$bdd->query("select * from utilisateur where pseudo='$pseudo' and mdp='$mdp'");
		if($res->rowCount()>0)
			$_SESSION['pseudo']=$pseudo;
		else
			echo"<p> Pseudo ou mot de passe invalide !</p>";

	}
	elseif($_POST['connexion']=='Se déconnecter')
	{
		$_SESSION['pseudo']=null;
	}
}


if(isset($_SESSION['pseudo']))
{

$pseudo=$_SESSION['pseudo'];
echo"<body>
	 	<div class='utilisateur'>
	 		<p>$pseudo, vous êtes connecté</p>
	 	</div>
	 	<form method='post' action='index.php'>
	 		<input type='submit' value='Se déconnecter' name='connexion'/>
	 	</form>
	 </body>";
}
else
{
echo"<body>
	 	<div class='utilisateur'>
	 		<p>Vous n'êtes pas connecté</p>
	 		<form method='post' action='index.php'>
	 			<p><label>Utilisateur : </label><input type='text' name='pseudo'/></p>
	 			<p><label>Mot de passe : </label><input type='password' name='mdp'/> <input type='submit' value='Se connecter' name='connexion'/> </p>

	 		</form>
	 	</div>
	 </body>";
}
?>
