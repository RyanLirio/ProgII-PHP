<?php
include_once 'veiculo.php';
class Carro extends Veiculo {
    public function mover() {
        return "O carro está andando na estrada.";
    }
}

?>