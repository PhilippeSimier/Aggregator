<?php
   
	require_once('../definition.inc.php');
	
    // Fonction pour renvoyer une réponse suite à une erreur 
    function erreur($httpStatus, $message, $detail){
        $data = array(
                'status' => $httpStatus,
                'message' => $message,
                'detail' => $detail
        );
        header('HTTP/1.1 ' . $httpStatus . ' ' . $message);
        header('content-type:application/json');
	echo json_encode($data);
    
    }

    // Contrôle de la présence du paramètre key en GET ou POST
    $key = filter_input(INPUT_GET, 'key');
    if($key === NULL){
        $key = filter_input(INPUT_POST, 'key');
    }
    if($key === NULL){
        erreur(403, "Bad Request", "The request cannot be fulfilled due to bad syntax." );
        return;  
    }

    // Contrôle de la présence du paramètre id en GET ou POST
    $id = filter_input(INPUT_GET, 'id');

    if($id === NULL){
        $id = filter_input(INPUT_POST, 'id');
    }
    if($id === NULL){
        erreur(403, "Bad Request", "The request cannot be fulfilled due to bad syntax." );
        return;
    }
	
	// Contrôle de la présence du paramètre folder en GET ou POST
    $folder = filter_input(INPUT_GET, 'folder');
    if($folder === NULL){
        $folder = filter_input(INPUT_POST, 'folder');
    }
    if($folder === NULL){
        erreur(403, "Bad Request", "The request cannot be fulfilled due to bad syntax." );
        return;  
    }	
	
	// connexion à la base smsd
	$bdd = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BASESMS, UTILISATEUR,PASSE);
	if ($folder == "sent")
		$sql = "SELECT `SendingDateTime` as dateTime,`DestinationNumber` as number,`TextDecoded` as text,`ID` FROM `sentitems` where id = ".$id. " order by SequencePosition";
	if ($folder == "inbox")
		$sql = "SELECT `ReceivingDateTime` as dateTime,`SenderNumber` as number,`TextDecoded` as text,`ID` FROM `inbox` where id = ".$id;
	
	$stmt = $bdd->query($sql);
	 
	if($message =  $stmt->fetchObject()){
		
		$data = array(
                'status' => "202 Accepted",
				'date' => $message->dateTime, 
                'number' => $message->number,
				'text' => utf8_encode($message->text)
            );

        header('HTTP/1.1 202 Accepted');
        header('content-type:application/json');
        echo json_encode($data);
	}
	else{
        erreur(500, "Internal Server Error", "Internal Server Error");
    }
	
?>	