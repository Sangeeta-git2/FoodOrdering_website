<?php
//session starting here-->
session_start();





//constant creating to store repeating values
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD', '');
define('DB_NAME','food_order');
define('SITEURL','http://localhost/food_order/');//this is for home url

$conn =mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());//connecting database

$db_select=mysqli_select_db($conn,DB_NAME) or die(mysqli_error());
?>