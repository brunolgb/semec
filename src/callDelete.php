<?php
include_once('./class/LoadClass.php');

$id = $_GET['id'];
$table = $_GET["tbl"];


$delete = new Delete();
$comand = "DELETE FROM $table WHERE id=:id"; 

$return = $delete->deleted(
    $comand,
    array(
        "id" => $id
    )
);

echo $return;
?>