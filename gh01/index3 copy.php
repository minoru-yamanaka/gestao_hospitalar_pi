<?php
session_start();
$isLogged = isset($_SESSION['token']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão Hospitalar</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .main-content {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .carousel-container {
            position: relative;
            width: 100%;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }
        .carousel-wrapper {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .carousel-slide {
            min-width: 100%;
            background-color: #f8f9fa;
        }
        .carousel-slide img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }
        .slide-content {
            padding: 25px;
            text-align: center;
        }
        .slide-content h2 {
            margin-top: 0;
            color: #0056b3;
            font-size: 1.6em;
        }
        .slide-content p {
            font-size: 1.1em;
            line-height: 1.6;
            color: #333;
        }
        .carousel-container input[type="radio"] {
            display: none;
        }
        .carousel-nav {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 10;
        }
        .carousel-nav label {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: rgba(255,255,255,0.7);
            border: 1px solid #ccc;
            cursor: pointer;
        }
        #slide1:checked ~ .carousel-wrapper { transform: translateX(0); }
        #slide2:checked ~ .carousel-wrapper { transform: translateX(-100%); }
        #slide3:checked ~ .carousel-wrapper { transform: translateX(-200%); }
        #slide4:checked ~ .carousel-wrapper { transform: translateX(-300%); }
        #slide1:checked ~ .carousel-nav label[for="slide1"],
        #slide2:checked ~ .carousel-nav label[for="slide2"],
        #slide3:checked ~ .carousel-nav label[for="slide3"],
        #slide4:checked ~ .carousel-nav label[for="slide4"] {
            background-color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">

        <?php if ($isLogged): ?>
            <div class="main-content">
                <div class="header" style="text-align: center;">
                    <h1>Sistema de Gestão Hospitalar 3</h1>
                    <p>Gerencie Pacientes de forma eficiente</p>
                    <h3>Acesso de administrador</h3>
                    <p>Você está logado para acessar o sistema.</p>
                </div>

                <div class="tabs">
                    <button class="tab-button" onclick="location.href='./frontend/lista_paciente.php';">📦 Paciente</button>
                    <button class="tab-button" onclick="location.href='./frontend/lista_convenio.php';">📦 Convênios</button>
                    <button class="tab-button" onclick="location.href='./frontend/lista_medicos.php';">📦 Médicos</button>
                    <button class="tab-button" onclick="location.href='./frontend/lista_consultas.php';">📦 Consultas</button>
                    <button class="tab-button" onclick="location.href='./frontend/lista_endereco.php';">📦 Endereços</button>
                    <button class="tab-button" onclick="location.href='./frontend/logout.php';">📦 Sair</button>
                </div>

                <div class="header">
                    <h2>Bem-vindo(a) à Gestão AMD Hospitalar!</h2>
                    <p>Sistema modular, intuitivo e poderoso, feito para facilitar sua rotina.</p>
                </div>
            </div>

        <?php else: ?>
            <div class="header" style="text-align: center;">
                <h1>Sistema de Gestão Hospitalar 3</h1>
                <p>Gerencie Pacientes de forma eficiente</p>
                <h3>Acesso Restrito</h3>
                <p>Você precisa estar logado para acessar o sistema.</p>
                <br>
                <div>
                    <button class="tab-button" onclick="location.href='./frontend/login.php';">📦 Fazer login</button>
                    <button class="tab-button" onclick="location.href='./frontend/cadastro.php';">📦 Criar conta</button>
                </div>
            </div>

                <!-- Carrossel único para ambos -->
        <div class="carousel-container">
            <input type="radio" name="slider" id="slide1" checked>
            <input type="radio" name="slider" id="slide2">
            <input type="radio" name="slider" id="slide3">
            <input type="radio" name="slider" id="slide4">

            <div class="carousel-wrapper">
                <div class="carousel-slide">
                    <img src="img/image01.png" alt="Sala de hospital moderna e bem iluminada.">
                    <div class="slide-content">
                        <h2>Lançamento da Gestão AMD Hospitalar!</h2>
                        <p>Sistema poderoso, personalizável e simples para gestão hospitalar.</p>
                    </div>
                </div>
                <div class="carousel-slide">
                    <img src="img/image02.png" alt="Médico utilizando o sistema de gestão em um computador.">
                    <div class="slide-content">
                        <h2>Bem-vindo de volta!</h2>
                        <p>Explore as ferramentas e envie sugestões para melhorarmos sempre.</p>
                    </div>
                </div>
                <div class="carousel-slide">
                    <img src="img/image03.png" alt="Gráficos e dados médicos exibidos em uma tela de computador.">
                    <div class="slide-content">
                        <h2>Novo Módulo: Relatórios Avançados</h2>
                        <p>Transforme dados em insights para decisões mais rápidas e assertivas.</p>
                    </div>
                </div>
                <div class="carousel-slide">
                    <img src="img/image04.png" alt="Prontuários médicos digitais organizados em um tablet.">
                    <div class="slide-content">
                        <h2>Dica Rápida</h2>
                        <p>Use modelos de prontuário para agilizar o atendimento aos pacientes.</p>
                    </div>
                </div>
            </div>
           
            <div class="carousel-nav">
                <label for="slide1"></label>
                <label for="slide2"></label>
                <label for="slide3"></label>
                <label for="slide4"></label>
            </div>
        </div>

        <?php endif; ?>



        <!-- Footer único para ambos -->
        <footer class="tabs" style="margin-top: 15px; border-top: 1px solid #eee; padding-top: 20px; text-align: center;">
            <p><strong>Precisa de ajuda?</strong> Fale conosco pelo e-mail <a href="mailto:contato@seusistema.com">contato@seusistema.com</a> ou telefone (XX) XXXX-XXXX.</p>
            <hr>
            <p>&copy; <?= date('Y') ?> Sistema de Gestão Hospitalar. Todos os direitos reservados.</p>
        </footer>
    </div>
</body>
</html>
