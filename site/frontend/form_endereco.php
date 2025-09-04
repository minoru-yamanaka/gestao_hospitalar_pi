<?php
// É uma boa prática iniciar a sessão se você planeja usar mensagens de feedback
// session_start(); 

require_once '../backend/DAO/EnderecoDAO.php';
require_once '../backend/DAO/PacienteDAO.php';

$dao = new EnderecoDAO();
$pacienteDao = new PacienteDAO();
$pacientes = $pacienteDao->getAll();
$endereco = null;

// Se for modo de edição, busca o endereço pelo ID
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $endereco = $dao->getById((int)$_GET['id']);
}

// Processa o formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $logradouro = $_POST['logradouro'] ?? '';
    $bairro = $_POST['bairro'] ?? '';
    $cidade = $_POST['cidade'] ?? '';
    $estado = $_POST['estado'] ?? '';
    $paciente_id = isset($_POST['paciente_id']) ? (int)$_POST['paciente_id'] : 0;

    // Validação simples para garantir que um paciente foi selecionado
    if ($paciente_id <= 0) {
        // Uma forma mais amigável de mostrar erro, sem usar die()
        $erro = "Erro: selecione um paciente válido.";
    } else {
        $enderecoObj = new Endereco(
            $id ? (int)$id : null,
            $logradouro,
            $bairro,
            $cidade,
            $estado,
            $paciente_id
        );

        if ($id) {
            $dao->update($enderecoObj);
        } else {
            $dao->create($enderecoObj);
        }

        // Redireciona para a lista em ambos os casos (criação e atualização)
        header("Location: lista_endereco.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $endereco ? "Editar Endereço" : "Cadastro de Endereço" ?></title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
         /* --- ESTILO AJUSTADO DO BOTÃO BUSCAR --- */
        #buscar {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none; /* Alterado de border-color para border */
            border-radius: 5px; /* Adicionado para arredondar as bordas */
            padding: 10px 15px; /* Adicionado para um tamanho melhor */
            cursor: pointer;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease; /* Adicionada transição suave */
        }
        
        #buscar:hover {
            transform: translateY(-4px); /* Eleva um pouco mais no hover */
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.5); /* Sombra mais pronunciada */
            filter: brightness(1.1); /* Deixa o botão mais "brilhante" */
        }

        #buscar:active {
            transform: translateY(0); /* Volta à posição original ao clicar */
            box-shadow: 0 2px 5px rgba(102, 126, 234, 0.3); /* Sombra menor para efeito de clique */
        }

        /* --- ESTILO PARA O BOTÃO DE SUBMIT --- */
        .btn-submit {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #28a745, #218838);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 15px;
            transition: background 0.3s ease;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #218838, #1e7e34);
        }
              
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Sistema de Gestão Hospitalar</h1>
    </div>

    <div class="tabs">
        <button class="tab-button" onclick="window.location.href='../index.php';">👥 Início</button>
        <button class="tab-button" onclick="window.location.href='lista_paciente.php';">📦 Paciente</button>
        <button class="tab-button" onclick="window.location.href='lista_convenio.php';">📦 Convênios</button>
        <button class="tab-button" onclick="window.location.href='lista_medicos.php';">📦 Médicos</button>
        <button class="tab-button" onclick="window.location.href='lista_consultas.php';">📦 Consultas</button>
        <button class="tab-button" onclick="window.location.href='lista_endereco.php';">📦 Endereços</button>
    </div>

    <div id="clientes" class="tab-content active">
        <h2><?= $endereco ? "Editar Endereço" : "Cadastro de Endereço" ?></h2>
        <br>
        
        <div class="actions">
            <button class="btn btn-primary" onclick="window.location.href='lista_endereco.php';">
                📃 Listar Endereços
            </button>
            <button class="btn btn-secondary" onclick="window.location.href='form_endereco.php';">
                ✨ Novo Endereço
            </button>
        </div>

        <?php if (isset($erro)): ?>
            <div id="clientesAlert" style="color: red; margin-top: 10px;"><?= $erro ?></div>
        <?php endif; ?>

        <form action="form_endereco.php<?= $endereco ? '?id=' . $endereco->getId() : '' ?>" method="post">

            <?php if ($endereco) : ?>
                <input type="hidden" name="id" value="<?= $endereco->getId() ?>">
            <?php endif; ?>

            <div>
                <label for="cep">Informe o CEP: <br><span id="status"></span></label>
                <div id="area-do-cep" >
                    <input placeholder="Somente números" type="text" id="cep" name="cep" maxlength="9" inputmode="numeric">
                    <br><br><button id="buscar">Buscar</button>
            </div>
            <div>
                <label for="logradouro">Logradouro:</label>
                <input type="text" name="logradouro" id="logradouro" value="<?= $endereco ? $endereco->getLogradouro() : '' ?>">
            </div>

            <div>
                <label for="bairro">Bairro:</label>
                <input type="text" name="bairro" id="bairro" value="<?= $endereco ? $endereco->getBairro() : '' ?>">
            </div>

            <div>
                <label for="cidade">Cidade:</label>
                <input type="text" name="cidade" id="cidade" value="<?= $endereco ? $endereco->getCidade() : '' ?>">
            </div>

            <div>
                <label for="estado">Estado:</label>
                <input type="text" name="estado" id="estado" value="<?= $endereco ? $endereco->getEstado() : '' ?>">
            </div>

            <div>
                        <label>Lista de Pacientes:</label>
                        <!-- <p>Lista de Pacientes</p> -->
                        <select type="text" name="paciente_id" id="paciente_id">
                            <option></option>
                            <?php foreach ($pacientes as $paciente) : ?>
                                <option value="<?= $paciente->getId() ?>"><?= $paciente->getNome() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

            <button type="submit"><?= $endereco ? 'Atualizar' : 'Cadastrar' ?></button>
            <br>
            <p>Já cadastrou o endereço? <a href="lista_endereco.php">Acesse a lista de endereços</a> ou volte para o <a href="../index.php">início</a> </p>
        </form> 
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>
"use strict";

