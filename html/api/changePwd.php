<?php
   
	require_once('../definition.inc.php');
	
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

    // Contrôle de la présence du paramètre id en GET ou POST
    $id = filter_input(INPUT_GET, 'id');
    if($id === NULL){
        $id = filter_input(INPUT_POST, 'id');
    }
    if($id === NULL){
        erreur(403, "Bad Request", "The request cannot be fulfilled due to bad syntax." );
        return;  
    }

	
	// Contrôle de la présence du paramètre pwd en GET ou POST
    $pwd = filter_input(INPUT_GET, 'pwd');

    if($pwd === NULL){
        $pwd = filter_input(INPUT_POST, 'pwd');
    }
    if($pwd === NULL){
        erreur(403, "Bad Request", "The request cannot be fulfilled due to bad syntax." );
        return;
    }
	
	// Contrôle de la présence du paramètre conf_pwd en GET ou POST
    $conf_pwd = filter_input(INPUT_GET, 'conf_pwd');

    if($conf_pwd === NULL){
        $conf_pwd = filter_input(INPUT_POST, 'conf_pwd');
    }
    if($conf_pwd === NULL){
        erreur(403, "Bad Request", "The request cannot be fulfilled due to bad syntax." );
        return;
    }
	
	// la variable conf_pwd doit être la même que pwd
	if($conf_pwd != $pwd){
        erreur(403, "Bad Request", "The pwd and conf_pwd is not the same." );
        return;		
	}	
	
	
	
	// Tous les paramètres sont présents on fait le travail
		
	$bdd = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BASE, UTILISATEUR,PASSE);
	
	
	$sql = sprintf("UPDATE `data`.`users` SET `encrypted_password` = %s WHERE `users`.`id` = %s;",
		
		$bdd->quote(md5($pwd)),
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
        erreur(500, "Internal Server Error", "Internal Server Error");
    }
	
	

	
?>	