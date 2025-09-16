<?php
require_once 'notificacao.php';

class Sms extends Notificacao{
    private $mensagem;

    public function enviar($mensagem){
        echo $mensagem;
    }

}

?>