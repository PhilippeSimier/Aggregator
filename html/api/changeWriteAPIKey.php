<?php

    // Contrôle des variables de sessions
	include "../administration/authentification/authcheck.php" ;
   
	require_once('../definition.inc.php');
	require_once('biblio.php');	
    
	// Lecture des paramètres requis
	$id	       = obtenir("id", FILTER_VALIDATE_INT);
	$key       = obtenir("key");
	$User_API_Key = obtenir("User_API_Key");
	
	$bdd = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BASE, UTILISATEUR,PASSE);
	// Contrôle de la clé User_API_Key
	controlerkey($bdd, $User_API_Key);
	
	$sql = sprintf("UPDATE `data`.`channels` SET `write_api_key` = %s WHERE `channels`.`id` = %s;",
		$bdd->quote($key),
		$bdd->quote($id)
	);
	
	$nb = $bdd->exec($sql);
	 
	if($nb == 1){
		
		$data = array(
                'status' => "200 OK",
            );

        header('HTTP/1.1 200 OK');
        header('content-type:application/json');
        echo json_encode($data);
	}
	else{
        envoyerErreur(500, "Internal Server Error", "Internal Server Error");
    }
    


?>