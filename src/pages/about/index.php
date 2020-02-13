<?php
session_start();
$page = $_GET["page"];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../assets/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../style/estilo.css">
    <title>SEMEC - SOBRE A SEMEC</title>
</head>
<body>
   <?php include_once('..'. DIRECTORY_SEPARATOR .'header'. DIRECTORY_SEPARATOR .'index.php'); ?>

    <div class="box-control">
        <div class="box-control-header">
            <div class="title">
                <span>PÁGINA INICIAL /</span>
                <span>Mais sobre SEMEC</span>
            </div>
            <?php
            if($page == "login")
            {
                echo "<div class='registration'>";
                    echo "<a href='../../../' class='btnPattern'>Voltar para login</a>";
                echo "</div> ";
            }
            else{
                $user = $_SESSION["id_user"];
                include_once('..'. DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR .'verify_session.php');
                echo "<div class='registration'>";
                    echo "<a href='../../pages/home/' class='btnPattern'>Voltar para home</a>";
                echo "</div> ";
            }
            ?>
        </div>
        <div class="box-control-body about">
            <div class="about_image">
            </div>
            <div class="about_text">
                <h2>Secretaria Municipal de Educação</h2>
                <div>
                    <h3>Endereço</h3>
                    <span>Rua das palmeiras, Nº 284E</span>
                    <span>Bairro Nossa senhora de fátima</span>
                    <span>CEP 78310-000</span>
                    <span><a href="https://www.google.com.br/maps/dir/-13.6665549,-59.7896766/">Abrir no google map</a></span>
                </div>
                <div>
                    <h3>Contato</h3>
                    <span>Telefone | (65) 3283-1472</span>
                    <span class='small'>E-MAIL | semeccdo@gmail.com</span>
                </div>
            </div>
        </div>
    </div>
    <?php include_once("../footer/index.php"); ?>
   <script src='../../scripts/script.js'></script>
</body>
</html>