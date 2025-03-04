<?php

namespace mvc_poo\app\Controller;

use mvc_poo\Core\pagesController;

class notFoundController extends pagesController {

    public function __construct()
    {
        $this->titre = "Erreur 404 - Page non trouvée";
        $this->class_page = "error404";

        echo $this->generer(
            array(
                "contentView" => $this->setTemplate('not-found')
        ));
    }
}