<?php
require_once 'animal.php';

class Gato extends Animal{

    public function __construct($_especie, $_raca, $_idade, $_peso, $_som){
        parent::__construct($_especie, $_raca, $_idade, $_peso, $_som);
    }

    public function falar($_som){
        echo $_som;
    }
}

?>