<?php
    session_start();
    include_once('../../class/LoadClass.php');


    $cone = new ConnectionDatabase();
    $show_calendar_information = $cone->find(
        "SELECT id, calendar_name, locality, school_year FROM calendar_information WHERE id=:id",
        array(":id" => $_GET["calendar"])
    );
    $list = $show_calendar_information[0];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../assets/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../style/estilo.css">
    <link rel="stylesheet" href="../../style/print.css">
    <?php 
        echo "<title>CALENDÁRIO ESCOLAR - ";
        echo strtoupper($list['calendar_name']) . " | ";
        echo strtoupper($list['school_year']);
        echo "</title>";
    ?>
</head>
<body>
    <?php
        echo "<input type='hidden' calendar value='" . $_GET['calendar'] . "'>";
    ?>
    <div class="controllerPrint">
        <header class='print-header tam100'>
            <figure>
                <img src="../../assets/logo-prefeitura.png" alt="Logo Prefeitura Municipal de Comodoro">
            </figure>
            <div class="titleContent tam70">
                <span>PREFEITURA MUNICIPAL DE COMODORO</span>
                <span>SECRETARIA MUNICIPAL DE EDUCAÇÃO E CULTURA</span>
                <span>CALENDÁRIO ESCOLAR</span>
            </div>
            <figure>
                <img src="../../assets/logo_default.svg" alt="Logo Secretaria Municipal de Comodoro">
            </figure>
        </header>
        <div class="informationsCalendar">
            <div>
                Nome do calendário
                <span>
                    <?php echo $show_calendar_information[0]['calendar_name']; ?>
                </span>
            </div>
            <div>
                Localidade
                <span>
                    <?php echo $show_calendar_information[0]['locality']; ?>
                </span>
            </div>
            <div>
                Ano letivo
                <span>
                    <?php echo $show_calendar_information[0]['school_year']; ?>
                </span>
            </div>
        </div>
        <div class="control-fill">
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
        <div class="footerPrint tam100">
            <div class="printLegendColor tam30">
                <?php
                $json_events = file_get_contents("../../data/events.json");
                $events = json_decode($json_events, assoc);
                foreach ($events as $line)
                {
                    if($line["name"] != "vazio")
                    {
                        $name = empty($line["nameReplace"]) ? $line["name"] : $line["nameReplace"];
                        echo "<div class='colors'>";
                            echo "<span class='color_symbol' id='{$line['name']}'></span>";
                            echo "<span class='color_name'>{$name}</span>";
                        echo "</div>";
                    }
                }
                ?>
            </div>
            <div class="informationMain">
                <?php
                    $bimestres = $cone->find(
                        "SELECT event, calendar_date FROM calendar WHERE event LIKE '%bimestre' AND id_calendar=:id ORDER BY calendar_date",
                        array(
                            ":id" => $_GET["calendar"]
                        )
                    );

                    $cont = 0;
                    for($i=1; $i <= count($bimestres); $i++)
                    {
                        switch($bimestres)
                        {
                            case 1:
                            echo "<div>";
                                echo "<span>";
                                    echo $i . "º Bimestre";
                                echo "</span>";
                            echo "</div>";
                            break;
                        case 2:
                            echo $bimestres[$cont]["calendar_date"];
                            $cont++;
                            break;
                        case 3:
                            echo $bimestres[$cont]["calendar_date"];
                            $cont++;
                            break;
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <script src='../../scripts/script_creatorMonth.js'></script>
    <!-- <script>window.print()</script> -->
</body>
</html>