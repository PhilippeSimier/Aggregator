<?php
	include "authentification/authcheck.php" ;

	require_once('../definition.inc.php');
	require_once('../api/biblio.php');
	include('thingHTTP.class.php');

	// connexion à la base
	$bdd = connexionBD(BASE, $_SESSION['time_zone']);
	$id  = obtenir("id", FILTER_VALIDATE_INT);
	
	try{
		$objet = new thingHTTP($bdd,$id);
		echo $objet->send_request();
	}
	//catch exception
	catch(Exception $e) {
		envoyerErreur(500, "Internal Server Error", "Internal Server Error");
	}
?>