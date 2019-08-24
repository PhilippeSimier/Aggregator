<?php
    // Contrôle des variables de sessions
	include "../administration/authentification/authcheck.php" ;    
   
	require_once('../definition.inc.php');
	require_once('biblio.php');	
	
	// Contrôle de la présence des paramètres key login User_API_Key pwd conf_pwd en GET ou POST
	$key       = obtenir("key");
    $login     = obtenir("login");
    $User_API_Key = obtenir("User_API_Key");
    $pwd	   = obtenir("pwd");
	$conf_pwd  = obtenir("conf_pwd");
  

	// la variable conf_pwd doit être la même que pwd
	if($conf_pwd != $pwd){
        envoyerErreur(403, "Bad Request", "The pwd and conf_pwd is not the same." );
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