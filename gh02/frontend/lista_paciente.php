<?php
require_once '../backend/DAO/PacienteDAO.php';

$dao = new PacienteDAO();
$pacientes = $dao->getAll();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pacientes</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    
 <div class="container">
        <div class="header" id="topo">
            <h1>Sistema de Gestão Hospitalar</h1>
            <!-- <p>Gerencie Pacientes de forma eficiente</p> -->
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

        <!-- Tab Clientes -->
        <div id="clientes" class="tab-content active">
            <h2>Gerenciar Pacientes</h2>
            <br>
            <div class="actions">
                <button class="btn btn-primary" onclick="window.location.href='form_paciente.php';">
                    ➕ Novo Paciente
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
                            <th>Nome:</th>
                            <th>Sobrenome:</th>
                            <th>DT nascimento</th>
                            <th>Sexo:</th>
                            <th>DT cadastro</th>
                            <th colspan="2" >Ação</th>
                        </tr>

                        <?php foreach ($pacientes as $paciente) : ?>
                            <tr>
                                <td><?= $paciente->getId() ?></td>                             
                                <td><?= $paciente->getNome() ?></td>
                                <td><?= $paciente->getSobrenome() ?></td>
                                <td><?= $paciente->getData_nascimento() ?></td>
                                <td><?= $paciente->getSexo() ?></td>
                                <td><?= $paciente->getData_cadastro() ?></td>
                                <td><a href="form_paciente.php?id=<?= $paciente->getId() ?>">Alterar</a></td>
                                <td><a href="../backend/excluirPaciente.php?id=<?= $paciente->getId() ?>">Excluir</a></td>
                            </tr>
                        <?php endforeach; ?>    
                                         
                    </thead>
                    <tbody id="clientesTableBody">
                        <tr>
                            <td colspan="6" class="loading"> 
                                <p>
                                    Visualize e gerencie os pacientes cadastrados no sistema, ou <a href="#topo">volte para o topo</a> ou <a href="../index.php">volte para o início</a>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        
  </body>
</html>