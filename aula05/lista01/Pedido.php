<?php

class Pedido
{
    private $items = array();

    public function __construct()
    {
        $this->items = array();
    }

    public function addItem($item){
        array_push($this->items, $item);
    }
    public function getItems(){
        return $this->items;
    }
}

$pedido1 = new Pedido();
$pedido1->addItem("Produto 1");
$pedido1->addItem("Produto 2");

foreach($pedido1->getItems() as $item){
    echo $item . "<br>";
}