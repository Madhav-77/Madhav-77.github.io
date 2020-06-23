<?php
include('config/database.php');
$email = $_POST['email'];
$type = $_POST['type_user'];

$user_check_query = "SELECT * FROM `users` WHERE email='$email'";
$result = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($result);
if(!$user){
    $user_check_query = "SELECT * FROM `restaurants` WHERE email='$email'";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if(!$user){
        $user_check_query = "SELECT * FROM `admin` WHERE email='$email'";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);
        if(!$user){
            echo 1;
        }
    } else {
        echo 0;
    }
} else {
    echo 0;
}
