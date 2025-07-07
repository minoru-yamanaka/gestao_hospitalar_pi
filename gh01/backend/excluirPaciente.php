<?php
require_once '../backend/DAO/PacienteDAO.php';
$dao = new PacienteDAO();

if(isset($_GET['id'])){
    $pacietes=$dao->getById((int)$_GET['id']);

    if($pacietes){
  $dao->excluir($_GET['id']);
  header("location:../lista_paciente.php");

    }

}
?>