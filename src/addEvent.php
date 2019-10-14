<?php
session_start();
include_once('./class/LoadClass.php');

$event = $_GET['event'];
$id_calendar = $_GET['id_calendar'];
$calendar_date = $_GET['calendar_date'];

if(isset($id_calendar) and isset($event) and isset($calendar_date))
{
    $events = new ConnectionDatabase();
    $searchRegistration = $events->find(
        "SELECT id, event FROM calendar WHERE id_calendar=:id_calendar AND calendar_date='$calendar_date'",
        array(
            ":id_calendar" => $id_calendar
        )
    );

    if(count($searchRegistration))
    {
        if($searchRegistration[0]['event'] != $event)
        {
            $updateEvent = $events->update(
                "UPDATE calendar SET event=:event WHERE id={$searchRegistration[0]['id']}",
                array(
                    ":event" => $event
                )
            );
    
            echo $updateEvent;
        }
        else{
            echo '{"message":"false"}';
        }
    }
    else
    {
        $modification_date = date("Y-m-d H:i:s");
        $registered_user = $_SESSION['id_user'];

        $insertEvent = $events->insert(
            "INSERT INTO calendar (id_calendar, calendar_date, event, modification_date, registered_user)
            VALUES('$id_calendar', '$calendar_date', '$event', '$modification_date', '$registered_user')
            ",
            null
        );

        echo $insertEvent;
    }
}

?>