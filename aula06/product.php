//Desenvolva uma classe Produto com atributo privado preco. Crie métodos getPreco e setPreco, validando que o preço não pode ser negativo.

<?php

class Product{
    
    private $price;

    public function __construct($price){
        $this->price = $price;
    }

    public function getPrice(){
        if($this->price > 0)
            return "Price: $this->price";
        else
            return "The product does not exist";
    }

    public function setPrice($new_price){
        if($new_price > 0){
            $this->price = $new_price;
            return "The price has been changed successfully";
        }else{
            return "The price is negative. Please enter a valid price;";
        }
    }
}

?>