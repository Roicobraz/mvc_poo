<?php 

namespace mvc_poo\Core;

use Exception;

class errors {
    private array $arrayErrors = [];
    private string $positionError = "top-right";

    public function __construct(string $position = "")
    {
        if($position != "")
        {
            $this->positionError = $position;
        }
    }

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

        array_push($this->arrayErrors, $test);
    }

    public function displayError(): string
    {
        if(str_contains($this->positionError, 'left'))
        {
            $position = 'close_left';
        }
        else if(str_contains($this->positionError, 'right'))
        {
            $position = 'close_right';
        }

        if(!empty($this->arrayErrors))
        {
            $background = "bg-error";
            $errors = $this->displayArray($position);
        }
        else
        {
            $background = "bg-success";
            $errors = "";
        }

        $block_error = "
            <div id='error'>
                {$this->taskbar($this->positionError, $background)}
                {$errors}
            </div>
            <script src='".URL."/js/framework/error.js' crossorigin='anonymous'></script>
        ";

        return($block_error);
    }

    public function displayArray(string $cross_position)
    {
        $titles = '<tr>
        <th>Message d\'erreur</th>
        <th>Fichier</th>
        <th>Ligne</th>
        </tr>';

        $code_html = "
        <div id='arrayerror' class='d-none'>
        <div id='closeerror' class='$cross_position'><span>&#10006;</span></div>
        <h2>Erreurs</h2>
        <table>
            <thead>
                $titles
            </thead>
            <tbody>";
        foreach($this->arrayErrors as $error)
        {
            $code_html .= 
                "<tr>
                    <td>{$error['message']}</td>
                    <td>{$error['file']}</td>
                    <td>{$error['line']}</td>
                </tr>";
        }
        $code_html .= "
            </tbody>
            <tfoot>
                $titles
            </tfoot>
        </table>
        </div>";

        return ($code_html);
    }

    public function taskbar(string $position, string $state)
    {
        $code_html = "
        <div id='taskerror' class='$position'>
            &#9888;
            <span class='$state'>".count($this->arrayErrors)."</span>
        </div>";

        return($code_html);
    }

    public function getArrayErrors(): array
    {
        return $this->arrayErrors;
    }
}