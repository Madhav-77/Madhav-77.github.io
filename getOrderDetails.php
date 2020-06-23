<?php
include('config\database.php');
session_start();
if (!$_SESSION['name']) {
    header('Location: index.php');
    exit();
} else if ($_SESSION['user_type'] != 1 && $_SESSION['user_type'] != 2) {
    header('Location: unauthorized_access.php');
} else { 
    $order_id = $_POST['order_id'];
    $getOrder = "SELECT * FROM `orders` WHERE `order_id`=$order_id";
    $query = mysqli_query($db, $getOrder);
    $order = mysqli_fetch_assoc($query);

    $allOrder = $order['orders'];
    $ordersArr = json_decode($allOrder, true);

    $response = "";
    $i =0;
    foreach($ordersArr as $ord){
        $i++;
        $f_type = $ord['type'] == "1" ? "Veg" : "Non-Veg";
        $amt = $ord['price']*$ord['qty'];
        $response .= "<tr id='".$order['order_id']."'><td>".$i."</td>";
        $response .= "<td>".$ord['name']."</td>";
        $response .= "<td>".$f_type."</td>";
        $response .= "<td>".$ord['qty']."</td>";
        $response .= "<td>".$ord['price']."</td>";
        $response .= "<td>".$amt."</td></tr>";
    }
    $response .= "<tr><td style='text-align:center;' colspan='5'><b>Total</b></td>";
    $response .= "<td><b>".$order['total']."</b></td></tr>";
    echo $response;
}
