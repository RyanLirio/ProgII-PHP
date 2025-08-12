<?php
class Carro{

    public $marca;
    public $ano;
    public $cor;

    public function __construct($marca, $ano, $cor){
        $this->marca = $marca;
        $this->ano = $ano;
        $this->cor = $cor;
    }

    public function exibirInformacoes(){
        echo "Marca: {$this->marca} | Ano: {$this->ano} | Cor: {$this->cor}";
    }
}

$carro1 = new Carro("Fiat", 1997, "Vermelho");

$carro1->exibirInformacoes();

?>