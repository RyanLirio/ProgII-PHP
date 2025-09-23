<?php
include_once 'transporte.php';
class Taxi extends Transporte {
    public function calcularTarifa($distancia) {
        return 3.00 + ($distancia * 2.50); 
    }
}

?>