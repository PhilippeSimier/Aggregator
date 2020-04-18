<?php
include "authentification/authcheck.php" ;
	
require_once('../definition.inc.php');
require_once('../api/Api.php');

$bdd = Api::connexionBD(BASE);

//------------si des données  sont soumises on les enregistre dans la table data.users ---------
if( !empty($_POST['envoyer'])){
	
	if(isset($_POST['action']) && ($_POST['action'] == 'insert')){
		$sql = sprintf("INSERT INTO `data`.`users` (`login`, `droits`, `email`, `telNumber`, `encrypted_password`, `User_API_Key`, `Created_at`, `sign_in_count`, `quotaSMS`, `delaySMS`) VALUES (%s, %s, %s, %s, %s, %s, CURRENT_TIMESTAMP, '0', %s, %s)",
			$bdd->quote($_POST['login']),
			$bdd->quote($_POST['droits']),
			$bdd->quote($_POST['email']),
			$bdd->quote($_POST['telNumber']),
			$bdd->quote(hash('sha256', $_POST['login'])),
			$bdd->quote($_POST['User_API_Key']),
			$bdd->quote($_POST['quotaSMS']),
			$bdd->quote($_POST['delaySMS'])
		);
			
		$bdd->exec($sql);
		header("Location: users.php");
		return;
	}
	if(isset($_POST['action']) && ($_POST['action'] == 'update')){
		$sql = sprintf("UPDATE `data`.`users` SET `login` = %s, `droits` = %s, `email` = %s, `telNumber` = %s, `User_API_Key`=%s, `quotaSMS`=%s, `delaySMS`=%s WHERE `users`.`id` = %s;"
					  , $bdd->quote($_POST['login'])
					  , $bdd->quote($_POST['droits'])
					  , $bdd->quote($_POST['email'])
					  , $bdd->quote($_POST['telNumber'])
					  , $bdd->quote($_POST['User_API_Key'])
					  , $bdd->quote($_POST['quotaSMS'])
					  , $bdd->quote($_POST['delaySMS'])
					  , $_POST['id']
					  );

		$bdd->exec($sql);
		header("Location: users.php");
		return;
	}
}
// -------------- sinon lecture de la table data.users  -----------------------------
else
{
	if (isset($_GET['id'])){
 
		$sql = sprintf("SELECT * FROM `users` WHERE `id`=%s", $bdd->quote($_GET['id']));
		$stmt = $bdd->query($sql);
		if ($user =  $stmt->fetchObject()){
		   $_POST['action']  = "update";
		   $_POST['id']      = $user->id;
		   $_POST['login']   = $user->login;
		   $_POST['droits']   = $user->droits;
		   $_POST['email']   = $user->email;
		   $_POST['telNumber']   = $user->telNumber;
		   $_POST['User_API_Key'] = $user->User_API_Key;
		   $_POST['quotaSMS'] = $user->quotaSMS;
		   $_POST['delaySMS'] = $user->delaySMS;
		} 
	}else {
		$_POST['action'] = "insert";
		$_POST['id'] = 0;
		$_POST['login']   = "";
		$_POST['droits']   = 1;
		$_POST['email']   = "";
		$_POST['telNumber']   = "";
		$_POST['User_API_Key'] = genererChaineAleatoire();
		$_POST['quotaSMS'] = "140";
		$_POST['delaySMS'] = "30";	
   }   
}
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>User Settings - Aggregator</title>
		<!-- Bootstrap CSS version 4.1.1 -->
		<link rel="stylesheet" href="/Ruche/css/bootstrap.min.css" >
		<link rel="stylesheet" href="/Ruche/css/ruche.css" />
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="/Ruche/scripts/bootstrap.min.js"></script>
		
	</head>
<body>

	<?php require_once '../menu.php'; ?>

	<div class="container" style="padding-top: 65px;">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="popin">
					<form class="form-horizontal" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" name="configuration" >
						
							<input type='hidden' name='action' value="<?php  echo $_POST["action"]; ?>" />
														
							<div class="form-group row">
								<label for="id"  class="font-weight-bold col-sm-3 control-label">Id  </label>
								<div class="col-sm-9">
									<input type="int"  name="id" class="form-control" readonly value="<?php echo  $_POST['id']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="api_key"  class="font-weight-bold col-sm-3 control-label">Api key  </label>
								<div class="col-sm-9">
									<input type="text"  name="User_API_Key" class="form-control" value="<?php echo  $_POST['User_API_Key']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="name"  class="font-weight-bold col-sm-3 col-form-label">Login  </label>
								<div class="col-sm-9">
									<input type="text"  name="login" class="form-control" value="<?php echo  $_POST['login']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="name"  class="font-weight-bold col-sm-3 col-form-label">Droits  </label>
								<div class="col-sm-9">
									<input type="int"  name="droits" class="form-control" value="<?php echo  $_POST['droits']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="name"  class="font-weight-bold col-sm-3 col-form-label">E mail  </label>
								<div class="col-sm-9">
									<input type="email"  name="email" class="form-control" value="<?php echo  $_POST['email']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="name"  class="font-weight-bold col-sm-3 col-form-label">Tel number  </label>
								<div class="col-sm-9">
									<input type="text"  name="telNumber" class="form-control" value="<?php echo  $_POST['telNumber']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="url"  class="font-weight-bold col-sm-3 col-form-label">Quota SMS  </label>
								<div class="col-sm-9">
									<input type="int"  name="quotaSMS" class="form-control" value="<?php echo  $_POST['quotaSMS']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="auth_name"  class="font-weight-bold col-sm-3 col-form-label">Delay  </label>
								<div class="col-sm-9">
									<input type="int"  name="delaySMS" class="form-control" value="<?php echo  $_POST['delaySMS']; ?>" />
								</div>
							</div>
																			
							<div class="form-group">
								</br>
								<button type="submit" class="btn btn-primary" value="Valider" name="envoyer" > Appliquer</button>
								<a  class="btn btn-info" role="button" href="users">Annuler</a>
							</div>	
					</form>
				</div>
			</div>
			
			<div class="col-md-6 col-sm-6 col-xs-12">
			    <div class="popin">
				<h3>User Settings</h3>
				<ul>
					<li><b>Login</b>: Enter a unique login for your user.</li>

					<li><b>API Key</b>: Auto generated API key for the user.</li>

					<li><b>Quota</b>: Enter the quota of daily SMS</li>
					
					<li><b>Delay</b>: Enter the delay  in seconds between two SMS transmissions </li>
					
					
				</ul>
				</div>
			</div>
		</div>
	</div>
</body>	