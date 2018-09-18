<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=reservation', 'root', '');
} 
catch (PDOException $e) {
    die('Erreur '.$e->getMessage());
}
?>
