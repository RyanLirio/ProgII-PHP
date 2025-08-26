<?php

class Cliente
{
    public $nome;
    protected $cpf;
    private $telefone;

    private function __construct($nome, $cpf, $telefone){
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->telefone = $telefone;
    }

}