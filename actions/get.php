<?php
    $con = mysqli_connect('localhost', 'root', '', 'lf_db');
    $sql = 'SELECT * FROM todo';
    $results = mysqli_query($con, $sql);
   
    $outputArray = [];
    $todoList = [];
        
    $html = []; 

    while($todo_row = mysqli_fetch_assoc($results)){

    $id = $todo_row['id'];
    $title = $todo_row['title'];
    $timestamp = $todo_row['date'];
    $details = $todo_row['details']; 

    $html[] = "<div id='container_div' data-id='$id'><div class='title'>$title</div><div class= 'date'>".date('Y-M-D H:i:s', $timestamp)."</div><div class='details'>".nl2br($details)."</div><button type='button' id='btn_delete' class='btn btn-danger'>Delete</button></div>";
    }

    if(mysqli_num_rows($results) > 0){
        $outputArray['success'] = true; 
        $outputArray['html'] = $html;
    }
    else  
    {
        $outputArray['success'] = false;
        $outputArray['message'] = "There was no todo item to add!";
        
    }
    echo (json_encode($outputArray)); //json encode the output array and echo it
    mysqli_close($con);
?> 