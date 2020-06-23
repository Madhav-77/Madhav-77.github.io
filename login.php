<?php
include('config\database.php');
$id = 0; //variable to check if the user is logged in or not

// initializing variables
// $login_error = "";

// REGISTER USER
/* if (isset($_POST['login_button'])) {
    // receive all input values from the form
    // var_dump($_POST['username']);
    $login_email = $_POST['login_email'];
    $login_password = $_POST['login_password'];
    $password = md5($login_password);
    $query = "SELECT `password` FROM `users` WHERE `email`= '$login_email'";
    $result = mysqli_query($db, $query);
    $pass = mysqli_fetch_assoc($result);
    if($pass != $password){
        $login_error = "Wrong Password!";
    }
} */

// echo $_POST['username'];
// if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    // var_dump($_POST['username']);
    $email = $_POST['login_email'];
    $password = $_POST['login_password'];
    $u_type = $_POST['u_type_login'];
    
    $password = md5($password);

    // directly checking password with email entered, as email validation has already been done on client side
    if($u_type == 1){
        $queryToCheckPass = "SELECT `password` FROM `users` WHERE `email` = '$email'";
        $res = mysqli_query($db, $queryToCheckPass);
        $pass = mysqli_fetch_assoc($res);
    } else if($u_type == 2){
        $queryToCheckPass = "SELECT `password` FROM `restaurants` WHERE `email` = '$email'";
        $res = mysqli_query($db, $queryToCheckPass);
        $pass = mysqli_fetch_assoc($res);
    } else {
        $queryToCheckPass = "SELECT `password` FROM `admin` WHERE `email` = '$email'";
        $res = mysqli_query($db, $queryToCheckPass);
        $pass = mysqli_fetch_assoc($res);
    }
    // echo $pass['password'];
    // echo "<br>";
    // echo $password;
    if($password != $pass['password']){
        echo "failed_login";
    } else {
        if($u_type == 1){
            $queryToGetUserDetails = "SELECT * FROM `users` WHERE `email` = '$email'";
            $result = mysqli_query($db, $queryToGetUserDetails);
            $data = mysqli_fetch_assoc($result);
        } else if($u_type == 2){
            $queryToGetUserDetails = "SELECT * FROM `restaurants` WHERE `email` = '$email'";
            $result = mysqli_query($db, $queryToGetUserDetails);
            $data = mysqli_fetch_assoc($result);
        } else {
            $queryToGetUserDetails = "SELECT * FROM `admin` WHERE `email` = '$email'";
            $result = mysqli_query($db, $queryToGetUserDetails);
            $data = mysqli_fetch_assoc($result);
        }
        session_start();
        $_SESSION['name'] = $data['name'];
        $_SESSION['user_type'] = $u_type;
        $_SESSION['email'] = $data['email'];
        $_SESSION['id'] = $data['id'];
        if($u_type==1){
            $_SESSION['food_pref_id'] = $data['food_type_id'];
        } 
        if($u_type==2){
            $_SESSION['food_type_id'] = $data['food_type_id'];
        }
        echo $u_type;
    }
// }