// Colocar o código dentro de um listener para garantir que o DOM está carregado
document.addEventListener("DOMContentLoaded", function() {
    const campoCep = document.querySelector("#cep");
    const campoLogradouro = document.querySelector("#logradouro");
    const campoBairro = document.querySelector("#bairro");
    const campoCidade = document.querySelector("#cidade");
    const campoEstado = document.querySelector("#estado");
    const botaoBuscar = document.querySelector("#buscar");
    const mensagem = document.querySelector("#status");

    // Aplica a máscara JQuery
    $(campoCep).mask("00000-000");

    botaoBuscar.addEventListener("click", async function(event){
        // Previne o comportamento padrão do botão, que poderia ser submeter o formulário
        event.preventDefault();

        // Remove a máscara para a validação e para a busca
        const cepValue = campoCep.value.replace('-', '');

        if(cepValue.length !== 8){
            mensagem.textContent = "Digite um CEP válido com 8 dígitos.";
            mensagem.style.color = "purple";
            return;
        }

        const url = `https://viacep.com.br/ws/${cepValue}/json/`;
        
        try {
            const resposta = await fetch(url);
            const dados = await resposta.json();

            if (dados.erro) {
                mensagem.textContent = "CEP não encontrado!";
                mensagem.style.color = "red";
            } else {
                mensagem.textContent = "CEP encontrado com sucesso!";
                mensagem.style.color = "green";

                campoLogradouro.value = dados.logradouro;
                campoBairro.value = dados.bairro;
                campoCidade.value = dados.localidade;
                campoEstado.value = dados.uf;
            }
        } catch (error) {
            mensagem.textContent = "Falha ao buscar o CEP. Verifique sua conexão.";
            mensagem.style.color = "red";
            console.error("Erro na API ViaCEP:", error);
        }
    });
});
</script>
</body>
</html>