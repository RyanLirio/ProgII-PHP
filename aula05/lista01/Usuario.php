<?php

class Usuario
{
    private $senha;

    public function __construct($senha){
        $this->senha = $senha;
    }

    public function verificarSenha($senhaDigitada){
        return $this->senha == $senhaDigitada;
    }
}

$usuario1 = new Usuario("12345678");
$senhaDigitada = "12345678";
echo verificarSenha($senhaDigitada);