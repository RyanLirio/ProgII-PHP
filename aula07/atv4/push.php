<?php
require_once 'notificacao.php';

class Push extends Notificacao{
    private $mensagem;

    public function enviar($mensagem){
        echo $mensagem;
    }

}

?>