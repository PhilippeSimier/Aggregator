<!DOCTYPE html>

<?php
include "authentification/authcheck.php" ;

//require_once('../ini/ini.php');
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
		
		var_dump($supp);
		// connexion à la base
		$bdd = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BASE, UTILISATEUR,PASSE);
		$sql = "DELETE FROM `things` WHERE `id` IN " . $supp;
		$bdd->exec($sql);
	}
	unset($_POST['table_array']);
	unset($_GET['page']);
	unset($_GET['ipp']);

}

?>

<html>
<head>
    <title>Things</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <!-- Bootstrap CSS version 4.1.1 -->
    <link rel="stylesheet" href="/Ruche/css/bootstrap.min.css">
	<link rel="stylesheet" href="/Ruche/css/ruche.css" />
	<link rel="stylesheet" href="/Ruche/css/jquery-confirm.min.css" />
	<link rel="stylesheet" href="//cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
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
					console.log("thing.php?id" + checkbox_val[0]);
					window.location = 'thing?id='+checkbox_val[0];
				}
			});
			
			$( "#btn_add" ).click(function() {
				console.log("Bouton Ajouter cliqué");
				window.location = 'thing'
			
			
			});
			
		});	
	
		
		
	</script>
    
 </head>

 <body>
	<?php require_once '../menu.php'; 	?>
	<div class="container" style="padding-top: 65px;">
		<div class="row popin">
			
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<form method="post" id="supprimer">
					<table id="tableau"  class="display table table-striped">
						<thead>
						  <tr>
							<th><input type='checkbox' name='all' value='all' id='all' ></th>
							<th>Name</th>
							<th>Tag</th>
							<th>Access</th>
							<th>Author</th>
							<th>Local IP</th>
						  </tr>
						</thead>
						<tbody>
							
							<?php
								
								
								$sql = "SELECT * FROM `login_things`";
                                if ($_SESSION['login'] == "root")
										$sql .= " where 1";	
								else	
								        $sql .= " where login = '" . $_SESSION['login'] . "'";
								$sql .= " order by `name` ";
								
								$stmt = $bdd->query($sql);
								
								while ($thing =  $stmt->fetchObject()){
									echo "<tr><td><input class='selection' type='checkbox' name='table_array[$thing->id]' value='$thing->id' ></td>";
									echo "<td>" . reduire($thing->name) . "</td>";
									echo "<td>" . $thing->tag . "</td>";
									echo "<td>" . $thing->status . "</td>";
									echo "<td>" . $thing->login . "</td>";
									echo "<td>" . $thing->local_ip_address . "</td>";
								}
							?>
						</tbody>
					</table>
					<input id="btn_supp" name="btn_supprimer" value="Delete" class="btn btn-danger" readonly size="9">
					<button id="btn_mod" type="button" class="btn btn-secondary">Edit settings</button>
					<button id="btn_add" type="button" class="btn btn-secondary">Add</button>
					</form>	
				</div>
			</div>	
		</div>
		<?php require_once '../piedDePage.php'; ?>
	</div>
</body>
</html>
	