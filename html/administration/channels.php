<?php
include "authentification/authcheck.php" ;

require_once('../ini/ini.php');
require_once('../definition.inc.php');

//------------si des données  sont reçues on les enregistrent dans le fichier configuration.ini ---------
if( !empty($_POST['envoyer'])){

    //  lecture du fichier de configuration
    $array  = parse_ini_file(CONFIGURATION, true);

	//  Modification des valeurs pour la section [thingSpeak]
	$array['thingSpeak'] = array (
								  'userkey' => $_POST['thingSpeak_userkey'],
								  'tag' => $_POST['thingSpeak_tag']
	                             );

    //  Ecriture du fichier de configuration modifié
    $ini = new ini (CONFIGURATION);
    $ini->ajouter_array($array);
    $ini->ecrire(true);

}

// -------------- sinon lecture du fichier de configuration  -----------------------------


   $ini  = parse_ini_file(CONFIGURATION, true);

   $_POST['thingSpeak_userkey'] = $ini['thingSpeak']['userkey'];
   $_POST['thingSpeak_tag'] = $ini['thingSpeak']['tag'];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>My channels</title>
    <!-- Bootstrap CSS version 4.1.1 -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/ruche.css" />

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="../scripts/bootstrap.min.js"></script> 


    <script>
	    function affiche(event){
			
			var url = $(this).attr("href");
			console.log(url);
			
			$.getJSON( url , function( data, status, error ) {
				console.log(data.channel);
				var contenu = "<ul>";
				$.each( data.channel, function( key, val ) {
					if (key.indexOf("field") != -1){
						contenu += '<li>' + key +  ' : <a href="/thingSpeakView.php?channel=' + data.channel.id + '&fieldP=' + key.substring(5,6) + '">'  + val + "</a></li>";
					}	
				});
				contenu += "</ul>";
				
				$("#modal-contenu").html( contenu );
				var title = data.channel.id + " : " + data.channel.name; 
				console.log(title);
				$("#ModalLongTitle").html( title );
				$("#ModalCenter").modal('show');
			});
			
			event.preventDefault();   // bloque l'action par défaut sur le lien cliqué
		}
	
	    $(document).ready(function(){

			$(".channels").click(affiche);
		});
    </script>

</head>
<body>

<?php require_once '../menu.php'; ?>

<div class="container" style="padding-top: 65px;">

				<div class="popin">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-12">
								
								
									<p class="font-weight-bold">User API Key : <?php echo  $_SESSION['User_API_Key']; ?> </p>
								
								
						</div>
						
					</div>					
				</div>
				<div class="popin">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="table-responsive">
						<table class="table table-striped">
							<thead>
							  <tr>
								<th>Channel</th>
								<th>Name</th>
								<th>Tags</th>
								<th>Created at</th>
								<th>Last entry id</th>
								<th>Write API Key</th>
							  </tr>
							</thead>
							<tbody>
								<?php
								$url = "https://api.thingspeak.com/channels.json?api_key=" . $_SESSION['User_API_Key'];
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
									echo "<tr><td>cURL Error #:" . $err ."</td></tr>";
								} else {
									
									$channels = json_decode($response);
									$count = count($channels);
									if(!isset($channels->{'status'})) {
									
										for ($i = 0; $i < $count; $i++) {
											echo "<tr>\n";
											echo '<td><a class="nav-link channels" href="https://api.thingspeak.com/channels/' . $channels[$i]->{'id'} . '/feed.json?results=0" target="_blank" >' . $channels[$i]->{'id'} . "</a></td>\n";
											echo "<td>" . $channels[$i]->{'name'} . "</td>\n";
											echo "<td>" . $channels[$i]->{'tags'}[0]->{'name'} . "</td>\n";
											echo "<td>" . $channels[$i]->{'created_at'} . "</td>\n";
											echo "<td>" . $channels[$i]->{'last_entry_id'} . "</td>\n";
											echo "<td>" . $channels[$i]->{'api_keys'}[0]->{'api_key'} . "</td>\n";
											echo "</tr>\n";
										}
									}
									else{
										echo '<tr><td colspan="6">Erreur status : ' . $channels->{'status'} ."<tr><td>\n";
									}
								}
								?>
							</tbody>
						</table>	
						</div>
					</div>	
				</div>
				</div>
		<?php require_once '../piedDePage.php'; ?>
</div>

<!-- Modal -->
		<div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenter" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="ModalLongTitle">Message !</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body" id="modal-contenu">
				...
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>
		
</body>
