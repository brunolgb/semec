<?php
    include_once('..'. DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR .'verify_session.php');
    include_once('..'. DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR .'class'. DIRECTORY_SEPARATOR .'LoadClass.php');

    $con = new ConnectionDatabase();

    $id_update = $_GET["id"];
    $tbl_update = $_GET["tbl"];
    if(!empty($id_update) and !empty($tbl_update))
    {
        $show = $con->find(
            "SELECT * FROM $tbl_update WHERE id=:id",
            array(":id" => $id_update)
        );
        $values = count($show) ? $show[0] : "";
        
        $id = $values["id"];
        $school = $values["school"];
        $student = $values["student"];
        $birth = $values["birth"];
        $mother = $values["mother"];
        $father = $values["father"];
        $last_year_of_study = $values["last_year_of_study"];

        // echo $student;
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
               <span>PÁGINA INICIAL / TRANSFERÊNCIA</span>
               <span>CADASTRO DE TRANSFERÊNCIA</span>
           </div>
           <div class="registration">
               <a href="../transferencia" class='btnPattern'>VOLTAR</a>
           </div>
       </div>
       <div class="box-control-body">
           <div class="form-pattern">
               <form action='./registration.php' method="post">
                    <input type="hidden" name="update_id" value='<?php echo $id_update; ?>'>
                    <input type="hidden" name="update_tbl" value='<?php echo $tbl_update; ?>'>
                   <div class="fieldControl">
                        <div class="fieldForm tam80 searchData">
                            <label for="student">Nome do Aluno</label>
                            <input type="text" name='student' id='student' value="<?php echo $student; ?>" maxlength='255' required autofocus>
                            <div class='viewSearchStudent'>

                            </div>
                        </div>
                        <div class="fieldForm tam20">
                            <label for="birth">Data de Nascimento</label>
                            <input type="date" name='birth' id='birth' value="<?php echo $birth; ?>" maxlength='7' class='tam20' required>
                        </div>
                    </div>
                    <div class="fieldControl">
                        <div class="fieldForm tam80">
                            <label for="school">Escola que estudou</label>
                            <select name="school" id="school" required>
                                <?php
                                
                                $listSchool = $con->find(
                                    "SELECT id, name_school, school_type FROM school",
                                    null
                                );

                                echo "<option disable>-- Escolha --</option>";
                                foreach ($listSchool as $line)
                                {
                                    $id_school = $line['id'];
                                    $name_complete = $line['school_type'] . " " . $line['name_school'];;
                                    $selected = $school == $id_school ? "selected" : "";
                                    
                                    echo "<option value='$id_school' $selected>$name_complete</option>";   
                                }
                                ?>
                            </select>
                        </div>
                        <div class="fieldForm tam20">
                            <label for="last_year_of_study">Ano letivo</label>
                            <input type="number" name='last_year_of_study' id='last_year_of_study' value="<?php echo isset($last_year_of_study) ? $last_year_of_study : date('Y'); ?>" maxlength='4' class='tam20' required>
                        </div>
                    </div>
                    <div class="fieldControl">
                        <div class="fieldForm tam100">
                            <label for="mother">Nome da Mãe</label>
                            <input type="text" name='mother' id='mother' value="<?php echo $mother; ?>" maxlength='255' required>
                        </div>
                    </div>
                    <div class="fieldControl">
                        <div class="fieldForm tam100">
                            <label for="father">Nome do pai</label>
                            <input type="text" name='father' id='father' value="<?php echo $father; ?>" mask-year maxlength='255' required>
                        </div>
                    </div>
                    <div class="tam100">
                        <button type="submit" class='submit'>Salvar</button>
                    </div>
               </form>
           </div>
       </div>
   </div>
   <?php include_once("..". DIRECTORY_SEPARATOR ."footer". DIRECTORY_SEPARATOR ."index.php"); ?>
   <script src='../../scripts/script.js'></script>
   <script src="../../scripts/mask.js"></script>
</body>
</html>