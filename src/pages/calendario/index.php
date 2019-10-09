<?php
    include_once('../../verify_session.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../assets/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../style/estilo.css">
    <title>SEMEC - Calendários</title>
</head>
<body>
   <?php include_once('../header/index.php'); ?>

   <div class="box-control">
       <div class="box-control-header">
           <div class="title">
               <span>PÁGINA INICIAL /</span>
               <span>CALENDÁRIOS</span>
           </div>
           <div class="registration">
               <a href="../cadastro-de-calendario" class='btnPattern'>Cadastrar</a>
           </div>
       </div>
       <div class="box-control-body">
           <div class="titleTableBody">
               <div class='tam5'>ID</div>
               <div class='tam30'>ÁREA</div>
               <div class='tam40'>NOME</div>
               <div class='tam10'>LETIVO</div>
               <div class='tam10'>TERMINADO</div>
               <div class='tam10'>MODIFICADO</div>
               <div class='tam7'>AÇÃO</div>
           </div>
           <?php

           include_once('../../class/LoadClass.php');

           $list = new Select();
           $listed = $list->findAll(
               "SELECT * FROM calendar_information",
               null);

           foreach($listed as $linha) { 
                echo "<div class='TableBody'>";
                    echo "<div class='tam5'>{$linha['id']}</div>";
                    echo "<div class='tam30'>{$linha['locality']}</div>";
                    echo "<div class='tam40'>{$linha['calendar_name']}</div>";
                    echo "<div class='tam10'>{$linha['school_year']}</div>";
                    echo "<div class='tam10'>{$linha['fineshed']}</div>";
                    echo "<div class='tam10'>{$linha['modification_date']}</div>";
                    echo "<div class='tam7' id='acao'>";
                        echo "<img src='../../assets/icon-search.png'>";
                        echo "<img src='../../assets/icon-update.png'>";
                        echo "<img src='../../assets/icon-delete.png' delete idRegistro='{$linha["id"]}' tbl='calendar_information'>";
                    echo "</div>";
                echo "</div>";
           }
           ?>
       </div>
   </div>



   <script src='../../scripts/script.js'></script>
</body>
</html>