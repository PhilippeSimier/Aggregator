<!DOCTYPE html>

<?php
include "authentification/authcheck.php" ;

require_once('../definition.inc.php');
require_once('../api/biblio.php');

// Fonction pour éliser une chaîne de caractères
function reduire( $chaine ){
	if ( strlen($chaine) > 60){
		$chaine = substr( $chaine, 0, 60) . '...';	
	}
return $chaine;	
}

// connexion à la base
$bdd = connexionBD(BASE, $_SESSION['time_zone']);

// Si le formulaire a été soumis
if(isset($_POST['btn_supprimer'])){
	// Si un élément a été sélectionné création de la liste des id à supprimer
	if (count($_POST['table_array']) > 0){
		$Clef=$_POST['table_array'];
		$supp = "(";
		foreach($Clef as $selectValue)
		{
			if($supp!="("){$supp.=",";}
			$supp.=$selectValue;
		}
		$supp .= ")";	

		$sql = "DELETE FROM `thinghttps` WHERE `id` IN " . $supp;
		$bdd->exec($sql);
	}
	unset($_POST['table_array']);
	unset($_GET['page']);
	unset($_GET['ipp']);
}

?>

<html>
<head>
    <title>Apps - thingHTTP - Aggregator</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <!-- Bootstrap CSS version 4.1.1 -->
    <link rel="stylesheet" href="/Ruche/css/bootstrap.min.css">
	<link rel="stylesheet" href="/Ruche/css/ruche.css" />
	<link rel="stylesheet" href="/Ruche/css/jquery-confirm.min.css" />
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="/Ruche/scripts/bootstrap.min.js"></script> 
	<script src="/Ruche/scripts/jquery-confirm.min.js"></script>
	<script >
		$(document).ready(function(){
			
			
			
			function cocherTout(etat)
			{
			  var cases = document.getElementsByTagName('input');   // on recupere tous les INPUT
			   for(var i=1; i<cases.length; i++)     // on les parcourt
				 if(cases[i].type == 'checkbox')     // si on a une checkbox...
					 {cases[i].checked = etat;}
			}
			
			
			$("#all").click(function(){	
				cocherTout(this.checked);
			});
			
			
			$( "#btn_supp" ).click(function() {
				console.log("Bouton Supprimer cliqué");
				
				nbCaseCochees = $('input:checked').length - $('#all:checked').length;
				console.log(nbCaseCochees);
				if (nbCaseCochees > 0){
					
					$.confirm({
						theme: 'bootstrap',
						title: 'Confirm!',
						content: 'Confirmez-vous la suppression de ' + nbCaseCochees + ' objet(s) ?',
						buttons: {
							confirm: {
								text: 'Confirmation', // text for button
								btnClass: 'btn-blue', // class for the button
								action: function () {
								$( "#supprimer" ).submit(); // soumission du formulaire
								}
							},
					 		cancel: {
								text: 'Annuler', // text for button
								action: function () {}
							}
						}
					});
				
				}
				else{
					$.alert({
					theme: 'bootstrap',
					title: 'Alert!',
					content: "Vous n'avez sélectionné aucun objet !"
					});
			
				}
			});
			
			$( "#btn_mod" ).click(function() {
				console.log("Bouton modifier cliqué");
				
			    // Ce tableau va stocker les valeurs des checkbox cochées
				var checkbox_val = [];

				// Parcours de toutes les checkbox checkées"
				$('.selection:checked').each(function(){
					checkbox_val.push($(this).val());
				});
				if(checkbox_val.length == 0){
					$.alert({
					theme: 'bootstrap',
					title: 'Alert!',
					content: "Vous n'avez sélectionné aucun objet !"
					});
				}
				if(checkbox_val.length > 1){
					$.alert({
					theme: 'bootstrap',
					title: 'Alert!',
					content: "Vous avez sélectionné plusieurs objets !"
					});
				}
				if(checkbox_val.length == 1){
					console.log("thingHTTP?id" + checkbox_val[0]);
					window.location = 'thingHTTP?id='+checkbox_val[0];
				}
			});
			
			// Bouton Add
			$( "#btn_add" ).click(function() {
				console.log("Bouton Ajouter cliqué");
				window.location = 'thingHTTP'			
			});
			// Bouton send
			$( "#btn_send" ).click(function() {
				console.log("Bouton Send cliqué");
				
			    // Ce tableau va stocker les valeurs des checkbox cochées
				var checkbox_val = [];

				// Parcours de toutes les checkbox checkées"
				$('.selection:checked').each(function(){
					checkbox_val.push($(this).val());
				});
				if(checkbox_val.length == 0){
					$.alert({
					theme: 'bootstrap',
					title: 'Alert!',
					content: "Vous n'avez sélectionné aucun thinghttp !"
					});
				}
				if(checkbox_val.length > 1){
					$.alert({
					theme: 'bootstrap',
					title: 'Alert!',
					content: "Vous avez sélectionné plusieurs thinghttps !"
					});
				}
				if(checkbox_val.length == 1){
					console.log("send_request?id" + checkbox_val[0]);
					window.location = 'send_request?id='+checkbox_val[0];
				}
			});			
			
			
		});
		
	</script>
    
 </head>

 <body>
	<?php require_once '../menu.php'; 	?>
	<div class="container" style="padding-top: 65px;">
		<div class="row popin">
			
			<div class="col-md-12 col-sm-12 col-xs-12">
			
			<?php
							include('paginator.class.php');
						    $pages = new Paginator;
							$pages->default_ipp = 10;  // 10 lignes par page

							// Comptage des lignes dans la table 
							$sql = "SELECT COUNT(*) as nb FROM `thinghttps`";
							if ($_SESSION['id'] == 0)
										$sql .= " where 1";
						    else   
								        $sql .= " where `user_id` = " . $_SESSION['id'];
							$stmt = $bdd->query($sql);
							$res =  $stmt->fetchObject();
							$pages->items_total = $res->nb;
							$pages->mid_range = 9;
							$pages->paginate();  

							echo '<div class="row marginTop">';
                            echo '<div class="col-sm-12 paddingLeft pagerfwt">';
							if($pages->items_total > 0) { 
								echo $pages->display_pages();
								echo $pages->display_total();
							}
							echo '</div>';
			?>
			
				
				<div class="table-responsive">
					<form method="post" id="supprimer">
					<table class="table table-striped">
						<thead>
						  <tr>
							<th><input type='checkbox' name='all' value='all' id='all' ></th>
							<th>id</th>
							<th>Name</th>
							<th>Created</th>
							<th>Method</th>
						  </tr>
						</thead>
						<tbody>
							
							<?php
								$sql = "SELECT * FROM `thinghttps`";
                                if ($_SESSION['id'] == 0)
										$sql .= " where 1 ";	
								else	
								        $sql .= " where `user_id` = " . $_SESSION['id'];
								$sql .= " order by `id` ". $pages->limit;
								
								$stmt = $bdd->query($sql);
								
								while ($thingHTTP =  $stmt->fetchObject()){
									echo "<tr><td><input class='selection' type='checkbox' name='table_array[$thingHTTP->id]' value='$thingHTTP->id' ></td>";
									echo "<td>" . $thingHTTP->id . "</td>";
									echo "<td>" . $thingHTTP->name . "</td>";
									echo "<td>" . $thingHTTP->created_at . "</td>";
									echo "<td>" . $thingHTTP->method . "</td>";
									echo "</tr>";								
								}
							?>
						</tbody>
					</table>
					<input id="btn_supp" name="btn_supprimer" value="Delete" class="btn btn-danger" readonly size="9">
					<button id="btn_mod" type="button" class="btn btn-secondary">Setting</button>
					<button id="btn_add" type="button" class="btn btn-secondary">Add</button>
					<button id="btn_send" type="button" class="btn btn-secondary">Send</button>
					</form>	
				</div>
	
		</div>
		<?php require_once '../piedDePage.php'; ?>
	</div>

	
	
</body>
</html>
	