<?php
include_once 'mensagem.php';
class Maiusculo extends Mensagem {
    public function formatar($texto) {
        return strtoupper($texto);
    }
}
?>