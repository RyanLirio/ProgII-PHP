<?php
include_once 'transporte.php';
class Onibus extends Transporte {
    public function calcularTarifa($distancia) {
        return 4.50; 
    }
}

?>