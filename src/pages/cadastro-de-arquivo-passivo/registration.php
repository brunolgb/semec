<?php
session_start();

include_once('..'. DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR .'class'. DIRECTORY_SEPARATOR .'LoadClass.php');


function searchEqual($con, $id)
{
    $show = $con->find(
        "SELECT * FROM passive_file WHERE id=:update_id",
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
    return $storage;
}

function actionUpdate($con, $query, $id_update)
{
    if(substr($query, 0, 12) != "modification")
    {
        $comand = "UPDATE passive_file SET $query WHERE id='$id_update'";

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

        $storage["modification_date"] = Date('Y-m-d H:i:s');
        $storage["registered_user"] = $_SESSION['id_user'];



        $comand = "INSERT INTO passive_file (school, student, birth, mother, father, last_year_of_study, modification_date, registered_user)
        VALUES ( 
        '{$storage['school']}',
        '{$storage['student']}',
        '{$storage['birth']}',
        '{$storage['mother']}',
        '{$storage['father']}',
        '{$storage['last_year_of_study']}',
        '{$storage['modification_date']}',
        '{$storage['registered_user']}'
        )";
        echo $comand;

        $return = $con->insert(
            $comand,
            null
        );
    }

    $returnAction = json_decode($return, true);
    if($returnAction["message"] == 1)
    {
        header('Location: ./');
    }
    else if($returnAction["message"] == 4)
    {
        header("Location: ./?id=$id_update&tbl=passive_file&m=4");
    }
    else
    {
        header("Location: ./?id=$id_update&tbl=passive_file&m=9");
    }
}
?>