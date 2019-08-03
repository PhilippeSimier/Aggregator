<?php


	if(!isset($_POST['md5']))
	{
		header("Location: ../index.php");
		exit();
	}
	
	if(!isset($_POST['login']))
	{
		  header("Location: ../index.php");
		  exit();
	}

	if($_POST['login']==NULL)
	{
		  header("Location: ../index.php?&erreur=Requiert un identifiant et un mot de passe.");
		  exit();
	}


	
	require_once('../../definition.inc.php');
	
	// connexion à la base
	$bdd = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BASE, UTILISATEUR,PASSE);

    // utilisation de la méthode quote() 
    // Retourne une chaîne protégée, qui est théoriquement sûre à utiliser dans une requête SQL.

    $sql = sprintf("SELECT * FROM `users` WHERE `login`=%s", $bdd->quote($_POST['login']));
    $stmt = $bdd->query($sql);

	$utilisateur =  $stmt->fetchObject();
	
	// vérification des identifiants login et md5 par rapport à ceux enregistrés dans la table users
	
	
	if (!($_POST['login'] == $utilisateur->login && $_POST['md5'] == $utilisateur->encrypted_password)){
		header("Location: ../index.php?&erreur=Incorrectes! Vérifiez vos identifiant et mot de passe.");
  		exit();
	}

	// A partir de cette ligne l'utilisateur est authentifié
	// donc nouvelle session
	session_start();

	// écriture des variables de session pour cet utilisateur

        $_SESSION['last_access'] = time();
        $_SESSION['ipaddr']		 = $_SERVER['REMOTE_ADDR'];
        $_SESSION['login'] 		 = $utilisateur->login;
		$_SESSION['id']			 = $utilisateur->id;
		$_SESSION['User_API_Key']= $utilisateur->User_API_Key;
        $_SESSION['droits'] 	 = 1;
       
	// mise à jours de la date et heure de son passage dans le champ last_sign_in_at de la table users
        
        $sql = "UPDATE `users` SET `last_sign_in_at` = CURRENT_TIMESTAMP  WHERE `users`.`id` = $utilisateur->id LIMIT 1" ;
        $stmt = $bdd->query($sql);

	// Incrémentation du compteur de session
       $sql = "UPDATE `users` SET `sign_in_count` = `sign_in_count`+1 WHERE `users`.`id` = $utilisateur->id LIMIT 1" ;
       $stmt = $bdd->query($sql);
	   
	// sélection de la page de retour
	if ($_POST['retour']!== ""){
		header("Location: " . $_POST['retour'] );
		exit;
	}
	else{
		header("Location: ../../index.php");
		exit;
	}	
	

?>
