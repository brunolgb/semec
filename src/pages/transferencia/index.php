<?php
    include_once('../../verify_session.php');
    include_once('../fillCount.php');
    include_once('../../class/LoadClass.php');
    include_once("../../class/DateTools.php");

    $verification_if_checked_the_checkbox = empty($_GET['filter_withdrawal']) ? '' : 'checked';
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
            <form method="get">
            <div class="filter">
                <input type="text" name="filter" id="filter" class='tam40' placeholder='Digite algo para filtrar' value='<?php echo $_GET["filter"]?>'>
                <div class="checkbox-filter tam20">
                    <input type="checkbox" name="filter_withdrawal" id="filter_withdrawal" value="sim" <?php echo $verification_if_checked_the_checkbox?>>
                    <label for="filter_withdrawal">Somente retirados</label>
                </div>
                <button class="submit">Filtrar</button>
            </div>
            </form>
            <?php
            if(empty($_GET["filter"]))
            {
                $filter = "";
            }
            else{
                $get_filter = strtoupper($_GET["filter"]);
                $filter = "WHERE
                    student LIKE '%$get_filter%' OR
                    mother LIKE '%$get_filter%' OR
                    father LIKE '%$get_filter%' OR
                    mother LIKE '%$get_filter%' OR
                    name_school LIKE '%$get_filter%' OR
                    school_type LIKE '%$get_filter%' OR
                    school_locality LIKE '%$get_filter%'";
            }

            if(isset($_GET["filter_withdrawal"]))
            {
                $filter_withdrawal = "withdrawal='" . $_GET["filter_withdrawal"] . "'";
                $filter = empty($filter) ? "WHERE " . $filter_withdrawal : $filter . " OR " . $filter_withdrawal; 
            }
            $conn = new ConnectionDatabase();
            $listed = $conn->find(
                "SELECT * FROM view_school_transfer $filter ORDER BY student",
                null);

                // verify lenght text
                $TextLenght = new TextLenght();
                $listed = array_map(function ($arrayText){
                    return array_map(function ($e){                    
                    $TextLenght = $GLOBALS["TextLenght"];
                    return $TextLenght->replace_text($e);
                    }, $arrayText);
            }, $listed);

            $total_registro = count($listed);
            echo "<div class='total_results'>";
                echo $total_registro;
                echo " Registros";
            echo "</div>";

            ?>
            <div class="titleTableBody">
                <div class='tam5'>ID</div>
                <div class='tam30'>ESCOLA QUE ESTUDOU</div>
                <div class='tam30'>NOME ALUNO</div>
                <div class='tam20'>NASCIMENTO</div>
                <div class='tam30'>MÃE</div>
                <div class='tam10'>LETIVO</div>
                <div class='tam10'>RETIRADA</div>
                <div class='tam7'>AÇÃO</div>
            </div>
            <?php
            counting($listed);

            foreach($listed as $linha) {

                // date replace
                $DateTools = new DatesTools();
                $birth = $DateTools->convertPattern("date", $linha['birth'], new Date_PatternBR());

                // replace for button withdraw
                $btn_withdrawal = empty($linha['withdrawal']) ? "<button class='btn_withdraw' withdraw>Retirar</button>" : "<button class='btn_withdraw withdrawal' withdrawal>RETIRADO</button>";

                // show results
                echo "<div class='TableBody'>";
                    echo "<div class='tam5'>{$linha['id']}</div>";
                    echo "<div class='tam30 align-left'>{$linha['school_type']} {$linha['name_school']}</div>";
                    echo "<div class='tam30 align-left'>{$linha['student']}</div>";
                    echo "<div class='tam20'>{$birth}</div>";
                    echo "<div class='tam30 align-left'>{$linha['mother']}</div>";
                    echo "<div class='tam10'>{$linha['last_year_of_study']}</div>";
                    echo "<div class='tam10' idWithdraw='" . $linha["id"] . "'>";
                        echo $btn_withdrawal;
                    echo "</div>";
                    echo "<div class='tam7' id='acao' idRegistro='{$linha["id"]}' tbl='school_transfer' page='cadastro-de-transferencia'>";
                        echo "<img src='../../assets/icon-search.png' update title='Editar informações'>";
                        echo "<img src='../../assets/icon-delete.png' delete title='Deletar registro'>";
                    echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
    <div class="box_withdraw">

        <div id="withdraw">
            Retirar transferência de
            <span number_of_withdrawSelected></span>
             aluno
        </div>
        <div class="form_withdraw">
            <form method="post" name="formulario_withdraw">
                <input type="hidden" name="ids_school_transfer" ids_school_transfer>
                <label for="withdrawal_date">Data da retirada</label>
                <input type="date" name="withdrawal_date" id="withdrawal_date" value="<?php echo date("Y-m-d")?>" form_field>

                <label for="responsible">Responsável que retirou</label>
                <input type="text" name="responsible" id="responsible" maxlenght="255" autofocus  form_field>

                <label for="family_relationsship">Parentesco do responsável</label>
                <input type="text" name="family_relationsship" id="family_relationsship" maxlenght="10" form_field>
                
                <label for="destination_school">Escola de destino</label>
                <select name="destination_school" id="destination_school" form_field>
                    <?php
                        $school_options = $conn->find(
                            "SELECT id, name_school,school_type FROM school",
                            null
                        );

                        foreach ($school_options as $school)
                        {
                            echo "<option value='" . $school["id"] ."'>";
                            echo $school["school_type"] . " " . $school["name_school"];
                            echo "</option>";
                        }
                    ?>
                    <option value="nenhuma" select_destinationSchool>Nenhuma da lista</option>
                </select>
                <input type="text" name="destination_city" class="destination_city" maxlenght="255" placeholder="Digite aqui a cidade caso não saiba a escola" form_field>
                <div class="buttons_withdraw">
                    <button type="submit" class="submit" submit>Retirar</button>
                    <button class="submit close_withdraw" close_withdraw>Fechar</button>
                </div>
            </form>
        </div>
    </div>
    <?php include_once("../footer/index.php"); ?>
   <script src='../../scripts/script.js'></script>
</body>
</html>