<?php
include "authentification/authcheck.php" ;

require_once('../definition.inc.php');
require_once('../api/Api.php');

$bdd = Api::connexionBD(BASESMS,$_SESSION['time_zone']);
$title = "SMS received";

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

		$sql = "DELETE FROM `inbox` WHERE `ID` IN " . $supp;
		$bdd->exec($sql);
	}
}

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title ?></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <!-- Bootstrap CSS version 4.1.1 -->
    <link rel="stylesheet" href="/Ruche/css/bootstrap.min.css">
	<link rel="stylesheet" href="/Ruche/css/ruche.css" />
	<link rel="stylesheet" href="/Ruche/css/jquery-confirm.min.css" />
    <link rel="stylesheet" href="/Ruche/css/datatables.min.css"/>
	<link rel="stylesheet" href="../css/dataTables.css" />
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="/Ruche/scripts/bootstrap.min.js"></script> 
	<script src="/Ruche/scripts/jquery-confirm.min.js"></script>
	<script src="//cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
	
	<script >
		$(document).ready(function(){
			
		    let options = {
                dom: 'ptlf',
                pagingType: "simple_numbers",
                lengthMenu: [5, 10, 15, 20, 40],
                pageLength: 10,
                order: [[1, 'desc']],
				columns: [{orderable:false}, {type:"text"}, {type:"text"} , {type:"text"}]
                
            };
			$('#tableau').DataTable(options);
			
			
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
				console.log("Bouton Supprimer cliquer");
				
				nbCaseCochees = $('input:checked').length - $('#all:checked').length;
				
				if(nbCaseCochees == 1) 
					message = "1 message sera supprimé.";
				else
					message = nbCaseCochees + " messages seront supprimés.";
				
				if (nbCaseCochees > 0){
					
					$.confirm({
						theme: 'bootstrap',
						title: 'Confirmation!',
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
			// Action sur le bouton lire
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
				
					var url = "../api/lireSMS.php?key=azerty&id=" + checkbox_val[0] + "&folder=inbox"
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
					title: 'Write an SMS',
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
							text: 'Send',
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
											title: "Error",
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
	<div class="container" style="padding-top: 65px; max-width: 90%;">
		<div class="row popin card">
			<div  class="card-header" style=""><h4><?php echo $title ?></h4></div>			
			<div class="col-md-12 col-sm-12 col-xs-12">			
				<div class="table-responsive">
					<form method="post" id="supprimer">
					<table id="tableau" class="display table table-striped">
						<thead>
						  <tr>
							<th><input type='checkbox' name='all' value='all' id='all' ></th>
							<th>Date Time</th>
							<th>To</th>
							<th>Body</th>														
						  </tr>
						</thead>
						<tbody>
							
							<?php
								
								$sql = "SELECT `ReceivingDateTime`,`SenderNumber`,`TextDecoded`,`ID` FROM `inbox` order by `ReceivingDateTime` desc ";
								
								$stmt = $bdd->query($sql);
								
								while ($message =  $stmt->fetchObject()){
									echo "<tr>\n    <td><input type='checkbox' class='selection' name='table_array[$message->ID]' value='$message->ID' ></td>\n";
									echo "    <td>" . $message->ReceivingDateTime . "</td>\n";
									echo "    <td>" . $message->SenderNumber . "</td>\n";
									echo "    <td>" . Api::reduire($message->TextDecoded) . "</td>\n";
									echo "</tr>\n";
									
								}
							?>
						</tbody>
					</table>
					<input id="btn_supp" name="btn_supprimer" value="Delete" class="btn btn-danger" readonly size="9">
					<button id="btn_lire" type="button" class="btn btn-info">Read</button>
					<button id="btn_ecrire" type="button" class="btn btn-info">Write</button>
					<a  class="btn btn-info" role="button" href="sent">SMS Sent</a>
					
					
					</form>	
				</div>
			</div>
	
		</div>
		<?php require_once '../piedDePage.php'; ?>
	</div>

	
	
</body>
</html>
	