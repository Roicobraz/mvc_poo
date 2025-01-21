<?php

namespace controller;

require_once(__ROOT__.'/view/vue.php');

use view\Vue;

class ControllerAccueil {
	public function accueil() {
        $vue = new Vue("accueil");
        $vue->generer(
            array(
                "conn" => false
        ));
    }
}