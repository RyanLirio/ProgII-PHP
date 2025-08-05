<?php

class Pessoa{
    public $nome = "";
    public $idade = 0;
    public function __construct($nome, $idade){
        $this->nome = $nome;
        $this->idade = $idade;
    }

    public function apresentar(){
        return "Olá, meu nome é {$this->nome}! Eu tenho {$this->idade} anos.";
    }
}

$pessoa1 = new Pessoa("Ryan", 19);
echo $pessoa1->apresentar();
?>