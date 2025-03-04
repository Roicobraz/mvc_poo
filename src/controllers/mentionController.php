<?php

namespace mvc_poo\app\Controller;

use mvc_poo\Core\pagesController;

class mentionController extends pagesController {

    public function __construct()
    {
        $this->titre = "Mentions légales";
        $this->class_global = "Legal_notices";
        
        echo $this->generer(
            array(
                "contentView" => $this->setTemplate('mentionsleg')
        ));
    }
}