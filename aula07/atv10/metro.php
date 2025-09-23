<?php
include_once 'transporte.php';
class Metro extends Transporte {
    public function calcularTarifa($distancia) {
        return 5.00; 
    }
}

?>