<?php
class thingHTTP
{
   // Constructeur
    function __construct($bdd, $id) {
        
		$sql = "SELECT * FROM thinghttps WHERE id = ".$id;
		$stmt = $bdd->query($sql);
			if($request =  $stmt->fetchObject()){
				$this->curl = curl_init();

				curl_setopt_array($this->curl, 
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
					curl_setopt($this->curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1 );
				if ($request->http_version == "1.0")
					curl_setopt($this->curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0 );
				
				if ($request->method == "POST")
					curl_setopt($this->curl, CURLOPT_POSTFIELDS, $request->body );
				
				// une authentification HTTP
				if ($request->auth_name != "" && $request->auth_pass != ""){
					curl_setopt($this->curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY );
					curl_setopt($this->curl, CURLOPT_USERPWD, "$request->auth_name:$request->auth_pass" );
					curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
				}	
			}
			else{
				// La requète retourne un objet vide !!
				$this->curl = NULL;
				throw new Exception("Constructor thingHTTP Error");
			}	
    }   

    // destructeur
    function __destruct() {
        //print "Destroying " . __CLASS__ . "\n";
		if ($this->curl != NULL){
			curl_close($this->curl);
		}
    }

   // déclaration des propriétés
    private $curl;
	private $response;
	private $err;

    // Méthode pour envoyer la requète
	// Retourne la réponse du serveur
    public function send_request() {
		if ($this->curl != NULL){
			$this->response = curl_exec($this->curl);
			$this->err = curl_error($this->curl);
			return $this->response;
		}
    }
	
	// Méthode pour obtenir l'erreur
	public function get_error(){
		return $this->err;
	}	
	
}


?>