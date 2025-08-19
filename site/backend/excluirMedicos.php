<?php
require_once '../backend/DAO/MedicoDAO.php';
$dao = new MedicoDAO();

if(isset($_GET['id'])){
    $medico=$dao->getById((int)$_GET['id']);

    if($medico){
  $dao->excluir($_GET['id']);
  header("location:../lista_medicos.php");

    }

}
?>