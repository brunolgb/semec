<?php
session_start();

include_once('../../class/LoadClass.php');

$storage = array();

foreach ($_POST as $key => $value)
{
    if(!empty($value))
    {
        $storage[":{$key}"] = $value;
    }
}

$storage[":modification_dat"] = Date('Y-m-d H:i:s');
$storage[":registered_use"] = $_SESSION['id_user'];
$storage[":finesh"] = 'n';



$insert = new ConnectionDatabase();
$comand = "INSERT INTO calendar_information (calendar_name, school_year, locality, modification_date, registered_user, fineshed)
VALUES ( 
'{$storage[':calendarName']}',
'{$storage[':schoolYear']}',
'{$storage[':localit']}',
'{$storage[':modification_dat']}',
'{$storage[':registered_use']}',
'{$storage[':finesh']}'
)";

$return = $insert->insert(
    $comand,
    $storage
);

$returnAction = json_decode($return, assoc);

if($returnAction["message"])
{
    header('Location: ./');
}
else
{
    header('Location: ./?m=erro');
}
?>