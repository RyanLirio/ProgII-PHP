<?php
require_once 'Funcionario.php';
class Gerente extends Funcionario
{

    public function __construct($nome, $cargo, $salario)
    {
        parent::__construct($nome, $cargo, $salario);
    }

    public function getSalario(){
        return $this->salario;
    }
    public function setSalario($salario){
        $this->salario = $salario;
    }
}

$gerente1 = new Gerente("Ryan", "Gerente de TI", 5000);
$gerente1->setSalario(6000);
echo "Salário do gerente: " . $gerente1->getSalario();

?>