<?php

class Pessoa{
    private $nome = "";
    private $idade = 0;
    public function __construct($nome, $idade){
        $this->nome = $nome;
        $this->idade = $idade;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getIdade(){
        return $this->idade;
    }

    public function apresentar(){
        return "Olá, meu nome é {$this->nome}! Eu tenho {$this->idade} anos.";
    }

    public function aniversario(){
        $this->idade += 1;
    }
}

$pessoa1 = new Pessoa("Ryan", 19);
$pessoa1->aniversario();
echo $pessoa1->apresentar();
?>