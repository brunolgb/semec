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
    <title>SEMEC - ESCOLAS</title>
</head>
<body>
   <?php include_once('../header/index.php'); ?>

    <div class="box-control">
        <div class="box-control-header">
            <div class="title">
                <span>PÁGINA INICIAL /</span>
                <span>ESCOLAS</span>
            </div>
            <div class="registration">
                <a href="../cadastro-de-escola" class='btnPattern'>Cadastrar</a>
            </div>
        </div>
        <div class="box-control-body">
            <form method="get">
            <div class="filter">
                    <input type="text" name="filter" id="filter" class='tam40' placeholder='Digite algo para filtrar'>
                    <button class="submit">Filtrar</button>
                </div>
            </form>
            <div class="titleTableBody">
                <div class='tam5 align-center'>ID</div>
                <div class='tam50'>NOME DA ESCOLA</div>
                <div class='tam20'>TIPO DE ENSINO</div>
                <div class='tam20'>LOCALIDADE</div>
                <div class='tam20 align-center'>DATA DE MODIFICAÇÃO</div>
                <div class='tam7 align-center'>AÇÃO</div>
            </div>
            <?php
            if(empty($_GET["filter"]))
            {
                $filter = "";
            }
            else{
                $get_filter = strtoupper($_GET["filter"]);
                $filter = "WHERE
                    bane_school LIKE '%$get_filter%'";
            }
            $conn = new ConnectionDatabase();
            $listed = $conn->find(
                "SELECT * FROM school $filter",
                null
            );

            // verify lenght text
            $TextLenght = new TextLenght();
            $listed = array_map(function ($arrayText){
                return array_map(function ($e){
                    $TextLenght = $GLOBALS["TextLenght"];
                    return $TextLenght->replace_text($e);

                }, $arrayText);

            }, $listed);
            counting($listed);

            foreach($listed as $linha) {

                // date replace
                $DateTools = new DatesTools();
                $birth = $DateTools->convertPattern("timestamp", $linha['modification_date'], new Date_PatternBR());
                
                // fineshed replace
                $fineshed = $linha['fineshed'] == "n" ? "não" : "sim";

                // show results
                echo "<div class='TableBody'>";
                    echo "<div class='tam5 align-center'>{$linha['id']}</div>";
                    echo "<div class='tam50'>{$linha['name_school']}</div>";
                    echo "<div class='tam20'>{$linha['school_type']}</div>";
                    echo "<div class='tam20'>{$linha['school_locality']}</div>";
                    echo "<div class='tam20 align-center'>{$linha['modification_date']}</div>";
                    echo "<div class='tam7 align-center' id='acao' idRegistro='{$linha["id"]}' tbl='school' page='cadastro-de-escola'>";
                        echo "<img src='../../assets/icon-search.png' update title='Editar informações'>";
                        echo "<img src='../../assets/icon-delete.png' delete title='Deletar registro'>";
                    echo "</div>";
                echo "</div>";
            }

            $total_registro = count($listed);
            echo "<div class='total_results'>";
                echo $total_registro;
                echo " Registros";
            echo "</div>";
            ?>
        </div>
    </div>
    <?php include_once("../footer/index.php"); ?>
   <script src='../../scripts/script.js'></script>
</body>
</html>