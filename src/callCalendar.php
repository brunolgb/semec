<?php
include_once("class". DIRECTORY_SEPARATOR ."LoadClass.php");
$id = $_GET["id"];
$connection = new ConnectionDatabase();
$list = $connection->find(
    "SELECT id, calendar_name, locality, school_year FROM calendar_information WHERE id != :id",
    array(":id" => $id)
);
$replace_json = json_encode($list);
echo $replace_json;
?>