<?php
    include_once('../../verify_session.php');
    include_once("../../class/LoadClass.php");

    $id_update = $_GET["id"];
    $tbl_update = $_GET["tbl"];
    if(!empty($id_update) and !empty($tbl_update))
    {
        $con = new ConnectionDatabase();
        $show = $con->find(
            "SELECT * FROM $tbl_update WHERE id=:id",
            array(":id" => $id_update)
        );
        $values = count($show) ? $show[0] : "";
        
        $id = $values["id"];
        $name_school = $values["name_school"];
        $school_type = $values["school_type"];
        $school_locality = $values["school_locality"];
    }

    // verificando o erro
    $message = new ErrorsForms();
    $responseMsg = $message->getMsg($_GET["m"]);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../assets/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../style/estilo.css">
    <title>SEMEC - CADASTRO DE TRANSFERÊNCIA</title>
</head>
<body>
    <?php echo $responseMsg; ?>
   <?php include_once('../header/index.php'); ?>

   <div class="box-control">
       <div class="box-control-header">
           <div class="title">
               <span>PÁGINA INICIAL / ESCOLAS</span>
               <span>CADASTRO DE ESCOLA</span>
           </div>
           <div class="registration">
               <a href="../escola" class='btnPattern'>VOLTAR</a>
           </div>
       </div>
       <div class="box-control-body">
           <div class="form-pattern">
               <form action='./registration.php' method="post">
                    <input type="hidden" name="update_id" value='<?php echo $id_update; ?>'>
                    <input type="hidden" name="update_tbl" value='<?php echo $tbl_update; ?>'>
                   <div class="fieldControl">
                        <div class="fieldForm tam100">
                            <label for="name_school">Nome da Escola</label>
                            <input type="text" name='name_school' id='name_school' value="<?php echo $name_school; ?>" maxlength='255' required autofocus>
                        </div>
                    </div>
                    <div class="fieldControl">
                        <div class="fieldForm tam50">
                            <label for="school_type">Tipo de Ensino</label>
                            <input type="text" name='school_type' id='school_type' value="<?php echo $school_type; ?>" maxlength='255' list='type_school' required autofocus>
                            <datalist id='type_school' style='display: none'>
                                <option value="E. M.">Escola Municipal</option>
                                <option value="E. M. E. I.">Escola Municipal de Ensino Infantil</option>
                            </datalist>
                        </div>
                        <div class="fieldForm tam50">
                            <label for="school_locality">Localidade</label>
                            <input type="text" name='school_locality' id='school_locality' value="<?php echo $school_locality; ?>" maxlength='255' required autofocus>
                        </div>
                    </div>
                    <div class="tam100">
                        <button type="submit" class='submit'>Salvar</button>
                    </div>
               </form>
           </div>
       </div>
   </div>
   <?php include_once("../footer/index.php"); ?>
   <script src='../../scripts/script.js'></script>
</body>
</html>