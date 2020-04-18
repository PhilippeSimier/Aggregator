<?php
include "authentification/authcheck.php" ;

require_once('../definition.inc.php');
require_once('../api/Api.php');


// connexion à la base
    
	$bdd = Api::connexionBD(BASE, $_SESSION['time_zone']);

// Lecture du paramètre facultatif allow
// Si allow n'est pas présent alors affichage des utilisateurs autorisés 
	$allow = Api::facultatif("allow", "1");
// construction du titre de la page	
	if ($allow && $_SESSION['droits'] > 1) 
		$title =  "Users"; 
	else 
		$title = "Suspended Users";
    if 	($_SESSION['droits'] == 1) 
		$title = "My Account";
	
// Si le formulaire a été soumis
if(isset($_POST['action'])){
	if ($_POST['action'] == "Suspending") $status = 0;
	if ($_POST['action'] == "Cancel") $status = 1;

	// Si un élément a été sélectionné création de la liste des id à mettre à jour
	if (count($_POST['table_array']) > 0){
		$Clef=$_POST['table_array'];
		$selection= "(";
		foreach($Clef as $selectValue)
		{
			if( $selection != "(" ){$selection .= ",";}
			$selection .= $selectValue;
		}
		$selection .= ")";

		$sql = "UPDATE `data`.`users` SET `allow` = " . $status . " WHERE `users`.`id` IN " . $selection;
		$bdd->exec($sql);
		
	}
	
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Users - Aggregator</title>
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
				columns: [{orderable:false}, {type:"text"}, {type:"text"} , {type:"text"} , {type:"text"}, {type:"text"}]
                
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
			
			
			$( "#action" ).click(function() {
				console.log("Bouton Disable cliqué");
				
				nbCaseCochees = $('input:checked').length - $('#all:checked').length;
				console.log(nbCaseCochees);
				if (nbCaseCochees > 0){
					
					$.confirm({
						theme: 'bootstrap',
						title: 'Confirm!',
						content: 'Confirmez-vous la désactivation de ' + nbCaseCochees + ' utilisateur(s) ?',
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
					content: "You haven't selected any user!"
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
					content: "You haven't selected any user!"
					});
				}
				if(checkbox_val.length > 1){
					$.alert({
					theme: 'bootstrap',
					title: 'Alert!',
					content: "You have selected several users!"
					});
				}
				if(checkbox_val.length == 1){
					console.log("id = " + checkbox_val[0]);
					
					$.confirm({
						theme: 'bootstrap',
						closeIcon: true, 
						columnClass: 'col-md-6 col-md-offset-3',
						title: 'Change Password',
						content: '' +
						'<form action="" class="passwd form-horizontal">' +
						'<div class="form-group">' +
						'<label class="col-sm-4 control-label">Passwd : </label>' +
						'<input type="password" id="pwd" name="pwd" size="30"  /><br />' +				
						'</div>' +
						'<div class="form-group">' +
						'<label class="col-sm-4 control-label">Confirm Passwd : </label>' +
						'<input type="password" id="conf_pwd" name="conf_pwd" size="30"  /><br />' +				
						'</div>' +
						'<input type="hidden"  name="id" value="' + checkbox_val[0] + '"  />' +
						'<input type="hidden" id="key" name="User_API_Key"  value="' + <?php echo "'".$_SESSION['User_API_Key']. "'"; ?> + '"/>' +
						'</form>',
						buttons: {
							formSubmit: {
								text: 'Appliquer',
								btnClass: 'btn-blue',
								action: function () {
									var pwd = this.$content.find('#pwd').val();
									var conf_pwd = this.$content.find('#conf_pwd').val();
									var form_data = this.$content.find('.passwd').serialize();
																	
									if (pwd != conf_pwd){
										$.alert('passwd and Confirm Passwd');
										return false;
									}
									console.log(' form_data : ' + form_data);
									
									$.getJSON( '../api/changePwd.php' , form_data, function( response,status, error ) {
										console.log("status : " + status);
										console.log("reponse : " +response);
										console.log("error : " +error);
										if (response.status == "202 Accepted"){
											console.log("message Accepted");
											$.dialog({
												title: "Info",
												content: "Change Accepted"
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
				}
			});
			
			$( "#btn_add" ).click(function() {
				console.log("Bouton Ajouter cliqué");
				
				$.confirm({
					theme: 'bootstrap',
					closeIcon: true, 
					columnClass: 'col-md-6 col-md-offset-3',
					title: 'Add user',
					content: '' +
					'<form action="" class="user form-horizontal">' +
					'<div class="form-group">' +
					'<label class="col-sm-4 control-label">Login : </label>' +
					'<input type="text" id="login" name="login" size="30" placeholder="Login"  /><br />' +
					'</div>' +
					'<div class="form-group">' +
					'<label class="col-sm-4 control-label">API Key : </label>' +
					'<input type="text" id="User_API_Key" name="User_API_Key" size="30" value="' + <?php echo "'".$key = Api::genererKey($bdd). "'"; ?> +'"  /><br />' +				
					'</div>' +
					'<div class="form-group">' +
					'<label class="col-sm-4 control-label">Passwd : </label>' +
					'<input type="password" id="pwd" name="pwd" size="30"  /><br />' +				
					'</div>' +
					'<div class="form-group">' +
					'<label class="col-sm-4 control-label">Confirm Passwd : </label>' +
					'<input type="password" id="conf_pwd" name="conf_pwd" size="30"  /><br />' +				
					'</div>' +
					'<input type="hidden" id="key" name="key"  value="' + <?php echo "'".$_SESSION['User_API_Key']. "'"; ?> + '"/>' +
					'</form>',
					buttons: {
						formSubmit: {
							text: 'Appliquer',
							btnClass: 'btn-blue',
							action: function () {
								var login = this.$content.find('#login').val();
								var User_API_Key = this.$content.find('#User_API_Key').val();
								var pwd = this.$content.find('#pwd').val();
								var conf_pwd = this.$content.find('#conf_pwd').val();
								var form_data = this.$content.find('.user').serialize();
								
								if(!login || !User_API_Key){
									$.alert('provide a valid login and API Key');
									return false;
								}
								
								if (pwd != conf_pwd){
									$.alert('passwd and Confirm Passwd');
									return false;
								}
								console.log(' form_data : ' + form_data);
								
								$.getJSON( '../api/createUser.php' , form_data, function( response,status, error ) {
									console.log("status : " + status);
									console.log("reponse : " +response);
									console.log("error : " +error);
									if (response.status == "202 Accepted"){
										console.log("message Accepted");
										$.dialog({
											title: "Info",
											content: "Message Accepted"
										});
										window.location = 'users'
										
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
			
			$( "#btn_typeZone" ).click(function() {
				console.log("Bouton Time Zone cliqué");
				
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
					content: "You haven't selected any user!"
					});
				}
				if(checkbox_val.length > 1){
					$.alert({
					theme: 'bootstrap',
					title: 'Alert!',
					content: "You have selected several users!"
					});
				}
				if(checkbox_val.length == 1){
					console.log("timeZone.php?id" + checkbox_val[0]);
					window.location = 'timeZone?id='+checkbox_val[0];
				}
			});
			
			$( "#btn_key" ).click(function() {
				console.log("Generate New API Key clicked");
				
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
					content: "You haven't selected any user!"
					});
				}
				if(checkbox_val.length > 1){
					$.alert({
					theme: 'bootstrap',
					title: 'Alert!',
					content: "You have selected several users!"
					});
				}
				if(checkbox_val.length == 1){
					console.log("id = " + checkbox_val[0]);
					$.confirm({
						theme: 'bootstrap',
						closeIcon: true, 
						columnClass: 'col-md-6 col-md-offset-3',
						title: 'Generate New API Key',
						content: '' +
						'<form action="" class="user form-horizontal">' +
						
						'<div class="form-group">' +
						'<label class="col-sm-4 control-label">API Key : </label>' +
						'<input type="text" id="key" name="key" size="30" value="' + <?php echo "'".$key = Api::genererKey($bdd). "'"; ?> +'"  /><br />' +				
						'</div>' +
						'<input type="hidden"  name="id" value="' + checkbox_val[0] + '"  />' +
						'<input type="hidden" id="User_API_Key" name="User_API_Key"  value="' + <?php echo "'".$_SESSION['User_API_Key']. "'"; ?> + '"/>' +
						'</form>',
						buttons: {
							formSubmit: {
								text: 'Apply',
								btnClass: 'btn-blue',
								action: function () {
									
									var User_API_Key = this.$content.find('#User_API_Key').val();
									var form_data = this.$content.find('.user').serialize();
									
									if(!key){
										$.alert('provide a valid User API Key');
										return false;
									}
									
									console.log(' form_data : ' + form_data);
									
									$.getJSON( '../api/changeKey.php' , form_data, function( response,status, error ) {
										console.log("status : " + status);
										console.log("reponse : " +response);
										console.log("error : " +error);
										if (response.status == "202 Accepted"){
											console.log("message Accepted");
											$.dialog({
												title: "Info",
												content: "Message Accepted"
											});
											setTimeout( function(){window.location = 'users'}, 5000); 								
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
				}	
			
			
			});
			
			$( "#btn_setting" ).click(function() {
				console.log("Bouton setting cliqué");
				
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
					content: "You haven't selected any user!"
					});
				}
				if(checkbox_val.length > 1){
					$.alert({
					theme: 'bootstrap',
					title: 'Alert!',
					content: "You have selected several users!"
					});
				}
				if(checkbox_val.length == 1){
					console.log("user?id" + checkbox_val[0]);
					window.location = 'user?id='+checkbox_val[0];
				}
			});
			
			
		});	
	
	</script>   
 </head>

 <body>
	<?php require_once '../menu.php'; 	?>
	<div class="container" style="padding-top: 65px;">
		<div class="row popin card">
			
			<div class="col-md-12 col-sm-12 col-xs-12">	
				<div  class="card-header" style=""><h4><?php echo $title ?></h4></div>
				<div class="table-responsive">
					<form method="post" id="supprimer">
					<table id="tableau" class="display"  class="table table-striped">
					
						<thead>
						  <tr>
							<th><input type='checkbox' name='all' value='all' id='all' ></th>
							<th>Login</th>
							<th>API Key</th>
							<th>Time Zone</th>
							<th>Last sign in</th>
							<th>Count</th>
						  </tr>
						</thead>
						<tbody>
							
							<?php
								$sql = "SELECT * FROM `users`";
                                if ($_SESSION['droits'] > 1){
										$sql .= " where allow = ";
										$sql .= $allow;
								}		
								else	
								        $sql .= " where login = '" . $_SESSION['login'] . "'";
								$sql .= " order by `login` ";
								
								$stmt = $bdd->query($sql);
								
								while ($thing =  $stmt->fetchObject()){
									echo "<tr><td><input type='checkbox' class='selection' name='table_array[$thing->id]' value='$thing->id' ></td>";
									echo "<td>" . $thing->login . "</td>";
									echo "<td>" . $thing->User_API_Key . "</td>";
									echo "<td>" . $thing->time_zone . "</td>";
									echo "<td>" . $thing->last_sign_in_at . "</td>";
									echo "<td>" . $thing->sign_in_count . "</td>";								
								}
							?>
						</tbody>
					</table>

					<button id="btn_mod" type="button" class="btn btn-warning">Change Password</button>
					<button id="btn_typeZone" type="button" class="btn btn-warning">Change Time Zone</button>
					<button id="btn_key" type="button" class="btn btn-warning">Generate New API Key</button>
					<?php
					if ($_SESSION['droits'] > 1){
						if ($allow == 0)
							echo ' <input id="action" name="action" value="Cancel" class="btn btn-danger" readonly > ';
						else
							echo ' <input id="action" name="action" value="Suspending" class="btn btn-danger" readonly > ';
						
						echo '<button id="btn_add" type="button" class="btn btn-secondary">Add</button> ';
						echo '<button id="btn_setting" type="button" class="btn btn-secondary">Setting</button>';
						if ( ! $allow) 	echo ' <a href="users?allow=1" class="btn btn-secondary" role="button" >Users</a>';
						if ($allow) echo ' <a href="users?allow=0" class="btn btn-secondary" role="button" >Suspended Users</a>';
					}	
					?>					
					</form>	
				</div>
			</div>
		</div>
		<?php require_once '../piedDePage.php'; ?>
	</div>
	
</body>
</html>
	