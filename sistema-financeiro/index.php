<?php
// Adicionar essas linhas para ver erros
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// IMPORTANTE: Carregar classes ANTES da sessão
require_once 'titular.php';
require_once 'conta.php';
require_once 'agente.php';

// Agora sim iniciar a sessão
session_start();

// Inicializar arrays na sessão se não existirem
if (!isset($_SESSION['titulares'])) $_SESSION['titulares'] = [];
if (!isset($_SESSION['agentes'])) $_SESSION['agentes'] = [];
if (!isset($_SESSION['contas'])) $_SESSION['contas'] = [];

$sucesso = false;
$mensagem = "";

// Processar formulários
if ($_POST) {
    switch ($_POST['acao']) {
        case 'criar_titular':
            $titular = new titular($_POST['nome'], $_POST['cpf'], (bool)$_POST['nome_sujo']);
            $_SESSION['titulares'][] = $titular;
            $sucesso = true;
            $mensagem = "<h4>✅ Titular Criado com Sucesso!</h4>";
            $mensagem .= "<strong>Nome:</strong> {$titular->nome}<br>";
            $mensagem .= "<strong>CPF:</strong> {$titular->getCpf()}<br>";
            $mensagem .= "<strong>Status:</strong> " . ($titular->nome_sujo ? "❌ Nome Sujo" : "✅ Nome Limpo") . "<br>";
            break;
            
        case 'criar_agente':
            $agente = new agente($_POST['id'], $_POST['nome']);
            $_SESSION['agentes'][] = $agente;
            $sucesso = true;
            $mensagem = "<h4>✅ Agente Criado com Sucesso!</h4>";
            $mensagem .= "<strong>ID:</strong> {$agente->getId()}<br>";
            $mensagem .= "<strong>Nome:</strong> {$agente->getNome()}<br>";
            break;
            
        case 'criar_conta':
            $titular_encontrado = null;
            $agente_encontrado = null;
            
            foreach ($_SESSION['titulares'] as $t) {
                if ($t->nome == $_POST['titular_nome']) {
                    $titular_encontrado = $t;
                    break;
                }
            }
            
            foreach ($_SESSION['agentes'] as $a) {
                if ($a->getNome() == $_POST['agente_nome']) {
                    $agente_encontrado = $a;
                    break;
                }
            }
            
            if ($titular_encontrado && $agente_encontrado) {
                $consulta = $agente_encontrado->consultar_nome_sujo($titular_encontrado);
                $conta = $agente_encontrado->criar_conta($titular_encontrado, floatval($_POST['saldo']));
                
                if ($conta instanceof Conta) {
                    $_SESSION['contas'][] = $conta;
                    $sucesso = true;
                    $mensagem = "<h4>🎉 Conta Criada!</h4>";
                    $mensagem .= "<strong>Número:</strong> {$conta->getNumeroConta()}<br>";
                    $mensagem .= "<strong>Titular:</strong> {$conta->getTitular()}<br>";
                    $mensagem .= "<strong>Saldo:</strong> R$ " . number_format($conta->getSaldo(), 2, ',', '.') . "<br>";
                } else {
                    $mensagem = "<h4>❌ Erro:</h4> {$conta}";
                }
            } else {
                $mensagem = "<h4>❌ Erro:</h4> Titular ou Agente não encontrado!";
            }
            break;
            
        case 'limpar':
            $_SESSION['titulares'] = [];
            $_SESSION['agentes'] = [];
            $_SESSION['contas'] = [];
            $sucesso = true;
            $mensagem = "<h4>🗑️ Dados limpos!</h4>";
            break;
            
        case 'depositar':
            $numero_conta = $_POST['numero_conta'];
            $valor_deposito = floatval($_POST['valor_deposito']);
            foreach ($_SESSION['contas'] as $c) {
                if ($c->getNumeroConta() == $numero_conta) {
                    $c->depositar($valor_deposito);
                    $sucesso = true;
                    $mensagem = "<h4>✅ Depósito de R$ " . number_format($valor_deposito, 2, ',', '.') . " realizado com sucesso!</h4>";
                    break;
                }
            }
            break;

        case 'sacar':
            $numero_conta = $_POST['numero_conta'];
            $valor_saque = floatval($_POST['valor_saque']);
            foreach ($_SESSION['contas'] as $c) {
                if ($c->getNumeroConta() == $numero_conta) {
                    if ($c->sacar($valor_saque)) {
                        $sucesso = true;
                        $mensagem = "<h4>✅ Saque de R$ " . number_format($valor_saque, 2, ',', '.') . " realizado com sucesso!</h4>";
                    } else {
                        $mensagem = "<h4>❌ Erro: Saldo insuficiente para saque!</h4>";
                    }
                    break;
                }
            }
            break;
            
        case 'limpar_nome':
            $titular_nome = $_POST['titular_nome'];
            $agente_nome = $_POST['agente_nome'];
            $titular_encontrado = null;
            $agente_encontrado = null;
            
            // Buscar titular
            foreach ($_SESSION['titulares'] as $t) {
                if ($t->nome == $titular_nome) {
                    $titular_encontrado = $t;
                    break;
                }
            }
            
            // Buscar agente
            foreach ($_SESSION['agentes'] as $a) {
                if ($a->getNome() == $agente_nome) {
                    $agente_encontrado = $a;
                    break;
                }
            }
            
            if ($titular_encontrado && $agente_encontrado) {
                if ($titular_encontrado->nome_sujo) {
                    $titular_encontrado->limparNome();
                    $sucesso = true;
                    $mensagem = "<h4>✅ Agente {$agente_nome} limpou o nome do titular {$titular_nome} com sucesso!</h4>";
                } else {
                    $mensagem = "<h4>⚠️ O titular {$titular_nome} já possui nome limpo!</h4>";
                }
            } else {
                $mensagem = "<h4>❌ Erro:</h4> Titular ou Agente não encontrado!";
            }
            break;

        case 'excluir_titular':
            $titular_nome = $_POST['titular_nome'];
            foreach ($_SESSION['agentes'] as $agente) {
                if ($agente->excluirTitular($titular_nome)) {
                    $sucesso = true;
                    $mensagem = "<h4>✅ Titular {$titular_nome} e suas contas foram excluídos com sucesso!</h4>";
                    break;
                }
            }
            break;

        case 'excluir_conta':
            $numero_conta = $_POST['numero_conta'];
            foreach ($_SESSION['agentes'] as $agente) {
                if ($agente->excluirConta($numero_conta)) {
                    $sucesso = true;
                    $mensagem = "<h4>✅ Conta {$numero_conta} e seu titular foram excluídos com sucesso!</h4>";
                    break;
                }
            }
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Bancário - Dev Mode</title>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-primary: #0d1117;
            --bg-secondary: #161b22;
            --bg-tertiary: #21262d;
            --border: #30363d;
            --text-primary: #f0f6fc;
            --text-secondary: #8b949e;
            --accent-blue: #58a6ff;
            --accent-green: #3fb950;
            --accent-orange: #f85149;
            --accent-purple: #a5a5ff;
            --accent-yellow: #d29922;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            padding: 20px;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: var(--bg-secondary);
            border-radius: 12px;
            border: 1px solid var(--border);
            overflow: hidden;
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.4);
        }

        .header {
            background: linear-gradient(135deg, var(--bg-tertiary) 0%, var(--bg-secondary) 100%);
            padding: 40px;
            text-align: center;
            border-bottom: 1px solid var(--border);
            position: relative;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--accent-blue), var(--accent-green), var(--accent-purple));
        }

        .header h1 {
            font-family: 'JetBrains Mono', monospace;
            font-size: 2.5em;
            font-weight: 700;
            color: var(--accent-blue);
            margin-bottom: 10px;
            text-shadow: 0 0 20px rgba(88, 166, 255, 0.3);
        }

        .header p {
            color: var(--text-secondary);
            font-size: 1.1em;
            font-family: 'JetBrains Mono', monospace;
        }

        .content {
            padding: 30px;
        }

        .form-box {
            background: var(--bg-tertiary);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 25px;
            margin: 20px 0;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .form-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--accent-blue);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .form-box:hover::before {
            transform: scaleX(1);
        }

        .form-box:hover {
            border-color: var(--accent-blue);
            box-shadow: 0 8px 25px rgba(88, 166, 255, 0.15);
        }

        .form-box h3 {
            font-family: 'JetBrains Mono', monospace;
            color: var(--accent-blue);
            margin-bottom: 20px;
            font-size: 1.2em;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input, select {
            padding: 12px 16px;
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: 6px;
            color: var(--text-primary);
            font-size: 14px;
            font-family: 'JetBrains Mono', monospace;
            transition: all 0.3s ease;
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 3px rgba(88, 166, 255, 0.1);
        }

        input::placeholder {
            color: var(--text-secondary);
        }

        button {
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            font-family: 'JetBrains Mono', monospace;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        button:hover::before {
            left: 100%;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(88, 166, 255, 0.3);
        }

        .result-box, .error-box {
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            border-left: 4px solid;
            font-family: 'JetBrains Mono', monospace;
        }

        .result-box {
            background: rgba(63, 185, 80, 0.1);
            border-left-color: var(--accent-green);
            color: var(--accent-green);
        }

        .error-box {
            background: rgba(248, 81, 73, 0.1);
            border-left-color: var(--accent-orange);
            color: var(--accent-orange);
        }

        .data-box {
            background: var(--bg-tertiary);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 25px;
            margin: 30px 0;
        }

        .data-box h3 {
            font-family: 'JetBrains Mono', monospace;
            color: var(--accent-green);
            margin-bottom: 20px;
            font-size: 1.3em;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .grid > div {
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 20px;
        }

        .grid h4 {
            font-family: 'JetBrains Mono', monospace;
            color: var(--accent-purple);
            margin-bottom: 15px;
            font-size: 1.1em;
        }

        .grid ul {
            list-style: none;
            padding: 0;
        }

        .grid li {
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 15px;
            margin: 10px 0;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.9em;
            transition: all 0.3s ease;
        }

        .grid li:hover {
            border-color: var(--accent-blue);
            box-shadow: 0 4px 12px rgba(88, 166, 255, 0.1);
        }

        .grid li form {
            display: inline-block;
            margin: 5px 5px 0 0;
        }

        .grid li button {
            padding: 6px 12px;
            font-size: 0.8em;
            margin-right: 5px;
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--accent-orange), #ff6b6b) !important;
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--accent-yellow), #ffa726) !important;
        }

        .terminal-section {
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 20px;
            margin: 30px 0;
            font-family: 'JetBrains Mono', monospace;
        }

        .terminal-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border);
        }

        .terminal-dots {
            display: flex;
            gap: 5px;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .dot.red { background: #ff5f56; }
        .dot.yellow { background: #ffbd2e; }
        .dot.green { background: #27ca3f; }

        .code-snippet {
            color: var(--text-secondary);
            font-size: 0.9em;
        }

        .syntax-class { color: var(--accent-purple); }
        .syntax-method { color: var(--accent-blue); }
        .syntax-string { color: var(--accent-green); }

        .conta-item {
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 15px;
            margin: 10px 0;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.9em;
            transition: all 0.3s ease;
        }

        .conta-item:hover {
            border-color: var(--accent-blue);
            box-shadow: 0 4px 12px rgba(88, 166, 255, 0.1);
        }

        .conta-info {
            margin-bottom: 10px;
            color: var(--text-primary);
        }

        .conta-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .action-form {
            display: flex;
            gap: 5px;
            align-items: center;
        }

        .value-input {
            width: 100px;
            padding: 6px 8px;
            font-size: 0.8em;
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: 4px;
            color: var(--text-primary);
            font-family: 'JetBrains Mono', monospace;
        }

        @media (max-width: 768px) {
            .container {
                margin: 10px;
                border-radius: 8px;
            }
            
            .content {
                padding: 20px;
            }
            
            .grid {
                grid-template-columns: 1fr;
            }
        }

        /* Scrollbar customization */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-primary);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-blue);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>&lt;/&gt; Banco do Brasel</h1>
            <p>// Associação & Agregação em PHP</p>
        </div>
        
        <div class="content">
            <div class="terminal-section">
                <div class="terminal-header">
                    <div class="terminal-dots">
                        <div class="dot red"></div>
                        <div class="dot yellow"></div>
                        <div class="dot green"></div>
                    </div>
                    <span>sistema-bancario.php</span>
                </div>
                <div class="code-snippet">
                    <span class="syntax-class">class</span> <span class="syntax-method">SistemaBancario</span> {<br>
                    &nbsp;&nbsp;// <span class="syntax-string">Demonstrando conceitos de POO</span><br>
                    &nbsp;&nbsp;<span class="syntax-method">public function</span> demonstrarConceitos() { ... }<br>
                    }
                </div>
            </div>

            <!-- Formulários -->
            <div class="form-box">
                <h3>📋 class Titular</h3>
                <form method="POST">
                    <input type="hidden" name="acao" value="criar_titular">
                    <div class="form-group">
                        <input type="text" name="nome" placeholder="$nome = 'João Silva'" required>
                        <input type="text" name="cpf" placeholder="$cpf = '123.456.789-00'" required>
                        <select name="nome_sujo">
                            <option value="0">✅ $nome_sujo = false</option>
                            <option value="1">❌ $nome_sujo = true</option>
                        </select>
                        <button type="submit">new Titular()</button>
                    </div>
                </form>
            </div>
            
            <div class="form-box">
                <h3>👨‍💻 class Agente</h3>
                <form method="POST">
                    <input type="hidden" name="acao" value="criar_agente">
                    <div class="form-group">
                        <input type="number" name="id" placeholder="$id = 001" required>
                        <input type="text" name="nome" placeholder="$nome = 'Carlos Dev'" required>
                        <button type="submit">new Agente()</button>
                    </div>
                </form>
            </div>
            
            <div class="form-box">
                <h3>🏦 class Conta</h3>
                <form method="POST">
                    <input type="hidden" name="acao" value="criar_conta">
                    <div class="form-group">
                        <input type="text" name="titular_nome" placeholder="$titular->nome" required>
                        <input type="text" name="agente_nome" placeholder="$agente->nome" required>
                        <input type="number" name="saldo" placeholder="$saldo_inicial = 0.00" min="0" step="0.01" value="0" required>
                        <button type="submit">$agente->criar_conta()</button>
                    </div>
                </form>
            </div>

            <div class="form-box">
                <h3>🧹 function limparNome()</h3>
                <form method="POST">
                    <input type="hidden" name="acao" value="limpar_nome">
                    <div class="form-group">
                        <input type="text" name="titular_nome" placeholder="$titular->nome" required>
                        <input type="text" name="agente_nome" placeholder="$agente->nome" required>
                        <button type="submit">$agente->limparNome($titular)</button>
                    </div>
                </form>
            </div>

            <!-- Exibir resultado -->
            <?php if ($mensagem): ?>
                <div class="<?php echo $sucesso ? 'result-box' : 'error-box'; ?>">
                    <?php echo $mensagem; ?>
                </div>
            <?php endif; ?>
            
            <!-- Exibir dados criados -->
            <?php if (!empty($_SESSION['titulares']) || !empty($_SESSION['agentes']) || !empty($_SESSION['contas'])): ?>
            <div class="data-box">
                <h3>📊 // Bancão</h3>
                <div class="grid">
                    <?php if (!empty($_SESSION['titulares'])): ?>
                    <div>
                        <h4>Array $titulares[<?php echo count($_SESSION['titulares']); ?>]</h4>
                        <ul>
                            <?php foreach ($_SESSION['titulares'] as $t): ?>
                            <li>
                                {nome: "<?php echo $t->nome; ?>", status: "<?php echo $t->nome_sujo ? 'sujo' : 'limpo'; ?>"}
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="acao" value="excluir_titular">
                                    <input type="hidden" name="titular_nome" value="<?php echo $t->nome; ?>">
                                    <button type="submit" class="btn-danger">excluir()</button>
                                </form>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($_SESSION['agentes'])): ?>
                    <div>
                        <h4>Array $agentes[<?php echo count($_SESSION['agentes']); ?>]</h4>
                        <ul>
                            <?php foreach ($_SESSION['agentes'] as $a): ?>
                            <li>{id: <?php echo $a->getId(); ?>, nome: "<?php echo $a->getNome(); ?>"}</li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($_SESSION['contas'])): ?>
                    <div>
                        <h4>Array $contas[<?php echo count($_SESSION['contas']); ?>]</h4>
                        <ul>
                            <?php foreach ($_SESSION['contas'] as $c): ?>
                            <li>
                                <div style="margin-bottom: 10px;">
                                    {conta: <?php echo $c->getNumeroConta(); ?>, titular: "<?php echo $c->getTitular(); ?>", saldo: <?php echo number_format($c->getSaldo(), 2, '.', ''); ?>}
                                </div>
                                
                                <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap; margin-top: 10px;">
                                    <form method="POST" style="display: flex; gap: 5px; align-items: center;">
                                        <input type="hidden" name="acao" value="depositar">
                                        <input type="hidden" name="numero_conta" value="<?php echo $c->getNumeroConta(); ?>">
                                        <input type="number" name="valor_deposito" placeholder="0.00" required step="0.01" 
                                               class="value-input">
                                        <button type="submit" style="padding: 6px 12px; font-size: 0.8em;">depositar()</button>
                                    </form>
                                    
                                    <form method="POST" style="display: flex; gap: 5px; align-items: center;">
                                        <input type="hidden" name="acao" value="sacar">
                                        <input type="hidden" name="numero_conta" value="<?php echo $c->getNumeroConta(); ?>">
                                        <input type="number" name="valor_saque" placeholder="0.00" required step="0.01" 
                                               class="value-input">
                                        <button type="submit" style="padding: 6px 12px; font-size: 0.8em;">sacar()</button>
                                    </form>
                                    
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="acao" value="excluir_conta">
                                        <input type="hidden" name="numero_conta" value="<?php echo $c->getNumeroConta(); ?>">
                                        <button type="submit" class="btn-danger" style="padding: 6px 12px; font-size: 0.8em;">excluir()</button>
                                    </form>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
            
            
        </div>
    </div>
</body>
</html>