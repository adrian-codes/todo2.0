<?php
session_start();

$con = mysqli_connect('localhost', 'root', '', 'lf_db');
   
$errorArray = array(); //create an array for error messages
$outputArray = array(); //create an array for output

if(isset($_POST)){
    if($_POST['title'] == ''){
        $errorArray['title'] = "There is no title!";
    }
    if($_POST['date'] == ''){
        $errorArray['date'] = "There is no date!";
    }
    else{
        $timestamp = strtotime($_POST['date']);
        if($timestamp == false){
            $errorArray['date'] = "The date is not valid!";
        }
        else if($timestamp < time()){
            $errorArray['date'] = "Date is set in the past!";
        }
    }
    if($_POST['details'] == ''){
            $errorArray['details'] = "The are no details!";
    }
    if(empty($errorArray)){
        
        $query = ' INSERT INTO todo (`title`, `date`, `details`, `user_id`) VALUES (';
        $query .= '"'.$_POST['title'].'",';
        $query .= $timestamp.',';
        $query .= '"'.$_POST['details'].'",';
        $query .='"'.$_SESSION['userinfo']['ID'].'");';
        $result = mysqli_query($con, $query);
    
       
        if(!$result){
            $errorArray[] = mysqli_error($con);
            $errorArray[] = "There was an error adding to database";
        } 
    }

    if(count($errorArray) == 0){
            $outputArray['success'] = true;
            $outputArray['message'] = "Files uploaded successfuly!";
        } else{
        $outputArray['success'] = false;
        $outputArray['message'] = "There were errors!";
        $outputArray['errors'] = $errorArray; 
    }
    mysqli_close($con);
}

else{
    $outputArray['success'] = false; 
    $outputArray['message'] = "Post was not set!"; 
}
    echo (json_encode($outputArray));
?>