<?php

    class Product{
        
        public $name;
        public $price;
        public $discount;
        public $total;

        public function __construct($name, $price, $discount){
            $this->name = $name;
            $this->price = $price;
            $this->discount = $discount;
        }

        public function final_price(){

            
            return $this->total = $this->price-($this->price*$this->discount);
        }
    }

    $banco = new Product("Banco de Carvalho", "199.90", "0.3");

   

    echo $banco->final_price();
    echo'br';
    echo $banco->name;

?>
    
