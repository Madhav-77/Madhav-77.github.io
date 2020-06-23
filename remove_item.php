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
$deleteItem_query = "DELETE FROM `items` WHERE `item_id` = $id";
echo $deleteItem_query;
mysqli_query($db, $deleteItem_query);