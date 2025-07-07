<?php
require_once '../backend/DAO/ConvenioDAO.php';
$dao = new ConvenioDAO();

if(isset($_GET['id'])){
    $convenio=$dao->getById((int)$_GET['id']);

    if($convenio){
  $dao->excluir($_GET['id']);
  header("location:../lista_convenio.php");

    }

}
?>