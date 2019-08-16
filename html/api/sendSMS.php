<?php
   
 
    // Fonction pour renvoyer une réponse suite à une erreur 
    function erreur($httpStatus, $message, $detail){
        $data = array(
                'status' => $httpStatus,
                'message' => $message,
                'detail' => $detail
        );
        header('HTTP/1.1 ' . $httpStatus . ' ' . $message);
        header('content-type:application/json');
	echo json_encode($data);
    
    }

    // Contrôle de la présence du paramètre key en GET ou POST
    $key = filter_input(INPUT_GET, 'key');
    if($key === NULL){
        $key = filter_input(INPUT_POST, 'key');
    }
    if($key === NULL){
        erreur(403, "Bad Request", "The request cannot be fulfilled due to bad syntax." );
        return;  
    }

    // Contrôle de la présence du paramètre number
    $number = filter_input(INPUT_GET, 'number');

    if($number === NULL){
        $number = filter_input(INPUT_POST, 'number');
    }
    if($number === NULL){
        erreur(403, "Bad Request", "The request cannot be fulfilled due to bad syntax." );
        return;
    }

    // Contrôle de la présence du paramètre message
    $message = filter_input(INPUT_GET, 'message');

    if($message === NULL){
        $message = filter_input(INPUT_POST, 'message');

    }
    if($message === NULL){
        erreur(403, "Bad Request", "The request cannot be fulfilled due to bad syntax." );
        return;
    }


    // Contrôle de la clé
	// La clé doit appartenir à un utilisateur de la table users
	require_once('../definition.inc.php');
	// connexion à la base data
	$bdd = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BASE, UTILISATEUR,PASSE);
    $sql = sprintf("SELECT COUNT(*) as nb FROM `users` WHERE `users`.`User_API_Key`=%s", $bdd->quote($key));
    $stmt = $bdd->query($sql);
	$res =  $stmt->fetchObject();
	
    // si aucune ligne ne correspond  à la clé reçue
    if ( $res->nb == 0) {
        erreur(405, "Authorization Required", "Please provide proper authentication details." );
        return;
    }

    // Contrôle du numéro de téléphone destinataire
    if (strlen($number)<8 || !is_numeric($number)){
        erreur(403, "Bad Request", "The request cannot be fulfilled due to bad number.");
        return;
    }

    // Contrôle de la longueur du message
    if (strlen($message)<1 || strlen($message)> 160){
        erreur(403, "Request Entity Too Large", "Your request is too large. Please reduce the size and try again.");
        return;
    }
    
	// Lecture du login de l'utilisteur dans la table users
    $sql = sprintf("SELECT `login` FROM `users` WHERE `users`.`User_API_Key` = %s", $bdd->quote($key));
    $stmt = $bdd->query($sql);
	$utilisateur =  $stmt->fetchObject();
	$creator = $utilisateur->login;
    $message = utf8_decode($message);  

	$bdd = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BASESMS, UTILISATEUR,PASSE);
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
        erreur(500, "Internal Server Error", "Internal Server Error");

    }
