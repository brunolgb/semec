<?php
include_once('./class/LoadClass.php');

$id = $_GET['id'];
$table = $_GET["tbl"];


$delete = new ConnectionDatabase();
$comand = "DELETE FROM $table WHERE id=:id"; 

$return = $delete->delete(
    $comand,
    array(
        "id" => $id
    )
);

echo $return;
?>