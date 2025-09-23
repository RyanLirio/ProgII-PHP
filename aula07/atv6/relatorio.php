<?php
class Relatorio {
    
    public function __call($nomeMetodo, $argumentos) {
        if ($nomeMetodo === 'gerar') {
            switch (count($argumentos)) {
                case 0:
                    return "Relatório geral gerado!";
                case 1:
                    return "Relatório do setor: {$argumentos[0]}";
                case 2:
                    return "Relatório do setor: {$argumentos[0]} no período {$argumentos[1]}";
                default:
                    return "Número de parâmetros não suportado para gerar relatório.";
            }
        }
        return "Método {$nomeMetodo} não existe.";
    }
}

$rel = new Relatorio();
echo $rel->gerar();                  
echo $rel->gerar("Financeiro");      
echo $rel->gerar("Vendas", "2025");  
