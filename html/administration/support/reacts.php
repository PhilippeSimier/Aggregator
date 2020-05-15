<!----------------------------------------------------------------------------------
    @fichier  administration/support/administration/sms.php							    		
    @auteur   Philippe SIMIER (Touchard Washington le Mans)
    @date     Avril 2020
    @version  v1.0 - First release						
    @details  support pour la page administration/sms.php
------------------------------------------------------------------------------------>

<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Support - REACT</title>
    <!-- Bootstrap CSS version 4.1.1 -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="../../scripts/bootstrap.min.js"></script> -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css" >
    <link rel="stylesheet" href="../../css/ruche.css" />
</head>

<body>
	
	<?php require_once '../../menu.php'; ?>
	
	<div class="container" >
		<div style="min-height : 500px">	
			<div class="row" style="background-color:white; padding-top: 65px; ">
				<div class="col-lg-12">
					<h4>Vue d'ensemble de reacts (réagir aux évènements)</h4>
					<p>Réagissez lorsque les données d'un canal remplissent certaines conditions</p></br>
					<p>les Reacts fonctionnent avec les applications ThingHTTP, pour effectuer des actions lorsque les données d'un canal remplissent une certaine condition.
					Vous pouvez configurer un react pour notifier un évenement par SMS ou Mail. 
					Par exemple lorsque le poids d'une ruche chute soudainement, demandez à ThingHTTP d'envoyer un SMS contenant une description de l'évènement.</p></br>
					<h4>Lire les reacts archivés </h4>
					<p> Choisir Reacts dans le menu utilisateur pour afficher le tableau des reacts archivés.</p>
					<p> Pour chacun des reacts les informations suivantes sont affichées. <ul>
					<li> Le login de l'utilisateur propriétaire </li>
					<li> Le nom du react </li>
					<li> La désignation du canal à vérifier </li>
					<li> La condition logique permettant de déclencher l'action. Cette condition est composée de trois parties :
						<ul> 
						<li>Un champs du canal </li>
						<li>Un opérateur de comparaison numérique; </li>
						<li>Une valeur numérique</li>
						</ul>
					<li> La désignation de l'application thingHtttp (cette application déclenche le service demandé via une requête http) 
					</ul>
					
					<h4>Supprimer les Reacts </h4>
					<p> Vous pouvez supprimer un ou plusieurs Reacts archivés. Cocher les Reacts à supprimer puis cliquer sur le bouton Delete. Une fenêtre de confirmation s'ouvre.
					Valider l'action</p></br>
					<h4>Modifier un React </h4>
					<p> Cochet le react à modifier puis cliquer sur le bouton setting. Un formulaire s'ouvre.</p></br>
					
				</div>
			</div>
		</div>
		<?php require_once '../../support/piedDePage.php'; ?>
	</div>
	
	
</body>	