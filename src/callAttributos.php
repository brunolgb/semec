<?php
include_once("class/LoadClass.php");

$id_calendar = $_GET["calendar"];
$event = $_GET["event"];


function getMonth()
{
    $contentMonth = file_get_contents("data/month.json");
    return json_decode($contentMonth, true);
}

function show(){
    $return_jsonMonth = getMonth();
    $array_between = array_map(function ($e){
        $month = $e["number"] < 10 ? "0" . $e["number"] : $e["number"];
        $between = "'2020-{$month}-01' AND '2020-{$month}-{$e["number_of_days"]}'";
        $id_calendar = $GLOBALS["id_calendar"];
        $connectionDatabase = $GLOBALS["connectionDatabase"];
        $event = $GLOBALS["event"];

        $caseSchoolYears = $event == "letivo" ?
        "OR event LIKE '%bimestre' AND calendar_date BETWEEN $between  AND id_calendar='{$id_calendar}'"
        : "";
        $findEvent = $connectionDatabase->find(
            "SELECT count(event) as total FROM calendar WHERE event=:event AND calendar_date BETWEEN $between  AND id_calendar='{$id_calendar}' $caseSchoolYears",
            array(":event"=>$event)
        );

        [$numero] = $findEvent;
        return $numero["total"];
    }, $return_jsonMonth);

    return $array_between;
}

function totalEvents($event){
    $id_calendar = $GLOBALS["id_calendar"];
    $connectionDatabase = $GLOBALS["connectionDatabase"];
    $caseSchoolYears = $event == "letivo" ?
        "OR event LIKE '%bimestre' AND id_calendar='{$id_calendar}'"
        : null;

    $findEvent = $connectionDatabase->find(
        "SELECT count(event) as total FROM calendar WHERE event=:event AND id_calendar='{$id_calendar}' $caseSchoolYears",
        array(":event"=>$event)
    );

    [$numero] = $findEvent;
    return $numero["total"];
}

if(isset($_GET) and !empty($_GET))
{
    $connectionDatabase = new ConnectionDatabase();
    
    if(strpos($event, " "))
    {
        $events = explode(" ", $event);
        $response = array_map(function ($e){
            return array(
                "name" => $e,
                "total" => totalEvents($e)
            );
        }, $events);
    }
    else
    {
        $response = show();
    }

    $json = json_encode($response);
    echo $json;
}

?>
