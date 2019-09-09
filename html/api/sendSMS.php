<?php
	/** Send a SMS with HTTP GET or POST
	    Parameters : 
		    key     (Required) User_API_Key Key for this specific service.
			number  (Required)  Phone Number 
			message (Required)  message
			
		reponse :
			The response is a JSON object  for example:

				{
				  "status": "202 Accepted",
				  "numero": "+3361234567",
				  "creator": "philippe",			  
				}
	
	**/   
 
    require_once('biblio.php');
	require_once('../definition.inc.php');
	
	// Contrôle de la présence des paramètres key number message en GET ou POST
	$key     = obtenir("key");
    $number  = obtenir("number");
    $message = obtenir("message"); 

    
    // Contrôle de la clé
	// La clé doit appartenir à un utilisateur de la table users
	
	// connexion à la base data
	$bdd = connexionBD(BASE);
	controlerkey($bdd, $key);

    // Contrôle du numéro de téléphone destinataire
    if (strlen($number)<10 || !is_numeric($number)){
        envoyerErreur(403, "Bad Request", "The request cannot be fulfilled due to bad number.");
        return;
    }

    // Contrôle de la longueur du message
    if (strlen($message)<1 || strlen($message)> 160){
        envoyerErreur(403, "Request Entity Too Large", "Your request is too large. Please reduce the size and try again.");
        return;
    }
    
	// Lecture du login de l'utilisteur dans la table users
    $sql = sprintf("SELECT `login` FROM `users` WHERE `users`.`User_API_Key` = %s", $bdd->quote($key));
    $stmt = $bdd->query($sql);
	$utilisateur =  $stmt->fetchObject();
	$creator = $utilisateur->login;
    $message = $message;  

	// Connexion à la base SMS
	$bdd = connexionBD(BASESMS);
	$sql = sprintf("INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID, Coding) VALUES ( %s, %s, %s, 'Unicode_No_Compression' )",
		$bdd->quote($number),
		$bdd->quote($message),
		$bdd->quote($creator)
	);
	$reponse = $bdd->exec($sql);
	
	
    if ($reponse !== false){
        $data = array(
                'status' => "202 Accepted",
                'numero' => $number,
                'creator' => $creator,
            );

        header('HTTP/1.1 202 Accepted');
        header('content-type:application/json');
        echo json_encode($data);
    }
    else{
        envoyerErreur(500, "Internal Server Error", "Internal Server Error");

    }
