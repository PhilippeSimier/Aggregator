<?php

    // Contrôle des variables de sessions
	include "../administration/authentification/authcheck.php" ;    
   
	require_once('../definition.inc.php');
	require_once('biblio.php');
	
	// Connexion à la base avec session heure UTC
	$bdd = connexionBD(BASE, "+00:00");

	// Lecture des paramétres obligatoires
	$channelId = obtenir("channelId", FILTER_VALIDATE_INT);
	
	// Lecture des paramétres facultatifs
	$results   = facultatif("results", "8000", FILTER_VALIDATE_INT);
	
	// Lecture des valeurs enregistrées dans la table feeds
	$sql = "SELECT * FROM `feeds` WHERE `id_channel`=" . $channelId;
    $nom_fichier = "channel_". $channelId . ".csv";

    header('Content-Type: application/csv-tab-delimited-table');
    header('Content-Disposition:attachment;filename='.$nom_fichier);
    
	$entry_id = 1;
    echo "created_at,entry_id,field1,field2,field3,field4,field5,field6,field7,field8,latitude,longitude,elevation,status\n";
	$stmt = $bdd->query($sql);
	while ($data = $stmt->fetchObject()){
			echo $data->date." UTC,";
			echo $entry_id++.",";
			echo $data->field1.",";
			echo $data->field2.",";
			echo $data->field3.",";
			echo $data->field4.",";
			echo $data->field5.",";
			echo $data->field6.",";
			echo $data->field7.",";
			echo $data->field8.",";
			echo $data->latitude.",";
			echo $data->longitude.",";
			echo $data->elevation.",";			
			echo $data->status."\n";
	}



