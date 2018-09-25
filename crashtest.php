<?php
include('connexion.php');
include('entete.php');
$user=$_POST['user'];
var_dump(unserialize($user));
?>