<?php
include "authentification/authcheck.php" ;
	
require_once('../definition.inc.php');
require_once('../api/Api.php');
require_once('../api/Str.php');
require_once('../api/Form.php');

use Aggregator\Support\Api;
use Aggregator\Support\Str;
use Aggregator\Support\Form;


// connexion à la base
    
	$bdd = Api::connexionBD(BASE, $_SESSION['time_zone']);
		

//------------si des données  sont soumises on les enregistre dans la table data.things ---------
if( !empty($_POST['envoyer'])){
    if ($_SESSION['tokenCSRF'] === $_POST['tokenCSRF']) {	
		if(isset($_POST['action']) && ($_POST['action'] == 'insert')){
			$sql = sprintf("INSERT INTO `data`.`things` (`user_id`, `latitude`, `longitude`, `elevation`, `name`, `tag`, `status`, `local_ip_address`, `class` ) VALUES ( %s, %s, %s, %s, %s, %s, %s, %s, %s);"
						  , $_POST['user_id']
						  , $_POST['latitude']
						  , $_POST['longitude']
						  , $_POST['elevation']
						  , $bdd->quote($_POST['name'])
						  , $bdd->quote($_POST['tag'])
						  , $bdd->quote($_POST['status'])
						  , $bdd->quote($_POST['local_ip_address'])
						  , $bdd->quote($_POST['class'])
						  ); 
			$bdd->exec($sql);
		
		}
		if(isset($_POST['action']) && ($_POST['action'] == 'update')){
			$sql = sprintf("UPDATE `things` SET `latitude` = %s, `longitude` = %s, `elevation` = %s, `name` = %s, `tag` = %s, `status` = %s, `user_id` = %s, `local_ip_address` = %s, `class` = %s  WHERE `things`.`id` = %s;"
						  , $_POST['latitude']
						  , $_POST['longitude']
						  , $_POST['elevation']
						  , $bdd->quote($_POST['name'])
						  , $bdd->quote($_POST['tag'])
						  , $bdd->quote($_POST['status'])
						  , $_POST['user_id']
						  , $bdd->quote($_POST['local_ip_address'])
						  , $bdd->quote($_POST['class'])
						  , $_POST['id']
						  ); 
			$bdd->exec($sql);
			
		}
	
	// destruction du tokenCSRF
	unset($_SESSION['tokenCSRF']);
		
	header("Location: things.php");
	return;
    }    
}

