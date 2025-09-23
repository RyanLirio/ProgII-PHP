<?php
include_once 'impressora.php';
abstract class Texto extends Impressora {
    
    public function imprimir($conteudo) {
        return "Texto: " . $conteudo;
    }
}

?>