<?php

class Conta {
    private $ativo = false;
    private $saldo = 0;
    private $titular = "";
    private $numero_conta;

    function __construct($titular, $saldo_inicial = 0) {
        $this->titular = $titular;
        $this->saldo = $saldo_inicial;
        $this->ativo = true;
        $this->numero_conta = rand(1000, 9999);
    }

    public function depositar($valor) {
        if ($this->ativo && $valor > 0) {
            $this->saldo += $valor;
            return true;
        }
        return false;
    }

    public function sacar($valor) {
        if ($this->ativo && $valor > 0 && $valor <= $this->saldo) {
            $this->saldo -= $valor;
            return true;
        }
        return false;
    }

    public function getSaldo() {
        return $this->saldo;
    }

    public function getTitular() {
        return $this->titular;
    }

    public function getNumeroConta() {
        return $this->numero_conta;
    }

    public function isAtiva() {
        return $this->ativo;
    }

    public function fecharConta() {
        if ($this->saldo == 0) {
            $this->ativo = false;
            return true;
        }
        return false;
    }

    public function criar_conta($titular, $saldo_inicial = 0) {
        if ($titular->nome_sujo) {
            return "Não é possível criar conta para titular com nome sujo";
        }

        if (!class_exists('Conta')) {
            return "Erro: Classe Conta não encontrada";
        }

        return new Conta($titular->nome, $saldo_inicial);
    }
}