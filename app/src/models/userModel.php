<?php 
namespace MVC_POO\app\models;

use MVC_POO\Core\ORM\DAO;
use MVC_POO\Core\ORM\QueryBuilder;

class userModel {
    
    public function getUserName(): string {
        if($this->isUserAuthenticated())
        {
            return $_SESSION['user']["user_name"];
        }
        return "anonyme";
    }  
    
    public function findOneUserByLogin(string $login): array {
        $dao = new DAO(_getPDO_, new QueryBuilder, "users");
        return $dao->findOneByLogin($login);
    }
    
    public function isUserAuthenticated(): bool {
        return isset($_SESSION['user']);
    }

    public function authenticateUser(string $password, array $user, array &$errors, string $redirect = "accueil"): void {
        if(password_verify($password, $user["password_hash"]))
        {  
            // on unset le password_hash pour éviter qu'on récupère le hash du mdp
            unset($user['password_hash']);
            // pour regéner la session
            session_regenerate_id(true);
            $_SESSION["user"] = $user;
            // redirection
            header("location:/$redirect");
        }
        else 
        {
            array_push($errors, "Mot de passe incorrect");         
        }
    }

    public function deconnection(): void {
        if($this->isUserAuthenticated())
        {
            // unset($_SESSION['user']);
            session_destroy();
        }
        header("Location:/accueil");
    }
}