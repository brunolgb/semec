<?php
include_once("class/LoadClass.php");

$id_calendar = $_GET["calendar"];
$event = $_GET["event"];

if(isset($_GET) and !empty($_GET))
{
    $attributes = new Attributes($id_calendar);

    if(strpos($event, " "))
    {
        $events = explode(" ", $event);
        $response = array_map(function ($e){
            $attributes = $GLOBALS['attributes'];
            return array(
                "name" => $e,
                "total" => $attributes->number_of_event_for_year($e)
            );
        }, $events);
    }
    else
    {
        $response = $attributes->number_of_event_for_month($event);
    }

    $json = json_encode($response);
    echo $json;
}

?>
