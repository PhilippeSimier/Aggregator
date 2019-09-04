<?php
    /** Read data from all fields in a channel with HTTP GET or POST
	    Parameters : 
			channelId (Required) Channel ID for the channel of interest.
			results   (Optional) Number of entries to retrieve. The maximum number is 8000  
	**/
	
	require_once('../definition.inc.php');
	require_once('biblio.php');	
	
	// Fonction pour remplacer les valeurs null par nan
    function nan($valeur){
	if($valeur == null)
		return "nan";
	else 
		return $valeur;
    }

    // Fonction pour mettre la date UTC au format yyyy-mm-ddThh-mm-ssZ
    function formatDate($date){
		$dt = new DateTime($date);
		//$dt->setTimeZone(new DateTimeZone('UTC'));
        return $dt->format('Y-m-d\TH-i-s\Z');
	}	
    
	// Lecture des paramétres obligatoires
	$channelId = obtenir("channelId", FILTER_VALIDATE_INT);
	
	// Lecture des paramétres facultatifs
	$results   = facultatif("results", "8000", FILTER_VALIDATE_INT);
	
    // connexion à la base data
	$bdd = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BASE, UTILISATEUR,PASSE);
	
	// selection de la timezone UTC pour la session
	$sql = "SET @@session.time_zone = \"+00:00\"";
	$stmt = $bdd->exec($sql);
	
	// Lecture des informations correspondant au channel dans la table channels
	$sql = "SELECT * FROM `channels` WHERE `id` = " . $channelId;
	$stmt = $bdd->query($sql);
	if ($result =  $stmt->fetchObject()){
			
		$channel = array(
			'id' => intval($result->id),
			'name' => $result->name,
		);
		if ($result->field1 != "") $channel['field1'] = $result->field1;
		if ($result->field2 != "") $channel['field2'] = $result->field2;
		if ($result->field3 != "") $channel['field3'] = $result->field3;
		if ($result->field4 != "") $channel['field4'] = $result->field4;
		if ($result->field5 != "") $channel['field5'] = $result->field5;
		if ($result->field6 != "") $channel['field6'] = $result->field6;
		if ($result->field7 != "") $channel['field7'] = $result->field7;
		if ($result->field8 != "") $channel['field8'] = $result->field8;
		
		
		// Lecture des valeurs enregistrées dans la table feeds
		$sql = "SELECT * FROM `feeds` where `id_channel` = ". $channelId . " ORDER BY `id` DESC limit " . $results;
		
		$stmt = $bdd->query($sql);
		$feeds = array();
		while ($feed =  $stmt->fetchObject()){
			$data = array(
					'created_at' => formatDate($feed->date),
					'entry_id' => intval($feed->id), 
				);	
			if ($result->field1 != "") $data['field1'] = nan($feed->field1);
			if ($result->field2 != "") $data['field2'] = nan($feed->field2);
			if ($result->field3 != "") $data['field3'] = nan($feed->field3);
			if ($result->field4 != "") $data['field4'] = nan($feed->field4);
			if ($result->field5 != "") $data['field5'] = nan($feed->field5);
			if ($result->field6 != "") $data['field6'] = nan($feed->field6);	
			if ($result->field7 != "") $data['field7'] = nan($feed->field7);	
			if ($result->field8 != "") $data['field8'] = nan($feed->field8);			
			array_push($feeds, $data);							
		}
		
		$output = array(
			'channel' => $channel,
			'feeds' => $feeds
		);
		
		header("Access-Control-Allow-Origin: *");
		header('Content-type: application/json');
		
		echo json_encode($output);
		
	}else{
		echo "-1";
	}	

?>