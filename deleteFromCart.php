<?php
include('config\database.php');
session_start();
if (!$_SESSION['name']) {
    header('Location: index.php');
    exit();
} else if ($_SESSION['user_type'] != 1) {
    header('Location: unauthorized_access.php');
} else {
    $u_id = $_SESSION['id'];
    $item_name = $_POST['name'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $order_id = $_POST['order_id'];
    $new_total = $_POST['new_total'];
    $curr_time = date('Y-m-d H:i:s');

    $getExistingCart = "SELECT * FROM `orders` WHERE `order_id` = $order_id";
    $query = mysqli_query($db, $getExistingCart);
    $data = mysqli_fetch_assoc($query);

    $encodedCart = $data['orders'];
    $decodedCart = json_decode($encodedCart, true);
    
    $i=0;
    foreach($decodedCart as $cartItem){
        if($cartItem['name'] == $item_name && $cartItem['price'] == $price && $cartItem['type'] == $type){
            array_splice($decodedCart, $i, 1);
        }
        $i++;
    }
    $updatedCart = json_encode($decodedCart);
    // print_r($updatedCart);

    $updateOrderQuery = "UPDATE `orders` SET `orders`='$updatedCart',`ordered_on`='$curr_time',`total`=$new_total WHERE `order_id` = $order_id";
    mysqli_query($db, $updateOrderQuery);
    echo $updateOrderQuery;
}

/* [{"name":"Pasta","price":"30","qty":1,"type":"1"},{"name":"Fried Noodles","price":"60","qty":1,"type":"1"}] */