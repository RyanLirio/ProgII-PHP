<?php

class agente {
    private $id_agente;
    private $nome;
   
    public function __construct($id_agente, $nome) {
        $this->id_agente = $id_agente;
        $this->nome = $nome;
    }

    public function consultar_nome_sujo($titular) {
        if ($titular->nome_sujo) {
            return "A conta não pode ser criada - titular possui nome sujo";
        } else {
            return "Titular aprovado para criação de conta";
        }
    }

    public function criar_conta($titular, $saldo_inicial = 0) {
        if ($titular->nome_sujo) {
            return false; // Adicione esta linha
        }
        return new Conta($titular->nome, $saldo_inicial);
    }

    public function getNome() {
        return $this->nome;
    }

    public function getId() {
        return $this->id_agente;
    }

    public function excluirTitular($nome) {
        foreach ($_SESSION['titulares'] as $key => $titular) {
            if ($titular->nome == $nome) {
                // Excluir todas as contas associadas ao titular
                foreach ($_SESSION['contas'] as $c_key => $conta) {
                    if ($conta->getTitular() == $titular->nome) {
                        unset($_SESSION['contas'][$c_key]);
                    }
                }
                unset($_SESSION['titulares'][$key]);
                return true;
            }
        }
        return false;
    }

    public function excluirConta($numero_conta) {
        foreach ($_SESSION['contas'] as $key => $conta) {
            if ($conta->getNumeroConta() == $numero_conta)  {
                // Excluir o titular associado à conta
                $titular_nome = $conta->getTitular();
                foreach ($_SESSION['titulares'] as $t_key => $titular) {
                    if ($titular->nome == $titular_nome) {
                        unset($_SESSION['titulares'][$t_key]);
                        break;
                    }
                }
                unset($_SESSION['contas'][$key]);
                return true;
            }
        }
        return false;
    }

    public function limparNomeTitular($titular) {
        if ($titular->nome_sujo) {
            $titular->limparNome();
            return "Agente {$this->nome} limpou o nome do titular {$titular->nome}";
        }
        return "O titular {$titular->nome} já possui nome limpo";
    }

}