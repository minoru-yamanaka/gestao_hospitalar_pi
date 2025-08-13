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

    <!-- CSS para o Carrossel e Imagens -->
    <style>
        .carousel-container {
            position: relative;
            width: 100%;
            max-width: 100%;
            margin: auto;
            overflow: hidden;
            border-radius: 12px; /* Aumentei o raio para um visual mais suave */
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
        
        /* Estilo para a imagem dentro do slide */
        .carousel-slide img {
            width: 100%;
            height: 400px; /* Altura fixa para a imagem */
            object-fit: cover; /* Garante que a imagem cubra a área sem distorcer */
            display: block;
        }

        /* Bloco de texto abaixo da imagem */
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
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 10; /* Garante que a navegação fique sobre a imagem */
        }

        .carousel-nav label {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.7); /* Fundo branco semitransparente */
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
            <!-- ================================== -->
            <!--   ÁREA PARA USUÁRIOS LOGADOS     -->
            <!-- ================================== -->
            <div class="header" id="topo">
                <div style="text-align: center; margin-bottom: 20px;">
                    <h1>Sistema de Gestão Hospitalar</h1>
                    <p>Gerencie Pacientes de forma eficiente</p>
                    <h3>Acesso de administrador</h3>
                    <p>Você logado para acessar o sistema.</p>
                    <br>
                    <button class="tab-button" onclick="window.location.href='index.php';">👥 Home</button>
                    <button class="tab-button" onclick="window.location.href='./frontend/logout.php';">📦 Sair</button>
                </div>

            <div class="tabs" style="margin-top: 30px;">
                <button class="tab-button" onclick="window.location.href='./frontend/lista_paciente.php';">📦 Paciente</button>
                <button class="tab-button" onclick="window.location.href='./frontend/lista_convenio.php';">📦 Convênios</button>
                <button class="tab-button" onclick="window.location.href='./frontend/lista_medicos.php';">📦 Médicos</button>
                <button class="tab-button" onclick="window.location.href='./frontend/lista_consultas.php';">📦 Consultas</button>
                <button class="tab-button" onclick="window.location.href='./frontend/lista_endereco.php';">📦 Endereços</button>
            </div>
          
          <div class="carousel-container">
                    <input type="radio" name="slider" id="slide1" checked>
                    <input type="radio" name="slider" id="slide2">
                    <input type="radio" name="slider" id="slide3">
                    <input type="radio" name="slider" id="slide4">

                    <div class="carousel-wrapper">
                        <!-- Slide 1 -->
                        <div class="carousel-slide">
                            <img src="img/image01.png" alt="Sala hospitalar moderna">
                            <div class="slide-content">
                                <h2>É com grande alegria que lançamos a Gestão AMD Hospitalar!</h2>
                                <p>Agradecemos por fazer parte deste marco. Nossa proposta é um sistema poderoso, personalizável e incrivelmente simples.</p>
                            </div>
                        </div>
                        <!-- Slide 2 -->
                        <div class="carousel-slide">
                            <img src="img/image02.png" alt="[Imagem de um médico usando um computador]">
                            <div class="slide-content">
                                <h2>Que bom ter você de volta!</h2>
                                <p>Estamos sempre trabalhando para aprimorar sua experiência. Fique à vontade para explorar e nos enviar suas sugestões!</p>
                            </div>
                        </div>
                        <!-- Slide 3 -->
                        <div class="carousel-slide">
                            <img src="img/image03.png" alt="[Imagem de gráficos com dados médicos]">
                            <div class="slide-content">
                                <h2>Novidade: Módulo de Relatórios Avançados!</h2>
                                <p>Crie dashboards personalizados e transforme dados em insights poderosos para uma gestão ainda mais precisa.</p>
                            </div>
                        </div>
                        <!-- Slide 4 -->
                        <div class="carousel-slide">
                            <img src="img/image04.png" alt="[Imagem de prontuários médicos organizados]">
                            <div class="slide-content">
                                <h2>Dica Rápida para Otimizar seu Tempo</h2>
                                <p>Você sabia que pode criar modelos de prontuário para agilizar atendimentos? Vá em "Configurações" e simplifique sua rotina.</p>
                            </div>
                            <br><br>
                        </div>
                        <div class="carousel-nav">
                        <label for="slide1"></label> <!-- Corrigido -->
                        <label for="slide2"></label>
                        <label for="slide3"></label>
                        <label for="slide4"></label>
                    </div>
                    </div>
                    <br><br>
                    
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
            </div>

             
        <?php else: ?>
            <!-- ================================== -->
            <!-- ÁREA PARA USUÁRIOS NÃO LOGADOS -->
            <!-- ================================== -->
            <div class="header" id="topo">
                <h1>Sistema de Gestão Hospitalar</h1>
                <p>Gerencie Pacientes de forma eficiente</p>
                <h3>Acesso Restrito</h3>
                <p>Você precisa estar logado para acessar o sistema.</p>
                <br>
                <div>
                    <button class="tab-button" onclick="window.location.href='./frontend/login.php';">📦 Fazer login</button>
                    <button class="tab-button" onclick="window.location.href='./frontend/cadastro.php';">📦 Criar conta</button>
                </div>
            </div>

            <div class="header" style="margin-top: 20px;">
                 <h2>Bem-vindo(a) ao Sistema de Gestão AMD Hospitalar</h2>
                 <p>Nossa plataforma foi criada para simplificar a gestão de hospitais, clínicas e consultórios. Popular por ser altamente personalizável e modular, ela se adapta perfeitamente às suas necessidades.</p>
                 <hr>
            </div>
        <?php endif; ?>

        <footer class="tabs" style="margin-top: 40px; border-top: 1px solid #eee; padding-top: 20px;">
            <p><strong>Precisa de ajuda ou quer saber mais?</strong></p>
            <p>Fale conosco pelo e-mail <a href="mailto:contato@seusistema.com">contato@seusistema.com</a> ou pelo telefone (XX) XXXX-XXXX.</p>
            <hr> 
            <p class="footer-text">&copy; <?= date('Y') ?> Sistema de Gestão Hospitalar. Todos os direitos reservados.</p>
        </footer>
    </div>
</body>
</html>
