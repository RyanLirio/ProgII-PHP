<?php

class Funcionario
{
    protected $nome;
    protected $cargo;
    protected $salario;
     protected function __construct($nome, $cargo, $salario)
     {
         $this->salario = $salario;
         $this->cargo = $cargo;
         $this->nome = $nome;
     }
}