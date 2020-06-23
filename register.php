<?php
include('config\database.php');

$email = $_POST['email'];
$username = $_POST['name'];
$password = $_POST['password'];
$contact = $_POST['contact'];
$city = $_POST['city'];
$pref = $_POST['pref']; //for customer
$f_type = $_POST['f_type']; //for restaurant
$u_type = $_POST['u_type'];

$password = md5($password);
if ($u_type == 1) {
    $query = "INSERT INTO users (`name`, `email`, `contact`, `password`, `food_type_id`, `city`) 
                VALUES('$username', '$email', '$contact', '$password', '$pref', '$city')";
} else {
    $query = "INSERT INTO `restaurants`(`name`, `email`, `contact`, `password`, `food_type_id`, `city`) 
                VALUES('$username', '$email', '$contact', '$password', '$f_type', '$city')";
}
if (mysqli_query($db, $query)) {
    session_start();
    $_SESSION['id'] = mysqli_insert_id($db);
    $_SESSION['name'] = $username;
    $_SESSION['user_type'] = $u_type;
    $_SESSION['email'] = $email;
    if ($u_type == 1) {
        $_SESSION['food_pref_id'] = $pref;
    } else {
        $_SESSION['food_type_id'] = $f_type;
    }
    echo $u_type;
}
// }
