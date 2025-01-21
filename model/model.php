<?php 

namespace model;

class model {
//propriété
	private $bdd;
//méthode
	protected function executerRequete($sql, $params = null) 
	{
		if ($params == null)
		{
			$resultat = $this->getBdd()->query($sql); // exécution directe
		}
		else
		{
			$resultat = $this->getBdd()->prepare($sql);  // requête préparée
			$resultat->execute($params);
		}
		return $resultat;
	}
	
	private function getBdd() 
	{
        if ($this->bdd == null)
		{
            // Création de la connexion
            $this->bdd = new \PDO('mysql:host='.$GLOBALS['settings']['database']['host'].'; dbname='.$GLOBALS['settings']['database']['dbname'].'; charset=utf8', $GLOBALS['settings']['database']['user'], $GLOBALS['settings']['database']['password'], array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
        }
        return $this->bdd;
    }
	
	protected function select_parameter($parameters) 
	{		
		/**
		* Inner Join					|	Where
		* with => table visé			| 	where => colonne visé
		* with_value => colonne visé	| 	where_value => donnée voulue
		*/
		if( isset($parameters[0]["with"]["with"]) && isset($parameters[0]["where"]["where"]) )
		{
			$param = "
				INNER JOIN ".$parameters["table"]." 
				ON ".$parameters['table'].".".$parameters[0]["with"]['with_value']."=".$parameters[0]["with"]['with'].".".$parameters[0]["with"]['with_value']."
			";
			
			$param .= " AND ".$parameters[0]["where"]["where"]."=:data";
			
			$prep = array("data" => $parameters[0]["where"]["where_value"]);
		}
		elseif(isset($parameters[0]["with"]["with"]))
		{
			$param = "INNER JOIN ".$parameters[0]['with']['with']." ON ".$parameters['table'].".".$parameters[0]["with"]['with_value']."=".$parameters[0]["with"]['with'].".".$parameters[0]["with"]['with_value'];
		}
		elseif(isset($parameters[0]["where"]["where"]))
		{
			$id = $parameters[0]["where"]["where_value"];
			$param = "where ".$parameters[0]["where"]['where']."=:data";
			$prep = array("data" => $parameters[0]["where"]["where_value"]);
		}
		else { $param = ""; }
		return(array("param" => $param, "prep" => $prep));
	}
	
	protected function update_parameter($parameters) {
		$upd_values ="";
		$prep_values = array();
		foreach($parameters["values"] as $value)
		{
			$upd_values .= array_search($value, $parameters["values"])." = :".array_search($value, $parameters["values"]);
			$prep_values = array_merge($prep_values, array(array_search($value, $parameters["values"]) => $value));
			
			if($value != end($parameters["values"]))
			{
				$upd_values .= ', ';
			}
		}
		return(array($upd_values, $prep_values));
	}
}