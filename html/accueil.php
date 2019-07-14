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
						$bdd = new PDO('mysql:host=127.0.0.1;dbname=data;charset=utf8', 'ruche', 'touchard72');
						$reponse = $bdd->query('SELECT * FROM `things`');
						while ($thing = $reponse->fetch()){
								echo 'map.addMarker({'; 
									echo 'lat:' . $thing['latitude'] . ",\n";
									echo 'lng:' . $thing['longitude'] . ",\n";
									echo 'title: "' . $thing['name'] . "\",\n";
									echo "infoWindow: {\n";
									echo 'content: "<p> <b>' . $thing['name'] . '</b><br />Coordonnées GPS : </br> Lat : ' . $thing['latitude'];
                                    echo '<br /> Lng : ' . $thing['longitude'] . '</p>"' ;
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
		<div class="container" style="padding-top: 65px;">
			<div class="row">
				<div class="col-md-4 col-sm-12 col-xs-12">
				
				<ul class="file-tree popin">
				<?php
					function listerCanal($userkey, $tag){
									$url = "https://api.thingspeak.com/channels.json?api_key=" . $userkey . "&tag=" . $tag;
									$curl = curl_init();

									curl_setopt_array($curl, array(
										  CURLOPT_URL => $url,
										  CURLOPT_RETURNTRANSFER => true,
										  CURLOPT_ENCODING => "",
										  CURLOPT_MAXREDIRS => 10,
										  CURLOPT_TIMEOUT => 30,
										  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
										  CURLOPT_CUSTOMREQUEST => "GET",
										  CURLOPT_HTTPHEADER => array(
											"cache-control: no-cache"
										  ),
									));

									$response = curl_exec($curl);
									$err = curl_error($curl);

									curl_close($curl);

									if ($err) {
										echo "cURL Error #:" . $err;
									} else {
										$channels = json_decode($response);
										$count = count($channels);
										
											echo '<li id="11" class="folder-data"><a href="#">Data visualisation</a>';
											echo '<ul id="channel">';
											for ($i = 0; $i < $count; $i++) {
												echo '<li>';
												echo '<a class="channels" href="https://api.thingspeak.com/channels/' . $channels[$i]->{'id'} . '/feed.json?results=0" target="_blank" >' . $channels[$i]->{'name'} . "</a>\n";
												echo '</li>';
											}
											echo '</ul>';
											echo '</li>';
										
									}
					
					}
					
					function listerMatlabVisu($bdd, $id){
						$sql = 'SELECT * FROM `Matlab_Visu` WHERE `things_id`='. $id;
						$reponse2 = $bdd->query($sql);
						echo '<li id="11" class="folder-matlab"><a href="#">Data Analysis</a>';
						echo "<ul>\n";
							while ($matalVisu = $reponse2->fetch()){
								echo '<li class="analysis">';
								echo '<a  href="/Ruche/MatlabVisualization?id='. $matalVisu['thing_speak_id'].'">'.$matalVisu['name']. '</a>';
								echo '</li>';
							}
						echo "</ul>\n";
						echo "</li>\n";
					}
					
					try{
						$bdd = new PDO('mysql:host=127.0.0.1;dbname=data;charset=utf8', 'ruche', 'touchard72');
						$reponse = $bdd->query('SELECT * FROM `users_things`');
						while ($thing = $reponse->fetch()){
								echo '<li class="folder-root">	<a href="#">' . $thing['name'] . '</a>'; 
									echo '<ul>';
									listerCanal($thing['USER_API_Key'], $thing['tag']);
									listerMatlabVisu($bdd, $thing['id']);
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
				<div class="col-md-8 col-sm-12 col-xs-12">
					<div class="popin">
					<div  id="map-canvas" style = "height: 500px; width: 100%;" ></div>
					</div>
				</div>
			</div>
		<?php require_once 'piedDePage.php'; ?>
		</div>
	</body>
</html>

