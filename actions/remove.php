<?php
$con = mysqli_connect('localhost', 'root', '', 'lf_db');
$deleteid = $_POST['dataid'];
$query = "DELETE FROM todo WHERE id = $deleteid LIMIT 1";
$results = mysqli_query($con, $query);

$outputArray = [];
$errorArray = [];


    if(mysqli_affected_rows($con) == 1){

        $outputArray['success'] = true;
        $outputArray['message'] = "File deleted successfuly!";
    } else{
        $errorArray[] = mysqli_error($con);
        $errorArray[] = "There was an error deleting from database";
        $outputArray['errors'] = $errorArray;
    }

echo (json_encode($outputArray));
?>

