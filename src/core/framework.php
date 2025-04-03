<?php

namespace mvc_poo\Core;

require ROOT_PATH. "/src/core/autoloader.php";

use Exception;
use mvc_poo\Core\autoloader;

class framework {
    public function __construct() {     
        /**
         * initialisation de l'autoloader
         */
        autoloader::register(); 
        
        // Vérification de la version de PHP
        if( IN_DEV && (phpversion() < '8.2.12' || phpversion() > '8.2.27') )
        {
            echo "<code>Attention votre version de PHP est ".phpversion().". <br>
            Ce framework pourrait contenir des bugs voir ne pas fonctionner.<br>
            Veuillez changer de version du langage ou attendre la vérification de compatibilté.</code>";
        }

        // définition de la connexion à la bd
        $pdo = $this->getPDO(
            "mysql:host=localhost;dbname=mvc_poo;charset=utf8",
            "root", ""
        );

        define("_getPDO_", $pdo);
    }

    /**
     * intancie la classe correspondant à la route dans la table de routage 
     */
    public function getController(string $route, array $routeMap){
        $route = str_replace('public', '', $route);

        // La route est-elle référencée
        try{
            if(!array_key_exists($route, $routeMap)) { 
                $controller = "notFoundController.php";
                throw new \Exception('Route non trouvé.');          
            }
            else
            {
                // récupération du controler en fonction de la route
                $controller = $routeMap[$route];
                
                // Le controller existe-t-il ?
                if(! file_exists(CONTROLLER_PATH . $controller))
                {
                    $controller = "errorController.php";
                    throw new \Exception('Controlleur inconnue.');
                }
            }
        } catch (\Exception $e){
            $GLOBALS['critical_error'] = $e;
        }
        require CONTROLLER_PATH . $controller;
        $this->checkClass($controller);
    }

    private function checkClass(string $controller)
    {
        // Construction du nom complet de la classe avec son namespace
        $nomClasseComplet = "mvc_poo\\app\\Controller\\" . str_replace('.php', '', $controller);
        try{
            // Instanciation dynamique de la classe
            if (class_exists($nomClasseComplet)) {
                $objet = new $nomClasseComplet();
                return $objet;
            } else {
                throw new \Exception("La classe $nomClasseComplet n'existe pas.");
            }  
        } catch (\Exception $e){ 
            $GLOBALS['critical_error'] = $e;
            require CONTROLLER_PATH . 'errorController.php';
            $this->checkClass('errorController.php');
        }
    }

    private function getPDO(string $dsn, string $user, string $pass): \PDO{
        return new \PDO (
            $dsn,
            $user,
            $pass,
            [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
        );
    }
}