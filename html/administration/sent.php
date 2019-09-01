<!DOCTYPE html>

<?php
include "authentification/authcheck.php" ;

require_once('../ini/ini.php');
require_once('../definition.inc.php');

function reduire( $chaine ){
	
	if ( strlen($chaine) > 60){
		$chaine = substr( $chaine, 0, 60) . '...';	
	}
return $chaine;	
}


// Si le formulaire à été soumis
if(isset($_POST['btn_supprimer'])){
	
	// Si un élément a été sélectionné
	if (count($_POST['table_array']) > 0){
		$Clef=$_POST['table_array'];
		$supp = "(";
		foreach($Clef as $selectValue)
		{
			if($supp!="("){$supp.=",";}
			$supp.=$selectValue;
		}
		$supp .= ")";
		var_dump($supp);
		// connexion à la base
		$bdd = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BASESMS, UTILISATEUR,PASSE);
		$sql = "DELETE FROM `sentitems` WHERE `ID` IN " . $supp;
		$bdd->exec($sql);
	}
	unset($_POST['table_array']);
	unset($_GET['page']);
	unset($_GET['ipp']);

}

?>

<html>
<head>
    <title>Sent</title>
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
				
				nbCaseCochees = $('input:checked').length - $('#all:checked').length;
				if(nbCaseCochees == 1) 
					message = "1 message sera supprimé.";
				else
					message = nbCaseCochees + " messages seront supprimés.";
				
				if (nbCaseCochees > 0){
					
					$.confirm({
						theme: 'bootstrap',
						title: 'Confirmation !',
						content: message,
						buttons: {
							cancel: {
								text: 'Annuler', // text for button
								action: function () {}
							},
							confirm: {
								text: 'Confirmer', // text for button
								btnClass: 'btn-blue', // class for the button
								action: function () {
								$( "#supprimer" ).submit(); // soumission du formulaire
								}
							}
					 		
						}
					});
				
				}
				else{
					$.alert({
					theme: 'bootstrap',
					title: 'Alert!',
					content: "Vous n'avez sélectionné aucun message !"
					});
			
				}
			});
			
			$( "#btn_lire" ).click(function() {
				console.log("Bouton lire cliqué");
				
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
				}else{
				
					var url = "../api/lireSMS.php?key=azerty&id=" + checkbox_val[0] + "&folder=sent"
					$.get(url, function(data, status){
						if (status == "success")
							console.log(data);
							$.dialog({
								title: data.number,
								content: data.text + "<br/><br/>" + data.date,
							});
					});
					
				}
			});
			
			// Action sur le bouton ecrire
			$( "#btn_ecrire" ).click(function() {
				console.log("Bouton ecrire cliqué");
				$.confirm({
					title: 'Ecrire un SMS',
					content: '' +
					'<form action="" class="formName">' +
					'<div class="form-group">' +
					'<label class="font-weight-bold">Number : </label><br />' +
					'<input type="text" id="number" name="number" size="12" placeholder="Number"  /><br />' +
					'</div>' +
					'<div class="form-group">' +
					'<label class="font-weight-bold">Message : </label>' +
					'<textarea  rows="5" id="message" name="message" maxlength="160" class="form-control" ></textarea>' +
					'</div>' +
					'<input type="hidden" id="key" name="key"  value="' + <?php echo "'".$_SESSION['User_API_Key']. "'"; ?> + '"/>' +
					'</form>',
					buttons: {
						formSubmit: {
							text: 'Envoyer',
							btnClass: 'btn-blue',
							action: function () {
								var message = this.$content.find('#message').val();
								var number = this.$content.find('#number').val();
								var form_data = this.$content.find('.formName').serialize();
								
								if(!message || isNaN(number)){
									$.alert('provide a valid number and message');
									return false;
								}
								console.log(' form_data : ' + form_data);
								
								$.getJSON( '../api/sendSMS.php' , form_data, function( response,status, error ) {
									console.log("status : " + status);
									console.log("reponse : " +response);
									console.log("error : " +error);
									if (response.status == "202 Accepted"){
										console.log("message Accepted");
										$.dialog({
											title: "Info",
											content: "Message Accepted"
										});
									}	
									else{
										$.dialog({
											title: "Erreur",
											content: response.message + " <em>" + response.detail + "</em>"
										});
									}
								});	
							}
						},
						cancel: function () {
							//close
						},
					},
					onContentReady: function () {
						// bind to events
						var jc = this;
						this.$content.find('form').on('submit', function (e) {
							// if the user submits the form by pressing enter in the field.
							e.preventDefault();
							jc.$$formSubmit.trigger('click'); // reference the button and click it
						});
					}
				});
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
							$pages->default_ipp = 12;  // 12 lignes par page
							
							// connexion à la base
							$bdd = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BASESMS, UTILISATEUR,PASSE);
							// Comptage des lignes dans la table 
							$sql = "SELECT COUNT(*) as nb FROM `sentitems`"; 
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
					<table class="table table-striped table-sm">
						<thead>
						  <tr>
							<th><input type='checkbox' name='all' value='all' id='all' ></th>
							<th>Date Time</th>
							<th>To</th>
							<th>Body</th>
							<th>Creator</th>
							
						  </tr>
						</thead>
						<tbody>
							
							<?php
								$sql = "SELECT `SendingDateTime`,`DestinationNumber`,`TextDecoded`,`CreatorId`,`ID` FROM `sentitems` order by `SendingDateTime` desc ". $pages->limit;
								
								$stmt = $bdd->query($sql);
								
								while ($message =  $stmt->fetchObject()){
									echo "<tr><td><input type='checkbox' class='selection' name='table_array[$message->ID]' value='$message->ID' ></td>";
									echo "<td>" . $message->SendingDateTime . "</td>";
									echo "<td>" . $message->DestinationNumber . "</td>";
									echo "<td>" . reduire($message->TextDecoded) . "</td>";
									echo "<td>" . $message->CreatorId . "</td></tr>";
									
								}
							?>
						</tbody>
					</table>
					<input id="btn_supp" name="btn_supprimer" value="Supprimer" class="btn btn-danger" readonly size="9">
					<button id="btn_lire" type="button" class="btn btn-info">Lire</button>
					<button id="btn_ecrire" type="button" class="btn btn-info">Ecrire</button>
					<a  class="btn btn-info" role="button" href="inbox">SMS Reçus</a>
					
					</form>	
				</div>
				
			
			
			
	
		</div>
		<?php require_once '../piedDePage.php'; ?>
	</div>

	
	
</body>
</html>
	