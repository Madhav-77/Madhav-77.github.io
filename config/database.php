<?php
$url='localhost';
$username='root';
$password='';
$db=mysqli_connect($url,$username,$password,"foodgasm");
if(!$db){
 die('Failed Connection to Database');
}
?>