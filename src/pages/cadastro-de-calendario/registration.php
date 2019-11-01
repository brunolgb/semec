<?php
session_start();

include_once('../../class/LoadClass.php');


function searchEqual($con, $id)
{
    $show = $con->find(
        "SELECT * FROM calendar_information WHERE id=:update_id",
        array(
            ":update_id" => $id
            )
        );
        return count($show) ? $show[0] : false;
}

function mountQuery($POST, $resultShow)
{
    foreach ($POST as $key => $value)
    {
        if(!in_array($key, array("", "update_tbl", "update_id")))
        {
            $upper = strtoupper($value);
            $storage .= $value == $resultShow[$key] ? "" : $key . "='$upper', ";
        }
    }

    $currentDate = Date('Y-m-d H:i:s');
    $user = $_SESSION['id_user'];
    $storage .= "modification_date='$currentDate',";
    $storage .= "registered_user='$user',";
    $storage .= "fineshed='n'";
    return $storage;
}

function actionUpdate($con, $query, $id_update)
{
    if(substr($query, 0, 12) != "modification")
    {
        $comand = "UPDATE calendar_information SET $query WHERE id='$id_update'";

        $return = $con->update(
            $comand,
            null
        );
    }
    else
    {
        $return = '{"message":4}';
    }
    return $return;
}
    
// initial Validation
if(isset($_POST) and !empty($_POST))
{
    $storage = array();
    
    $con = new ConnectionDatabase();
    $id_update = $_POST["update_id"];

    if(!empty($id_update))
    {
        $resultShow = searchEqual($con, $id_update);
        $query = mountQuery($_POST, $resultShow);
        $return = actionUpdate($con, $query, $id_update);
    }
    else
    {
        foreach ($_POST as $key => $value)
        {
            if(!empty($value))
            {
                $storage["{$key}"] = strtoupper($value);
            }
        }

        $storage["modification_dat"] = Date('Y-m-d H:i:s');
        $storage["registered_use"] = $_SESSION['id_user'];
        $storage["finesh"] = 'n';



        $comand = "INSERT INTO calendar_information (calendar_name, school_year, locality, modification_date, registered_user, fineshed)
        VALUES ( 
        '{$storage['calendar_name']}',
        '{$storage['school_year']}',
        '{$storage['locality']}',
        '{$storage['modification_dat']}',
        '{$storage['registered_use']}',
        '{$storage['finesh']}'
        )";

        $return = $con->insert(
            $comand,
            null
        );
    }

    $returnAction = json_decode($return, true);
    if($returnAction["message"] == 1)
    {
        header('Location: ../calendario');
    }
    else if($returnAction["message"] == 4)
    {
        header("Location: ./?id=$id_update&tbl=calendar_information&m=4");
    }
    else
    {
        header("Location: ./?id=$id_update&tbl=calendar_information&m=9");
    }
}
?>