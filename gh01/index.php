<?php
session_start();
$isLogged = isset($_SESSION['token']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css"> 
    <title>Gestão Hospitalar</title>
</head>
<body>
    <!-- Header Principal -->
    <!-- <header class="header-main">
        <div class="container">
            <div class="header-content">
                <h1 class="logo">Sistema de Gestão Hospitalar</h1>
                <nav class="nav-auth">
                    <ul class="nav-list">
                        <?php if($isLogged): ?>
                            <li><a href="index.php" class="nav-link">Home</a></li>
                            <li><a href="./frontend/usuario.php" class="nav-link">Minha Conta</a></li>
                            <li><a href="./frontend/logout.php" class="nav-link btn-logout">Sair</a></li>
                        <?php else: ?>
                            <li><a href="index.php" class="nav-link">Home</a></li>
                            <li><a href="./frontend/login.php" class="nav-link btn-login">Login</a></li>
                            <li><a href="./frontend/cadastro.php" class="nav-link btn-register">Cadastrar-se</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </header> -->

    
        <?php if ($isLogged): ?>
            <!-- Área para usuários logados -->
            <div class="container">
                    <div class="header" id="topo">
                        <h1>Sistema de Gestão Hospitalar</h1>
                        <p>Gerencie Pacientes de forma eficiente</p>

                        <h3>Acesso de administrador</h3>
                        <p>Você logado para acessar o sistema.</p>

                        </br>
                        <div class="">
                            <button class="tab-button" onclick="window.location.href='index.php';">
                                👥 Home
                            </button>
                            <!-- <button class="tab-button" onclick="window.location.href='./frontend/login.php';">
                                📦 Fazer login
                            </button>
                            <button class="tab-button" onclick="window.location.href='./frontend/cadastro.php';">
                                📦 Criar conta
                            </button> -->
                            <button class="tab-button" onclick="window.location.href='./frontend/logout.php';">
                                📦 Sair
                            </button>
                        </div>
                        
                    </div>
            <div>
                

                <div class="tabs">
                    <!-- <button class="tab-button" onclick="window.location.href='index.php';">
                        👥 Home
                    </button> -->
                    <button class="tab-button" onclick="window.location.href='./frontend/lista_paciente.php';">
                        📦 Paciente
                    </button>
                    <button class="tab-button" onclick="window.location.href='./frontend/lista_convenio.php';">
                        📦 Convênios
                    </button>
                    <button class="tab-button" onclick="window.location.href='./frontend/lista_medicos.php';">
                        📦 Médicos
                    </button>
                    <button class="tab-button" onclick="window.location.href='./frontend/lista_consultas.php';">
                        📦 Consultas
                    </button>
                    <button class="tab-button" onclick="window.location.href='./frontend/lista_endereco.php';">
                        📦 Endereços
                    </button>
                </div>
                
                <div class="tabs">
                    <p class="footer-text"> &copy; 2024 Sistema de Gestão Hospitalar. Todos os direitos reservados.</p>
                </div>
            </div>
                    
        <?php else: ?>
                
                <!-- Área para usuários não logados -->
                <div class="container">
                    <div class="header" id="topo">
                        <h1>Sistema de Gestão Hospitalar</h1>
                        <p>Gerencie Pacientes de forma eficiente</p>

                        <h3>Acesso Restrito</h3>
                        <p>Você precisa estar logado para acessar o sistema.</p>

                        </br>
                        <div class="">
                            <!-- <button class="tab-button" onclick="window.location.href='index.php';">
                                👥 Home
                            </button> -->
                            <button class="tab-button" onclick="window.location.href='./frontend/login.php';">
                                📦 Fazer login
                            </button>
                            <button class="tab-button" onclick="window.location.href='./frontend/cadastro.php';">
                                📦 Criar conta
                            </button>
                        </div>

                    </div>
                </div>

                <?php endif; ?>

    </main>

 
    


        
 


        
</body>
</html>