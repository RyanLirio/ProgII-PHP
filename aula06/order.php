// Crie uma classe Pedido com atributo privado itens (array). Implemente métodos para adicionar e listar itens do pedido.

<?php

class Order{
    private $items = [];

    public function __construct($item){
        $this->items = $items;
    }

    public function getListItems(){
        
    }

    public function setListItems($new_item){
        if(is_null($new_item)){
            array_push($this->item, $new_item);
            echo "The item has added to list";
        }else{
            echo "Can't be added to list";
        }
    }

}

?>
