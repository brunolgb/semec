<?php
session_start();
$cpf = $_POST["cpf"];
$password_acess = $_POST['password_acess'];

if(isset($cpf) and isset($password_acess))
{
    include_once("class/LoadClass.php");
    $select = new ConnectionDatabase();
    $res = $select->find(
        "SELECT * FROM person where password_acess=:password_acess",
        array(
            ":cpf"=>$cpf,
            ":password_acess"=>$password_acess
    ));

    if(count($res))
    {
        $_SESSION["id_user"] = $res[0]["id"];
        header("Location: ./pages/home");
    }
    else{
        echo "não foi possivel";
        header("Location: ../");
    }

}
?>