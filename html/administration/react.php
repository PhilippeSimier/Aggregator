<?php
include "authentification/authcheck.php" ;

require_once('../definition.inc.php');
require_once('../api/Api.php');
require_once('../api/Str.php');
require_once('../api/Form.php');

use Aggregator\Support\Api;
use Aggregator\Support\Str;
use Aggregator\Support\Form;

$bdd = Api::connexionBD(BASE, $_SESSION['time_zone']);

//------------si des données  sont soumises on les enregistre dans la table data.reacts ---------
if( !empty($_POST['envoyer'])){
	if ($_SESSION['tokenCSRF'] === $_POST['tokenCSRF']) { // si le token est valide
		if(isset($_POST['action']) && ($_POST['action'] == 'insert')){
			$sql = sprintf("INSERT INTO `data`.`reacts` (`name`, `testFrequency`, `conditionChannel`, `conditionField`, `condition`, `conditionValue`, `actionType`, `actionName`, `react_type` ) VALUES ( %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s);"
						, $bdd->quote($_POST['name'])   // utf8_decode()
						, $bdd->quote($_POST['testFrequency'])
						, $bdd->quote($_POST['conditionChannel'])
						  , $bdd->quote($_POST['conditionField'])
						  , $bdd->quote($_POST['condition'])
						  , $bdd->quote($_POST['conditionValue'])
						  , $bdd->quote($_POST['actionType'])
						  , $bdd->quote($_POST['actionName'])
						  , $bdd->quote($_POST['option'])
						  );
			$bdd->exec($sql);
		}
		if(isset($_POST['action']) && ($_POST['action'] == 'update')){
			$sql = sprintf("UPDATE `` SET `name` = %s, `run_interval`=%s, `run_on_insertion`=%s, `channel_id`=%s, `field_number`=%s, `condition`=%s, `condition_value`=%s, `actionable_type`=%s, `actionable_id`=%s, `react_type`=%s WHERE `reacts`.`id` = %s;"
						  , $bdd->quote($_POST['name'])
						  , $bdd->quote($_POST['run_interval'])
						  , $bdd->quote($_POST['run_on_insertion'])
						  , $bdd->quote($_POST['channel_id'])
						  , $bdd->quote($_POST['field_number'])
						  , $bdd->quote($_POST['condition'])
						  , $bdd->quote($_POST['condition_value'])
						  , $bdd->quote($_POST['actionable_type'])
						  , $bdd->quote($_POST['actionable_id'])
						  , $bdd->quote($_POST['react_type'])
						  , $_POST['id']
						  );

			$bdd->exec($sql);
		}

		// destruction du tokenCSRF
		unset($_SESSION['tokenCSRF']);

		header("Location: reacts");
		return;
	}
}
// -------------- sinon lecture de la table data.reacts  -----------------------------
else
{
	if (isset($_GET['id'])){
	// Création d'un objet react à partir de son id
		$sql = sprintf("SELECT * FROM `reacts` WHERE `id`=%s", $bdd->quote($_GET['id']));
		$stmt = $bdd->query($sql);
		if ($react =  $stmt->fetchObject()){
		   $react->action = "update";
		}
	}else {
	// Création d'un nouvel objet react par défault
		$react = new stdClass();
		$react->action = "insert";
		$react->id = 0;
		$react->user_id = $_SESSION['id'];
		$react->name = "React";
		$react->run_interval = "";
		$react->run_on_insertion = "";
		$react->channel_id = "";
		$react->field_number = "";
		$react->condition = "";
		$react->condition_value = "0";
		$react->actionable_type = "";
		$react->actionable_id = "";
		$react->react_type = "";
	}


// -------------- Création des différents Select  -----------------------------

    
    try{	
		// Création du selectUser
		$sql = "SELECT id,login FROM users ORDER BY id;";
		$stmt = $bdd->query($sql);
		
		$selectUser = array();
		while ($user = $stmt->fetchObject()){
			$selectUser[$user->id] = $user->login;
		}
		
		// Création du select_channel_id
		$sql = "SELECT id,name FROM channels ORDER BY id;";
		$stmt = $bdd->query($sql);

		$select_channel_id = array();
		while ($channel = $stmt->fetchObject()){
			$select_channel_id[$channel->id] = $channel->name;
		}
		
		// Création du $select_actionable_id
		$sql = "SELECT id,name FROM thinghttps ORDER BY id;";
		$stmt = $bdd->query($sql);
		$select_actionable_id = array();
		while ($thingHttp = $stmt->fetchObject()){
			$select_actionable_id[$thingHttp->id] = $thingHttp->name;
		}
		
	}
	catch (\PDOException $ex) 
	{
	    echo($ex->getMessage());
        return;		
	}

	//Création du select_react_type
	if($_SESSION['language'] == "EN")
		$select_react_type = array('Run action only the first time the condition is met','Run action each time condition is met');
	else
		$select_react_type = array("Exécuter l'action uniquement la première fois que la condition est remplie","Exécuter l'action chaque fois que la condition est remplie");






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

		<title>Channel Settings - Aggregator</title>
		<!-- Bootstrap CSS version 4.1.1 -->
		<link rel="stylesheet" href="/Ruche/css/bootstrap.min.css" >
		<link rel="stylesheet" href="/Ruche/css/ruche.css" />

		<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="/Ruche/scripts/bootstrap.min.js"></script>

	</head>
<body>

	<?php require_once '../menu.php'; ?>

	<div class="container-fluid" style="padding-top: 65px;">
		<div class="row">
			<div class="col-md-6 col-sm-12 col-12">
				<div class="popin">
					<form class="form-horizontal" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" name="configuration" >
							<?php

								echo Form::hidden('action', $react->action);
								echo Form::hidden("tokenCSRF", $_SESSION["tokenCSRF"] );
								echo Form::hidden('id', $react->id);


								if($_SESSION['droits'] > 1) //  un selecteur pour les administrateur
									echo Form::select("user_id", $selectUser, "User", $react->user_id);
								else
									echo Form::hidden("user_id", $react->user_id );

								$options = array( 'class' => 'form-control');
								echo Form::input( 'text', 'name', $react->name, $options);

								$select_interval = array('on_insertion' => "On data insertion", 
								                         '10mins' =>"Every 10 minutes", 
														 '30mins' =>"Every 30 minutes", 
														 '60mins' =>"Every 60 minutes" );
								echo Form::select('shedule', $select_interval, "Test Frequency", $react->run_interval);

								
								echo Form::select("channel_id", $select_channel_id, "Condition", $react->channel_id);
								
								$select_field_number = array();  // champs mis à jour en ajax
								echo Form::select("field_number", $select_field_number , " ", $react->field_number);
								
								$select_condition = array(	'gt' => 'is greater than',
															'gte' => 'is greater or equal to',
															'lt' => 'is less than',
															'lte' => 'is less than or equal',
															'eq' =>  'is equal to',
															'neq' => 'is not equal' );
								echo Form::select("condition", $select_condition , " ", $react->condition);

								$optionsNumber = array( 'class' => 'form-control', 'step' => "0.001");
								echo Form::input( 'number', 'condition_value', $react->condition_value, $optionsNumber, " ");

								$select_actionable_type = array('thingHTTP' => "ThingHTTP", 'sms' => "SMS", 'email' => "Email" );
								echo Form::select("actionable_type", $select_actionable_type , "action", $react->actionable_type );
								
								echo Form::select("actionable_id", $select_actionable_id , "perform ThingHTTP", $react->actionable_id );
								
								$select_react_type = array('false'=>'Run action only the first time the condition is met', 
														   'true' =>'Run action each time condition is met');
								echo Form::select("react_type", $select_react_type , "Option", $react->react_type ); 

							?>

							<div class="form-group">
								</br>
								<button type="submit" class="btn btn-primary" value="Valider" name="envoyer" > Apply</button>
								<a  class="btn btn-info" role="button" href="reacts">Cancel</a>
							</div>
					</form>
				</div>
			</div>

			<div class="col-md-6 col-sm-12 col-12">
			    <div class="popin">
				<h3>Reacts Settings</h3>
				<ul>
					<li>Channel Name: Enter a unique name for the reac.</li>

					<li>Description: Enter a description of the channel.</li>

					<li>Field#: Check the box to enable the field, and enter a field name. Each  channel can have up to 8 fields.</li>


					<li>Tags: Enter keywords that identify the thing. Separate tags with commas.</li>

					<li>Show Channel Location:
						<ul>
							<li>Latitude: Specify the latitude position in decimal degrees. For example, the latitude of the city of London is 51.5072.</li>

							<li>Longitude: Specify the longitude position in decimal degrees. For example, the longitude of the city of London is -0.1275.</li>

							<li>Elevation: Specify the elevation position meters. For example, the elevation of the city of London is 35.052.</li>
						</ul>
					</li>
				</ul>
				</div>
			</div>
		</div>

		<?php require_once '../piedDePage.php'; ?>
	</div>

</body>