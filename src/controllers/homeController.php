<?php

namespace mvc_poo\app\Controller;

use mvc_poo\Core\pagesController;

class homeController extends pagesController {

    public function __construct()
    {
        $this->titre = "Accueil";
        $this->class_page = "home";
 
        echo $this->generer(
            array(
                "contentView" => $this->setTemplate('home'),
        ));
    }
}