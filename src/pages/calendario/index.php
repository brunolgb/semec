<?php
    include_once('../../verify_session.php');
    include_once('../fillCount.php');
    include_once('../../class/LoadClass.php');
    include_once("../../class/DateTools.php");
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
                <div class='tam20'>MODIFICADO</div>
                <div class='tam7'>AÇÃO</div>
            </div>
            <?php
            $list = new ConnectionDatabase();
            $listed = $list->find(
                "SELECT * FROM calendar_information",
                null);

            counting($listed);

            foreach($listed as $linha) {

                // date replace
                $DateTools = new DatesTools();
                $date_final = $DateTools->convertPattern("timestamp", $linha['modification_date'], new Date_PatternBR());

                // fineshed replace
                $fineshed = $linha['fineshed'] == "n" ? "não" : "sim";

                // show results
                echo "<div class='TableBody'>";
                    echo "<div class='tam5'>{$linha['id']}</div>";
                    echo "<div class='tam30'>{$linha['locality']}</div>";
                    echo "<div class='tam40'>{$linha['calendar_name']}</div>";
                    echo "<div class='tam10'>{$linha['school_year']}</div>";
                    echo "<div class='tam10'>{$fineshed}</div>";
                    echo "<div class='tam20'>{$date_final}</div>";
                    echo "<div class='tam7' id='acao' idRegistro='{$linha["id"]}' tbl='calendar_information' page='cadastro-de-calendario'>";
                        echo "<img src='../../assets/icon-search.png' title='Preencher Calendario' linkWindow='../preenchendo-calendario'>";
                        echo "<img src='../../assets/icon-update.png' update title='Editar informações'>";
                        echo "<img src='../../assets/icon-delete.png' delete title='Deletar registro'>";
                    echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
    <?php include_once("../footer/index.php"); ?>
   <script src='../../scripts/script.js'></script>
</body>
</html>