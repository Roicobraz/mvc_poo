<?php
session_start();

define("ROOT_PATH", dirname(__DIR__));
define("CONTROLLER_PATH", ROOT_PATH."/src/controllers/");
define("CONFIG_PATH", ROOT_PATH."/src/config/");
define("VIEW_PATH", ROOT_PATH."/src/views/");
define("MODEL_PATH", ROOT_PATH."/src/models/");

// Inclusion du framework
require ROOT_PATH. "/core/framework.php";
use MVC_POO\Core\framework;
$controller = new framework("mysql:host=mysql;dbname=DB1;charset=utf8", "root", "root");

// Inclusion du modèle user
require MODEL_PATH. "userModel.php";

$route = filter_input(INPUT_GET, "route") ?? "/accueil";
$routeMap = require CONFIG_PATH . "routes.php";

require CONTROLLER_PATH . $controller->getController($route, $routeMap);
