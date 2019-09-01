<?php
include "authentification/authcheck.php" ;
	

require_once('../ini/ini.php');
require_once('../definition.inc.php');
$bdd = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BASE, UTILISATEUR,PASSE);

function faireSelectUsers($bdd , $user_id){
	
	$sql = "SELECT id,login FROM `users`";
	$stmt = $bdd->query($sql);
	echo '<div class="form-group"><label for="tag"  class="font-weight-bold">User : </label>';
	echo '<select class="form-control" name="user_id">';
	while ($thing =  $stmt->fetchObject()){
		if ($thing->id == $user_id)
			echo "<option selected value='" . $thing->id . "'>" . $thing->login . "</option>" ;
        else
			echo "<option value='" . $thing->id . "'>" . $thing->login . "</option>" ;	
	}
    echo "</select>";
    echo "</div>";	
	
}	

//------------si des données  sont soumises on les enregistre dans la table data.things ---------
if( !empty($_POST['envoyer'])){
	
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
		header("Location: things.php");
		return;
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

}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>thing</title>
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

<div class="container" style="padding-top: 65px;">
		
		<div class="row">
			<div class="col-md-3 col-sm-12 col-xs-12">
				<div class="popin">
					<form class="form-horizontal" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" name="configuration" >
						
							<input type='hidden' name='action' value="<?php  echo $_POST["action"]; ?>" />
							<input type='hidden' name='id' value="<?php  echo $_POST["id"]; ?>" />
							<?php
								if($_SESSION['id'] == 0)
									faireSelectUsers($bdd, $_POST["user_id"] );
								else
									echo "<input type='hidden' name='user_id' value='".  $_POST["user_id"]. "' />"; 
							?>
							<div class="form-group">
								<label for="tag"  class="font-weight-bold">Tag : </label>
								<input type="text"  name="tag" class="form-control" value="<?php echo  $_POST['tag']; ?>" />
							</div>
							
							<div class="form-group">
								<label for="name"  class="font-weight-bold">Name : </label>
								<input type="text"  name="name" class="form-control" value="<?php echo  $_POST['name']; ?>" />
							</div>
							
							<div class="form-group">
								<label for="status"  class="font-weight-bold">Status : </label>
								<select class="form-control" name="status">
									<option <?php if ($_POST['status'] == "private") echo "selected" ?> value="private">private</option>
									<option <?php if ($_POST['status'] == "public") echo "selected" ?> value="public">public</option>
								</select>
							</div>

							<div class="form-group">
								<label for="latitude"  class="font-weight-bold">Latitude : </label>
								<input id="latitude" type="int"  name="latitude" class="form-control" value="<?php echo  $_POST['latitude']; ?>" />
							</div>
							
							<div class="form-group">
								<label for="longitude"  class="font-weight-bold">Longitude : </label>
								<input id="longitude" type="int"  name="longitude" class="form-control" value="<?php echo  $_POST['longitude']; ?>" />
							</div>
							
							<div class="form-group">
								<label for="altitude"  class="font-weight-bold">Altitude : </label>
								<input id="altitude" type="int"  name="elevation" class="form-control" value="<?php echo  $_POST['elevation']; ?>" />
							</div>
							
							<div class="form-group">
								<label for="local_ip_address"  class="font-weight-bold">Local IP : </label>
								<input id="local_ip_address" type="text"  name="local_ip_address" class="form-control" value="<?php echo  $_POST['local_ip_address']; ?>" />
							</div>
							
							<div class="form-group">
								<label for="local_ip_address"  class="font-weight-bold">Class : </label>
								<input id="local_ip_address" type="text"  name="class" class="form-control" value="<?php echo  $_POST['class']; ?>" />
							</div>
							
							<div class="form-group">
								</br>
								<button type="submit" class="btn btn-primary" value="Valider" name="envoyer" > Appliquer</button>
								<a  class="btn btn-info" role="button" href="things">Annuler</a>
							</div>	
					</form>
				</div>
			</div>
			<!-- Localisation géographique -->
			<div class="col-md-9 col-sm-12 col-xs-12">	
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

	
		