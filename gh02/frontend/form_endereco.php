<?php
require_once '../backend/DAO/EnderecoDAO.php';
require_once '../backend/DAO/PacienteDAO.php';

$dao = new EnderecoDAO();
$pacienteDao = new PacienteDAO();
$pacientes = $pacienteDao->getAll();
$endereco = null;

if (isset($_GET['id'])) {
    $endereco = $dao->getById($_GET['id']);
}

if ($_POST) {
    $id = $_POST['id'] ?? null;
    $logradouro = $_POST['logradouro'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $paciente_id = $_POST['paciente_id'];

    $endereco = new Endereco($id, $logradouro, $bairro, $cidade, $estado, $paciente_id);
    if ($id) {
        $dao->update($endereco);
    } else {
        $dao->create($endereco);
        header("location:form_endereco.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Endereços</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>Sistema de Gestão Hospitalar</h1>
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
            <h2><?= $endereco ? "Editar Endereços" : "Cadastro de Endereços" ?></h2>
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

            <form action="form_endereco.php" method="post">

                    <?php if ($endereco) : ?>
                        <input type="hidden" name="id" value="<?= $endereco->getId() ?>">
                    <?php endif; ?>

                    <div>
                        <label for="logradouro">Logradouro:</label>
                        <input type="text" name="logradouro" id="logradouro" required value="<?= $endereco ? $endereco->getLogradouro() : '' ?>">
                    </div>

                    <div>
                        <label for="bairro">Bairro:</label>
                        <input type="text" name="bairro" id="bairro" required value="<?= $endereco ? $endereco->getBairro() : '' ?>">
                    </div>
                    <div>
                        <label for="cidade">Cidade:</label>
                        <input type="text" name="cidade" id="cidade" required value="<?= $endereco ? $endereco->getCidade() : '' ?>">
                    </div>
                    <div>
                        <label for="estado">Estado:</label>
                        <input type="text" name="estado" id="estado" required value="<?= $endereco ? $endereco->getEstado() : '' ?>">
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

                    <button type="submit">Cadastrar</button>
                    <br>
                    <p>Já cadastrou o endereço? <a href="lista_endereco.php">Acesse a lista de endereços</a> ou volte para o <a href="../index.php">início</a> </p>
                </form> 
        </div>
    </div>

</body>
</html>