<?php
        include_once('..'. DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR .'verify_session.php');
    include_once('..'. DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR .'class'. DIRECTORY_SEPARATOR .'LoadClass.php');

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

        $calendar_name = $values["calendar_name"];
        $school_year = $values["school_year"];
        $locality = $values["locality"];

        $check_locality = array();
        switch ($locality) {
            case 'indigena': $check_locality[0] = " locatityCalendarMoviment"; break;
            case 'rural': $check_locality[1] = " locatityCalendarMoviment"; break;
            case 'urbano': $check_locality[2] = " locatityCalendarMoviment"; break;
        }
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
    <title>SEMEC - Cadastro de Calendários</title>
</head>
<body>
    <?php echo $responseMsg; ?>
   <?php include_once('../header/index.php'); ?>

   <div class="box-control">
       <div class="box-control-header">
           <div class="title">
               <span>PÁGINA INICIAL / CALENDÁRIOS</span>
               <span>CADASTRO DE CALENDÁRIOS</span>
           </div>
           <div class="registration">
               <a href="../calendario" class='btnPattern'>VOLTAR</a>
           </div>
       </div>
       <div class="box-control-body">
           <div class="form-pattern">
               <form action='./registration.php' method="post">
                    <input type="hidden" name="update_id" value='<?php echo $id_update; ?>'>
                    <input type="hidden" name="update_tbl" value='<?php echo $tbl_update; ?>'>
                   <div class="fieldControl">
                        <div class="fieldForm tam80">
                            <label for="calendar_name">Nome do Calendário</label>
                            <input type="text" name='calendar_name' id='calendar_name' value="<?php echo $calendar_name; ?>" placeholder='Ex: Escolas urbanas' required>
                        </div>
                        <div class="fieldForm tam20">
                            <label for="school_year">Ano letivo</label>
                            <input type="text" name='school_year' id='school_year' value="<?php echo $school_year; ?>" maxlength='4' class='tam20' required>
                        </div>
                    </div>

                    <div class="locatityCalendar">
                        <div class="titleLocalityCalendar">Escolha a localidade</div>
                        <aside class="btnLocalityCalendar">
                            <div class='choiseLocality <?php echo $check_locality[0]; ?>' locality='indigena'>
                                <img src="../../assets/icone-indigena.svg" alt="">
                                <span>Indígena</span>
                            </div>
                            <div class='choiseLocality <?php echo $check_locality[1]; ?>' locality='rural'>
                                <img src="../../assets/icone-rural.svg" alt="">
                                <span>Rural</span>
                            </div>
                            <div class='choiseLocality <?php echo $check_locality[2]; ?>' locality='urbano'>
                                <img src="../../assets/icone-urbano.svg" alt="">
                                <span>Urbano</span>
                            </div>
                            <div class='choiseLocality <?php echo $check_locality[3]; ?>' locality='mesclado'>
                                <img src="../../assets/icone-mesclado.svg" alt="">
                                <span>Mesclado</span>
                            </div>
                        </aside>
                        <input type="hidden" name="locality" value='<?php echo $locality; ?>' localityValue required>

                        <div class="tam100">
                            <button type="submit" class='submit'>Salvar</button>
                        </div>
                    </div>
               </form>
           </div>
       </div>
   </div>
   <?php include_once('..'. DIRECTORY_SEPARATOR .'footer'. DIRECTORY_SEPARATOR .'index.php')?>
   <script src='../../scripts/script.js'></script>
</body>
</html>