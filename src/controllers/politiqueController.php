<?php

namespace mvc_poo\app\Controller;

use mvc_poo\Core\pagesController;

class politiqueController extends pagesController {

    public function __construct()
    {
        $this->titre = "Politique de confientialité";
        $this->class_global = "Privacy_Policy";
        
        echo $this->generer(
            array(
                "contentView" => $this->setTemplate('politiqueconf')
        ));
    }
}