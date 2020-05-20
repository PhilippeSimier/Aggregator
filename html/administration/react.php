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
$error = "";
 
	//------------si des données  sont soumises on les enregistre dans la table data.reacts ---------
	if( !empty($_POST['envoyer']) && $_SESSION['tokenCSRF'] === $_POST['tokenCSRF']  && $_POST['channel_id']!== ''){
		

		
		try{
			  
				if(isset($_POST['action']) && ($_POST['action'] == 'insert')){
					
					if($_POST['shedule'] == 'on_insertion'){ 
						$run_interval = 0; 
						$run_on_insertion = 1;
					}else{
						$run_interval = $_POST['shedule']; 
						$run_on_insertion = 0;
					}
						
					$sql = sprintf("INSERT INTO `data`.`reacts` (`user_id`, `name`, `react_type`, `run_interval`, `run_on_insertion`, `channel_id`, `field_number`, `condition`, `condition_value`, `actionable_type`, `actionable_id`, `run_action_every_time` ) VALUES ( %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s);"
							, $bdd->quote($_POST['user_id'])
							, $bdd->quote($_POST['name'])
							, $bdd->quote($_POST['react_type'])
							, $bdd->quote($run_interval)
							, $bdd->quote($run_on_insertion)
							, $bdd->quote($_POST['channel_id'])
							, $bdd->quote($_POST['field_number'])
							, $bdd->quote($_POST['condition'])
							, $bdd->quote($_POST['condition_value'])
							, $bdd->quote($_POST['actionable_type'])
							, $bdd->quote($_POST['actionable_id'])
							, $bdd->quote($_POST['run_action_every_time'])
							);
					
					$bdd->exec($sql);
				}
				if(isset($_POST['action']) && ($_POST['action'] == 'update')){
					
					if($_POST['shedule'] == 'on_insertion'){ 
						$run_interval = 0; 
						$run_on_insertion = 1;
					}else{
						$run_interval = $_POST['shedule']; 
						$run_on_insertion = 0;
					}
					
					$sql = sprintf("UPDATE `reacts` SET `user_id`= %s, `name` = %s, `react_type` = %s, `run_interval`=%s, `run_on_insertion`=%s, `channel_id`=%s, `field_number`=%s, `condition`=%s, `condition_value`=%s, `actionable_type`=%s, `actionable_id`=%s, `run_action_every_time`=%s WHERE `reacts`.`id` = %s;"
							, $bdd->quote($_POST['user_id'])
							, $bdd->quote($_POST['name'])
							, $bdd->quote($_POST['react_type'])
							, $bdd->quote($run_interval)
							, $bdd->quote($run_on_insertion)
							, $bdd->quote($_POST['channel_id'])
							, $bdd->quote($_POST['field_number'])
							, $bdd->quote($_POST['condition'])
							, $bdd->quote($_POST['condition_value'])
							, $bdd->quote($_POST['actionable_type'])
							, $bdd->quote($_POST['actionable_id'])
							, $bdd->quote($_POST['run_action_every_time'])
							, $_POST['id']
							);
					
					$bdd->exec($sql);
				}
			
			// destruction du tokenCSRF
			unset($_SESSION['tokenCSRF']);

			header("Location: reacts");
			return;
			
		}catch (\PDOException $ex) 
		{
			$error = $ex->getMessage();
		}	
		
	}
	// -------------- sinon création d'un objet react et d'un selecteur field_number  -----------------------------
	
	try{
		$id = Api::verifier('id',FILTER_VALIDATE_INT);
		if ($id != null){
		// Création d'un objet react à partir de son id
			$sql = sprintf("SELECT * FROM `reacts` WHERE `id`=%s", $bdd->quote($id));
			$stmt = $bdd->query($sql);
			if ($react =  $stmt->fetchObject()){
			   $react->action = "update";
			}
		// Création des options pour $select_field_number
			$sql = "SELECT * FROM `channels` where `id` = ". $react->channel_id;
			$stmt = $bdd->query($sql); 
			$channel = $stmt->fetchObject();
			$select_field_number['1'] = $channel->field1;
			$select_field_number['2'] = $channel->field2;	
			$select_field_number['3'] = $channel->field3;
			$select_field_number['4'] = $channel->field4;
			$select_field_number['5'] = $channel->field5;
			$select_field_number['6'] = $channel->field6;
			$select_field_number['7'] = $channel->field7;
			$select_field_number['8'] = $channel->field8;
			
		}else {
		// Création d'un nouvel objet react par défault
			$react = new stdClass();
			$react->action = "insert";
			$react->id = 0;
			$react->user_id = $_SESSION['id'];
			$react->name = "React";
			$react->react_type = "numeric";
			$react->run_interval = "";
			$react->run_on_insertion = "";
			$react->channel_id = "";
			$react->field_number = "";
			$react->condition = "";
			$react->condition_value = "0";
			$react->actionable_type = "";
			$react->actionable_id = "";
			$react->run_action_every_time = "";
			$react->last_run_at = "";
			$react->action_value = "";
		
		//  selecteur mis à jour en ajax   car le channel_id du react est vide à ce stade
			$select_field_number = array();  
		}


	// -------------- Création des options des différents Selecteurs  ----------------------

			
		// Création du selectUser
		
		$sql = "SELECT id,login FROM users ORDER BY id;";
		$stmt = $bdd->query($sql);
			
		$selectUser = array();
		while ($user = $stmt->fetchObject()){
			$selectUser[$user->id] = $user->login;
		}
			
		// Création du select_channel_id
		if($_SESSION['droits'] > 1)
			$sql = "SELECT id,name FROM channels ORDER BY id;";
		else
			$sql = "SELECT id,name FROM users_channels where user_id = {$_SESSION['id']} ORDER BY id;";
		
		$stmt = $bdd->query($sql);

		$select_channel_id = array();
		$select_channel_id[''] = "Choose your channel";
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

		// Création du tokenCSRF
		$tokenCSRF = STR::genererChaineAleatoire(32);
		$_SESSION['tokenCSRF'] = $tokenCSRF;
	
	}catch (\PDOException $ex) 
	{
		// si une erreur est intervenue pendant la création du react ou des sélecteurs alors
		// il est impossible de créer le formulaire 
		echo $ex->getMessage();
		return;
	}	
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Channel Settings - Aggregator</title>
		<!-- Bootstrap CSS version 4.1.1 -->
		<link rel="stylesheet" href="../css/bootstrap.min.css" >
		<link rel="stylesheet" href="../css/ruche.css" />

		<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="../scripts/bootstrap.min.js"></script>
		
		<script>
		    
		$(document).ready(function(){	
			
			console.log($('select#react_type').val());
			switch($('select#react_type').val()) {
				case 'numeric':
				    console.log("numeric");
					$('#section').append($('#numeric_condition'));
				    break;

				case 'nodata':
				    console.log("nodata");
					$('#section').append($('#numeric_nodata'));
				    break;
			}
			
			$('#react_type').change(function(){  
				console.log(this.value);
				if (this.value === 'numeric'){
					$('#template').append($('#numeric_nodata'));
					$('#section').append($( '#numeric_condition'));
				}
				if (this.value === 'nodata'){
					$('#template').append($('#numeric_condition'));
					$('#section').append($( '#numeric_nodata'));
				}
				
			});
			
			
			// when a channel is changed
			$('#channel_id').change(function(){  
				// $("#loader").show();    
				$.post("../api/fields_html.php", { channelId: this.value },
					function(code_html){
						// $("#loader").hide();   
						$("#field_number").html(code_html);  // ajoute dans l'élément id épreuve le contenu html reçu
					}
				);
			});
    

			
			
			
		});
		
		</script>

	</head>
