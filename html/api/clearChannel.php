<?php

    // Contrôle des variables de sessions
	include "../administration/authentification/authcheck.php" ;    
   
	require_once('../definition.inc.php');
	require_once('biblio.php');	
	
	// Lecture des paramétres obligatoires
	$channelId = obtenir("channelId", FILTER_VALIDATE_INT);

	$bdd = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BASE, UTILISATEUR,PASSE);
	
	$sql = sprintf("DELETE FROM `data`.`feeds` WHERE `feeds`.`id_channel` = %s",
	       $channelId);
	
	$nb = $bdd->exec($sql);
	 
	if($nb > 0){
		
		$data = array(
                'status' => "202 Accepted",
				'channel' => $channelId, 
				
            );

        header('HTTP/1.1 202 Accepted');
        header('content-type:application/json');
        echo json_encode($data);
	}
   



?>