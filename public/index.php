<?php
// définition du lien du site
define("URL", 'http://localhost:8080/mvc_poo');

// Définit que le site est en développement
define("IN_DEV", true);

// Constantes necessaire au framework
define("ROOT_PATH", dirname(__DIR__));
define("CONFIG_PATH", ROOT_PATH."/src/config/");
define("ASSETS_PATH", ROOT_PATH."/src/assets/");
define("MODEL_PATH", ROOT_PATH."/src/models/");
define("VIEW_PATH", ROOT_PATH."/src/views/");
define("CONTROLLER_PATH", ROOT_PATH."/src/controllers/");

// Vérification de la version de PHP
if(phpversion() != '8.2.27' && IN_DEV)
{
    echo "<code>Attention votre version de PHP est ".phpversion().", ce framework a été développé en 8.2.27. <br>
    Ce framework pourrait contenir des bugs voir ne pas fonctionner.<br>
    Veuillez changer de version du langage ou attendre la vérification de compatibilté.</code>";
}

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
if(IN_DEV) {
    echo($GLOBALS['error']->displayError());
}
?>