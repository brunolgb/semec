<?php
    include_once('../../verify_session.php');
    include_once('../../class/LoadClass.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../assets/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../style/estilo.css">
    <link rel="stylesheet" href="../../style/information_calendar.css">
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
       $calendar_name = $prefix_show_calendar_information['calendar_name'];
       $locality = $prefix_show_calendar_information['locality'];
       $school_year = $prefix_show_calendar_information['school_year'];
       ?>
       <div class="box-control-body">
            <div class="control-fill">
                <div class="fill-header tam100">
                    <?php
                    echo "<div>";
                        echo "Nome do calendário";
                        echo "<span>{$calendar_name}</span>";
                        echo "<input type='hidden' calendar value='" . $_GET['calendar'] . "'>";
                    echo "</div>";
                    echo "<div>";
                        echo "Localidade";
                        echo "<span>{$locality}</span>";
                    echo "</div>";
                    echo "<div>";
                        echo "Ano letivo";
                        echo "<span>{$school_year}</span>";
                    echo "</div>";
                    ?>
                </div>
                <div class="fill-body tam100">
                    <?php
                    $month = new AllMonth();
                    for ($i=0; $i < 12; $i++)
                    {
                        $month->mountMonth($i, $_GET['calendar']);
                    }
                    ?>
                </div>  
            </div>
       </div>
       <div class="informations_calendar">
           <div>
               <span total_feriado>
                   <?php
                   echo $month->all_number_of_event("feriado");
                   ?>
               </span>
               FERIADOS
           </div>
           <div>
            <span total_letivo>
                <?php
                   echo $month->all_number_of_event("letivo");
                ?>
            </span>
               Dias letivos
           </div>
           <div>
            <span total_facultativo>
                <?php
                   echo $month->all_number_of_event("facultativo");
                   ?>
            </span>
               Facultavivo
           </div>
           <?php
            echo "<button class='imprimir' calendar-id={$_GET["calendar"]}>";
            echo "Imprimir";
            echo "</button>";
            ?>
        </div>
   </div>
    <?php include_once("../footer/index.php"); ?>
    <script src='../../scripts/script.js'></script>
</body>
</html>