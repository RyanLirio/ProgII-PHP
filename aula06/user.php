// Crie uma classe Usuario com atributo privado senha. Implemente um método verificarSenha($senhaDigitada) que retorna verdadeiro ou falso.

<?php

class User{
    private $senha;
    
    public function __contruct($senha){
        $this->senha = $senha;
    }

    public function verificarSenha($senhaDigitada){
        if($senhaDigitada = "123"){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
?>