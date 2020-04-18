<?php
include "authentification/authcheck.php" ;
	
require_once('../definition.inc.php');
require_once('../api/Api.php');

$bdd = Api::connexionBD(BASE);



//------------si des données  sont soumises on les enregistre dans la table data.thinghttps ---------
if( !empty($_POST['envoyer'])){
	
	if(isset($_POST['action']) && ($_POST['action'] == 'insert')){
		$sql = sprintf("INSERT INTO `data`.`thinghttps` (`user_id`, `api_key`, `url`, `auth_name`, `auth_pass`, `method`, `content_type`, `http_version`, `host`, `body`, `name`, `parse`) VALUES ( %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s);"
		              , $bdd->quote($_POST['user_id'])   
					  , $bdd->quote($_POST['api_key'])
					  , $bdd->quote($_POST['url'])
					  , $bdd->quote($_POST['auth_name'])
					  , $bdd->quote($_POST['auth_pass'])
					  , $bdd->quote($_POST['method'])
					  , $bdd->quote($_POST['content_type'])
					  , $bdd->quote($_POST['http_version'])
					  , $bdd->quote($_POST['host'])
					  , $bdd->quote($_POST['body'])
					  , $bdd->quote($_POST['name'])
					  , $bdd->quote($_POST['parse'])				  
					  ); 	
		$bdd->exec($sql);
		header("Location: thingHTTPs.php");
		return;
	}
	if(isset($_POST['action']) && ($_POST['action'] == 'update')){
		$sql = sprintf("UPDATE `thinghttps` SET `url` = %s, `method`=%s, `auth_name`=%s, `auth_pass`=%s, `content_type`=%s, `http_version`=%s, `host`=%s, `body`=%s, `name`=%s , `parse`=%s  WHERE `thinghttps`.`id` = %s;"
					  , $bdd->quote($_POST['url'])
					  , $bdd->quote($_POST['method'])
					  , $bdd->quote($_POST['auth_name'])
					  , $bdd->quote($_POST['auth_pass'])
					  , $bdd->quote($_POST['content_type'])
					  , $bdd->quote($_POST['http_version'])
					  , $bdd->quote($_POST['host'])
					  , $bdd->quote($_POST['body'])
					  , $bdd->quote($_POST['name'])
					  , $bdd->quote($_POST['parse'])
					  , $_POST['id']
					  );

		$bdd->exec($sql);
		header("Location: thingHTTPs.php");
		return;
	}
}
// -------------- sinon lecture de la table data.channels  -----------------------------
else
{
	if (isset($_GET['id'])){
 
		$sql = sprintf("SELECT * FROM `thinghttps` WHERE `id`=%s", $bdd->quote($_GET['id']));
		$stmt = $bdd->query($sql);
		if ($thinghttp =  $stmt->fetchObject()){
		   $_POST['action'] = "update";
		   $_POST['id']     = $thinghttp->id;
		   $_POST['user_id']   = $thinghttp->user_id;
		   $_POST['api_key'] = $thinghttp->api_key;
		   $_POST['url'] = $thinghttp->url;
		   $_POST['auth_name'] = $thinghttp->auth_name;
		   $_POST['auth_pass'] = $thinghttp->auth_pass;
		   $_POST['method'] = $thinghttp->method;
		   $_POST['content_type'] = $thinghttp->content_type;
		   $_POST['http_version'] = $thinghttp->http_version;
		   $_POST['host'] = $thinghttp->host;
		   $_POST['body'] = $thinghttp->body;
		   $_POST['name'] = $thinghttp->name;
		   $_POST['parse'] = $thinghttp->parse;
	   } 
	}else {
		$_POST['action'] = "insert";
		$_POST['id'] = 0;
		$_POST['user_id']   = $_SESSION['id'];
		$_POST['api_key'] = Api::genererChaineAleatoire();
		$_POST['url'] = "";
		$_POST['auth_name'] = "";
		$_POST['auth_pass'] = "";
		$_POST['method'] = "";
		$_POST['content_type'] = "";
		$_POST['http_version'] = "";
		$_POST['host'] = "";
		$_POST['body'] = "";
		$_POST['name'] = "";
		$_POST['parse'] = "";		
   }   
}
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>thingHTTP Settings - Aggregator</title>
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
							<input type='hidden' name='user_id' value="<?php  echo $_POST["user_id"]; ?>" />
							
							<div class="form-group row">
								<label for="id"  class="font-weight-bold col-sm-3 control-label">Id  </label>
								<div class="col-sm-9">
									<input type="text"  name="id" class="form-control" readonly value="<?php echo  $_POST['id']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="api_key"  class="font-weight-bold col-sm-3 control-label">Api_key  </label>
								<div class="col-sm-9">
									<input type="text"  name="api_key" class="form-control" value="<?php echo  $_POST['api_key']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="name"  class="font-weight-bold col-sm-3 col-form-label">Name  </label>
								<div class="col-sm-9">
									<input type="text"  name="name" class="form-control" value="<?php echo  $_POST['name']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="url"  class="font-weight-bold col-sm-3 col-form-label">URL  </label>
								<div class="col-sm-9">
									<input type="text"  name="url" class="form-control" value="<?php echo  $_POST['url']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="auth_name"  class="font-weight-bold col-sm-3 col-form-label">HTTP Auth Username  </label>
								<div class="col-sm-9">
									<input type="text"  name="auth_name" class="form-control" value="<?php echo  $_POST['auth_name']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="auth_pass"  class="font-weight-bold col-sm-3 col-form-label">HTTP Auth Password  </label>
								<div class="col-sm-9">
									<input type="text"  name="auth_pass" class="form-control" value="<?php echo  $_POST['auth_pass']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="method"  class="font-weight-bold col-sm-3 col-form-label">Method  </label>
								<div class="col-sm-9">
									<select class="form-control" name="method" >
										<option <?php if ($_POST['method']=="GET")    echo 'selected="selected"'?> value="GET">GET</option>
										<option <?php if ($_POST['method']=="POST")   echo 'selected="selected"'?> value="POST">POST</option>
										<option <?php if ($_POST['method']=="PUT")    echo 'selected="selected"'?> value="PUT">PUT</option>
										<option <?php if ($_POST['method']=="DELETE") echo 'selected="selected"'?> value="DELETE">DELETE</option>
									</select>
								</div>
							</div>
							
							<div class="form-group row">
								<label for="content_type"  class="font-weight-bold col-sm-3 col-form-label">Content Type  </label>
								<div class="col-sm-9">
									<input type="text"  name="content_type" class="form-control" value="<?php echo  $_POST['content_type']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="http_version"  class="font-weight-bold col-sm-3 col-form-label">HTTP Version  </label>
								<div class="col-sm-9">
									<select class="form-control" name="http_version" >
										<option <?php if ($_POST['http_version']=="1.0")    echo 'selected="selected"'?> value="1.0">1.0</option>
										<option <?php if ($_POST['http_version']=="1.1")    echo 'selected="selected"'?> value="1.1">1.1</option>
									</select>
								</div>
							</div>
							
							<div class="form-group row">
								<label for="host"  class="font-weight-bold col-sm-3 col-form-label">Host  </label>
								<div class="col-sm-9">
									<input type="text"  name="host" class="form-control" value="<?php echo  $_POST['host']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="body"  class="font-weight-bold col-sm-3 col-form-label">Body  </label>
								<div class="col-sm-9">
									<textarea class="form-control vertical_resize_only" rows="4" name="body"><?php echo  $_POST['body']; ?></textarea>
								</div>
							</div>
							
							
							
							<div class="form-group row">
								<label for="parse"  class="font-weight-bold col-sm-3 col-form-label">parse  </label>
								<div class="col-sm-9">
									<input type="text"  name="parse" class="form-control" value="<?php echo  $_POST['parse']; ?>" />
								</div>
							</div>
							
													
							
							<div class="form-group">
								</br>
								<button type="submit" class="btn btn-primary" value="Valider" name="envoyer" > Appliquer</button>
								<a  class="btn btn-info" role="button" href="thingHTTPs">Annuler</a>
							</div>	
					</form>
				</div>
			</div>
			
			<div class="col-md-6 col-sm-6 col-xs-12">
			    <div class="popin">
				<h3>ThingHTTP Settings</h3>
				<ul>
					<li><b>Name</b>: Enter a unique name for your ThingHTTP request.</li>

					<li><b>API Key</b>: Auto generated API key for the ThingHTTP request.</li>

					<li><b>URL</b>: Enter the address of the website you are requesting data from or writing data to starting with either http:// or https://.</li>
					
					<li><b>HTTP Auth Username</b>: If your URL requires authentication, enter the username for authentication to access private channels or websites.</li>
					
					<li><b>HTTP Auth Password</b>: If your URL requires authentication, enter the password for authentication to access private channels or websites.</li>

					<li><b>Method</b>: Select the HTTP method required to access the URL.</li>

					<li><b>Content Type</b>: Enter the MIME or form type of the request content. For example, application/x-www-form-urlencoded.</li>

					<li><b>HTTP Version</b>: Select the version of HTTP on your server.</li>
					
					<li><b>Host</b>: If your ThingHTTP request requires a host address, enter the domain name here. For example, api.aggregate.com.</li>
					
					<li><b>Headers</b>: If your ThingHTTP request requires custom headers, enter the information here. You must specify the name of the header and a value.</li>
					
					<li><b>Body</b>: Enter the message you want to include in your request.</li>
					
					<li><b>Parse String</b>: If you want to parse the response, enter the exact string to look for in the response data.</li>
				</ul>
				</div>
			</div>
		</div>
	</div>
</body>	