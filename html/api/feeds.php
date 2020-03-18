<?php
    /** fichier		 : feeds.php
	    description  : Read data from all fields in a channel with HTTP GET or POST
	    author       : Philippe SIMIER Lycée Touchard Le Mans
		
		réécriture   : RewriteRule ^channels/([0-9]+)/feeds.([a-zA-Z]+)$   api/feeds.php?channelId=$1&type=$2 [QSA]
		url          : channels/539387/feeds.json?callback=mafonction&offset=0&results=2
		url	réécrite : api/feeds.php?channelId=539387&type=json&callback=mafonction&offset=0&results=2
		
	    Parameters : 
			channelId (Required) Channel ID for the channel of interest.
			type      (Required) le type de sortie JSON CSV
			results   (Optional) Number of entries to retrieve. The maximum number is 8000
			 	
	**/
	
	require_once('../definition.inc.php');
	require_once('biblio.php');	
	
    
	// Lecture des paramétres obligatoires
	$channelId = obtenir("channelId", FILTER_VALIDATE_INT);
	$type = obtenir("type");
		
	// Lecture des paramétres facultatifs
	$results   = facultatif("results", "8000", FILTER_VALIDATE_INT);

	// Connexion à la base avec session heure UTC
	$bdd = connexionBD(BASE, "+00:00");

	if ($type == "json"){
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
    }
    if($type == "csv"){
		
		// Lecture des valeurs enregistrées dans la table feeds
		$sql = "SELECT * FROM `feeds` where `id_channel` = ". $channelId . " ORDER BY `date` DESC limit " . $results;
		$nom_fichier = "channel_". $channelId . ".csv";

		header('Content-Type: application/csv-tab-delimited-table');
		header('Content-Disposition:attachment;filename='.$nom_fichier);
		
		
		echo "created_at,entry_id,field1,field2,field3,field4,field5,field6,field7,field8,latitude,longitude,elevation,status\n";
		$stmt = $bdd->query($sql);
		while ($data = $stmt->fetchObject()){
				echo $data->date." UTC,";
				echo $data->id.",";
				echo nan($data->field1).",";
				echo nan($data->field2).",";
				echo nan($data->field3).",";
				echo nan($data->field4).",";
				echo nan($data->field5).",";
				echo nan($data->field6).",";
				echo nan($data->field7).",";
				echo nan($data->field8).",";
				echo $data->latitude.",";
				echo $data->longitude.",";
				echo $data->elevation.",";			
				echo $data->status."\n";
		}
	}
?>