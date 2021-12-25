<?php
include ('../config/constant.php');

//1.get id to be deleted from admin

 $id = $_GET['id'];


//2 creating sql query to delete data
$sql1="DELETE FROM tbl_admin WHERE id=$id";

//executing query
$res= mysqli_query($conn,$sql1);
if($res==TRUE){
    //echo "admin deleted";
    //session used
    $_SESSION['delete'] ="<div class='success'>Admin Deleted successfully.</div>";
    //redirecting to manage page
    header("location:".SITEURL.'admin/admin-manage.php');

}
else{
    //echo "failed to delete admin";
    $_SESSION['delete'] =" <div class = 'error>'Try again . Failed to delete. </div>";
    header("location:".SITEURL.'admin/admin-manage.php');//3 redirect page to admin manage page with message

}








?>