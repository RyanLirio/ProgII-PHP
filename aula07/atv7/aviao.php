<?php
include_once 'veiculo.php';
class Aviao extends Veiculo {
    public function mover() {
        return "O avião está voando no céu.";
    }
}

?>