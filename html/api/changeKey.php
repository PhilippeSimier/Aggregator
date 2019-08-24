<?php
    // Contrôle des variables de sessions
	include "../administration/authentification/authcheck.php" ;
   
	require_once('../definition.inc.php');
	require_once('biblio.php');	
    
	$id	       = obtenir("id", FILTER_VALIDATE_INT);
	$key       = obtenir("key");
	$User_API_Key = obtenir("User_API_Key");
	
	$bdd = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BASE, UTILISATEUR,PASSE);
	// Contrôle de la clé API
	controlerkey($bdd, $User_API_Key);
	
	$sql = sprintf("UPDATE `data`.`users` SET `User_API_Key` = %s WHERE `users`.`id` = %s;",
		$bdd->quote($key),
		$bdd->quote($id)
	);
	
	$nb = $bdd->exec($sql);
	 
	if($nb == 1){
		
		$data = array(
                'status' => "202 Accepted",
            );

        header('HTTP/1.1 202 Accepted');
        header('content-type:application/json');
        echo json_encode($data);
	}
	else{
        envoyerErreur(500, "Internal Server Error", "Internal Server Error");
    }
    



?>