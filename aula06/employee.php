//Desenvolva uma classe Funcionario com atributo protegido salario. Crie uma subclasse Gerente que permita definir bônus, alterando o valor do salário.

<?php

class Employee{

    protected $wage;
     
    public function __construct($wage){
        $this->wage = $wage;
    }

}

?>