<?php
require_once 'notificacao.php';

class Email extends Notificacao{
    private $mensagem;

    public function enviar($mensagem){
        echo $mensagem;
    }

}

?>