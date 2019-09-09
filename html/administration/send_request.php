<?php
	include "authentification/authcheck.php" ;

	require_once('../definition.inc.php');
	require_once('../api/biblio.php');

	// connexion à la base
	$bdd = connexionBD(BASE, $_SESSION['time_zone']);
	$id  = obtenir("id", FILTER_VALIDATE_INT);
	
	$sql = "SELECT * FROM thinghttps WHERE id = ".$id;
	
	$stmt = $bdd->query($sql);
	if($request =  $stmt->fetchObject()){
		
		$curl = curl_init();

		curl_setopt_array($curl, 
			array(
				CURLOPT_URL => $request->url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_CUSTOMREQUEST => $request->method,
				CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache"
					),
			)
		);
		if ($request->http_version == "1.1")
			curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1 );
		if ($request->http_version == "1.0")
			curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0 );
		
		if ($request->method == "POST")
			curl_setopt($curl, CURLOPT_POSTFIELDS, $request->body );
		
		// une authentification HTTP
        if ($request->auth_name != "" && $request->auth_pass != ""){
			curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY );
			curl_setopt($curl, CURLOPT_USERPWD, "$request->auth_name:$request->auth_pass" );
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		}	
		
		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "Error : " . $err ;
		} else {
			echo $response;
		}		
	
	}
	else{
        envoyerErreur(500, "Internal Server Error", "Internal Server Error");
    }

	

?>