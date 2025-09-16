//Implemente uma classe Cliente com atributos privados nome e cpf. Crie métodos públicos para definir e obter esses valores, validando o CPF

<?php

class Client{
    
    private $name;
    private $cpf;

    public function __construct($name, $cpf){
        $this->name = $name;
        $this->cpf = $cpf;
    }

    public function getName(){
        return $this->name;
    }


    public function setName($newName){
        if(ctype_alpha($this->name)){
            $this->name = $newName;
            echo "The name is modified. Now the name is $newName.";
        }else{
            echo "Enter with valid name.";
        }
    }


    public function getCpf(){
        echo "Cpf: $this->cpf";
    }

    public function setCpf($newCpf){
        if(strlen($this->cpf) != 11){
            $this->cpf = $newCpf;
            echo "O cpf foi alterado com sucesso.";
        }else{
            echo "Insira um cpf válido.";
        }
    }
}