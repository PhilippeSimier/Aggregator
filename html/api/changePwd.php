<?php
   
	require_once('../definition.inc.php');
	require_once('biblio.php');	
    
	$id	       = obtenir("id");
	$pwd	   = obtenir("pwd");
	$conf_pwd  = obtenir("conf_pwd");
	$User_API_Key = obtenir("User_API_Key");
    
	
	// la variable conf_pwd doit être la même que pwd
	if($conf_pwd != $pwd){
        erreur(403, "Bad Request", "The pwd and conf_pwd is not the same." );
        return;		
	}	
	
	// Tous les paramètres sont présents on fait le travail
		
	$bdd = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BASE, UTILISATEUR,PASSE);
	// Contrôle de la clé API
	controlerkey($bdd, $User_API_Key);
	
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