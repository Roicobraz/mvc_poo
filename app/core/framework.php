<?php

namespace MVC_POO\Core;

require ROOT_PATH. "/core/autoloader.php";

use Exception;
use MVC_POO\app\models\userModel;
use MVC_POO\Core\autoloader;

class framework {

    public function __construct(string $dsn = '', string $user = '', string $pass = '')
    {
        /**
         * Connexion à la base de donnée
         */
        if(!empty($dsn) && !empty($user) && !empty($pass))
        {
            $pdo = $this->getPDO($dsn, $user, $pass);
            define("_getPDO_", $pdo);
        }
        else
        {
            define("_getPDO_", new Exception('<code>La connexion à la base de donnée n\'a pas été initialisé</code>'));
        }
        
        /**
         * initialisation de l'autoloader
         */
        autoloader::register(); 
    }

    /**
     * Retourne un nom de fichier php correspondant à un contrôleur
     * en fonction d'une route et d'une table de routage 
     */
    public function getController(string $route, array $routeMap): string{
        $route = str_replace('app/public', '', $route);

        // La route est-elle référencée
        if(!array_key_exists($route, $routeMap)) {
            $user = new userModel;
            if(get_class(_getPDO_) != 'Exception' && function_exists('isUserAuthenticated') && $user->isUserAuthenticated())
            {
                $routeMap = require CONFIG_PATH . "private_routes.php";
                require CONTROLLER_PATH . $this->getController($route, $routeMap);
            }
            
            return "notFoundController.php";
        }

        // récupération du contrôleur en fonction de la route
        $controller = $routeMap[$route];

        // Le controleur existe-t-il ?
        if(! file_exists(CONTROLLER_PATH . $controller)){
            return "notFoundController.php";
        }

        return $controller;
    }

    /**
     * connexion à la base de données
     */
    public function getPDO(string $dsn, string $user, string $pass): \PDO {
        return( new \PDO (
            $dsn,
            $user,
            $pass,
            [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
        ));
    }
}