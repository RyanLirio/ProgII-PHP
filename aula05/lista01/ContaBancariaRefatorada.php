<?php

class ContaBancariaRefatorada
{

    private $proprietario;
    private $saldo = 0;

    private function __construct($proprietario, $saldo)
    {
        $this->proprietario = $proprietario;
        $this->saldo = $saldo;
    }
    protected function depositar($valor){
        $this->saldo += $valor;
    }
    protected function sacar($valor){
        if($valor <= $this->saldo){
            $this->saldo -= $valor;
        }
        else{
            echo "Saldo insuficiente";
        }
    }
}