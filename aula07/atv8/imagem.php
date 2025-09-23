<?php
include_once 'impressora.php';
abstract class Imagem extends Impressora {
    
    public function imprimir($conteudo) {
        return "Imagem: " . $conteudo;
    }
}

?>