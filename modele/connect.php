<?php

	$hostname = "localhost";	//ou localhost
	$base= "pweb19_sadaoui";
	$loginBD= "root";	//ou "root"
	$passBD="";
try {

	$pdo = new PDO ("mysql:server=$hostname; dbname=$base", "$loginBD", "$passBD");
	//die('OK connexion');
}

catch (PDOException $e) {
	die  ("Echec de connexion : " . utf8_encode($e->getMessage()) . "\n");
}

?>