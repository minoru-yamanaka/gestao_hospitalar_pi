<?php
require_once '../backend/DAO/EnderecoDAO.php';

$dao = new EnderecoDAO();
$enderecos = $dao->getAll();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Endereços</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container" id="topo">
        <div class="header">
            <h1>Sistema de Gestão Hospitalar</h1>
            <!-- <p>Gerencie Pacientes de forma eficiente</p> -->
        </div>

        <div class="tabs">
            <button class="tab-button" onclick="window.location.href='../index.php';">
                👥 Home
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

        <!-- Tab Clientes -->
        <div id="clientes" class="tab-content active">
            <h2>Gerenciar Endereços</h2>
            <br>
            <div class="actions">
                <button class="btn btn-primary" onclick="window.location.href='form_endereco.php';">
                    ➕ Novo endereco
                </button>
                <button class="btn btn-secondary" onclick="location.reload(); return false;">
                    🔄 Atualizar Lista
                </button>
            </div>

            <div id="clientesAlert"></div>

            <div class="table-container">
                <table id="clientesTable">
                    <thead>
                           <tr>
                            <th>Id:</th>
                            <th>Logradouro:</th>
                            <th>Bairro:</th>
                            <th>Cidade</th>
                            <th>Estado:</th>
                            <th>Paciente:</th>
                            <th>Ação</th>
                            <th>Ação</th>
                        </tr>
                
                    <?php foreach ($enderecos as $endereco): ?>
                        <tr>
                            <td><?= $endereco->getId() ?></td>
                            <td><?= $endereco->getLogradouro() ?></td>
                            <td><?= $endereco->getBairro() ?></td>
                            <td><?= $endereco->getCidade() ?></td>
                            <td><?= $endereco->getEstado() ?></td>
                            <td><?= $endereco->getPaciente_id() ?></td>
                            
                            <td><a href="form_endereco.php?id=<?=$endereco->getId()?>">Alterar</a></td>
                            <td><a href="../backend/excluirEndereco.php?id=<?=$endereco->getId()?>">Excluir</a></td>
                        </tr>
                    <?php endforeach; ?>                             
                    </thead>
                    <tbody id="clientesTableBody">
                        <tr>
                            <td colspan="6" class="loading"> 
                                <p>
                                    Visualize e gerencie os endereços cadastrados no sistema, ou <a href="#topo">volte para o topo</a> ou <a href="../index.php">volte para Home</a>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
</body>
</html>