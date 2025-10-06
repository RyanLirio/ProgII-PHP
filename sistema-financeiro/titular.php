<?php

class titular {
    public $nome;
    private $cpf_titular;
    public $nome_sujo;
    private $data_nascimento;

    public function __construct($nome, $cpf_titular, $nome_sujo = false, $data_nascimento = null) {
        $this->nome = $nome;
        $this->cpf_titular = $cpf_titular;
        $this->nome_sujo = $nome_sujo;
        $this->data_nascimento = $data_nascimento;
    }

    public function getCpf() {
        return $this->cpf_titular;
    }

    public function getDataNascimento() {
        return $this->data_nascimento;
    }

    public function limparNome() {
        $this->nome_sujo = false;
        return "Nome do titular {$this->nome} foi limpo";
    }
}
?>