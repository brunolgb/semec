<?php
    include_once('..'. DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR .'class'. DIRECTORY_SEPARATOR .'LoadClass.php');

    $student = strtoupper($_GET['student']);
    if(!empty($student) and isset($student))
    {
        $con = new ConnectionDatabase();
        $searchStudent = $con->find(
            "SELECT student, birth FROM school_transfer WHERE student LIKE '%$student%'",
            null
        );
        echo json_encode($searchStudent);
    }
?>