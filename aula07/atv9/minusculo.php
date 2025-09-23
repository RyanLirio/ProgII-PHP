<?php
include_once 'mensagem.php';
class Minusculo extends Mensagem {
    public function formatar($texto) {
        return strtolower($texto);
    }
}

?>