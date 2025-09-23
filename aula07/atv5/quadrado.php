<?php
include_once 'figuraGeometrica.php';
class Quadrado extends FiguraGeometrica{
    private $base;
    private $altura;

    public function calcularArea($base = 0, $altura = 0, $raio = 0){
        return $base * $altura;
    }

}

?>