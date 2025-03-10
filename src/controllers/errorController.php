<?php

namespace mvc_poo\app\Controller;

use mvc_poo\Core\pagesController;

class errorController extends pagesController {

    public function __construct()
    {
        $this->titre = "Erreur";
        $this->class_page = "error";
        $this->nav_active = false;
        $this->footer_active = false;
        $this->css_files = array("framework/errorcrit");
 
        echo $this->generer(
            array(
                "contentView" => $this->setTemplate('error'),
        ));
    }
}