<body>

	<?php require_once '../menu.php'; ?>

	<div class="container-fluid" style="padding-top: 65px;">
		<div class="row">
			<div class="col-md-6 col-sm-12 col-12">
				<div class="popin">
					<?php echo '<p style="color: #ff0000;">' . $error . '</p>'; ?>
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
								
								$select_react_type = array('numeric' => "Numeric",
														   'nodata'  => "No data check");
								echo Form::select( 'react_type', $select_react_type, "Condition Type", $react->react_type);						   
														   
								echo "<div id='section'></div>";


								$select_actionable_type = array('' => 'Choose your action', 'thingHTTP' => "ThingHTTP",  'email' => "Send a email" );
								echo Form::select("actionable_type", $select_actionable_type , "action", $react->actionable_type );
								
								echo Form::select("actionable_id", $select_actionable_id , "perform", $react->actionable_id );
								
								$select_react_type = array('0'=>'Run action only the first time the condition is met', 
														   '1' =>'Run action each time condition is met');
								echo Form::select("run_action_every_time", $select_react_type , "Option", $react->run_action_every_time ); 
								
								$options = array( 'class' => 'form-control', 'readonly' => null);
								echo Form::input( 'text', 'last_run_at', $react->last_run_at, $options , 'last run at');
								echo Form::input( 'text', 'action_value', $react->action_value, $options , 'action value');

							?>

							<div class="form-group">
								</br>
								<button type="submit" class="btn btn-primary" value="Valider" name="envoyer" > Apply</button>
								<a  class="btn btn-info" role="button" href="reacts">Cancel</a>
							</div>
					</form>	
							
							<?php
								
								// Morceaux de formulaire qui seront switchés en fonction du type de react
								echo "<div id='template' style='display:none' >";
								
								// Condition Numerique
								echo "<div id='numeric_condition' >";
								$select_interval = array('on_insertion' => "On data insertion", 
								                         '10' =>"Every 10 minutes", 
														 '30' =>"Every 30 minutes", 
														 '60' =>"Every 60 minutes" );
								echo Form::select('shedule', $select_interval, "Test Frequency", $react->run_interval);

								
								echo Form::select("channel_id", $select_channel_id, "Condition", $react->channel_id);
								
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
								echo "</div>";
								// Fin de condition numeric
								
								// Condition no data check
								
								echo "<div id='numeric_nodata' >";
								echo Form::hidden('field_number', '0');
								$select_interval = array('10' =>"Every 10 minutes", 
														 '30' =>"Every 30 minutes", 
														 '60' =>"Every 60 minutes" );
								echo Form::select('shedule', $select_interval, "Test Frequency", $react->run_interval);
								
								echo Form::select("channel_id",   $select_channel_id, "If Channel", $react->channel_id);
								
								echo "<div class='form-group row'><div class='col-3'></div><div class='col-9'>Has not been updated for</div></div>";							
								$optionsNumber = array( 'class' => 'form-control', 'step' => "1");
								echo Form::input( 'number', 'condition_value', $react->condition_value, $optionsNumber, " ");
								echo "<div class='form-group row'><div class='col-3'></div><div class='col-9'>minutes</div></div><br />";
								
								echo "</div>";
								// Fin de no data check
							    echo "</div>";
							
							
							?>
							
							
							
					
				</div>
			</div>

			<div class="col-md-6 col-sm-12 col-12">
			    <div class="popin">
				<h3>Reacts Settings</h3>
				<ul>
					<li>React Name: Enter a unique name for your React.</li>

					<li>Test Frequency: Choose whether to test your condition every time data enters the channel or on a periodic basis.</li>

					<li>Condition: Select a channel, a field and the condition for your React.</li>


					<li>Action: Select ThingHTTP, Send a SMS, Send a email to run when the condition is met.</li>
					
					<li>Options: Select when the React runs.</li>
					
				</ul>
				</div>
			</div>
		</div>

		<?php require_once '../piedDePage.php'; ?>
	</div>

</body>