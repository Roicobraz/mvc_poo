<?php
namespace mvc_poo\Core\FG;

use mvc_poo\Core\FG\FormField;

class Form {
    private string $enctype;
    
    protected string $method = "POST";
    protected string $action = "";
    protected array $fields;

    public function __construct(string $method="", string $action="")
    {
        if(!empty($method)){ $this->method = $method; }
        if(!empty($action)){ $this->action = $action; }
    }

    private function renderFields(): string {
        $html_fields = "";
        foreach($this->fields as $field)
        {
            $html_fields .= $field->render();
        }
        
        return $html_fields;
    }

    public function render(): string {
        $content = "<form method={$this->method} action='{$this->action}'>
            {$this->renderFields()}
        </form>";
        
        return $content;
    }

    /**
     * Remplir les données dans les formulaire à partir d'un tableau associatif
     */
    public function hydrate(array $data): void {
        foreach($data as $key => $value) {
            if(array_key_exists($key, $this->fields))
            {
                $this->fields[$key]->setValue($value);
            }
        }
    }

    public function addField(FormField $field): self {
        $this->fields[$field->getName()] = $field; 

        return($this);
    }

    public function __toString(): string
    {
        return $this->render();
    }
    
    /**
     * Formulaire par défaut de connexion
     */
    function connection(): self
    {
        $this
            ->addField(new FormField("id", "Identifiant"))
            ->addField(new FormField("pwd", "Mot de passe", "password"));

        return($this);
    }

    /**
     * Formulaire par défaut de contact
     */
    function contact()
    {

    }

    /**
     * Formulaire par défaut de recherche
     */
    function search()
    {

    }

    /**
     * Formulaire par défaut de filtres
     */
    function filters()
    {

    }
}