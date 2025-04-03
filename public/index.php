<?php
// définition du lien du site
define("URL", 'http://localhost/dev_web/mvc_poo');

// Définit que le site est en développement
define("IN_DEV", true);

// Constantes necessaire au framework
define("ROOT_PATH", dirname(__DIR__));
define("CONFIG_PATH", ROOT_PATH."/src/config/");
define("ASSETS_PATH", ROOT_PATH."/src/assets/");
define("MODEL_PATH", ROOT_PATH."/src/models/");
define("VIEW_PATH", ROOT_PATH."/src/views/");
define("CONTROLLER_PATH", ROOT_PATH."/src/controllers/");

// Appel des assets
require_once("../src/assets/assets.php");

// Inclusion du framework
require ROOT_PATH. "/src/core/framework.php";
use mvc_poo\Core\framework;
$controller = new framework();

// Gestion des erreurs 
use mvc_poo\Core\errors;
$GLOBALS['error'] = new errors("top-right");

// routage
if(filter_input(INPUT_GET, "route") == null)
{  $route = "/accueil"; }
else 
{ $route = filter_input(INPUT_GET, "route"); }
$routeMap = require CONFIG_PATH . "routes.php";

$controller->getController($route, $routeMap);

// Affichage des erreurs
if(IN_DEV && !empty($GLOBALS['error']->getArrayErrors())) {
    echo($GLOBALS['error']->displayError());
}
?>