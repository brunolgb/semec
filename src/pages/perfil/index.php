<?php
    include_once('../../verify_session.php');
    include_once('../../class/LoadClass.php');

    // verificando o erro
    $message = new ErrorsForms();
    $responseMsg = $message->getMsg($_GET["m"]);

    // database
    $connetion = new ConnectionDatabase();
    $listed = $connetion->find(
        "SELECT cpf, birth FROM person WHERE id=:id",
        array(
            ":id"=>$_SESSION["id_user"]
        )
    );
    $results = $listed[0];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../assets/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../style/estilo.css">
    <title>SEMEC - PERFIL </title>
</head>
<body>
   <?php
    include_once('../header/index.php');
    echo $responseMsg;
   ?>

   <div class="box-control">
       <div class="box-control-header">
           <div class="title">
               <span>PÁGINA INICIAL</span>
               <span>PERFIL</span>
           </div>
       </div>
       <div class="box-control-body">
           <div class="form-pattern">
               <form action='./registration.php' method="post">
                   <div class="fieldControl">
                        <div class="fieldForm tam70">
                            <label for="name_person">Seu nome</label>
                            <input type="text" name='name_person' id='name_person' value='<?php echo $_SESSION["name_person"]?>'>
                        </div>
                        <div class="fieldForm tam30">
                            <label for="birth">Nascimento</label>
                            <input type="date" name='birth' id='birth' maxlength='4' class='tam100'  value='<?php echo $results["birth"]?>'>
                        </div>
                    </div>
                    <div class="fieldControl">
                        <div class="fieldForm tam100">
                            <label for="cpf">CPF</label>
                            <input type="text" name='cpf' id='cpf' value='<?php echo $results["cpf"]?>'>
                        </div>
                    </div>
                    <div class="tam100">
                        <button type="submit" class='submit'>Salvar</button>
                    </div>
               </form>
           </div>
       </div>
   </div>



   <script src='../../scripts/script.js'></script>
</body>
</html>