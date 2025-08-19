<?php 
session_start();
require_once '../backend/DAO/UsuarioDAO.php';
if(isset($_SESSION['token']))
{
    header('Location:../index.php');
    exit();
}

if($_SERVER['REQUEST_METHOD']==='POST'){
    $email =filter_input(INPUT_POST,'email', FILTER_SANITIZE_EMAIL);
    $senha =filter_input(INPUT_POST,'senha');

    $dao = new UsuarioDAO();
    $usuario = $dao->getByEmail($email);

    if($usuario && password_verify($senha,$usuario->getSenha())){
  $token = bin2hex(random_bytes(25));
    $_SESSION['token'] = $token; 
    $dao->updateToken($usuario->getId(), $token); 
    header('Location:../index.php');
        exit(); 
    }else{
    $erro= "Email ou senha inválida!";
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <!-- <h1>Login</h1>
    <?php if(isset($erro)) echo "<p style='color:red'>$erro</p>";?>
    <form action="login.php"  method="post">
        <div>
            <h1>Login</h1>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <label for="senha">Senha :</label>
            <input type="password" name="senha" id="senha">
        </div>
        <button type="submit">Logar</button>
    </form>
    <a href="cadastro.php">Cadastro</a> -->


     <div class="container">
        <!-- <div class="header">
            <h1>Sistema de Gestão Hospitalar</h1>
        </div> -->

        <div class="tab-content active">
                <form action="login.php"  method="post">
                    <h1>Sistema de Gestão Hospitalar</h1>
                    <h2>Faça seu Login no Sistema de Gestão Hospitalar</h2>
                    <p>Preencha seus dados de Acesso:<p>
                        <div>
                            <label for="email">Email :</label>
                            <input type="mail" name="email" id="email">
                        </div>
                        <div>
                            <label for="senha">Senha :</label>
                            <input type="password" name="senha" id="senha">
                        </div>
                            <?php if(isset($erro)) echo "<p style='color:red'>$erro</p>";?>
                            <button type="submit">Logar</button>
                            <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a> ou volte para o <a href="../index.php">início</a> </p>
                        <br>
                </form> 
        </div>
    </div>
</body>
</html>