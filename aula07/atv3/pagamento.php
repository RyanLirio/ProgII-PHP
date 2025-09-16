<?php

abstract class Pagamento{

    abstract public function processar($_valor, $_tempoDeAprovacao);
}
?>