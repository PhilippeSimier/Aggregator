<?php
  
     // Fonction pour renvoyer une réponse suite à une erreur 
	// Cette fonction termine l'éxécution du script
    function envoyerErreur($httpStatus, $message, $detail){
        $data = array(
                'status' => $httpStatus,
                'message' => $message,
                'detail' => $detail
        );
        header('HTTP/1.1 ' . $httpStatus . ' ' . $message);
        header('content-type:application/json');
		echo json_encode($data);  
        exit();		
    }

    // Fonction pour contrôler la valeur d'un paramètre en GET ou POST
	// Si le paramètre n'est pas présent une erreur 403 est envoyée 
    function obtenir($key){
		$valeur = filter_input(INPUT_GET, $key);
		if($valeur === NULL){
			$valeur = filter_input(INPUT_POST, $key);
		}
		if($valeur === NULL){
			envoyerErreur(403, "Bad Request", "The request cannot be fulfilled due to bad syntax." ); 
		}
        return $valeur;		
	}	
	
	// Fonction pour contrôler la présence de la clé dans la table users
	// Retourne true si la clé est présente dans la table users
	// Sinon envoie un message d'erreur 405
    function controlerkey($bdd, $key){
		$sql = sprintf("SELECT COUNT(*) as nb FROM `users` WHERE `users`.`User_API_Key`=%s", $bdd->quote($key));
		$stmt = $bdd->query($sql);
		$res =  $stmt->fetchObject();
	
		// si aucune ligne ne correspond  à la clé reçue
		if ( $res->nb == 0) {
			envoyerErreur(405, "Authorization Required", "Please provide proper authentication details." );
		}
	return true;	
    }
?>