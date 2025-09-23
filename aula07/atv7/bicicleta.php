<?php
include_once 'veiculo.php';
class Bicicleta extends Veiculo {
    public function mover() {
        return "A bicicleta está sendo pedalada.";
    }
}

?>