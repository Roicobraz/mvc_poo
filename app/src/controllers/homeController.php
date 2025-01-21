<?php

namespace MVC_POO\app\controller;

class homeController {

    public function __construct()
    {
        $contentView = VIEW_PATH. "home.php";
        require VIEW_PATH . "layout.php";
    }

}