<?php
    include_once('..'. DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR .'verify_session.php');
    include_once('..'. DIRECTORY_SEPARATOR .'fillCount.php');
    include_once('..'. DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR .'class'. DIRECTORY_SEPARATOR .'LoadClass.php');
    include_once('..'. DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR .'class'. DIRECTORY_SEPARATOR .'DateTools.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../assets/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../style/estilo.css">
    <title>SEMEC - ARQUIVO PASSIVO</title>
</head>
<body>
   <?php include_once('../header/index.php'); ?>

    <div class="box-control">
        <div class="box-control-header">
            <div class="title">
                <span>PÁGINA INICIAL /</span>
                <span>ARQUIVO PASSIVO</span>
            </div>
            <div class="registration">
                <a href="../cadastro-de-arquivo-passivo" class='btnPattern'>Cadastrar</a>
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
                <div class='tam5'>ID</div>
                <div class='tam30'>ESCOLA QUE ESTUDOU</div>
                <div class='tam30'>NOME ALUNO</div>
                <div class='tam20'>NASCIMENTO</div>
                <div class='tam30'>MÃE</div>
                <div class='tam20'>ANO LETIVO</div>
                <div class='tam7'>AÇÃO</div>
            </div>
            <?php
            if(empty($_GET["filter"]))
            {
                $filter = "";
            }
            else{
                $get_filter = strtoupper($_GET["filter"]);
                $filter = "WHERE
                    school LIKE '%$get_filter%' OR
                    student LIKE '%$get_filter%' OR
                    mother LIKE '%$get_filter%' OR
                    father LIKE '%$get_filter%'";
            }

            $list = new ConnectionDatabase();
            $listed = $list->find(
                "SELECT * FROM passive_file",
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
                    echo "<div class='tam7' id='acao' idRegistro='{$linha["id"]}' tbl='passive_file' page='cadastro-de-arquivo-passivo'>";
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
    <?php include_once('..'. DIRECTORY_SEPARATOR .'footer'. DIRECTORY_SEPARATOR .'index.php')?>
   <script src='../../scripts/script.js'></script>
</body>
</html>