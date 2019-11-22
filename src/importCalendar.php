<?php
session_start();
include_once("class/ConnectionDatabase.php");
$calendar_import = $_GET["import"];
$calendar_export = $_GET["export"];
$event = $_GET["q"];
$user = $_SESSION["id_user"];
$_SESSION["errors"] = "";

if(isset($_GET) and !empty($_GET))
{
    $connection = new ConnectionDatabase();
    $data_export = getData_export($connection, $calendar_export, $event);
    import($connection, $calendar_import, $data_export, $user);
    if(empty($_SESSION["errors"]))
    {
       $verify_importation = array("message"=>true);
    }
    else
    {
       $verify_importation = array(
           "message"=>false,
        "data" => $_SESSION["errors"]);
    }
    echo json_encode($verify_importation);
}

function mountComand($event)
{
    $events = explode(" ", $event);
    $query = array_reduce($events, function ($ccumulator, $e){
        $e = strpos($e, "_") ? str_replace("_", "%", $e): $e;
        
        $ccumulator .= "event LIKE '{$e}' OR ";
        return $ccumulator;
    });

    $query = substr($query, 0, strlen($query) - 3);
    return $query;
}

function getData_export($connection, $calendar_export, $event)
{
    $query = mountComand($event);
    return $connection->find(
        "SELECT calendar_date, event FROM calendar WHERE id_calendar=:id AND $query",
        array(
            ":id" => $calendar_export
            )
    );
}
function import($connection,$calendar_import, $data_exported, $user)
{
    foreach ($data_exported as $line)
    {
        $list = $connection->find(
            "SELECT id FROM calendar WHERE calendar_date=:calendar_date and id_calendar='$calendar_import' ORDER BY calendar_date",
            array(
                ":calendar_date" => $line["calendar_date"]
            )
        );
        if(count($list))
        {
            $return = update($connection, $list, $line["event"], $user);
        }
        else
        {
            $return = register($connection, $line, $calendar_import, $user);
        }
        logErro($return, $line["calendar_date"]);
    }
}

function register($connection, $list, $id_calendar, $registered_user)
{
    $calendar_date = $list["calendar_date"];
    $event = $list["event"];
    $modification_date = date("Y-m-d H:i:s");

    $insert = $connection->insert(
        "INSERT INTO calendar (id_calendar, calendar_date, event, modification_date, registered_user)
        VALUES ('$id_calendar', '$calendar_date', '$event', '$modification_date', '$registered_user')",
        null
    );
    return $insert;
}
function update($connection, $data, $event, $registered_user)
{
    $calendar_date = $data["calendar_date"];
    $event = $data["event"];
    $modification_date = date("Y-m-d H:i:s");

    $update = $connection->update(
        "UPDATE calendar SET 
        event = '$event' and
        modification_date = '$modification_date' and
        registered_user = '$registered_user'
        where id =:id",
        array(
            ":id" => $data["id"]
        )
    );
    return $update;
}
function logErro($data, $date)
{
    $json = json_decode($data, true);
    if(!$json["message"]){
        $_SESSION["errors"] .= "{$date},";
    }
}
?>