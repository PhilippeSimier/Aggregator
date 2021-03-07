<?php

namespace Aggregator\Support;
   

class Channel
{
   /**  Constructeur
    *   @param $bdd une connexion à la base de données
	*/
   function __construct($bdd, $id) {
		$this->bdd = $bdd;
		$this->id = $id;
		
		$sql = "SELECT * FROM channels WHERE id = {$id}";
		$stmt = $bdd->query($sql);
		$this->property = $stmt->fetchObject();
	}
	
	/** Methode to show property
     *  @return nothing
     */	 
	public function showProperty(){
		
		
		print_r($this->property);
		
	}
	
	/** Methode to read feed
     *  @return array
     */	 
	public function read($field, $nb){
		
		$sql = "SELECT `date`, {$field} as value FROM feeds WHERE id_channel = ". $this->id . " order by `date` desc limit {$nb}";
		$stmt = $this->bdd->query($sql);
		$result = [];
		while ($feed =  $stmt->fetchObject()){
			$result[] = $feed->value;
		}
		return $result;
	}	
	

	// déclaration des propriétés
    private $property;
    private $bdd;	
}