<?php

    class User{
        public $users = [];
        public $name;
        public $email;
        public $years;
        

        public function __construct($name, $email, $years){
            $this->name = $name;
            $this->email = $email;
            $this->years = $years;
            
        }

        public function exibirDados($n, $e, $y){
            return "Nome: $n, Email: $e, idade: $y";
        }

        public function ehMaiorDeIdade(){
            if ($this->years >= 18)
                return "Maior de idade. Já pode ser preso";
            else
                return "Cê é menor de idade, vá estudar rapaz"; 
        }
    }

    $user1 = new User("ryan2", "ryanlirio2@gmail.com", "19");

   

    echo $user1->exibirDados("ryan2", "ryanlirio2@gmail.com", "19");
    echo "<br>";
    echo $user1->ehMaiorDeIdade();
    
?>
    
