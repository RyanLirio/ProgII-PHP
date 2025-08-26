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