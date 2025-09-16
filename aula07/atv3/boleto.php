<?php

require_once 'pagamento.php';

class Boleto extends Pagamento{

    private float $_valor = 100;
    private float $_tempoDeAprovacao = 48;


    public function processar($_valor, $_tempoDeAprovacao){
        echo "O valor de $_valor está sendo processado. Tempo de aprovação: " . ($_tempoDeAprovacao) . " horas.";
    }
}

?>