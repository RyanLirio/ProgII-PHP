<?php

require_once 'produto.php'; // Importa a classe Produto


$produto1 = new Produto("Café", 1000.0, 3);
$produto2 = new Produto("agua", 1.0, 30);
$produto3 = new Produto("Leite", 10.0, 5);

foreach (Produto::$produtos as $p) {
    echo $p->exibirDetalhes();
    echo "<br>";
    echo $p->valorTotal();
    echo "<br>";
    echo "<br>";
}




?>