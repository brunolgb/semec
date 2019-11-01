<?php
include_once("class/LoadClass.php");
$connection = new ConnectionDatabase();
$list = $connection->find(
    "SELECT id, calendar_name, locality, school_year FROM calendar_information",
    null
);
$replace_json = json_encode($list);
echo $replace_json;
?>