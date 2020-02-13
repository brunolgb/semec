<?php
    include_once('..'. DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR .'verify_session.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../assets/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../style/estilo.css">
    <link rel="stylesheet" href="../../style/mypage.css">
    <title>SEMEC - DESENVOLVEDOR</title>
</head>
<body>
   <?php include_once('..'. DIRECTORY_SEPARATOR .'header'. DIRECTORY_SEPARATOR .'index.php'); ?>

    <div class="box-control box-controldev">
        <div class="box-control-header">
            <div class="title">
                <span>PÁGINA INICIAL /</span>
                <span>DESENVOLVEDOR</span>
            </div>
        </div>
    </div>
        <section class="control_mypage mypage_logo">
            <figure>
                <img src="../../assets/logo_colors.svg" alt="">
            </figure>
        </section>
        <section class="control_mypage mypage_services">
            <div class="controlServices">
                <h1>Nossos serviços</h1>
                <div class="myservices">
                    <div class="myservice">
                        <span class="titleService">Social mídia</span>
                        <span id="separator"></span>
                        <span class='describeService'>
                            Sem dúvidas nenhuma, as redes sociais tem se tornado parte do cotidiano da maioria das pessoas e empresas!
                            Usar as redes para divulgar produtos e serviços tem sido, atualmente, um dos melhores mecânismos para alcançar novos clientes.
                            <br>Esteja aonde seus clientes estão, e nós podemos te ajudar nisso!
                        </span>
                    </div>
                    <div class="myservice">
                        <span class="titleService">Desenvolvimento</span>
                        <span id="separator"></span>
                        <span class='describeService'>
                            Marcar presença na grande Internet é a maneira mais promissora de ter ganhos!
                            As pessoas tem buscado facilidades que somente um <em>site ou aplicativo</em> pode oferecer! <br>Venha para a rede!
                        </span>
                    </div>
                    <div class="myservice">
                        <span class="titleService">Design Gráfico</span>
                        <span id="separator"></span>
                        <span class='describeService'>
                            Cuidar da sua identidade visual é primordial! Entenda que uma boa logo, uma camiseta personalizada, um flyer, folder, banner e etc. podem tornar sua presença mais significativa!
                        </span>
                    </div>
                </div>
            </div>
        </section>
        <section class="control_mypage mypage_redes">
            <div class='controlRedes'>
                <div>
                    <a href="http://www.facebook.com/solucaocriativaoficial" target="_blank">
                        <img src="../../assets/icon-facebook.svg" alt="Facebook">
                        <span>/solucaocriativaoficial</span>
                    </a>
                </div>
                <div>
                    <a href="http://www.instagran.com/solucaocriativaoficial" target="_blank">
                    <img src="../../assets/icon-instagran.svg" alt="Instagran">
                    <span>@solucaocriativaoficial</span>
                </div>
            </div>
        </section>
   <script src='../../scripts/script.js'></script>
</body>
</html>