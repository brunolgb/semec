<?php
    include_once('../../verify_session.php');
    include_once('../../class/ConnectionDatabase.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../assets/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../style/estilo.css">
    <title>SEMEC - PREENCHIMENTO DE CALENDÁRIO</title>
</head>
<body>
   <?php include_once('../header/index.php'); ?>

   <div class="box-control">
       <div class="box-control-header">
           <div class="title">
               <span>PÁGINA INICIAL / CALENDÁRIOS</span>
               <span>PREENCHIMENTO DE CALENDÁRIO</span>
           </div>
           <div class="registration">
               <a href="../calendario" class='btnPattern'>VOLTAR</a>
           </div>
       </div>
       <?php
       $id_calendar = $_GET['calendar'];
       
       $cone = new ConnectionDatabase();
       $show_calendar_information = $cone->find(
           "SELECT id, calendar_name, locality, school_year FROM calendar_information WHERE id=:id",
           array(":id" => $id_calendar)
       );

        //    prefixo do array
       $prefix_show_calendar_information = $show_calendar_information[0];

        //    verificando se o campo não esta vazio
       $calendar_name = empty($prefix_show_calendar_information['calendar_name']) ? ' ------- ' : $prefix_show_calendar_information['calendar_name'];
       $locality = empty($prefix_show_calendar_information['locality']) ? ' ------- ' : $prefix_show_calendar_information['locality'];
       $school_year = empty($prefix_show_calendar_information['school_year']) ? ' ------- ' : $prefix_show_calendar_information['school_year'];
       ?>
       <div class="box-control-body">
            <div class="control-fill">
                <div class="fill-left tam30">
                    <div class="header-fill-left">
                        <?php
                        echo "Nome do calendário";
                        echo "<span>{$calendar_name}</span>";
                        echo "Localidade";
                        echo "<span>{$locality}</span>";
                        echo "Ano letivo";
                        echo "<span>{$school_year}</span>";
                        ?>
                    </div>
                    <div class="inputs-fill-left">
                        <form action="" method='post' name='fillCalendar'>
                            <label for="date">Data Selecionada</label>
                            <input type="date" name="date" id="date">

                            <label for="event">Selecione o evento</label>
                            <input type="text" name="event" id="event">

                            <div class="btnForm">
                                <button type="submit">Salvar</button>
                                <button type="reset">Limpar</button>
                            </div>
                            <button class="btnPatternBorder tam60">
                                <img src="../../assets/icon-search.png" alt="">
                                <span>VER CALENDÁRIO</span>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="fill-right tam70">
                    <div class="fill-right-top tam100">
                        <div class="month-and-btn tam50">
                            <div class="month">
                                <div class='months tam100'>
                                    <div class='months-title'>
                                        Janeiro
                                    </div>
                                    <div class='days'>

                                    </div>
                                </div>

                                <div class='months tam100' style='background-color: blue;'>
                                    <div class='months-title'>
                                        Janeiro
                                    </div>
                                    <div class='days'>

                                    </div>
                                </div>
                            </div>
                            <div class="btnForm">
                                <button>Anterior</button>
                                <button>Próximo</button>
                            </div>
                        </div>
                    </div>
                    <div class="fill-right-bottom">

                    </div>
                </div>
            </div>
       </div>
   </div>



   <script src='../../scripts/script.js'></script>
</body>
</html>