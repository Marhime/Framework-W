<?php
//app/Config.php

class Config
{
	protected $parameters; // contient les infos du fichiers parameters.php
	
	public function __construct(){
		require __DIR__ . '/Config/parameters.php';
		$this -> parameters = $parameters;
		// Au moment où j'instancie cette classe, je récupère le fichier parameters.php, et je stocke tous les paramètres de mon application dans la propriété $parameters.
	}
	
	public function getParametersConnect(){
		return $this -> parameters['connect'];
		// Cette fonction retourne seulement les informations de connexion qui me seront utiles au moment de la connexion à la BDD. 
	}

	public function getParametersSite(){
	    return $this -> parameters['site'];
	    // cette fonction retourne seulement ce qu'il y a le array parameters relatives au site qui me seront utile dans mes vues.
    }
}
//------------
// $config = new Config;
// echo '<pre>';
// print_r($config -> getParametersConnect());
// echo '</pre>';

