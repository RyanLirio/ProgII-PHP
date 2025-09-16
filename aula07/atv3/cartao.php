<?php

require_once 'pagamento.php';

class Cartao extends Pagamento{

    private float $_valor = 100;
    private float $_tempoDeAprovacao = 2.5;

    public function processar($_valor, $_tempoDeAprovacao){
        echo "O valor de $_valor está sendo processado. Tempo de aprovação: $_tempoDeAprovacao.";
    }
}

?>