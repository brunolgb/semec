<?php
session_start();

$verify_action = $_POST["verify_action"];
$cpf = $_POST["cpf"];
$password_acess =  md5($_POST['password_acess']);

if(isset($_POST))
{
    include_once("class/LoadClass.php");
    $connection = new ConnectionDatabase();

    if($verify_action == "login")
    {
        $select = $connection->find(
            "SELECT * FROM person where cpf='$cpf' AND password_acess=:password_acess",
            array(
                ":password_acess"=>$password_acess
        ));

        if(count($select))
        {
            $_SESSION["id_user"] = $select[0]["id"];
            header("Location: ./pages/home");
        }
        else{
            header("Location: ../?m=user%or%password%invalid");
        }
    }
    else
    {
        $select = $connection->find(
            "SELECT id FROM person where cpf=:cpf",
            array(
                ":cpf"=>$cpf
        ));
        if(count($select))
        {
            header("Location: ../?m=cpf%registered");
        }
        else{
            $name_person = $_POST["name_person"];
            $birth = $_POST['birth'];
            $registration_date = date("Y-m-d h:i:s");

            $insert = $connection->insert(
                "INSERT INTO person (name_person, birth, cpf, password_acess, registration_date)
                VALUES ('$name_person', '$birth', '$cpf', '$password_acess', '$registration_date')",
                null
            );

            $transf_json = json_decode($insert, assoc);
            if($transf_json["message"])
            {
                // buscando o id do ususario
                $id_user = $connection->find(
                    "SELECT id FROM person where cpf=:cpf",
                    array(
                        ":cpf"=>$cpf
                ));

                $_SESSION["id_user"] = $id_user[0]['id'];
                header("Location: pages/home");
            }
            else
            {
                header("Location: ./?m=erro");
            }
        }
    }
}
?>