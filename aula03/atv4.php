<?php

    class Calculadora{
        public $num1;
        public $num2;

        public function __construct($num1, $num2){
            $this->num1 = $num1;
            $this->num2 = $num2;
        }

        public function Soma(){
            echo "O resultado da sua soma é ". $this->num1 + $this->num2;
        }

        public function Subtracao(){
            echo "<br>O resultado da sua subtração é " . $this->num1-$this->num2;
        }

        public function Multiplicacao(){
            echo "<br>O resultado da sua multiplicação é " . $this->num1*$this->num2;
        }

        public function Divisao(){
            echo "<br>O resultado da sua divisão é " . $this->num1/$this->num2;
        }
    }

    $calculo1 = new Calculadora(5,3);
    $calculo1->Soma();
    $calculo1->Subtracao();
    $calculo1->Multiplicacao();
    $calculo1->Divisao();

?>