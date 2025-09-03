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
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <style>
        .main-content {
            display: flex;
            flex-direction: column;
            gap: 5px; /* Espaçamento entre os elementos */
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

        /* Estilos do botão de chat */
        .chat-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 15px 25px;
            font-size: 16px;
            font-weight: bold;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: transform 0.2s;
            display: flex;
            align-items: center;
            gap: 8px; /* Espaço entre o ícone e o texto */
            text-decoration: none; /* Remove underline */
        }

        .chat-button:hover {
            transform: scale(1.05); /* Efeito sutil ao passar o mouse */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- PAGE | HOME LOGADOS  -->
        <?php if ($isLogged): ?>
            <div class="main-content">
                <div class="header" style="text-align: center;">
                    <h1>MedSync - Sistema de Gestão Hospitalar</h1>
                    <h2>Gestão inteligente para hospitais eficientes</h2>
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

                <!-- mensageM PRINCIPAL para home | logados  -->
                <div class="header">
                    <h2>Bem-vindo(a) à Gestão AMD Hospitalar!</h2>
                    <p>Sistema modular, intuitivo e poderoso, feito para facilitar sua rotina.</p>
                </div>
            </div>

             <!-- Carrossel para não logados -->
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
<br>
        <!-- mensagens para home | logados  -->
        <div class="header">

                    <!-- mensagem  01 -->
                    <h2>É com grande alegria que lançamos a Gestão AMD Hospitalar!</h2>
                            <br>
                        <p>
                            Seja bem-vindo(a)! Agradecemos imensamente por você fazer parte deste marco em nossa história. Este lançamento é a realização de um grande projeto, e tê-lo(a) conosco desde o início é a nossa maior motivação.
                            <br><br>
                            <strong>Nossa proposta</strong> sempre foi clara: criar um sistema de gestão que fosse ao mesmo tempo poderoso e incrivelmente simples. Uma ferramenta modular e personalizável, pensada para se adaptar à rotina de hospitais e clínicas, e não o contrário. Acreditamos que a tecnologia deve ser tão intuitiva que dispensa manuais, permitindo que você foque no que realmente importa: o cuidado e o bem-estar dos pacientes.
                            <br><br>
                            Explore, utilize e sinta-se em casa. Estamos apenas começando!
                        </p>
                           
                    
            </div>

        <!-- PAGE | HOME LOGADOS  -->
        <?php else: ?>
            <div class="header" style="text-align: center;">
                <h1>MedSync - Sistema de Gestão Hospitalar</h1>
                <h2>Gestão inteligente para hospitais eficientes</h2>
                <h3>Acesso Restrito</h3>
                <p>Você precisa estar logado para acessar o sistema.</p>
                <br>
                <div style="padding-top:10px">
                    <button class="tab-button" onclick="location.href='./frontend/login.php';">📦 Entrar</button>
                    <button class="tab-button" onclick="location.href='./frontend/cadastro.php';">📦 Criar conta</button>
                </div>
            </div>

        <!-- Carrossel para não logados -->
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
<br>
        <!-- mensagens para home | não logados  -->
        <!-- <div class="header">

                    
                    <h2>É com grande alegria que lançamos a Gestão AMD Hospitalar!</h2>
                            <br>
                        <p>
                            Seja bem-vindo(a)! Agradecemos imensamente por você fazer parte deste marco em nossa história. Este lançamento é a realização de um grande projeto, e tê-lo(a) conosco desde o início é a nossa maior motivação.
                            <br><br>
                            <strong>Nossa proposta</strong> sempre foi clara: criar um sistema de gestão que fosse ao mesmo tempo poderoso e incrivelmente simples. Uma ferramenta modular e personalizável, pensada para se adaptar à rotina de hospitais e clínicas, e não o contrário. Acreditamos que a tecnologia deve ser tão intuitiva que dispensa manuais, permitindo que você foque no que realmente importa: o cuidado e o bem-estar dos pacientes.
                            <br><br>
                            Explore, utilize e sinta-se em casa. Estamos apenas começando!
                        </p>
                            <br>
                                <hr>
                            <br>

                    <h2>Que bom ter você de volta à Gestão AMD Hospitalar!</h2>
                            <br>
                        <p>
                                Estamos sempre trabalhando para aprimorar sua experiência. Por isso, fique à vontade para explorar todas as ferramentas. Caso tenha alguma ideia nova ou precise de suporte, não hesite em nos contatar. Estamos aqui para ajudar!
                        </p>
                            <br>
                             
                            <br>

                 
            </div> -->

        <?php endif; ?>


        <!-- Footer único para ambos -->

        <footer class="footer">
            <p><strong>Precisa de ajuda?</strong> | Fale conosco pelo e-mail <a href="mailto:contato@seusistema.com">contato@seusistema.com</a> ou telefone (XX) XXXX-XXXX.</p>
            
            <p>&copy; <?= date('Y') ?> Sistema de Gestão Hospitalar. Todos os direitos reservados.</p>
        </footer>
    </div>

    <!-- Botão de Chat Flutuante -->
    


    <a href="chat/chat.html" class="chat-button" role="button">
    💬 Posso ajudar?
    </a>
    
</body>
</html>
