<?php include('partials/menu.php');?>
<div class="main_contain">
<div class="wrapper">
<h1>Change Password </h1>
<br> <br>
<?php 
if(isset($_GET['id']))
{
    $id= $_GET['id'];
}

?>
<form action="" method="POST">
<table class="tbl_wid">
            <tr>
                <td>Current Password:</td>
                <td>
                    <input type="password" name="current_password" placeholder="Current password">
            </td>
            </tr>
            <tr>
                <td>New Password:</td>
                <td>
                    <input type="password" name="new_password" placeholder ="New password" >
                </td>
            </tr>
            <tr>
                <td>Confirm Password:</td>
                <td>
                    <input type="password" name="confirm_password" placeholder ="confirm password" >
                </td>
            </tr>
            
            <tr>
                <td colspan="2">
                    <input type ="hidden" name ="id" value ="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Change Password" class = "btn_secondary">

                </td>
            </tr>
        </table>
        </form>
</div>
</div>
<?php 
if(isset($_POST['submit']))
{
    $id =$_POST['id'];
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);

   $sql1="SELECT * FROM tbl_admin WHERE id=$id AND pass='$current_password'";
   $res = mysqli_query($conn,$sql1);
   if($res==TRUE)
   {
    $count = mysqli_num_rows($res);
    if($count==1)
    {
       if($new_password==$confirm_password)
       {
        $sql2= "UPDATE tbl_admin SET
        pass='$new_password'
        WHERE id =$id
        ";

        $res2= mysqli_query($conn,$sql2);
        if($res2==TRUE)
        {
         $_SESSION['change-password']= "<div class='success'>password changed successfully.</div>";
         header("location:".SITEURL.'admin/admin-manage.php');
        }
        else{
            $_SESSION['change-password']= "<div class='error'>failed to change password.</div>";
            header("location:".SITEURL.'admin/admin-manage.php');

        }

       }
       else{
           $_SESSION['not-match-psw']= "<div class='error'>password didn't match.</div>";
        header("location:".SITEURL.'admin/admin-manage.php');

       }
        
    }
    else{
        $_SESSION['user-not-found']= "<div class='error'>User not found.</div>";
        header("location:".SITEURL.'admin/admin-manage.php');

    }

}
}

?>
<?php include('partials/footer.php');?>