// -------------- sinon lecture de la table data.things  -----------------------------
else
{
   if (isset($_GET['id'])){
 
   $sql = sprintf("SELECT * FROM `things` WHERE `id`=%s", $bdd->quote($_GET['id']));
   $stmt = $bdd->query($sql);
	   if ($thing =  $stmt->fetchObject()){
		   $_POST['action'] = "update";
		   $_POST['id'] = $thing->id;
		   $_POST['user_id'] = $thing->user_id;
		   $_POST['tag'] = $thing->tag;
		   $_POST['name'] = $thing->name;
		   $_POST['status'] = $thing->status;
		   $_POST['elevation']  = $thing->elevation;
		   $_POST['latitude']  = $thing->latitude;
		   $_POST['longitude']  = $thing->longitude;
		   $_POST['local_ip_address']  = $thing->local_ip_address;
		   $_POST['class'] = $thing->class;
		   
	   } 
   }else {
  	   $_POST['action'] = "insert";
	   $_POST['id'] = 0;
	   $_POST['user_id'] = $_SESSION['id'];
	   $_POST['tag'] = "inconnu";
	   $_POST['name'] = "inconnu";
	   $_POST['status'] = "private";
	   $_POST['elevation']  = "44";
	   $_POST['latitude']  = "48.847849";
	   $_POST['longitude']  = "2.335168";
	   $_POST['local_ip_address']  = "";
	   $_POST['class'] = "";
	   
   }
 
    // Création du selectUser 
	$sql = "SELECT id,login FROM users ORDER BY id;";
	$stmt = $bdd->query($sql);
	
	$selectUser = array();
	while ($user = $stmt->fetchObject()){
		$selectUser[$user->id] = $user->login;
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

    <title>Thing - Aggregator</title>
    <!-- Bootstrap CSS version 4.1.1 -->
	<link rel="stylesheet" href="/Ruche/css/bootstrap.min.css" >
    <link rel="stylesheet" href="/Ruche/css/ruche.css" />
    
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="/Ruche/scripts/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKUqx5vjYkrX15OOMAxFbOkGjDfAPL1J8"></script>
	<script src="/Ruche/scripts/gmaps.js"></script>
    

		
	<script>
			
	$(function () {
    
	function position(e){
            console.log(e.latLng.lat().toFixed(6));
		    console.log(e.latLng.lng().toFixed(6));
		    map.removeMarkers();
		    map.addMarker({
                lat: e.latLng.lat(),
                lng: e.latLng.lng(),
				draggable: true,
				//icon: ruche,
                title: 'Nouvelle position'
			});
			$('input[name=latitude]').val(e.latLng.lat().toFixed(6));
			$('input[name=latitude]').css("backgroundColor", "#00ff00");
			$('input[name=longitude]').val(e.latLng.lng().toFixed(6));
			$('input[name=longitude]').css("backgroundColor", "#00ff00");
			// Elevation de la position 
			map.getElevations({
				locations : [[e.latLng.lat(),e.latLng.lng()]],
				callback : function (result, status){
				if (status == google.maps.ElevationStatus.OK) {
					console.log(result["0"].elevation.toFixed(0));
					$('input[name=elevation]').val(result["0"].elevation.toFixed(1));
					$('input[name=elevation]').css("backgroundColor", "#00ff00");
				}
			}
			});
        }
	
	
	
	
    /*****************  creation et affichage de la map **************/
	
	var	map = new GMaps({
		div: '#map-canvas',
		lat: <?php echo  $_POST['latitude']; ?> , 
		lng: <?php echo  $_POST['longitude']; ?> ,
		zoom : 13 ,
		mapType : 'terrain',
	});
	
    var ruche = new google.maps.MarkerImage('images/map_ruche.png');
	
	/************  placement d'une puce au milieu de la map ********/
	map.addMarker({
        lat: <?php echo  $_POST['latitude']; ?>, 
        lng: <?php echo  $_POST['longitude']; ?>,
        title: <?php echo '"Tag ' . $_POST['tag'] . '"'; ?>,
		draggable: true,
		dragend : position,
        infoWindow: {
          content: '<p> <?php echo "<b>" . $_POST['name'] . "</b><br />Coordonnées GPS : </br> Lat : " . $_POST['latitude'] . "<br /> Lng : " . $_POST['longitude']; ?></p>' 
		  
        }
		
    });
	

    /******  gestion du formulaire positionner ********/
	
	$('#formulaire').submit(function(e){
        e.preventDefault();
		mon_adresse = $('#mon_adresse').val().trim(); 
			
        GMaps.geocode({
          address: mon_adresse,
          callback: function(results, status){
            if(status=='OK'){
              map.removeMarkers();
			  console.log(results["0"].formatted_address);
			  var latlng = results[0].geometry.location;
              map.setCenter(latlng.lat(), latlng.lng());
              var marker = map.addMarker({
                lat: latlng.lat(),
                lng: latlng.lng(),
				title: mon_adresse,
				draggable: true,
				dragend : position,
				infoWindow: {
					content: '<p>' + results["0"].formatted_address + '<br />Coordonnées GPS : ' + latlng.lat().toFixed(6) + ' , ' + latlng.lng().toFixed(6) + '</p>'
				}
				
              });
				$('input[name=latitude]').val(latlng.lat().toFixed(6));
				$('input[name=latitude]').css("backgroundColor", "#00ff00");
				$('input[name=longitude]').val(latlng.lng().toFixed(6));
				$('input[name=longitude]').css("backgroundColor", "#00ff00");
				$('#mon_adresse').val(results["0"].formatted_address);
				
				// Elevation de la position 
				map.getElevations({
					locations : [[latlng.lat(),latlng.lng()]],
					callback : function (result, status){
					if (status == google.maps.ElevationStatus.OK) {
						console.log(result["0"].elevation.toFixed(0));
						$('input[name=elevation]').val(result["0"].elevation.toFixed(1));
						$('input[name=elevation]').css("backgroundColor", "#00ff00");
					}
					}
				});
			  
            }
			else{
				alert("Oups cette adresse est inconnue !!!");
			}
          }
        });
      });
	
    /***** Menu *******************/

    map.setContextMenu({
        control: 'map',
        options: [{
            title: 'Changer la position',
            name: 'add_marker',
            action: function(e) {
                this.removeMarkers();
				this.addMarker({
                lat: e.latLng.lat(),
                lng: e.latLng.lng(),
                title: 'Nouvelle position'
				});
				$('input[name=latitude]').val(e.latLng.lat().toFixed(6));
				$('input[name=latitude]').css("backgroundColor", "#00ff00");
				$('input[name=longitude]').val(e.latLng.lng().toFixed(6));
				$('input[name=longitude]').css("backgroundColor", "#00ff00");
				
				
			}
		}, {
			title: 'Centrer la carte ici',
			name: 'center_here',
			action: function(e) {
				this.setCenter(e.latLng.lat(), e.latLng.lng());
			}
		}]
	})	
  
});
		
		</script>
				
</head>
<body>

<?php require_once '../menu.php'; ?>

<div class="container-fluid" style="padding-top: 65px;">
		
		<div class="row">
			<div class="col-md-5 col-sm-12 col-12">
				<div class="popin">
					<form class="form-horizontal" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" name="configuration" >
						
							<?php
								echo Form::hidden('action', $_POST['action']);
								echo Form::hidden('id', $_POST['id']);
								echo Form::hidden("tokenCSRF", $_SESSION["tokenCSRF"] );
								
								if($_SESSION['droits'] > 1) //  un selecteur pour les administrateur
									echo Form::select("user_id", $selectUser, "User ", $_POST["user_id"]);
								else
									echo Form::hidden("user_id", $_POST["user_id"]);
								
								$options = array( 'class' => 'form-control');
								echo Form::input( 'text', 'tag', $_POST['tag'], $options , 'Tag');
								echo Form::input( 'text', 'name', $_POST['name'], $options , 'Name');
								
								$status = array('private' => "private", 'public' =>"public" );
								echo Form::select("status", $status, "Status ", $_POST["status"]);
								
								echo Form::input( 'int', 'latitude',  $_POST['latitude'],  $options , 'latitude');
								echo Form::input( 'int', 'longitude', $_POST['longitude'], $options , 'longitude');
								echo Form::input( 'int', 'elevation', $_POST['elevation'], $options , 'elevation');
								echo Form::input( 'text', 'local_ip_address', $_POST['local_ip_address'], $options , 'local IP');
								
								$classes = array('ruche' => "beehive", 'objet' => 'thing', 'weather' => 'weather station');
								echo Form::select("class", $classes, "Class ", $_POST["class"]);
							?>
							
							<div class="form-group">
								</br>
								<button type="submit" class="btn btn-primary" value="Valider" name="envoyer" > Apply</button>
								<a  class="btn btn-info" role="button" href="things">Cancel</a>
							</div>	
					</form>
				</div>
			</div>
			<!-- Localisation géographique -->
			<div class="col-md-7 col-sm-12 col-xs-12">	
				<div class="popin">
					<form method="post" id="formulaire" style="margin-bottom: 6px">
						<div class="form-group">
						<input type="text" id ="mon_adresse"  value="" placeholder="Adresse" class="form-control" required/>
						</div>
						<input type="submit" class="btn" value="Positionner" />
					</form>
					<div id="map-canvas" style = "height: 500px; width: 100%;" ></div>
				</div>
			</div>	
				
			
		
		</div>
		<div class="row">
			
		</div>
		<?php require_once '../piedDePage.php'; ?>
</div>
	
</body>

	
		