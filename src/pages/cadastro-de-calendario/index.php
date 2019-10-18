<?php
    include_once('../../verify_session.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../assets/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../style/estilo.css">
    <title>SEMEC - Cadastro de Calendários</title>
</head>
<body>
   <?php include_once('../header/index.php'); ?>

   <div class="box-control">
       <div class="box-control-header">
           <div class="title">
               <span>PÁGINA INICIAL / CALENDÁRIOS</span>
               <span>CADASTRO DE CALENDÁRIOS</span>
           </div>
           <div class="registration">
               <a href="../calendario" class='btnPattern'>VOLTAR</a>
           </div>
       </div>
       <div class="box-control-body">
           <div class="form-pattern">
               <form action='./registration.php' method="post">
                   <div class="fieldControl">
                        <div class="fieldForm tam80">
                            <label for="calendarName">Nome do Calendário</label>
                            <input type="text" name='calendarName' id='calendarName' placeholder='Ex: Escolas urbanas'>
                        </div>
                        <div class="fieldForm tam20">
                            <label for="schoolYear">Ano letivo</label>
                            <input type="text" name='schoolYear' id='schoolYear' value='2020' maxlength='4' class='tam20'>
                        </div>
                    </div>

                    <div class="locatityCalendar">
                        <div class="titleLocalityCalendar">Escolha a localidade</div>
                        <div class='choiseLocality' locality='indigena'>
                            <img src="../../assets/icone-indigena.svg" alt="">
                            <span>Indígena</span>
                        </div>
                        <div class='choiseLocality' locality='rural'>
                            <img src="../../assets/icone-rural.svg" alt="">
                            <span>Rural</span>
                        </div>
                        <div class='choiseLocality' locality='urbano'>
                            <img src="../../assets/icone-urbano.svg" alt="">
                            <span>Urbano</span>
                        </div>
                        <input type="hidden" name="localit" value='' localityValue>

                        <div class="tam100">
                            <button type="submit" class='submit'>Salvar</button>
                        </div>
                    </div>
               </form>
           </div>
       </div>
   </div>



   <script src='../../scripts/script.js'></script>
</body>
</html>