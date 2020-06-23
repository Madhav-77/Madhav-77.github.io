<?php
include('config\database.php');
session_start();
if (!$_SESSION['name']) {
    header('Location: index.php');
    exit();
} else if ($_SESSION['user_type'] != 2) {
    header('Location: unauthorized_access.php');
} else { 
    $order_id = $_POST['order_id'];
    $updateStatus = "UPDATE `orders` SET `order_status`=2 WHERE `order_id`=$order_id";
    mysqli_query($db, $updateStatus);
}