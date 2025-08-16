<?php
session_start();
require_once '../backend/DAO/UsuarioDAO.php';
require_once '../backend/Model/Usuario.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = filter_input(INPUT_POST, 'nome');
    $email = filter_input(INPUT_POST, 'email',FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha');
    $confirmaSenha = filter_input(INPUT_POST, 'confirmaSenha');

    if($senha !== $confirmaSenha ||!$nome || !$email ||!$senha){
     $erro = "Dados inválidos ou senha não conferem!";
    }else{
  $dao= new UsuarioDAO();

  if($dao->getByEmail($email)){
    
    $erro ="Já existe usuário com esse email!";
  }else{
    $senhaHash = password_hash($senha,PASSWORD_DEFAULT);

    $toke =bin2hex(random_bytes(25));
    
    $usuario = new Usuario(null,$nome,$email,$senhaHash,$toke);
    if($dao->create($usuario)){
        $_SESSION['token']==$token;
        header("location:../index.php");
    }else{
        $erro= "Usuário Cadastrado com Sucesso!";
    }
  }
}
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* Estilos para as mensagens de feedback */
        .mensagem-sucesso {
            color: green;
            font-weight: bold;
            background-color: #e6ffe6;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
        }
        .mensagem-erro {
            color: red;
            font-weight: bold;
            background-color: #ffe6e6;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="tab-content active">             
            
            <form method="POST">
            <form action="" method="post"> 
                <h1>Sistema de Gestão Hospitalar</h1>
                <h2>Faça seu cadastro no Sistema de Gestão Hospitalar</h2>
                <p>Preencha seus dados de Acesso:</p>
                <br>
                <div>
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" required>
                </div>
                <div>
                    <label for="email">E-mail:</label>
                    <input type="mail" name="email" id="email" required> <!-- CORRIGIDO: type="mail" para type="email" -->
                </div>
                <div>
                    <label for="senha">Senha:</label>
                    <input type="password" name="senha" id="senha" required>
                </div>
                <div>
                    <label for="confirmaSenha">Confirmar Senha:</label>
                    <input type="password" name="confirmaSenha" id="confirmaSenha" required>
                </div>
                <?php if(isset($erro)) echo "<p style='color: red'>$erro</p>";?>
                <button type="submit">Cadastrar</button>
                <br>
                <p>Já tem uma conta? <a href="login.php">Entrar</a> ou <a href="../index.php">volte para o início</a></p>

            </form>
        </div>
    </div>
</body>
</html>