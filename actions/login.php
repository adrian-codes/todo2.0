<?php
    session_start();
    $con = mysqli_connect('localhost', 'root', '', 'lf_db');
    
    $username = $_POST['username'];
    $username = htmlentities($username);
    $username = stripslashes($username);
    $password = sha1($_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $results = mysqli_query($con, $sql);
    
    if(mysqli_num_rows($results) > 0){
        $userinfo = mysqli_fetch_assoc($results);
        $_SESSION['userinfo'] = $userinfo;
        header('Location: ../index.php');
    }
    else{
        //user was not found in database
        print "Username/Password is incorrect";
        header('Location: loginform.php');
    }


?>