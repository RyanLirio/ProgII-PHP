<?php

require_once 'pagamento.php';

class Pix extends Pagamento{

    private float $_valor = 100;
    private float $_tempoDeAprovacao = 0.25;


    public function processar($_valor, $_tempoDeAprovacao){
        echo "O valor de $_valor está sendo processado. Tempo de aprovação: " . ($_tempoDeAprovacao * 60) . " minutos.";
    }
}

?>