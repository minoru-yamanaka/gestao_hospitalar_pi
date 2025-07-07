<?php 
session_start();
if(!isset($_SESSION['token'])){
    header("localhost:../index.php");
    exit;
}

require_once '../backend/DAO/UsuarioDAO.php';

$dao= new UsuarioDAO();

$user = $dao->getByToken($_SESSION['token']);

if(!$user){
$_SESSION['token']==null;
 header("localhost:login.php");
 exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <header>
        <div>
            <h1>Minha Conta</h1>
            <p>Nome :<?=$user->getNome()?></p>
            <p>Email :<?=$user->getEmail()?></p>
            <a href="../index.php">Voltar</a>
        </div>
    </header>
    
    <!-- <div>
        <h1>Minha Conta</h1>
        <p>Nome :<?=$user->getNome()?></p>
        <p>Email :<?=$user->getEmail()?></p>
        <a href="../index.php">Voltar</a>
        <li></li>
    </div> -->

</body>
</html>