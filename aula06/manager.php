//Desenvolva uma classe Funcionario com atributo protegido salario. Crie uma subclasse Gerente que permita definir bônus, alterando o valor do salário.

<?php
require_once 'employee.php';
class Manager extends Employee{
    
    public function __construct($wage){
        parent::__construct($wage);
    }

    public function setBonusWage($bonusWage){
        if($bonusWage > 0){
            $this->wage = $bonusWage;
            echo "US$$bonusWage was added to your wage. Wage has been changed successfully.";
        }else{
            echo "The bonus can't be negative. Enter a valid bonus.";
        }
    }
}

?>