<?php
include('config\database.php');
session_start();
if (!$_SESSION['name']) {
    header('Location: index.php');
    exit();
} else if ($_SESSION['user_type'] != 1) {
    header('Location: unauthorized_access.php');
} else {
    $order_id = $_POST['ord_id'];
    $total = $_POST['total'];
    $order = $_POST['order'];
    $in_cart = 0;
    $order_status = 1;
    $curr_time = date('Y-m-d H:i:s');
    
    $encodedOrder = json_encode($order);
    $updateItemsToCart = "UPDATE `orders` 
                SET `orders`='$encodedOrder',`ordered_on`='$curr_time',`total`=$total, `in_cart`=0, `order_status`=1 WHERE `order_id`=$order_id";
    $cartItems = mysqli_query($db, $updateItemsToCart);
    // print_r($order);
}