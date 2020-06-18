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
$lang['Validate'] = "Valider";
$lang['close'] = "Fermer";
$lang['display'] = "Afficher";

/* index & Menu*/
$lang['Sign_in'] = "Se connecter";
$lang['User login'] = "Identifiant";
$lang['Password'] = "Mot de Passe";
$lang['Users'] = "Utilisateurs";
$lang['Browse_Sites'] = "Parcourir";
$lang['Things'] = "Objets";
$lang['Channels'] = "Canaux";
$lang['ThingHTTPs'] = "Actions HTTP";
$lang['Reacts'] = "Déclencheurs";
$lang['Sign_Out'] = "Se déconnecter";
$lang['My_Account'] = "Mon compte";
$lang['docs_page'] = "Documentation Aggregator pour cette page";
$lang['Data_visualisation'] = "Visualisation des données";
$lang['Data_Analysis'] = "Analyse des données";

/* thingView */
$lang['graphic'] = "Graphique";
$lang['hide_all'] = "Cacher tout";
$lang['more_historical_data'] = "Plus de données historiques";
$lang['setting filter'] = "Réglage du filtre";
$lang['simple_moving_average'] = "Moyenne Mobile Simple";
$lang['exponential_moving_average'] = "Moyenne Mobile Exponentielle";
$lang['period'] = "Periode";

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

/* things */
$lang['things'] = "Objets";
$lang['access'] = "Accès";
$lang['tag'] = "Etiquette";
$lang['author'] = "Créateur";
$lang['Ip_address'] = "Adresse IP";

/* channels */
$lang['channel'] = "Canal";
$lang['write_API_Key'] = "Clé API";
$lang['last_write_entry'] = "Date dernière entrée";
$lang['last_entry_id'] = "Nb Valeurs";
$lang['generate_New_API_Key'] = "Générer une nouvelle clé API";
$lang['view_last_values'] = "Afficher les dernières valeurs";
$lang['download_CSV'] = "Télécharger CSV";
$lang['clear_all_feed'] = "Effacer tout le flux";

/* thingHTTPs */
$lang['created'] = "Créé"; 
$lang['method']  = "Méthode";
$lang['send']    = "Envoyer";

/* SMS */
$lang['read'] = "Lire";
$lang['write'] = "Ecrire";
$lang['date_of_issue'] = "Date d'émission";
$lang['date_of_receipt'] = "Date de reception";
$lang['to'] = "à";
$lang['from'] = "de";
$lang['sent'] = "Envoyés";
$lang['received'] = "Reçus";

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

/* webcam */
$lang['download_picture'] = "Télécharger l'image";

/* react formulaire */
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