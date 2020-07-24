<?php
/*----------------------------------------------------------------------------------
    @fichier  sigfox.php							    		
    @auteur   Philippe SIMIER (Touchard Washington le Mans)
    @date     19 Juillet 2020
    @version  v1.0 - First release						
    @details  Reception des datas du cloud Sigfox 
	
    Parametres : 
	    id     (Requis)  L'id du device emetteur des datas.
		time   (Requis)  le timestamp des datas
		data   (Requis)  les datas au format brute
		
		type	  (optionnal) le type de trame (1 mesures 2 batterie)
		seqNumber (optionnal) le numero de séquence
		field1    (optionnal) la valeur décodée du champs 1
		field2    (optionnal) la valeur décodée du champs 2
		field3    (optionnal) la valeur décodée du champs 3
		field4    (optionnal) la valeur décodée du champs 4
		field5    (optionnal) la valeur décodée du champs 5
		field6    (optionnal) la valeur décodée du champs 6		
------------------------------------------------------------------------------------*/

	require_once('./definition.inc.php');
	require_once('./api/Api.php');
	
	use Aggregator\Support\Api;
	use Aggregator\Support\Str;
	
	$bdd = Api::connexionBD(BASE);
	
	$dateTime = new DateTime();
	$dateTime->setTimezone(new DateTimeZone('UTC'));
	
	// Contrôle de la présence des paramètres id time et data en GET ou POST
	$idDevice    = Api::obtenir("id");
    $time        = Api::obtenir("time");
    $data        = Api::obtenir("data");
	
	// Lecture des paramètres falcultatifs seqNumber, type, field1 ... field6
	$seqNumber   = Api::facultatif("seqNumber", NULL);
	$type        = Api::facultatif("type", NULL);
	$field1      = Api::facultatif("field1", NULL);
	$field2      = Api::facultatif("field2", NULL);
	$field3      = Api::facultatif("field3", NULL);
	$field4      = Api::facultatif("field4", NULL);
	$field5      = Api::facultatif("field5", NULL);
	$field6      = Api::facultatif("field6", NULL);
	
	$dateTime->setTimestamp($time);

	try{

		// Tout est OK on enregistre la data reçue
		$sql = sprintf("INSERT INTO sigfox (idDevice, seqNumber, time, data, type, field1, field2, field3, field4, field5, field6) VALUES ( %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s )",
			$bdd->quote($idDevice),
			$bdd->quote($seqNumber),
			$bdd->quote($dateTime->format('Y-m-d H:i:s')),
			$bdd->quote($data),
			$bdd->quote($type),
			$bdd->quote($field1),
			$bdd->quote($field2),
			$bdd->quote($field3),
			$bdd->quote($field4),
			$bdd->quote($field5),
			$bdd->quote($field6)
		);
		$reponse = $bdd->exec($sql);
	}
	catch (\PDOException $ex) 
	{
	   Api::envoyerErreur('503','Service Unavailable',$ex->getMessage());       	   
	}

?>