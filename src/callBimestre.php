<?php
include_once("class". DIRECTORY_SEPARATOR ."LoadClass.php");

$id_calendar = $_GET["calendar"];
$event = $_GET["event"];

if(isset($_GET) and !empty($_GET))
{
    $attributes = new Attributes($id_calendar);
    $response = $attributes->number_and_data_event_for_month($event);
    $json = json_encode($response);
    echo $json;
}
?>
