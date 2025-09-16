<?php

abstract class Animal{
    protected $_especie; 
    protected $raca;
    protected int $_idade;
    protected float $_peso;
    protected $_som;


    public function __construct($_especie, $raca, $_idade, $_peso, $_som){
        $this->_especie = $_especie;
        $this->_raca = $_raca;
        $this->$_idade;
        $this->$_peso = $_peso;
        $this->$_som = $_som;
    }

    abstract public function falar($_som);
    
}

?>