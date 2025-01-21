<?php

namespace controller;

/**
*   Ensemble des controleurs
**/
require_once(__ROOT__.'/controller/controlleraccueil.php');

use controller\ControllerAccueil;

use view\Vue;

class Routeur {
    private $ctrlaccueil;
	
    public function __construct() {
        $this->ctrlaccueil = new ControllerAccueil();
    }

    // Route une requête entrante : exécution l'action associée
    public function routerRequete() {
        session_start();
        try {
				$this->ctrlaccueil->accueil();
        }
        catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    // Affiche une erreur
    private function error($msgErreur) {
        $vue = new Vue("erreur");
        $vue->generer(array('msgerreur' => $msgErreur));
    }
	
	/**
	* Méthode de routage plus simple et rapide
	*/
	private function route($action, $parameter = '') {
		if ($_GET['action'] == $action && $_GET['action'] == $action)
		{
			$controller = 'ctrl'.$action;
			$this->$controller->accueil();
			exit;
		}
	}
	
	private function action($repository, $the_action) {
		if ($_GET['action'] == $the_action) {
			$repository = $repository.'_repository';
			$this->$repository->$the_action();   
		}
	}
}