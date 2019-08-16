<?php
include "authentification/authcheck.php" ;
	

require_once('../ini/ini.php');
require_once('../definition.inc.php');

//------------si des données  sont soumises on les enregistre dans la table users.things ---------
if( !empty($_POST['envoyer'])){
	$bdd = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BASE, UTILISATEUR,PASSE);
	if(isset($_POST['action']) && ($_POST['action'] == 'insert')){
		$sql = sprintf("INSERT INTO `data`.`users` (`login`, `encrypted_password`, `User_API_Key`) VALUES ( %s, %s, %s );"
					  , $bdd->quote($_POST['login'])
					  , $bdd->quote($_POST['encrypted_password'])
					  , $bdd->quote($_POST['User_API_Key'])
					  ); 
		$bdd->exec($sql);
		header("Location: users.php");
		return;
	}
	if(isset($_POST['action']) && ($_POST['action'] == 'update')){
		$sql = sprintf("UPDATE `users` SET `login` = %s, `encrypted_password` = %s, `User_API_Key` = %s WHERE `users`.`id` = %s;"
					  , $bdd->quote($_POST['login'])
					  , $bdd->quote($_POST['encrypted_password'])
					  , $bdd->quote($_POST['User_API_Key'])
					  , $_POST['id']
					  ); 
		$bdd->exec($sql);
		header("Location: users.php");
		return;
	}
	
    
}

// -------------- sinon lecture de la table users.things  -----------------------------
else
{
   if (isset($_GET['id'])){
   $bdd = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BASE, UTILISATEUR,PASSE);
   $sql = sprintf("SELECT * FROM `users` WHERE `id`=%s", $bdd->quote($_GET['id']));
   $stmt = $bdd->query($sql);
	   if ($thing =  $stmt->fetchObject()){
		   $_POST['action'] = "update";
		   $_POST['id'] = $thing->id;
		   $_POST['login'] = $thing->login;
		   $_POST['User_API_Key'] = $thing->User_API_Key;
		   $_POST['encrypted_password'] = $thing->encrypted_password;
	   } 
   }else {
  	   $_POST['action'] = "insert";
	   $_POST['id'] = 0;
	   $_POST['login'] = "";
	   $_POST['User_API_Key'] = "";
	   $_POST['encrypted_password'] = "";   
	   
   }   

}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>thing</title>
    <!-- Bootstrap CSS version 4.1.1 -->
	<link rel="stylesheet" href="/Ruche/css/bootstrap.min.css" >
    <link rel="stylesheet" href="/Ruche/css/ruche.css" />
    
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="/Ruche/scripts/bootstrap.min.js"></script>  	
	<script>
	</script>
				
</head>
<body>

<?php require_once '../menu.php'; ?>

<div class="container" style="padding-top: 65px;">
		
		<div class="row">
			<div class="col">
				<div class="popin">
					<form class="form-horizontal" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" name="configuration" >
						
							<input type='hidden' name='action' value="<?php  echo $_POST["action"]; ?>" />
							<input type='hidden' name='id' value="<?php  echo $_POST["id"]; ?>" />
							<input type='hidden' name='encrypted_password' value="<?php  echo $_POST["encrypted_password"]; ?>" />
							<div class="form-group">
								<label for="login"  class="font-weight-bold">Login : </label>
								<input type="text"  name="login" class="form-control" value="<?php echo  $_POST['login']; ?>" />
							</div>
							
							<div class="form-group">
								<label for="User_API_Key"  class="font-weight-bold">API Key : </label>
								<input type="text"  name="User_API_Key" class="form-control" value="<?php echo  $_POST['User_API_Key']; ?>" />
							</div>
							
							<div class="form-group">
								<label for="password"  class="font-weight-bold">Password : </label>
								<input type="text"  name="status" class="form-control" value="" />
							</div>

							<div class="form-group">
								<label for="confirm_password"  class="font-weight-bold">Confirm password : </label>
								<input id="confirm_password" type="text"  name="confirm_password" class="form-control" value="" />
							</div>
							
							</br>
							<button type="submit" class="btn btn-primary" value="Valider" name="envoyer" > Appliquer</button>
							<a  class="btn btn-info" role="button" href="users">Annuler</a>
								
					</form>
				</div>	
			</div>
		</div>				
		<?php require_once '../piedDePage.php'; ?>
</div>
	
</body>

	
		