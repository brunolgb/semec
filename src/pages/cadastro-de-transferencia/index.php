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
                        <div class="fieldForm tam80">
                            <label for="student">Nome do Aluno</label>
                            <input type="text" name='student' id='student' value="<?php echo $student; ?>" maxlength='255' required autofocus>
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
                                <option disable selected>-- Escolha --</option>
                                <option value="E. M. Carlos Pompermayer">Carlos Pompermayer</option>
                                <option value="E. M. João Medeiros Calmon">João Medeiros Calmon</option>
                                <option value="E. M. Nossa Senhora das Graças">Nossa Senhora das Graças</option>
                                <option value="E. M. Professor Vitor Quintiliano">Professor Vitor Quintiliano</option>
                                <option value="E. M. Darcy Ribeiro">Darcy Ribeiro</option>
                                <option value="E. M. E. I. Sonho Encantado">Sonho Encantado</option>
                                <option value="E. M. E. I. Cantinho Feliz">Cantinho Feliz</option>
                                <option value="E. M. Indigena Vale do Guaporé">Indigena Vale do Guaporé</option>
                                <option value="E. M. Tiago Elias Fernandes">Tiago Elias Fernandes</option>
                                <option value="E. M. Indigena Nambiquara">Indigena Nambikuara</option>
                                <option value="E. M. Erico Verissimo">Erico Verissimo</option>
                                <option value="E. M. Professora Helena Matiuzzo Felix">E. M. Professora Helena Matiuzzo Felix</option>
                                <option value="E. M. Castelo Branco">Castelo Branco</option>
                                <option value="E. M. Bom Jardim">Bom Jardim</option>
                            </select>
                        </div>
                        <div class="fieldForm tam20">
                            <label for="last_year_of_study">Ano letivo</label>
                            <input type="text" name='last_year_of_study' id='last_year_of_study' value="<?php echo $last_year_of_study; ?>" maxlength='4' class='tam20' required>
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
                            <input type="text" name='father' id='father' value="<?php echo $father; ?>" maxlength='255' required>
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