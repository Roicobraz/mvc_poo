<?php
namespace mvc_poo\Core\FG;

class FormField {
    private string $type;
    private string $name;
    private string $label = '';
    private string $options = '';
    private string $value = "";
    private string $id;

    private string $input;

    public function __construct(string $name, string $label="", string $type="text", string $id="", string $value="")
    {
        $this->type = $type;
        $this->name = $name;
        if(!empty($label))
        {
            $this->label = $label;
        }
        $this->setValue($value);
        $this->setId($id);
    }

    public function setId(string $id) {
        $this->id = $id;
    }

    public function getId(): string {
        return $this->id;
    }

    public function setValue(string $value) {
        if(!empty($value))
        {
            $this->value = $value;
        }
    }
    
    public function getValue(): string {
        return $this->value;
    } 
    
    public function getName(): string {
        return $this->name;
    }

    public function render(): string {
        $content = "";
        if(!empty($this->label))
        {
            $content .= "<label for='{$this->name}'>{$this->label}</label>";
        }
        
        $content .= "<input type='{$this->type}' name='{$this->name}' id='{$this->getId()}'";
        if(empty($this->getValue()))
        {
            $content .= ">";
        }
        else
        {
            $content .= "value='{$this->getValue()}'>";
        }
        
        return $content;
    }
}