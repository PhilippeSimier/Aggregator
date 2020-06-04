<?php

$lang = array();

/* DataTables */
$lang['dataTables'] = "lang/dataTable.French.json";

/* Buttons */
$lang['add'] = "Ajouter";
$lang['edit_settings'] = "Modifier";
$lang['delete'] = "Supprimer";
$lang['Cancel'] = "Annuler";
$lang['Apply'] = "Appliquer";

/* Users */
$lang['Change_Password'] = "Mot de passe";
$lang['Change_Time_Zone'] = "Changer fuseau horaire";
$lang['New_API_Key'] = "Nouvelle clé API";
$lang['Suspending'] = "suspendre";
$lang['Failed_login'] = "Échec de la connexion";
$lang['Failed_logins'] = "Échecs de la connexion";

$lang['Users'] = "Utilisateurs";
$lang['Users_suspending'] = "Utilisateurs suspendus";
$lang['login'] = "Identifiant";
$lang['API_Key'] = "Clé API";
$lang['Time_Zone'] = "Fuseau horaire";
$lang['last_sign_in'] = "Dernière connexion";
$lang['count'] = "Total";

/* Failed login */
$lang['Ip_address'] = "Adresse IP";

/* Reacts */
$lang['user'] = "Utilisateur";
$lang['name'] = "Nom";
$lang['channel_to_check'] = "Canal à Vérifier";
$lang['Choose_your_channel'] = "Choisir votre canal";
$lang['field'] = "Champs à Vérifier";
$lang['Choose_your_field'] = "Choisir votre champ";
$lang['condition'] = "Condition";
$lang['action'] = "Action à Effectuer";
$lang['Has_not_been_updated_for'] = "N'a pas été mis à jour depuis";


/* react formulaire */
$lang['react'] = "Réagir";
$lang['select_react_type'] = array('0' => "Uniquement la première fois que la condition est remplie",
                                   '1' => "Chaque fois que la condition est remplie");

$lang['select_channel_id'] = "Sélectionner un Canal";

$lang['select_actionable_type'] = array('' => 'Choisissez une action', 
                                        'thingHTTP' => "Requête HTTP",
										'email' => "Envoyez un Email" );

$lang['select_interval'] = array('on_insertion' => "Lors de l'insertion de Valeur",
                         '10' => "Toutes les 10 minutes",
                         '30' => "Toutes les 30 minutes",
                         '60' => "Toutes les 60 minutes" );

$lang['select_condition'] = array(	'gt' => "est supérieur à",
                                    'gte' => "est supérieur ou égal à",
                                    'lt' => "est inférieur à",
                                    'lte' => "est inférieur ou égal à",
                                    'eq' =>  "est égal à",
                                    'neq' => "est différent de" );


$lang['select_react_type'] = array ('0' => "Exécuter l'action uniquement la première fois que la condition est remplie",
                                    '1' => "Exécuter une action chaque fois que la condition est remplie");




///////////////support/Reacts///////////////
$lang['reacts_title1'] = "Vue d'ensemble de reacts (réagir aux évènements)";
$lang['reacts_text1a'] = "Réagissez lorsque les données d'un canal remplissent certaines conditions";
$lang['reacts_text1b'] = "les Reacts fonctionnent avec les applications ThingHTTP, pour effectuer des actions lorsque les données d'un canal remplissent une certaine condition.
                          Vous pouvez configurer un react pour notifier un évenement par SMS ou Mail.
                          Par exemple lorsque le poids d'une ruche chute soudainement, demandez à ThingHTTP d'envoyer un SMS contenant une description de l'évènement.";
$lang['reacts_title2'] = "Lire les reacts archivés";
$lang['reacts_text2a'] = "Choisir Reacts dans le menu utilisateur pour afficher le tableau des reacts archivés.";
$lang['reacts_text2b'] = "Pour chacun des reacts les informations suivantes sont affichées.";
$lang['reacts_text2c'] = "Le login de l'utilisateur propriétaire";
$lang['reacts_text2d'] = "Le nom du react";
$lang['reacts_text2e'] = "La désignation du canal à vérifier";
$lang['reacts_text2f'] = "La condition logique permettant de déclencher l'action. Cette condition est composée de trois parties :";
$lang['reacts_text2g'] = "Un champs du canal";
$lang['reacts_text2h'] = "Un opérateur de comparaison numérique";
$lang['reacts_text2i'] = "Une valeur numérique";
$lang['reacts_text2j'] = "La désignation de l'application thingHtttp (cette application déclenche le service demandé via une requête http)";
$lang['reacts_title3'] = "Supprimer les Reacts";
$lang['reacts_text3a'] = "Vous pouvez supprimer un ou plusieurs Reacts archivés. Cocher les Reacts à supprimer puis cliquer sur le bouton Delete. Une fenêtre de confirmation s'ouvre.
                          Valider l'action";
$lang['reacts_title4'] = "Modifier un React";
$lang['reacts_text4a'] = "Cochet le react à modifier puis cliquer sur le bouton setting. Un formulaire s'ouvre.";



///////////////React///////////////




//------------Text sur le coté du Formulaire---------------//

$lang['react_aide'] = "<h3>Option du Reagir aux évenements</h3>
<ul>
	<li>Nom du React : Saisissez un nom unique pour votre React.</li>
	<li>Fréquence de test : Choisissez de tester votre condition à chaque fois que des données entrent dans le canal ou périodiquement.</li>
	<li>Condition : Sélectionnez un canal, un champ et la condition de votre React.</li>
	<li>Action : Sélectionnez Requête HTTP, Envoyer un Email, à exécuter lorsque la condition est remplie.</li>
	<li>Option : Sélectionnez le moment où React s'exécute.</li>
</ul>";

















 ?>