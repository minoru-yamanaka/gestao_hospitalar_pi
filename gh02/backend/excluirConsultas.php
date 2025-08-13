<?php
require_once '../backend/DAO/ConsultaDAO.php';

$dao = new ConsultaDAO();

if (isset($_GET['id'])) {
    $consulta = $dao->getById((int)$_GET['id']);

    if ($consulta) {
        $dao->excluir($_GET['id']);
        header("location:../frontend/lista_consultas.php");
    }
}
?>
