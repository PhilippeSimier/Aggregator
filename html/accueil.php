<!DOCTYPE html>

<?php
    session_start();
	require_once('definition.inc.php');


?>

<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Browse sites</title>
		<!-- Bootstrap CSS version 4.1.1 -->
		<link rel="stylesheet" href="/Ruche/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/Ruche/css/ruche.css" />
		<link rel="stylesheet" href="/Ruche/css/font-awesome.min.css" />
		<link rel="stylesheet" href="/Ruche/css/file-explore.css" />
		<!-- <link rel="stylesheet" href="/Ruche/css/app.css" /> -->
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="/Ruche/scripts/bootstrap.min.js"></script>
		<script src="/Ruche/scripts/file-explore.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKUqx5vjYkrX15OOMAxFbOkGjDfAPL1J8"></script>
		<script src="/Ruche/scripts/gmaps.js"></script>
		
		<script type="text/javascript">
			$(document).ready(function () {
                        $(".file-tree").filetree();
						
						var	map = new GMaps({
						div: '#map-canvas',
						lat: 48.01 , 
						lng: 0.206 ,
						zoom : 13 ,
						mapType : 'terrain',
						});
						
						<?php
						require_once('definition.inc.php');
						// connexion à la base data
						$bdd = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BASE, UTILISATEUR,PASSE);
						
						if (!isset($_SESSION['id'])) // Personne n'est connecté donc objet publique
							$sql = 'SELECT * FROM `things` where status = "public";';
						else if ($_SESSION['id'] != 0)
							$sql = "SELECT * FROM `things` where user_id = ". $_SESSION['id'];
						else   // C'est root qui est connecté, tous les objets sont affichés
							$sql = "SELECT * FROM `things`";
							
						$reponse = $bdd->query($sql);
	
						while ($thing = $reponse->fetchObject()){
								echo 'map.addMarker({'; 
									echo 'lat:' . $thing->latitude . ",\n";
									echo 'lng:' . $thing->longitude . ",\n";
									echo 'title: "' . $thing->name . "\",\n";
									echo "infoWindow: {\n";
									echo 'content: "<p> <b>' . $thing->name . '</b><br />Coordonnées GPS : </br> Lat : ' . $thing->latitude;
                                    echo '<br /> Lng : ' . $thing->longitude . '</p>"' ;
									echo "}\n";
								echo "});\n";
								
						}
						$reponse->closeCursor();
						?>						
			});
		</script>

	</head>

	<body>
		<?php require_once 'menu.php'; ?>
		<div class="container" style="padding-top: 75px;">
			<div class="row">
				<div class="col-md-4 col-sm-12 col-xs-12">
				<div class="popin" style="margin: 0px; padding : 4px;">
					<ul class="file-tree ">
					<?php
						
						function listerChannels($bdd, $tags){
							
							$sql = 'SELECT count(*) as nb FROM `channels` WHERE `tags`='. $bdd->quote($tags);
							
							if ($bdd->query($sql)->fetchObject()->nb > 0){
								$sql = 'SELECT * FROM `channels` WHERE `tags`='.  $bdd->quote($tags);
								$reponse = $bdd->query($sql);
								echo '<li  class="folder-data"><a href="#">Data visualisation</a>';
								echo "<ul id=\"channel\">\n";
									while($channel = $reponse->fetchObject()){
										echo '<li>';
										echo '<a class="channels" href="https://api.thingspeak.com/channels/' . $channel->id . '/feed.json?results=0" target="_blank" >' . $channel->name . "</a>\n";
										echo '</li>';								
									}
								
								echo "</ul>\n";
								echo "</li>\n";
							}
						}	
						
						function listerMatlabVisu($bdd, $id){
							
							$sql = 'SELECT count(*) as nb FROM `Matlab_Visu` WHERE `things_id`='. $id;					
							if ($bdd->query($sql)->fetchObject()->nb > 0){
								$sql = 'SELECT * FROM `Matlab_Visu` WHERE `things_id`='. $id;
								$reponse2 = $bdd->query($sql);
								echo '<li  class="folder-matlab"><a href="#">Data Analysis</a>';
								echo "<ul>\n";
									while ($matalVisu = $reponse2->fetchObject()){
										echo '<li class="analysis">';
										echo '<a target="_blank" href="/Ruche/MatlabVisualization?id='. $matalVisu->thing_speak_id.'&name='. urlencode($matalVisu->name) .'">'.$matalVisu->name. '</a>';
										echo '</li>';
									}
								echo "</ul>\n";
								echo "</li>\n";
							}	
						}
						
						try{
							if (!isset($_SESSION['id']))
								$sql = 'SELECT * FROM `things` where status = "public";';
							else if ($_SESSION['id'] != 0)
								$sql = "SELECT * FROM `things` where user_id = ". $_SESSION['id'];
							else   // C'est root qui est connecté
								$sql = "SELECT * FROM `things`";
							
							$reponse = $bdd->query($sql);
							while ($thing = $reponse->fetchObject()){
									echo '<li class="folder-root ' .$thing->class .'">	<a href="#">' . $thing->name . '</a>'; 
										echo '<ul>';
										listerChannels($bdd, $thing->tag);
										listerMatlabVisu($bdd, $thing->id);
										echo '</ul>';
									echo '</li>';
									
							}
							$reponse->closeCursor();
						}
						catch (Exception $e){
							echo "erreur BDD";
							die('Erreur : ' . $e->getMessage());
						}
						?>								
					</ul>
				</div>
				</div>
				<div class="col-md-8 col-sm-12 col-xs-12">
					<div class="popin" style="margin: 0px;">
					<div  id="map-canvas" style = "height: 500px; width: 100%;" ></div>
					</div>
				</div>
			</div>
		<?php require_once 'piedDePage.php'; ?>
		</div>
	</body>
</html>

