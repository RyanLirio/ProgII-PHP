<?php

class Calculadora{

    public function somar($a, $b = null, $c = null) {
        if ($c !== null) {
            return $a + $b + $c; 
        } elseif ($b !== null) {
            return $a + $b; 
        }
        else{
            return $a;
        }
    }

}

?>