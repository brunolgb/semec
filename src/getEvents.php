<?php
include_once("class/LoadClass.php");

$id_calendar = $_GET["id"];

if(isset($_GET) and !empty($_GET))
{
    $attributes = new Attributes($id_calendar);
    $response = $attributes->attributes_distinct();

    $json = json_encode($response);
    echo $json;
}

?>