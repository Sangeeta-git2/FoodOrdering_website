<?php 
include('partials/menu.php');

?>
<div class="main_contain">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br />  <br />

        <?php
        if(isset($_SESSION['add'])){// check for whether the session is set or not
            echo $_SESSION['add'];//for displaying session msg
            unset($_SESSION['add']);//remove session msg
        }
        ?>
        <form  method="POST">

        <table class="tbl_wid">
            <tr>
                <td>Full Name</td>
                <td>
                    <input type="text" name="full-name" placeholder="Enter your name">
            </td>
            </tr>
            <tr>
                <td>Username</td>
                <td>
                    <input type="text" name="userName"  placeholder="Enter your username">
                </td>
            </tr>
            <tr>
            <td>Password</td>
            <td>
                <input type="password" name="Password" placeholder="Enter your password">
            </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn_secondary">

                </td>
            </tr>
        </table>
        </form>
    </div>
</div>



<?php include('partials/footer.php');?>

<?php
//processing value from form and save in database
//check if the submit button is clicked or not

if(isset($_POST['submit'])){
    //1.get data from form
    $fullName=mysqli_real_escape_string($conn,$_POST['full-name']);//securing also from admin 
    $userName=mysqli_real_escape_string($conn,$_POST['userName']);
   $Password=MD5($_POST['Password']);//password incription
//2.saving data to database through sql query


$sql1 = "INSERT INTO tbl_admin (full_name,username,pass) VALUES('$fullName','$userName','$Password')";

if( mysqli_query($conn,$sql1)){
   //creating variable to display msg
   $_SESSION['add']=" <div class ='success'> Admin is added succesfully.</div>";
   //redirecting page
   header("location:".SITEURL.'admin/admin-manage.php');
}
else{
   //creating variable to display msg
   $_SESSION['add']="<div class ='error'>Failed to add Admin</div>";
   //redirecting page to add admin
   header("location:".SITEURL.'admin/add-admin.php');
}
}