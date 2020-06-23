<?php
include('config\database.php');
session_start();
if (!$_SESSION['name']) {
    header('Location: index.php');
    exit();
} else if($_SESSION['user_type'] != 1) {
    header('Location: unauthorized_access.php');
} else {
    $u_id = $_POST['userId'];
    $r_id = $_POST['r_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $qty = 1;
    $total = $price*$qty;
    $curr_time = date('Y-m-d H:i:s');

    $cartItem = array(
        'name'=>$name,
        'price'=>$price,
        'qty'=>$qty,
        'type'=>$type
    );
    $cartArr = array();
    array_push($cartArr, $cartItem);
    $cart = json_encode($cartArr);
    
    $addItemsToCart = "INSERT INTO `orders`(`orders`, `ordered_on`, `restaurant_id`, `user_id`, `total`, `in_cart`, `order_status`) 
                        VALUES ('$cart', '$curr_time', $r_id, $u_id, $total, 1, 0)";
    $cartItems = mysqli_query($db, $addItemsToCart);
    /* // $data = mysqli_fetch_assoc($cartItems);
    // return $data;a
    if(!empty($data)){
        return $data;
    } else {
        return false;
    } */
}


?>