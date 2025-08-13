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
    <!-- <title>Gestão Hospitalar</title> -->
    <title>01</title>

    <style>
        .main-content { /* Adicionado para encapsular a área do usuário logado */
            display: flex;
            flex-direction: column;
            gap: 5px; /* Espaçamento entre os elementos */
        }

        .carousel-container {
            position: relative;
            width: 100%;
            max-width: 100%;
            margin: auto;
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
            box-sizing: border-box;
            background-color: #f8f9fa;
        }
        
        .carousel-slide img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            display: block;
        }

        .slide-content {
            padding: 25px; /* CORREÇÃO: Removido 'padding: 20px' duplicado */
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
            margin-bottom: 20px;
        }

        .carousel-container input[type="radio"] {
            display: none;
        }
        
        .carousel-nav {
            position: absolute;
            bottom: 20px;
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
            background-color: rgba(255, 255, 255, 0.7);
            border: 1px solid #ccc;
            cursor: pointer;
            transition: background-color 0.3s;
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
                <div class="header" id="topo" style="text-align: center;">
                    <h1>Sistema de Gestão Hospitalar 0</h1>
                    <p>Gerencie Pacientes de forma eficiente</p>
                    <h3>Acesso de administrador</h3>
                    <p>Você está logado para acessar o sistema.</p>
                    <br>
                    <!-- <div> <button class="tab-button" onclick="window.location.href='index.php';">👥 Home</button>
                        <button class="tab-button" onclick="window.location.href='./frontend/logout.php';">📦 Sair</button>
                    </div> -->
                </div>

                <div class="tabs">
                    <button class="tab-button" onclick="window.location.href='./frontend/lista_paciente.php';">📦 Paciente</button>
                    <button class="tab-button" onclick="window.location.href='./frontend/lista_convenio.php';">📦 Convênios</button>
                    <button class="tab-button" onclick="window.location.href='./frontend/lista_medicos.php';">📦 Médicos</button>
                    <button class="tab-button" onclick="window.location.href='./frontend/lista_consultas.php';">📦 Consultas</button>
                    <button class="tab-button" onclick="window.location.href='./frontend/lista_endereco.php';">📦 Endereços</button>
                    <button class="tab-button" onclick="window.location.href='./frontend/logout.php';">📦 Sair</button>
                </div>

                <div class="header">

                    <!-- mensagem  -->
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

                    <!-- mensagem  -->
                    <h2>Que bom ter você de volta à Gestão AMD Hospitalar!</h2>
                            <br>
                        <p>
                                Estamos sempre trabalhando para aprimorar sua experiência. Por isso, fique à vontade para explorar todas as ferramentas. Caso tenha alguma ideia nova ou precise de suporte, não hesite em nos contatar. Estamos aqui para ajudar!
                        </p>
                            <br>
                                <!-- <hr> -->
                            <br>

                    <!-- mensagem  -->
            </div>
            
                <div class="carousel-container">
                    <input type="radio" name="slider" id="slide1" checked>
                    <input type="radio" name="slider" id="slide2">
                    <input type="radio" name="slider" id="slide3">
                    <input type="radio" name="slider" id="slide4">

                    <div class="carousel-wrapper">
                        <div class="carousel-slide">
                            <img src="img/image01.png" alt="Sala de hospital moderna e bem iluminada.">
                            <div class="slide-content">
                                <h2>É com grande alegria que lançamos a Gestão AMD Hospitalar!</h2>
                                <p>Agradecemos por fazer parte deste marco. Nossa proposta é um sistema poderoso, personalizável e incrivelmente simples.</p>
                            </div>
                        </div>
                        <div class="carousel-slide">
                            <img src="img/image02.png" alt="Médico utilizando o sistema de gestão em um computador.">
                            <div class="slide-content">
                                <h2>Que bom ter você de volta!</h2>
                                <p>Estamos sempre trabalhando para aprimorar sua experiência. Fique à vontade para explorar e nos enviar suas sugestões!</p>
                            </div>
                        </div>
                        <div class="carousel-slide">
                            <img src="img/image03.png" alt="Gráficos e dados médicos exibidos em uma tela de computador.">
                            <div class="slide-content">
                                <h2>Novidade: Módulo de Relatórios Avançados!</h2>
                                <p>Crie dashboards personalizados e transforme dados em insights poderosos para uma gestão ainda mais precisa.</p>
                            </div>
                        </div>
                        <div class="carousel-slide">
                            <img src="img/image04.png" alt="Prontuários médicos digitais organizados em um tablet.">
                            <div class="slide-content">
                                <h2>Dica Rápida para Otimizar seu Tempo</h2>
                                <p>Você sabia que pode criar modelos de prontuário para agilizar atendimentos? Vá em "Configurações" e simplifique sua rotina.</p>
                            </div>
                        </div>
                    </div> <div class="carousel-nav">
                        <label for="slide1"></label>
                        <label for="slide2"></label>
                        <label for="slide3"></label>
                        <label for="slide4"></label>
                    </div>
                </div> 
            </div> 

            <br>

            <?php else: ?>
            <div class="header" id="topo" style="text-align: center;">
                <h1>Sistema de Gestão Hospitalar 0</h1>
                <p>Gerencie Pacientes de forma eficiente</p>
                <h3>Acesso Restrito</h3>
                <p>Você precisa estar logado para acessar o sistema.</p>
                <br>
                <div> <button class="tab-button" onclick="window.location.href='./frontend/login.php';">📦 Fazer login</button>
                    <button class="tab-button" onclick="window.location.href='./frontend/cadastro.php';">📦 Criar conta</button>
                </div>
            </div>

            <div class="header" style="margin-top: 20px;">
                <h2>Bem-vindo(a) ao Sistema de Gestão AMD Hospitalar</h2>
                <br>
                <p>Nossa plataforma foi criada para simplificar a gestão de hospitais, clínicas e consultórios. Popular por ser altamente personalizável e modular, ela se adapta perfeitamente às suas necessidades.</p>
                <br>
                <hr>
            </div>

             <div class="carousel-container">
                    <input type="radio" name="slider" id="slide1" checked>
                    <input type="radio" name="slider" id="slide2">
                    <input type="radio" name="slider" id="slide3">
                    <input type="radio" name="slider" id="slide4">

                    <div class="carousel-wrapper">
                        <div class="carousel-slide">
                            <img src="img/image01.png" alt="Sala de hospital moderna e bem iluminada.">
                            <div class="slide-content">
                                <h2>É com grande alegria que lançamos a Gestão AMD Hospitalar!</h2>
                                <p>Agradecemos por fazer parte deste marco. Nossa proposta é um sistema poderoso, personalizável e incrivelmente simples.</p>
                            </div>
                        </div>
                        <div class="carousel-slide">
                            <img src="img/image02.png" alt="Médico utilizando o sistema de gestão em um computador.">
                            <div class="slide-content">
                                <h2>Que bom ter você de volta!</h2>
                                <p>Estamos sempre trabalhando para aprimorar sua experiência. Fique à vontade para explorar e nos enviar suas sugestões!</p>
                            </div>
                        </div>
                        <div class="carousel-slide">
                            <img src="img/image03.png" alt="Gráficos e dados médicos exibidos em uma tela de computador.">
                            <div class="slide-content">
                                <h2>Novidade: Módulo de Relatórios Avançados!</h2>
                                <p>Crie dashboards personalizados e transforme dados em insights poderosos para uma gestão ainda mais precisa.</p>
                            </div>
                        </div>
                        <div class="carousel-slide">
                            <img src="img/image04.png" alt="Prontuários médicos digitais organizados em um tablet.">
                            <div class="slide-content">
                                <h2>Dica Rápida para Otimizar seu Tempo</h2>
                                <p>Você sabia que pode criar modelos de prontuário para agilizar atendimentos? Vá em "Configurações" e simplifique sua rotina.</p>
                            </div>
                        </div>
                    </div> <div class="carousel-nav">
                        <label for="slide1"></label>
                        <label for="slide2"></label>
                        <label for="slide3"></label>
                        <label for="slide4"></label>
                    </div>
                </div> 
            </div> 

        <?php endif; ?>

        <footer class="tabs" style="margin-top: 15px; border-top: 1px solid #eee; padding-top: 20px; text-align: center;">
            <p><strong>Precisa de ajuda ou quer saber mais?</strong></p> 
            
            <p>Fale conosco pelo e-mail <a href="mailto:contato@seusistema.com">contato@seusistema.com</a> ou pelo telefone (XX) XXXX-XXXX.</p>
            <hr> 
            <p class="footer-text">&copy; <?= date('Y') ?> Sistema de Gestão Hospitalar. Todos os direitos reservados.</p>
        </footer>

        
        
    </div>
</body>
</html>