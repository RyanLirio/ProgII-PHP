//Crie uma classe ContaBancaria com atributo privado saldo. Implemente métodos
//depositar e sacar, garantindo que o saldo nunca fique negativo.
<?php
session_start();

class ContaBancaria{

    private $saldo;


    public function __construct($saldo){
        $this->saldo = $saldo;
    }

    public function sacar($valor_a_retirar){
        if($this->saldo > $valor_a_retirar){
            $this->saldo -= $valor_a_retirar;
            return "O total de R$ $valor_a_retirar foi debitado da sua conta. O saldo atual é de R$$this->saldo.";
        }else{
            return "Saldo insuficiente. O saldo atual é de R$$this->saldo.";
        }
    }

    public function depositar($valor_a_adicionar){
        if($valor_a_adicionar > 0){
            $this->saldo += $valor_a_adicionar;
            return "O total de R$ $valor_a_adicionar foi adicionado em sua conta. O saldo atual é de R$$this->saldo.";
        }else{
            return "Insira um valor válido.";
        }
    }

}


?>