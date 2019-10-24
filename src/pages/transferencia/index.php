<?php
    include_once('../../verify_session.php');
    include_once('../fillCount.php');
    include_once('../../class/LoadClass.php');
    include_once("../../class/DateTools.php");
    include_once("../../class/Pattern_br.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../assets/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../style/estilo.css">
    <title>SEMEC - TRANSFERÊNCIA</title>
</head>
<body>
   <?php include_once('../header/index.php'); ?>

    <div class="box-control">
        <div class="box-control-header">
            <div class="title">
                <span>PÁGINA INICIAL /</span>
                <span>TRANSFERÊNCIA</span>
            </div>
            <div class="registration">
                <a href="../cadastro-de-transferencia" class='btnPattern'>Cadastrar</a>
            </div>
        </div>
        <div class="box-control-body">
            <div class="titleTableBody">
                <div class='tam5'>ID</div>
                <div class='tam30'>ESCOLA QUE ESTUDOU</div>
                <div class='tam30'>NOME ALUNO</div>
                <div class='tam20'>NASCIMENTO</div>
                <div class='tam30'>MÃE</div>
                <div class='tam20'>ANO LETIVO</div>
                <div class='tam7'>AÇÃO</div>
            </div>
            <?php
            $list = new ConnectionDatabase();
            $listed = $list->find(
                "SELECT * FROM school_transfer",
                null);

            counting($listed);
            
            // verify lenght text
            $TextLenght = new TextLenght();
            $listed = array_map(function ($arrayText){
                return array_map(function ($e){

                    $TextLenght = $GLOBALS["TextLenght"];
                    return $TextLenght->replace_text($e);

                }, $arrayText);

            }, $listed);

            foreach($listed as $linha) {

                // date replace
                $DateTools = new DatesTools();
                $birth = $DateTools->convertPattern("date", $linha['birth'], new Date_PatternBR());

                // fineshed replace
                $fineshed = $linha['fineshed'] == "n" ? "não" : "sim";

                // show results
                echo "<div class='TableBody'>";
                    echo "<div class='tam5'>{$linha['id']}</div>";
                    echo "<div class='tam30'>{$linha['school']}</div>";
                    echo "<div class='tam30'>{$linha['student']}</div>";
                    echo "<div class='tam20'>{$birth}</div>";
                    echo "<div class='tam30'>{$linha['mother']}</div>";
                    echo "<div class='tam20'>{$linha['last_year_of_study']}</div>";
                    echo "<div class='tam7' id='acao' idRegistro='{$linha["id"]}' tbl='school_transfer' page='cadastro-de-transferencia'>";
                        echo "<img src='../../assets/icon-search.png' update title='Editar informações'>";
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