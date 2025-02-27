<?php 

namespace mvc_poo\Core;

use Exception;

class errors {
    public array $errors = [];

    /**
     * Ajoute un tableau qui resence le fichier la ligne et le message de l'erreur
     */
    public function addError(Exception $error): void
    {
        $test =
        [
            "file" => $error->getFile(),
            "line" => $error->getLine(),
            "message" => $error->getMessage()
        ];

        array_push($this->errors, $test);
    }
}