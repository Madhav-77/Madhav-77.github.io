<?php
include('config\database.php');
session_start();
if (!$_SESSION['name']) {
    header('Location: index.php');
    exit();
} else if ($_SESSION['user_type'] != 1) {
    header('Location: unauthorized_access.php');
} else {
    $u_id = $_POST['userId'];
    $r_id = $_POST['r_id'];

    $getItemsFromCart = "SELECT * FROM `orders` WHERE `user_id` = $u_id AND `order_status` = 0 AND `restaurant_id` = $r_id";
    $existingCartItems = mysqli_query($db, $getItemsFromCart);
    $oldCart = mysqli_fetch_assoc($existingCartItems);
    $oldCartArr = json_decode($oldCart['orders'], true);
    $oldTotal = $oldCart['total'];
    $order_id = $oldCart['order_id'];

    $name = $_POST['name'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $qty = 1;
    $isItemPresent = 0;

    /* foreach($oldCartArr as $order){
        if($order['name'] == $name && $order['type'] == $type && $order['price'] == $price){
            $order['price'] += $price;
            $order['qty'] += $qty;
        }
    } */
    for ($i = 0; $i < sizeof($oldCartArr); $i++) {
        echo $i;
        if ($oldCartArr[$i]['name'] == $name && $oldCartArr[$i]['type'] == $type && $oldCartArr[$i]['price'] == $price) {
            $isItemPresent = 1;
            // echo $isItemPresent;
            // $oldCartArr[$i]['price'] += $price;
            $oldCartArr[$i]['qty'] += $qty;
        }
    }
    print_r($oldCartArr);

    $total = $price * $qty;
    $curr_time = date('Y-m-d H:i:s');
    
    if (!empty($oldCartArr)) {
        if($isItemPresent == 0){
            $cartItem = array(
                'name' => $name,
                'price' => $price,
                'qty' => $qty,
                'type' => $type
            );
            array_push($oldCartArr, $cartItem);
        }
        $total += $oldTotal;
        $cart = json_encode($oldCartArr);
        // print_r($oldCartArr);
        $updateItemsToCart = "UPDATE `orders` 
                    SET `orders`='$cart',`ordered_on`='$curr_time',`total`=$total WHERE `order_id`=$order_id";
        $cartItems = mysqli_query($db, $updateItemsToCart);
    } else {
        echo "CartFull";
    }
}
