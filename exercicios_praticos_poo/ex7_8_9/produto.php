<?php

class Produto{
    public static $produtos = [];
    private $nome;
    private $preco;
    private $quantidade;

    public function __construct($nome, $preco, $quantidade){
        $this->nome = $nome;
        $this->preco = $preco;
        $this->quantidade = $quantidade;
        self::$produtos[] = $this;
    }

    public function valorTotal(){
        $valortotal = $this->preco * $this->quantidade;
        return "O valor total de $this->nome é R$$valortotal";
    }

    public function exibirDetalhes(){
        return "Produto: $this->nome | Preço: $this->preco | Estoque: $this->quantidade";
    }

    
}


?>