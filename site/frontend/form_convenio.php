<?php
require_once '../backend/DAO/ConvenioDAO.php';
require_once '../backend/DAO/PacienteDAO.php';

$dao= new ConvenioDAO;
$pacienteDao= new PacienteDAO();

$pacientes= $pacienteDao->getAll();

$convenio=null;

if(isset($_GET['id'])){
$convenio= $dao->getById($_GET['id']);
}



if($_POST){
$id = $_POST['id'] ?? null;    
$empresa = $_POST['empresa'];
$cnpj = $_POST['cnpj'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$paciente_id =$_POST['paciente_id'];

$convenio = new Convenio($id,$empresa,$cnpj,$telefone,$email,$paciente_id);
if($id){
$dao->update($convenio);
}else{
$dao->create($convenio);
header("location:form_convenio.php");
exit;
}
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Convenio</title>
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
            <h2><?=$convenio?"Editar Convênio":"Cadastro de Convênios"?></h2>
            <br>
            <div class="actions">
                <button class="btn btn-primary" onclick="window.location.href='lista_convenio.php';">
                    📃 Listar Convênios
                </button>
                <button class="btn btn-secondary" onclick="location.reload(); return false;">
                    🔄 Limpar Campos
                </button>
            </div>

            <div id="clientesAlert"></div>

           <form action="form_convenio.php" method="post">

                        
                        
                        <?php if($convenio) :?>
                            <input type="hidden" name="id" value="<?=$convenio->getId()?>">
                        <?php endif; ?>

                        <div>
                            <label for="empresa">Empresa :</label>
                            <input type="text" name="empresa" id="empresa" required value="<?=$convenio?$convenio->getEmpresa():''?>">
                        </div>

                        <div>
                            <label for="cnpj">Cnpj:</label>
                            <input type="text" name="cnpj" id="cnpj" required value="<?=$convenio?$convenio->getCnpj():''?>">
                        </div>

                        <div>
                            <label for="telefone">Telefone :</label>
                            <input type="text" name="telefone" id="telefone" required value="<?=$convenio?$convenio->getTelefone():''?>">
                        </div>

                        <div>
                            <label for="email">Email :</label>
                            <input type="mail" name="email" id="email" required value="<?=$convenio?$convenio->getEmail():''?>">
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

                        <button type="submit">Cadastrar</button>
                        </form>   
                        <br>
                        <p>Já cadastrou o convênio? <a href="lista_paciente.php">Acesse a lista de convênios </a> ou volte para o <a href="../index.php">início</a> </p>
            </form> 
        </div>
    </div>
</div>
</body>
</html>