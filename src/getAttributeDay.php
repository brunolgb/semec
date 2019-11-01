<?php
include_once('./class/LoadClass.php');

$calendar_date = $_GET['calendar_date'];
$id_calendar = $_GET['id_calendar'];

if(isset($calendar_date) and isset($id_calendar))
{
    $attribute = new ConnectionDatabase();
    $listAttributes = $attribute->find(
        "SELECT event FROM calendar WHERE id_calendar=$id_calendar AND calendar_date=:date_cal",
        array(
            ":date_cal" => $calendar_date
        )
    );

    // response
    echo json_encode($listAttributes);
}

?>