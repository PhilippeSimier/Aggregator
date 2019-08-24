<?php
  
    // Fonction pour renvoyer une réponse suite à une erreur 
	// Cette fonction tue (termine) l'éxécution du script
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
	
	// Fonction pour vérifier la présence d'un paramètre en GET ou POST
	// Si le paramètre n'est pas présent ou ne correspond pas au type demandé 
	// alors la valeur NULL est retournée
	// Le paramètre filter_flag (filtre de validation) est optionnel 
	// il peut prendre les valeurs suivantes :
	// FILTER_VALIDATE_EMAIL
	// FILTER_VALIDATE_FLOAT
	// FILTER_VALIDATE_INT
	
    function verifier($key, $filter_flag = FILTER_DEFAULT){
		$valeur = filter_input(INPUT_GET, $key, $filter_flag);
		if($valeur === NULL || $valeur === FALSE){
			$valeur = filter_input(INPUT_POST, $key, $filter_flag);
		}
		if($valeur === NULL || $valeur === FALSE ){
			$valeur = NULL; 
		}	
        return $valeur;		
	}	

    // Fonction pour contrôler la présence d'un paramètre OBLIGATOIRE en GET ou POST
	// Si le paramètre n'est pas présent une erreur 403 est envoyée 
	// Le paramètre filter_flag (filtre de validation) est optionnel 
	// il peut prendre les valeurs suivantes :
	// FILTER_VALIDATE_EMAIL
	// FILTER_VALIDATE_FLOAT
	// FILTER_VALIDATE_INT
	
    function obtenir($key, $filter_flag = FILTER_DEFAULT){
        $valeur = verifier( $key, $filter_flag);
		if ($valeur === NULL)
		    envoyerErreur(403, "Bad Request", "The request cannot be fulfilled due to bad syntax.");	
		else
			return $valeur;			
	}
	
    // Fonction pour obtenir la valeur d'un paramètre FACULTATIF en GET ou POST
	// Si le paramètre n'est pas présent la valeur par défaut est retournée
	// Le paramétre $default contient la valeur par défaut.
	// Le paramètre filter_flag (filtre de validation) est optionnel 
	// il peut prendre les valeurs suivantes :
	// FILTER_VALIDATE_EMAIL
	// FILTER_VALIDATE_FLOAT
	// FILTER_VALIDATE_INT 
	function facultatif($key, $default, $filter_flag = FILTER_DEFAULT){
		$valeur = verifier( $key, $filter_flag);
		if ($valeur === NULL)
				return $default;
		else
				return $valeur;
		
	}	
	
	
	// Fonction pour contrôler la présence de la clé dans la table users
	// Retourne true si la clé appartient à un utilisateur présent dans la table users
	// Sinon tue le script et envoie un message d'erreur 405
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
	
	// Fonction pour obtenir un objet channel à partir de sa write_api_key
	// Retourne l'objet channel si la write_api_key est présente dans la table channels
	// Sinon tue le script et envoie un message d'erreur 405
    function obtenirChannel($bdd, $write_api_key){
		$sql = sprintf("SELECT * FROM `channels` WHERE `write_api_key` = %s", $bdd->quote($write_api_key));
		$stmt = $bdd->query($sql);
		$channel =  $stmt->fetchObject();
		
	
		// si aucune ligne ne correspond  à la clé reçue
		if ( $channel === false) {
			envoyerErreur(405, "Authorization Required", "Please provide proper write_api_key." );
		}
		else {
			return $channel;
        }			
    }
	
	
	
	
	
	
	
	
	
	// Fonction pour generer une chaine aléatoire
	// Retourne la chaine générée
	function genererChaineAleatoire($longueur = 0)
	{
		if( $longueur == 0 ){
			$longueur = rand ( 10 , 16 );
		}	
		$string = "";
		$chaine = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		srand((double)microtime()*1000000);
		for($i=0; $i<$longueur; $i++) {
			$string .= $chaine[rand()%strlen($chaine)];
		}
		return $string;
	}	
	
	// Fonction pour générer un clé API utilisateur
	// La fonction vérifie que la clé générée est unique
	function genererKey($bdd){
		
		do{
			$key = genererChaineAleatoire();
			$sql = sprintf("SELECT COUNT(*) as nb FROM `users` WHERE `users`.`User_API_Key`=%s", $bdd->quote($key));
			$stmt = $bdd->query($sql);
			$res =  $stmt->fetchObject();
		}while($res->nb != 0);
		return $key;	
	}	
?>