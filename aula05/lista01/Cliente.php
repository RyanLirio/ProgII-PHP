<?php

class Cliente
{
    public $nome;
    protected $cpf;
    private $telefone;

    public function __construct($nome, $cpf, $telefone){
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->telefone = $telefone;
    }

    public function exibirCliente(){
        return "Nome: $this->nome, CPF: $this->cpf, Telefone: $this->telefone";
    }


}

$cliente1 = new Cliente("Ryan", "12345678910", "12345678910");
//echo $cliente1; Não funciona, pois existem atributos protegidos e privados
echo $cliente1->exibirCliente();