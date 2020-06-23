<?php
include('config\database.php');
session_start();
if (!$_SESSION['name']) {
    header('Location: index.php');
    exit();
} else if($_SESSION['user_type'] != 1) {
    header('Location: unauthorized_access.php');
} else {
    $userId = $_POST['userId'];
    $r_id = $_POST['r_id'];
    $getItemsFromCart = "SELECT * FROM `orders` WHERE `user_id` = $userId AND `order_status` = 0"; // AND `restaurant_id`= $r_id"
    // echo $getItemsFromCart;
    $cartItems = mysqli_query($db, $getItemsFromCart);
    $data = mysqli_fetch_assoc($cartItems);
    // print_r($data);
    // return $data;a
    if(!empty($data)){
        echo 1;
    } else {
        echo 0;
    }
}


?>