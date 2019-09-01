<?php
include "authentification/authcheck.php" ;
	
require_once('../definition.inc.php');
require_once('../api/biblio.php');

$bdd = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BASE, UTILISATEUR,PASSE);

// Fonction pour créer le sélecteur tag 
// Le tag d'un canal fait référence au tag d'un objet
function faireSelectTags($bdd , $thing_tag){
	
	$sql = "SELECT tag FROM `things`";
	$stmt = $bdd->query($sql);
	
	echo '<select class="form-control" name="tags">';
	while ($thing =  $stmt->fetchObject()){
		if ($thing->tag == $thing_tag)
			echo "<option selected value='" . $thing->tag . "'>" . $thing->tag . "</option>" ;
        else
			echo "<option value='" . $thing->tag . "'>" . $thing->tag . "</option>" ;	
	}
    echo "</select>";
    
}

//------------si des données  sont soumises on les enregistre dans la table data.channels ---------
if( !empty($_POST['envoyer'])){
	
	if(isset($_POST['action']) && ($_POST['action'] == 'insert')){
		$sql = sprintf("INSERT INTO `data`.`channels` (`name`, `field1`, `field2`, `field3`, `field4`, `field5`, `field6`, `field7`, `field8`, `status`, `tags`,`write_api_key` ) VALUES ( %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s);"
		              , $bdd->quote($_POST['name'])   // utf8_decode()
					  , $bdd->quote($_POST['field1'])
					  , $bdd->quote($_POST['field2'])
					  , $bdd->quote($_POST['field3'])
					  , $bdd->quote($_POST['field4'])
					  , $bdd->quote($_POST['field5'])
					  , $bdd->quote($_POST['field6'])
					  , $bdd->quote($_POST['field7'])
					  , $bdd->quote($_POST['field8'])
					  , $bdd->quote($_POST['status'])
					  , $bdd->quote($_POST['tags'])
					  , $bdd->quote(genererKey($bdd))
					  ); 	
		$bdd->exec($sql);
		header("Location: channels.php");
		return;
	}
	if(isset($_POST['action']) && ($_POST['action'] == 'update')){
		$sql = sprintf("UPDATE `channels` SET `name` = %s, `field1`=%s, `field2`=%s, `field3`=%s, `field4`=%s, `field5`=%s, `field6`=%s , `field7`=%s , `field8`=%s , `status`=%s, `tags`=%s WHERE `channels`.`id` = %s;"
					  , $bdd->quote($_POST['name'])
					  , $bdd->quote($_POST['field1'])
					  , $bdd->quote($_POST['field2'])
					  , $bdd->quote($_POST['field3'])
					  , $bdd->quote($_POST['field4'])
					  , $bdd->quote($_POST['field5'])
					  , $bdd->quote($_POST['field6'])
					  , $bdd->quote($_POST['field7'])
					  , $bdd->quote($_POST['field8'])
					  , $bdd->quote($_POST['status'])
					  , $bdd->quote($_POST['tags'])
					  , $_POST['id']
					  );

		$bdd->exec($sql);
		header("Location: channels.php");
		return;
	}
}
// -------------- sinon lecture de la table data.channels  -----------------------------
else
{
	if (isset($_GET['id'])){
 
		$sql = sprintf("SELECT * FROM `channels` WHERE `id`=%s", $bdd->quote($_GET['id']));
		$stmt = $bdd->query($sql);
		if ($channel =  $stmt->fetchObject()){
		   $_POST['action'] = "update";
		   $_POST['id']     = $channel->id;
		   $_POST['name']   = $channel->name;
		   $_POST['field1'] = $channel->field1;
		   $_POST['field2'] = $channel->field2;
		   $_POST['field3'] = $channel->field3;
		   $_POST['field4'] = $channel->field4;
		   $_POST['field5'] = $channel->field5;
		   $_POST['field6'] = $channel->field6;
		   $_POST['field7'] = $channel->field7;
		   $_POST['field8'] = $channel->field8;
		   $_POST['status'] = $channel->status;
		   $_POST['tags']   = $channel->tags;
	   } 
	}else {
		$_POST['action'] = "insert";
		$_POST['id'] = 0;
		$_POST['name'] = "";
		$_POST['field1'] = "";
		$_POST['field2'] = "";
		$_POST['field3'] = "";
		$_POST['field4'] = "";
		$_POST['field5'] = "";
		$_POST['field6'] = "";
		$_POST['field7'] = "";
		$_POST['field8'] = "";
		$_POST['status'] = "";
		$_POST['tags'] = "";
   }   
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

	<div class="container" style="padding-top: 65px;">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="popin">
					<form class="form-horizontal" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" name="configuration" >
						
							<input type='hidden' name='action' value="<?php  echo $_POST["action"]; ?>" />
							
							
							<div class="form-group row">
								<label for="id"  class="font-weight-bold col-sm-2 col-form-label">id : </label>
								<div class="col-sm-10">
									<input type="text"  name="id" class="form-control" readonly value="<?php echo  $_POST['id']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="name"  class="font-weight-bold col-sm-2 col-form-label">Name : </label>
								<div class="col-sm-10">
									<input type="text"  name="name" class="form-control" value="<?php echo  $_POST['name']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="field1"  class="font-weight-bold col-sm-2 col-form-label">field1 : </label>
								<div class="col-sm-10">
									<input type="text"  name="field1" class="form-control" value="<?php echo  $_POST['field1']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="field2"  class="font-weight-bold col-sm-2 col-form-label">field2 : </label>
								<div class="col-sm-10">
									<input type="text"  name="field2" class="form-control" value="<?php echo  $_POST['field2']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="field3"  class="font-weight-bold col-sm-2 col-form-label">field3 : </label>
								<div class="col-sm-10">
									<input type="text"  name="field3" class="form-control" value="<?php echo  $_POST['field3']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="field4"  class="font-weight-bold col-sm-2 col-form-label">field4 : </label>
								<div class="col-sm-10">
									<input type="text"  name="field4" class="form-control" value="<?php echo  $_POST['field4']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="field5"  class="font-weight-bold col-sm-2 col-form-label">field5 : </label>
								<div class="col-sm-10">
									<input type="text"  name="field5" class="form-control" value="<?php echo  $_POST['field5']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="field6"  class="font-weight-bold col-sm-2 col-form-label">field6 : </label>
								<div class="col-sm-10">
									<input type="text"  name="field6" class="form-control" value="<?php echo  $_POST['field6']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="field7"  class="font-weight-bold col-sm-2 col-form-label">field7 : </label>
								<div class="col-sm-10">
									<input type="text"  name="field7" class="form-control" value="<?php echo  $_POST['field7']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="field8"  class="font-weight-bold col-sm-2 col-form-label">field8 : </label>
								<div class="col-sm-10">
									<input type="text"  name="field8" class="form-control" value="<?php echo  $_POST['field8']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="status"  class="font-weight-bold col-sm-2 col-form-label">status : </label>
								<div class="col-sm-10">
									<input type="text"  name="status" class="form-control" value="<?php echo  $_POST['status']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="tags"  class="font-weight-bold col-sm-2 col-form-label">tags : </label>
								<div class="col-sm-10">
									<?php faireSelectTags($bdd , $_POST['tags']); ?>
								</div>
							</div>
							
							
							<div class="form-group">
								</br>
								<button type="submit" class="btn btn-primary" value="Valider" name="envoyer" > Appliquer</button>
								<a  class="btn btn-info" role="button" href="channels">Annuler</a>
							</div>	
					</form>
				</div>
			</div>
			
			<div class="col-md-6 col-sm-6 col-xs-12">
			    <div class="popin">
				<h3>Channel Settings</h3>
				<ul>
					<li>Channel Name: Enter a unique name for the channel.</li>

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
	