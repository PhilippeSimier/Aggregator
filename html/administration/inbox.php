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

?>

<html>
<head>
    <title>InBox</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <!-- Bootstrap CSS version 4.1.1 -->
    <link rel="stylesheet" href="/Ruche/css/bootstrap.min.css">
	<link rel="stylesheet" href="/Ruche/css/ruche.css" />
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="/Ruche/scripts/bootstrap.min.js"></script> 
    
 </head>

 <body>
	<?php require_once '../menu.php'; ?>
	<div class="container" style="padding-top: 65px;">
		<div class="row popin">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<?php
					include('paginator.class.php');
					$pages = new Paginator;
					$pages->default_ipp = 10;  // 10 lignes par page
									
					// connexion à la base
					$bdd = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BASESMS, UTILISATEUR,PASSE);
					// Comptage des lignes dans la table 
					$sql = "SELECT COUNT(*) as nb FROM `inbox`"; 
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
					<table class="table table-striped">
						<thead>
						  <tr>
							<th>Date Time</th>
							<th>From</th>
							<th>Body</th>
						  </tr>
						</thead>
						<tbody>
							<?php
								// connexion à la base
								$bdd = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BASESMS, UTILISATEUR,PASSE);
								// utilisation de la méthode quote() 
								// Retourne une chaîne protégée, qui est théoriquement sûre à utiliser dans une requête SQL.
								$sql = "SELECT `ReceivingDateTime`,`SenderNumber`,`TextDecoded` FROM `inbox` order by `ReceivingDateTime` desc ". $pages->limit;
								$stmt = $bdd->query($sql);
								while ($message =  $stmt->fetchObject()){
									echo "<tr><td>" . $message->ReceivingDateTime . "</td>";
									echo "<td>" . $message->SenderNumber . "</td>";
									echo "<td>" . utf8_encode(reduire($message->TextDecoded)) . "</td></tr>";
								}
							?>
						</tbody>
					</table>	
				
				</div>	

			
	
		</div>
		<?php require_once '../piedDePage.php'; ?>
		
	</div>	
	
</body>
</html>
	