<?php
session_start();
$user = $_SESSION["id_user"];
if(!empty($_GET) and isset($_GET))
{
    include_once('.'. DIRECTORY_SEPARATOR .'class'. DIRECTORY_SEPARATOR .'LoadClass.php');
    $ids_withdraw = $_GET["ids_school_transfer"];
    $withdrawal_date = $_GET["withdrawal_date"];
    $responsible = $_GET["responsible"];
    $family_relationsship = $_GET["family_relationsship"];
    $destination_school = $_GET["destination_school"];
    $destination_city = $_GET["destination_city"];
    $registered_date = date("Y-m-d H:i:s");
    $modification_date = date("Y-m-d H:i:s");

    if($destination_school == "nenhuma")
    {
        $comand = "INSERT INTO school_transfer_withdrawal (
            id_school_transfer,
            withdrawal_date,
            responsible,
            family_relationsship,
            destination_city,
            registered_date,
            modification_date,
            registered_user
            ) VALUES(
            '$ids_withdraw',
            '$withdrawal_date',
            '$responsible',
            '$family_relationsship',
            '$destination_city',
            '$registered_date',
            '$modification_date',
            '$user'
        )";
    }
    else
    {
        $comand = "INSERT INTO school_transfer_withdrawal (
            id_school_transfer,
            withdrawal_date,
            responsible,
            family_relationsship,
            destination_school,
            registered_date,
            modification_date,
            registered_user
            ) VALUES(
            '$ids_withdraw',
            '$withdrawal_date',
            '$responsible',
            '$family_relationsship',
            '$destination_school',
            '$registered_date',
            '$modification_date',
            '$user'
        )";
    }

    $con_withdraw = new ConnectionDatabase();
    $insert_school_transfer_withdrawal = $con_withdraw->insert(
        $comand,
        null
    );

    $response_step1 = json_decode($insert_school_transfer_withdrawal, true);
    if($response_step1['message'])
    {
        echo updateTransfer($ids_withdraw, $con_withdraw);
    }
    else{
        echo '[{ "erro": "Não foi inserido" }, ' . $insert_school_transfer_withdrawal . ']';
    }

}
function updateTransfer($id_withdraw, $con_withdraw){
        $comand = "UPDATE school_transfer SET withdrawal='sim' WHERE id='$id_withdraw'";
        $updateTransfer = $con_withdraw->update(
            $comand,
            null
        );
        return $updateTransfer;
    }
?>