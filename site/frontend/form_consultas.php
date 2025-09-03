<?php
require_once '../backend/Model/Consulta.php';
require_once '../backend/DAO/PacienteDAO.php';
require_once '../backend/DAO/MedicoDAO.php';
require_once '../backend/DAO/ConsultaDAO.php';

$dao= new ConsultaDAO;
$pacienteDao= new PacienteDAO();
$medicoDao = new MedicoDAO();

$pacientes= $pacienteDao->getAll();
$medicos= $medicoDao->getAll();

$consultas=null;

if(isset($_GET['id'])){
$consultas= $dao->getById($_GET['id']);
}



if($_POST){
$id = $_POST['id'] ?? null;    
$data = $_POST['data'];
$horas = $_POST['horas'];
$especialidade = $_POST['especialidade'];
$paciente_id =$_POST['paciente_id'];
$medico_id = $_POST['medico_id'];

$consultas = new Consultas($id,$data,$horas,$especialidade,$paciente_id,$medico_id);
if($id){
$dao->update($consultas);
}else{
$dao->create($consultas);
header("location:form_consultas.php");
exit;
}
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Consultas</title>
    <link rel="stylesheet" href="../css/style.css">
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
                    <h2><?=$consultas?"Editar Consultas":"Cadastro de Consultas"?></h2>
                    <br>
                    <div class="actions">
                        <button class="btn btn-primary" onclick="window.location.href='lista_consultas.php';">
                            📃 Listar Pacientes
                        </button>
                        <button class="btn btn-secondary" onclick="location.reload(); return false;">
                            🔄 Limpar Campos
                        </button>
                    </div>

                    <div id="clientesAlert"></div>

                    <form action="form_consultas.php" method="post">
                            <?php if($consultas) :?>
                                <input type="hidden" name="id" value="<?=$consultas->getId()?>">
                                <?php endif; ?>

                            <div>
                                <label for="data">Data da Consulta :</label>
                                <input type="date" name="data" id="data" required value="<?=$consultas?$consultas->getData():''?>">
                            </div>

                            <div>
                                <label for="horas">Horário:</label>
                                <input type="text" name="horas" id="horas" required value="<?=$consultas?$consultas->getHoras():''?>">
                            </div>
                                
                            <div>
                                <label for="especialidade">Especialidade:</label>
                                <input type="text" name="especialidade" id="especialidade" required value="<?=$consultas?$consultas->getEspecialidade():''?>">
                            </div> 
                            <p>Lista de Pacientes</p>
                            <div>
                                <select name="paciente_id" id="paciente_id">
                                    <option></option>
                                    <?php foreach($pacientes as $paciente):?>
                                    <option value="<?=$paciente->getId()?>"><?=$paciente->getNome()?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <p>Lista de Médicos</p>
                            <div>
                                <select name="medico_id" id="medico_id">
                                    <option></option>
                                    <?php foreach($medicos as $medico):?>
                                    <option value="<?=$medico->getId()?>"><?=$medico->getNome()?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                                <button type="submit">Cadastrar</button>
                                <br>
                                <p>Já cadastrou a consulta? <a href="lista_consultas.php">Acesse a lista de consultas </a> ou volte para o <a href="../index.php">início</a> </p>
                                </form> 
                    </div>
    </div>

    </main>

































</body>
</html>