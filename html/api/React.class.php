<?php

namespace Aggregator\Support;
   
    require_once('ThingHTTP.class.php');   // La classe React utilise les objets thingHTTP
	use Aggregator\Support\ThingHTTP;
	use Aggregator\Support\ThingHTTPException;

class React
{
   /**  Constructeur
    *   @param $bdd une connexion à la base de donnée
	*   @id    id du react à construire
	*/
    function __construct($bdd, $id) {
		$this->bdd = $bdd;
		$sql = "SELECT * FROM reacts WHERE id = ".$id;
		$stmt = $bdd->query($sql);
		$this->property = $stmt->fetchObject();
	}

	/** Methode to perform the react
     *  @return boolean
     */	
    public function perform() {
		if($this->property) {
			// lecture de la dernière valeur du champ n° field_number du canal channel_id
			$sql = "SELECT field" . $this->property->field_number ." as value FROM feeds WHERE id_channel = ". $this->property->channel_id ." ORDER BY `feeds`.`date` desc limit 1";
			$stmt = $this->bdd->query($sql);
			$this->property->action_value = $stmt->fetchObject()->value;

			// calcul de la comparaison
			$condition = $this->comparaison( $this->property->action_value , $this->property->condition , $this->property->condition_value );
			
			// Exécution de l'action associé
			if ($condition && ( !$this->property->last_result || $this->property->run_action_every_time)){
					
					try{
						$http = new ThingHTTP($this->bdd, $this->property->actionable_id);
						$http->send_request();
					}
					catch(ThingHTTPException $e) {
						echo $e->getMessage();
					}
					// Sauvegarde de l'heure d'éxécution & de la valeur d'action
					$sql = "UPDATE `reacts` SET `last_run_at`= now(), `action_value` = {$this->property->action_value} WHERE `id` = {$this->property->id}";
					$stmt = $this->bdd->query($sql);
					
			}
			
			// Sauvegarde de la propriété last_result  dans la base
			if ($condition)  { $last_result = 1; } else  $last_result = 0;
			$sql = "UPDATE `reacts` SET `last_result` = '{$last_result}' WHERE `reacts`.`id` = {$this->property->id}";
			$stmt = $this->bdd->query($sql);
			return true;
		} else{
			return false;
		}	
	}
	
	/** Methode to show property
     *  @return nothing
     */	 
	public function showProperty(){
		
		echo '<pre>';
		var_dump($this->property);
		echo '</pre>';
	}

	/** Methode pour calculer la comparaison
     *  @return booleen
     */	

    private function comparaison($arg1, $op, $arg2)
    {
        $retour = false;
		switch ($op) {
			case "lt":
				$retour = $arg1 < $arg2;
				break;
			case "lte":
				$retour = $arg1 <= $arg2;
				break;
			case "gt":
				$retour = $arg1 > $arg2;
				break;
			case "gte":
				$retour = $arg1 >= $arg2;
				break;
			case "neq":
				$retour = $arg1 !== $arg2;
				break;
			case "eq":
				$retour = $arg1 === $arg2;
				break;				
		}
        return $retour;
    }	

	// déclaration des propriétés
    private $property;
    private $bdd;	
}