<?php
// définition du lien du site
define("URL", 'http://localhost:8080/mvc_poo');

define("ROOT_PATH", dirname(__DIR__));
define("CONTROLLER_PATH", ROOT_PATH."/src/controllers/");
define("CONFIG_PATH", ROOT_PATH."/src/config/");
define("VIEW_PATH", ROOT_PATH."/src/views/");

// TODO
// define("MODEL_PATH", ROOT_PATH."/models/");

// Appel des assets
define("ASSETS_PATH", ROOT_PATH."/src/assets/");
require_once("../src/assets/assets.php");

// Inclusion du framework
require ROOT_PATH. "/src/core/framework.php";
use mvc_poo\Core\framework;
$controller = new framework();

// Gestion des erreurs
use mvc_poo\Core\errors;
$GLOBALS['error'] = new errors;

// routage
if(filter_input(INPUT_GET, "route") == null)
{  $route = "/accueil"; }
else 
{ $route = filter_input(INPUT_GET, "route"); }
$routeMap = require CONFIG_PATH . "routes.php";

$controller->getController($route, $routeMap);

print_r($GLOBALS['error']->errors);
?>