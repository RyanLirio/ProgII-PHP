<?php
include_once 'mensagem.php';
class Capitalizado extends Mensagem {
    public function formatar($texto) {
        return ucwords(strtolower($texto));
    }
}


?>