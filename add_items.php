<?php
include('config\database.php');
session_start();
if (!$_SESSION['name']) {
    header('Location: index.php');
    exit();
}
if ($_SESSION['user_type'] != 2) {
    header('Location: unauthorized_access.php');
}

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$food_type = $_POST['type'];

$addItem_query = "INSERT INTO `items`(`restaurant_id`, `item_name`, `price`, `type`) 
                    VALUES ($id, '$name', $price, '$food_type')";
mysqli_query($db, $addItem_query);
