<?php
include "authentification/authcheck.php" ;
	
require_once('../definition.inc.php');
require_once('../api/Api.php');
require_once('../api/Str.php');
require_once('../api/Form.php');

use Aggregator\Support\Api;
use Aggregator\Support\Str;
use Aggregator\Support\Form;

$bdd = Api::connexionBD(BASE);



//------------si des données  sont soumises on les enregistre dans la table data.users ---------
if( !empty($_POST['envoyer'])){
	if ($_SESSION['tokenCSRF'] === $_POST['tokenCSRF']) { // si le token est valide
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
			
			// destruction du tokenCSRF
			unset($_SESSION['tokenCSRF']);
			
			header("Location: users.php");
			return;
		}
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
		   $_POST['time_zone'] = $user->time_zone;
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
		$_POST['User_API_Key'] = Str::genererChaineAleatoire();
		$_POST['time_zone'] = "";
		$_POST['quotaSMS'] = "140";
		$_POST['delaySMS'] = "30";	
	}
	
	// Création du tokenCSRF
	$tokenCSRF = STR::genererChaineAleatoire(32);
	$_SESSION['tokenCSRF'] = $tokenCSRF;

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

	<div class="container" style="padding-top: 65px; max-width: 90%;">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="popin">
					<form class="form-horizontal" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" name="configuration" >
						
							<?php 	
							    echo Form::hidden("action",    $_POST["action"] );
								echo Form::hidden("tokenCSRF", $_SESSION["tokenCSRF"] );
								
								$options = array( 'class' => 'form-control', 'readonly' => null);
								echo Form::input( 'int', 'id', $_POST['id'], $options, 'Id ' ); 
								echo Form::input( 'text', 'User_API_Key', $_POST['User_API_Key'], $options , 'Api key ');
								echo Form::input( 'text', 'time_zone', $_POST['time_zone'], $options , 'Time zone ');
								
								$options = array( 'class' => 'form-control');
								echo Form::input( 'text', 'login', $_POST['login'], $options , 'Login ');
								
								$droits = array(1 => "Utilisateur", 2 =>"Administrateur" );
								echo Form::select("droits", $droits,     "Droits  ", $_POST['droits']);
								
								echo Form::input( 'email' , 'email',     $_POST['email'],     $options , 'E mail ');
								echo Form::input( 'text'  , 'telNumber', $_POST['telNumber'], $options , 'Tel number ');
								echo Form::input( 'int'   , 'quotaSMS',  $_POST['quotaSMS'],  $options , 'Quota SMS ');
								echo Form::input( 'int'   , 'delaySMS',  $_POST['delaySMS'],  $options , 'Delay SMS ');
							?>
																		
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