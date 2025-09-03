<?php
require_once '../backend/DAO/PacienteDAO.php';
require_once '../backend/Model/Paciente.php'; // Certifique-se de ter essa linha se usa uma classe Paciente

$dao = new PacienteDAO();
$pacientes = null;

if (isset($_GET['id'])) {
    $pacientes = $dao->getById((int)$_GET['id']);
}

if ($_POST) {
    $id = $_POST['id'] ?? null;
    $nome = $_POST['nome'] ?? '';
    $sobrenome = $_POST['sobrenome'] ?? '';
    $data_nascimento = $_POST['data_nascimento'] ?? '';
    $sexo = $_POST['sexo'] ?? '';
    $data_cadastro = $_POST['data_cadastro'] ?? '';

    $pacientes = new Paciente($id, $nome, $sobrenome, $data_nascimento, $sexo, $data_cadastro);

    if ($id) {
        $dao->update($pacientes);
    } else {
        $dao->create($pacientes);
    }

    header("Location: form_paciente.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pacientes</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .sexo-container {
            text-align: left;
            margin-bottom: 1em;
        }

        .radio-group {
            display: inline-block;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>MedSync - Sistema de Gestão Hospitalar</h1>
            </div>

        <div class="tabs">
            <button class="tab-button" onclick="window.location.href='../index.php';">
                👥 Início
            </button>
            <button class="tab-button" onclick="window.location.href='lista_paciente.php';">
                📦 Paciente
            </button>
            <button class="tab-button" onclick="window.location.href='lista_convenio.php';">
                📦 Convênios
            </button>
            <button class="tab-button" onclick="window.location.href='lista_medicos.php';">
                📦 Médicos
            </button>
            <button class="tab-button" onclick="window.location.href='lista_consultas.php';">
                📦 Consultas
            </button>
            <button class="tab-button" onclick="window.location.href='lista_endereco.php';">
                📦 Endereços
            </button>
        </div>

        <div id="clientes" class="tab-content active">
            <h2><?= $pacientes ? "Editar Paciente" : "Cadastro de Paciente" ?></h2>
            <br>
            <div class="actions">
                <button class="btn btn-primary" onclick="window.location.href='lista_paciente.php';">
                    📃 Listar Pacientes
                </button>
                <button class="btn btn-secondary" onclick="location.reload(); return false;">
                    🔄 Limpar Campos
                </button>
            </div>

            <div id="clientesAlert"></div>

            <form action="form_paciente.php" method="post">

                <?php if ($pacientes): ?>
                    <input type="hidden" name="id" value="<?= $pacientes->getId() ?>">
                <?php endif; ?>

                <div>
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" required value="<?= $pacientes ? $pacientes->getNome() : '' ?>">
                </div>

                <div>
                    <label for="sobrenome">Sobrenome:</label>
                    <input type="text" name="sobrenome" id="sobrenome" required value="<?= $pacientes ? $pacientes->getSobrenome() : '' ?>">
                </div>

                <div>
                    <label for="data_nascimento">Data de Nascimento:</label>
                    <input type="date" name="data_nascimento" id="data_nascimento" required value="<?= $pacientes ? $pacientes->getData_nascimento() : '' ?>">
                </div>

                <div>
                    <label for="data_cadastro">Data de Cadastro:</label>
                    <input type="date" name="data_cadastro" id="data_cadastro" required value="<?= $pacientes ? $pacientes->getData_cadastro() : '' ?>">
                </div>

                <div class="sexo-container">
                    <label>Sexo:</label><br>
                    
                    <div class="radio-group">
                        <input type="radio" name="sexo" id="sexo_m" value="masculino" <?= $pacientes && $pacientes->getSexo() === 'masculino' ? 'checked' : '' ?>>
                        Masculino
                        <br>
                        <input type="radio" name="sexo" id="sexo_f" value="feminino" <?= $pacientes && $pacientes->getSexo() === 'feminino' ? 'checked' : '' ?>>
                        Feminino
                    </div>
                </div>

                <button type="submit"><?= $pacientes ? 'Atualizar' : 'Cadastrar' ?></button>
                <br>
                <p>Já cadastrou o paciente? <a href="lista_paciente.php">Acesse a lista de pacientes </a> ou volte para o <a href="../index.php">início</a> </p>
            </form> 
        </div>
    </div>
</body>
</html>