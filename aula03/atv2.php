<?php

class Aluno{
    public $nome;
    public $media;

    public function __construct($nome, $media){
        $this->nome = $nome;
        $this->media = $media;
    }

    public function verificarAprovacao(){
        if($media > 6.9)
            echo "$this->nome | $this->media | Aprovado"."<br>";
        else   
            echo "$this->nome | $this->media | Reprovado"."<br>";
    }
}
$aluno1 = new Aluno("Ana", 8.5);

$aluno2 = new Aluno("Pedro", 6.0);

$aluno1->verificarAprovacao();
$aluno2->verificarAprovacao();

?>