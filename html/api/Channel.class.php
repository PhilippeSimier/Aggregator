<?php

namespace Aggregator; 

class Channel
{
   /**  Constructeur
    *   @param $id du channel
	*/
   function __construct($id) {
		
		global $bdd;
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
	
	/** Methode to read data in a channel
	 *  @param $field le nom du champ
	 *  @param $nb le nombre de valeurs à lire	 
     *  @return array
     */	 
	public function read($field, $nb){
		
		$sql = "SELECT `date`, {$field} as value FROM `feeds` WHERE id_channel = ". $this->id . " order by `date` desc limit {$nb}";
		$stmt = $this->bdd->query($sql);
		$result = [];
		while ($feed =  $stmt->fetchObject()){
			$result[] = $feed->value;
		}
		return $result;
	}

	/** Methode to write data in a channel
     *  @return le nombre de lignes insérées
     */	
    public function write($field, $value){
		$sql = sprintf("INSERT INTO `data`.`feeds` (`id_channel`, `%s`) VALUES ( %s, %s);"
							  , $field
							  , $this->id
							  , $this->bdd->quote($value)
							  );
		$count = $this->bdd->exec($sql);
		return $count;
	}

	/** Méthode pour calculer la moyenne
	 *  @param $field le numero du champs
	 *  @nb le nombre de valeur à lire
     *  @return la somme des valeurs du tableau array.
     */	 
	public function avg($field, $nb){
		$a = $this->read($field, $nb);
		
		if(count($a) !== 0) {
			$avg = array_sum($a) / count($a);
			return $avg;
		}
		else {
			return NAN;
		}
    }
	
	/** Méthode pour obtenir la valeur minimale
	 *  @param $field le numero du champs
	 *  @nb le nombre de valeur à lire 
     *  @return la somme des valeurs du tableau array.
     */	
	public function getMin($field, $nb){
		$a = $this->read($field, $nb);
		
		if(count($a) !== 0) {
			return min($a);
		}
		else {
			return NAN;
		}
    }
	
	/** Méthode pour obtenir la valeur maximale
	 *  @param $field le numero du champs
	 *  @nb le nombre de valeur à lire 
     *  @return la somme des valeurs du tableau array.
     */	
	public function getMax($field, $nb){
		$a = $this->read($field, $nb);
		
		if(count($a) !== 0) {
			return max($a);
		}
		else {
			return NAN;
		}
    }
	
	// déclaration des propriétés
    private $property;
    private $bdd;	
}