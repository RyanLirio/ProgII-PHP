<?php

class Usuario
{
    private $senha;

    public function __construct($senha){
        $this->senha = $senha;
    }

    public function verificarSenha($senhaDigitada){
        if($this->senha == $senhaDigitada){
            return "Acesso permitido";
        } else {
            return "Acesso negado";
        }
        
    }
}

$usuario1 = new Usuario("12345678");
$senhaDigitada = "1234567810";
echo $usuario1->verificarSenha($senhaDigitada);