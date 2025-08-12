<?php

    class ContaBancaria{
        public $titular;
        public $saldo;
        public $valor;

        public function __construct($titular, $saldo){
            
            $this->titular = $titular;
            $this->saldo = $saldo;
        }
    

        public function depositar($valor){
            $this->valor = $valor;
            $this->saldo += $this->valor;
            echo "R$$this->valor foi adicionado a sua conta! Agora o seu saldo é de R$$this->saldo."."<br><br>";
        }

        public function sacar($valor){
            $this->valor = $valor;
            if($this->valor < $this->saldo){    
                $this->saldo -= $valor;
                echo "R$$this->valor foi retirado a sua conta! Agora o seu saldo é de R$$this->saldo."."<br><br>";
            }else{
                echo "Saldo insuficiente. Seu saldo atual é de R$$this->saldo."."<br><br>";
            }
        }
    }

    $conta1 = new ContaBancaria("Ryan Lirio", 11000,00);
    
    $conta1->sacar(12000,00);
    $conta1->depositar(1001,00);
    $conta1->sacar(12000,00);

?>