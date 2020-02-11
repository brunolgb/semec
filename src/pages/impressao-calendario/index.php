<?php
    session_start();
    $id_calendar = $_GET["calendar"];
    include_once('..'. DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR .'class'. DIRECTORY_SEPARATOR .'LoadClass.php');
    include_once('..'. DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR .'class'. DIRECTORY_SEPARATOR .'DateTools.php');


    $cone = new ConnectionDatabase();
    $show_calendar_information = $cone->find(
        "SELECT id, calendar_name, locality, school_year FROM calendar_information WHERE id=:id",
        array(":id" => $id_calendar)
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
        echo "<input type='hidden' calendar value='" . $id_calendar . "'>";
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
                    $month->mountMonth($i, $id_calendar);
                }
                ?>
            </div>  
        </div>
        <div class="footerPrint tam100">
            <div id='legend'>
                <?php
                $json_events = file_get_contents("../../data/events.json");
                $events = json_decode($json_events, true);
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
            <div class="informationMain tam80">
                <?php   
                $inicio_bimestre = $cone->find(
                    "SELECT calendar_date as data FROM calendar WHERE event LIKE 'inicio%bimestre' AND id_calendar='{$id_calendar}' ORDER BY calendar_date",
                    null
                );
                $termino_bimestre = $cone->find(
                    "SELECT calendar_date as data FROM calendar WHERE event LIKE 'termino%bimestre' AND id_calendar='{$id_calendar}' ORDER BY calendar_date",
                    null
                );
                echo "<div class='bimestre'>";
                    echo "<div class='legend_bimestre tam100'>";
                        echo "<div>";
                            echo "<span>I.B</span> INÍCIO DE BIMESTRE";
                        echo "</div>";
                        echo "<div>";
                            echo "<span>T.B</span> TÉRMINO DE BIMESTRE";
                        echo "</div>";
                    echo "</div>";

                // date replace
                $DateTools = new DatesTools();
                $attributes = new Attributes($id_calendar);
                
                for ($i=0; $i < 4; $i++)
                {
                    $bimestre = $i + 1;
                    $inicio = $inicio_bimestre[$i]["data"];
                    $termino = $termino_bimestre[$i]["data"];

                    $start = !empty($inicio) ? $DateTools->convertPattern("date", $inicio, new Date_PatternBR()) : "----";
                    $previous = !empty($termino) ? $DateTools->convertPattern("date", $termino, new Date_PatternBR()) : "----";

                    $between = "'$inicio' AND '$termino'";

                    $total_letivos = $attributes->number_of_event("letivo", $between);

                    echo "<div id='controll_info'>";
                        echo "{$bimestre}º Bimestre";
                        echo "<span>Dias letivos {$total_letivos}</span>";
                        echo "<span>{$start} a {$previous}</span>";
                    echo "</div>";
                }
                echo "</div>";
                ?>
                <div class="defultInformation">
                    <?php
                    $event = array(
                        array("event"=> "letivo", "text" => "dias letivos"),
                        array("event"=> "feriado", "text" => "feriados"),
                        array("event"=> "facultativo", "text" => "facultativos")
                    );
                    foreach ($event as $line_event)
                    {
                        echo "<div>";
                            echo "Total de " . $line_event["text"];
                            echo "<span>{$attributes->number_of_event_for_year($line_event['event'])}</span>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src='../../scripts/script_creatorMonth.js'></script>
    <script>
        setTimeout(() => {
            window.print()
        }, 1000);
    </script>
</body>
</html>