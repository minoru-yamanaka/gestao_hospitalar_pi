<?php
require_once '../backend/DAO/EnderecoDAO.php';
$dao = new EnderecoDAO;

if(isset($_GET['id'])){
    $endereco=$dao->getById((int)$_GET['id']);

    if($endereco){
  $dao->excluir($_GET['id']);
  header("location:../frontend/lista_endereco.php");

    }

}
?>