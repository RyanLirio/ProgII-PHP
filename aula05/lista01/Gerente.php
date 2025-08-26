<?php

class Gerente extends Funcionario
{

    public function __construct($salario)
    {
        parent::__construct($salario);
    }

    public function getSalario(){
        return $this->salario;
    }
    public function setSalario($salario){
        $this->salario = $salario;
    }
}