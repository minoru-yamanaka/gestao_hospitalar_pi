<?php
require_once '../backend/DAO/ConsultaDAO.php';

$dao = new ConsultaDAO();
$consultas = $dao->getAll();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Consutas</title>
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
            <h2>Gerenciar Conultas</h2>
            <br>
            <div class="actions">
                <button class="btn btn-primary" onclick="window.location.href='form_consultas.php';">
                    ➕ Nova consulta
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
                          <th>Data:</th>
                          <th>Horas:</th>
                          <th>Especialidade</th>
                          <th>Paciente:</th>
                          <th>Mdico</th>
                          <th>Ação</th>
                          <th>Ação</th>
                      </tr>
                
                  <?php foreach ($consultas as $consulta): ?>
                      <tr>
                          <td><?= $consulta->getId() ?></td>
                          <td><?= $consulta->getData() ?></td>
                          <td><?= $consulta->getHoras() ?></td>
                            <td><?= $consulta->getEspecialidade() ?></td>
                          <td><?= $consulta->getPaciente_id() ?></td>
                            <td><?= $consulta->getMedico_id() ?></td>
                          
                          <td><a href="form_consultas.php?id=<?=$consulta->getId()?>">Alterar</a></td>
                          <td><a href="../backend/excluirConsultas.php?id=<?=$consulta->getId()?>">Excluir</a></td>
                      </tr>
                  <?php endforeach; ?>                             
                    </thead>
                    <tbody id="clientesTableBody">
                        <tr>
                            <td colspan="6" class="loading"> 
                                <p>
                                    Visualize e gerencie as consultas cadastradas no sistema, ou <a href="#topo">volte para o topo</a> ou <a href="../index.php">volte para Home</a>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
</body>
</html>