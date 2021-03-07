<?php

	require_once(__DIR__ ."/../definition.inc.php");
	require_once(__DIR__ ."/Api.php");
	require_once(__DIR__ ."/Channel.class.php");
	
	
	use Aggregator\Support\Api;
	
	
	
		if ($argc === 2){
		
		$bdd = Api::connexionBD(BASE, "+00:00");
	
		try	{
			// construction de la requête SQL pour obtenir les information sur un script
			$sql = "SELECT * FROM `scripts` WHERE id = {$argv[1]}";
			$stmt = $bdd->query($sql);
			if ($script =  $stmt->fetchObject()){
				$code = $script->code;
				$language = $script->language;
			}else{
				echo "erreur script inconnu\n";
				return;
			}
		}
		catch(\PDOException $ex) {
			echo($ex->getMessage()."\n");
			return;
		}
	
		// Execution du code
		if ($language === "php"){
		
			try {
				$result = eval($code);
			} 
			catch (ParseError $e) {
				echo "line " . $e->getLine() . " : " . $e->getMessage();
			}
		}
		
		if ($language === "shell"){
			
			exec($code, $output, $exitcode);
			echo "Returned with status {$exitcode} and output:\n";
			echo implode("\n", $output) ;
			echo "\n";
		}		
		
	}else{
		
		echo "usage : run 1 \n";
	}	