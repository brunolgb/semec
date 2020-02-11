<?php
session_start();

include_once('..'. DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR .'class'. DIRECTORY_SEPARATOR .'LoadClass.php');

$connection = new ConnectionDatabase();

$show = $connection->find(
    "SELECT * FROM person WHERE id=:id",
    array(
        ":id" => $_SESSION["id_user"]
    )
);


foreach ($_POST as $key => $value)
{
    if($show[0][$key] != $value)
    {
        $storage .= "{$key} = '{$value}', ";
    }
}

if(!empty($storage))
{
    $registration_date = Date('Y-m-d H:i:s');
    $storage .= "registration_date = '{$registration_date}'";

    $comand = "UPDATE person SET $storage WHERE id=:id";

    echo $comand;

    $return = $connection->update(
        $comand,
        array(
            ":id" => $_SESSION['id_user']
        )
    );

    $returnAction = json_decode($return, assoc);
    switch ($returnAction["message"])
    {
        case true:
            header('Location: ./');
        break;
        case false:
            header('Location: ./?m=9');
        break;
    }

}
else
{
    header('Location: ./?m=4');
}
?>