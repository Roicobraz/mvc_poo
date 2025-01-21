<?php 
namespace MVC_POO\Core;

class autoloader{

/**
 * Enregistre notre autoloader
 */
static function register(){
    spl_autoload_register(array(__CLASS__, 'autoload'));
}

/**
 * Inclue le fichier correspondant à notre classe
 * @param $class string Le nom de la classe à charger
 */
static function autoload($class){
    $class = str_replace(__NAMESPACE__. '\\','',$class);
    $class = str_replace('\\','/',$class); 
    if(file_exists(__DIR__ . '/' . $class . '.php')){
        require __DIR__ . '/' . $class . '.php'; 
    }
}

}