<?php

    // Contrôle des variables de sessions
	include "../administration/authentification/authcheck.php" ;    
   
	require_once('../definition.inc.php');
	require_once('biblio.php');

	try
	{
		$bdd = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BASE, UTILISATEUR,PASSE);
	}
	catch (Exception $ex)
	{
		die('<br />Pb connexion serveur BD : ' . $ex->getMessage());
	}

	// Lecture des paramétres obligatoires
	$channelId = obtenir("channelId", FILTER_VALIDATE_INT);
	
	// Lecture des paramétres facultatifs
	$results   = facultatif("results", "8000", FILTER_VALIDATE_INT);

    // // Lecture des valeurs enregistrées dans la table feeds
	$sql = "SELECT * FROM `feeds` WHERE `id_channel`=" . $channelId;
    $nom_fichier = "channel_". $channelId . ".csv";

    header('Content-Type: application/csv-tab-delimited-table');
    header('Content-Disposition:attachment;filename='.$nom_fichier);

	$stmt = $bdd->query($sql);
	while ($data = $stmt->fetchObject()){
			echo $data->date.",";
			echo $data->field1.",";
			echo $data->field2.",";
			echo $data->field3.",";
			echo $data->field4.",";
			echo $data->field5.",";
			echo $data->field6.",";
			echo $data->field7.",";
			echo $data->field8."\n";
	}



