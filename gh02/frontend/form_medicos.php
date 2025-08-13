<?php
require_once '../backend/DAO/MedicoDAO.php';

$dao= new MedicoDAO();

$medico=null;

if(isset($_GET['id'])){
$medico= $dao->getById($_GET['id']);
}

if($_POST){
$id =filter_input(INPUT_POST,'id')??null;     
$nome =filter_input(INPUT_POST,'nome');  
$especialidade =filter_input(INPUT_POST,'especialidade');  
$crm =filter_input(INPUT_POST,'crm');  

$medico = new Medicos($id,$nome,$especialidade,$crm,$email);
if($id){
$dao->update($medico);
}else{
$dao->create($medico);
header("location:form_medicos.php");
exit;
}
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Médicos</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
           
    <div class="container">
        <div class="header">
            <h1>Sistema de Gestão Hospitalar</h1>
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

        <div id="clientes" class="tab-content active">
            <h2><?= $medico ? "Editar Médico" : "Cadastro de Médicos" ?></h2>
            <br>
            <div class="actions">
                <button class="btn btn-primary" onclick="window.location.href='lista_medicos.php';">
                    📃 Listar de médicos
                </button>
                <button class="btn btn-secondary" onclick="location.reload(); return false;">
                    🔄 Limpar Campos
                </button>
            </div>

            <div id="clientesAlert"></div>

           <form action="form_medicos.php" method="post">
                    <?php if($medico) :?>
                        <input type="hidden" name="id" value="<?=$medico->getId()?>">
                    <?php endif; ?>
                <div>
                    <label for="nome">Nome :</label>
                    <input type="text" name="nome" id="nome" required value="<?=$medico?$medico->getNome():''?>">
                </div>

                    <div>
                    <label for="especialidade">Especialidade:</label>
                    <input type="text" name="especialidade" id="especialidade" required value="<?=$medico?$medico->getEspecialidade():''?>">
                </div>
                    <div>
                    <label for="crm">Crm :</label>
                    <input type="text" name="crm" id="crm" required value="<?=$medico?$medico->getCrm():''?>">
                </div>
                <button type="submit">Cadastrar</button>
                <br>
                <p>Já cadastrou o médico? <a href="lista_paciente.php">Acesse a lista de médicos </a> ou volte para <a href="../index.php">Home</a> </p>
            </form> 
        </div>
    </div>

</body>
</html>