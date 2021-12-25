<?php //check user loged in or not
if(!isset($_SESSION['user']))// if user session is not set
{
    //user is not logged in
    //redirect to login page with message
    $_SESSION['no-login-msg'] = "<div class ='text_center'>Please login to access Admin Panel. </div>";
    header("location:".SITEURL.'admin/login.php');
}

?>