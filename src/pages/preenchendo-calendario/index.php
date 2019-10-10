<?php
    include_once('../../verify_session.php');
    include_once('../../class/ConnectionDatabase.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../assets/icon.png" type="image/x-icon">
    <!-- <link rel="stylesheet" href="../../style/estilo.css"> -->
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
                <div class="fill-header tam100">
                    <?php
                    echo "<div>";
                        echo "Nome do calendário";
                        echo "<span>{$calendar_name}</span>";
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
                    for($i = 0; $i < 12; $i++)
                    {
                        echo "<div class='month'>";
                            echo "<div class='title-month'>";
                                echo "JANEIRO";
                            echo "</div>";
                            echo "<div class='semana title-semana'>";
                                echo "<div class='day'>D</div>";
                                echo "<div class='day'>S</div>";
                                echo "<div class='day'>T</div>";
                                echo "<div class='day'>Q</div>";
                                echo "<div class='day'>Q</div>";
                                echo "<div class='day'>S</div>";
                                echo "<div class='day'>S</div>";

                            echo "</div>";
                            echo "<div class='days tam100'>";
                                echo "<div class='semana tam100'>";
                                    $cont = 1;
                                    for($ii = 1; $ii < 31; $ii++)
                                    {
                                        echo "<div class='day' day>{$ii}</div>";
                                        if($cont == 7 or $cont == 14 or $cont == 21 or $cont == 28)
                                        {
                                            echo "</div>";
                                            echo "<div class='semana'>";
                                        }
                                        $cont++;
                                    }
                                echo "</div>";
                            echo "</div>";
                            echo "<div class='month_information'>";
                            echo "I.B. T.B";
                            echo "</div>";
                        echo "</div>";
                    }
                    ?>
                </div>  
            </div>
       </div>
   </div>



   <script src='../../scripts/script.js'></script>
</body>
</html>