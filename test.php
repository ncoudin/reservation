<?php
include('connexion.php');
include('entete.php');

$user = new utilisateur('XD','XD',0);
var_dump($user);
$oue=serialize($user);
echo"<form method='post' action='crashtest.php'>
	 	<input type='hidden' name='user' value='$oue'/>
	 	<input type='submit'/>
	 </form>";
?>