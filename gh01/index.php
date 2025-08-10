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
                                <hr>
                            <br>

                    <!-- mensagem  -->




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

                    <div class="header">
                        <h2>Bem-vindo(a) ao Sistema de Gestão AMD Hospitalar</h2>
                        <br>
                        <p>
                            Nossa plataforma foi criada para simplificar a gestão de hospitais, clínicas e consultórios. Popular por ser altamente personalizável e modular, ela se adapta perfeitamente às suas necessidades, provando que um sistema poderoso também pode ser intuitivo. Nossa filosofia é: <strong>Dispensa manual, pois até quem nunca viu, já sabe como funciona.</strong>
                        </p> 
                    </div>

                    <?php endif; ?>


                    <!-- Rodapé - Fotter-->
                        <div class="tabs">
                            <p><strong>Precisa de ajuda ou quer saber mais?</strong>
                            <hr>
                                <p>Fale conosco pelo e-mail <a href="mailto:contato@seusistema.com">contato@seusistema.com</a> ou pelo telefone (XX) XXXX-XXXX.</p>
                            <hr> 
                                <p class="footer-text">&copy; 2025 Sistema de Gestão Hospitalar. Todos os direitos reservados.</p>
                        </div>



                </div>
      
</body>
</html>