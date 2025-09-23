<?php
include_once 'impressora.php';
abstract class Pdf extends Impressora {
    
    public function imprimir($conteudo) {
        return "PDF: " . $conteudo;
    }
}

?>