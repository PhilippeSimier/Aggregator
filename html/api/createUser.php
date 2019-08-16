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

    // Contrôle de la présence du paramètre key en GET ou POST
    $key = filter_input(INPUT_GET, 'key');
    if($key === NULL){
        $key = filter_input(INPUT_POST, 'key');
    }
    if($key === NULL){
        erreur(403, "Bad Request", "The request cannot be fulfilled due to bad syntax." );
        return;  
    }

    // Contrôle de la présence du paramètre login en GET ou POST
    $login = filter_input(INPUT_GET, 'login');

    if($login === NULL){
        $login = filter_input(INPUT_POST, 'login');
    }
    if($login === NULL){
        erreur(403, "Bad Request", "The request cannot be fulfilled due to bad syntax." );
        return;
    }
	
	// Contrôle de la présence du paramètre User_API_Key en GET ou POST
    $User_API_Key = filter_input(INPUT_GET, 'User_API_Key');

    if($User_API_Key === NULL){
        $User_API_Key = filter_input(INPUT_POST, 'User_API_Key');
    }
    if($User_API_Key === NULL){
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
	
	// Contrôle de la présence du paramètre pwd en GET ou POST
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
	
	// Contrôle de la clé
	// La clé doit appartenir à l'utilisateur root de la table users
	
    $sql = sprintf("SELECT  login FROM `users` WHERE `users`.`User_API_Key`=%s", $bdd->quote($key));
	
    $stmt = $bdd->query($sql);
	if (!($res =  $stmt->fetchObject())){
		erreur(405, "Authorization Required", "Please provide proper authentication details." );
        return;
	}	
	
    // si le login ne correspond pas à root
    if ( $res->login != 'root') {
        erreur(406, "Authorization Required", "Please provide proper authentication details." );
        return;
    }
	
	$sql = sprintf("INSERT INTO `users` (`login`, `encrypted_password`, `User_API_Key`, `Created_at`, `sign_in_count`) VALUES (%s, %s, %s, CURRENT_TIMESTAMP, '0')",
		$bdd->quote($login),
		$bdd->quote(md5($pwd)),
		$bdd->quote($User_API_Key)
	);
	
	$nb = $bdd->exec($sql);
	 
	if($nb == 1){
		
		$data = array(
                'status' => "202 Accepted",
				'login' => utf8_encode($login), 
				'User_API_Key' => utf8_encode($User_API_Key)
            );

        header('HTTP/1.1 202 Accepted');
        header('content-type:application/json');
        echo json_encode($data);
	}
	else{
        erreur(500, "Internal Server Error", "Internal Server Error");
    }
	
	

	
?>	