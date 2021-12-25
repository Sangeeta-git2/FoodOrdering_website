
<?php include('partials/menu.php');?>
<div class="main_contain">
<div class="wrapper">
<h1>Update Admin </h1>
<br> <br>
<?php 
$id = $_GET['id'];
$sql1 = "SELECT * FROM tbl_admin WHERE id =$id";
$res = mysqli_query($conn,$sql1);

if($res==TRUE){
    $count=mysqli_num_rows($res);
    if($count==1)
    {
        $row= mysqli_fetch_assoc($res);
        $full_name=$row['full_name'];
        $username=$row['username'];
    }
    else{
        header("location:".SITEURL.'admin/admin-manage.php');
    }


}




?>


<form action="" method="POST">
<table class="tbl_wid">
            <tr>
                <td>Full Name</td>
                <td>
                    <input type="text" name="full-name" value="<?php  echo $full_name;?>">
            </td>
            </tr>
            <tr>
                <td>Username</td>
                <td>
                    <input type="text" name="userName" value="<?php  echo $username;?>" >
                </td>
            </tr>
            
            <tr>
                <td colspan="2">
                    <input type ="hidden" name ="id" value ="<?php echo $id ?>">
                    <input type="submit" name="submit" value="Update Admin" class="btn_secondary">

                </td>
            </tr>
        </table>
        </form>

</div>


</div>
<?php
if(isset($_POST['submit']))
{
   $id = $_POST['id'];
   $fullName=$_POST['full-name'];
   $userName=$_POST['userName'];

   $sql1 = "UPDATE tbl_admin SET
   full_name='$fullName',
   username='$userName'
   WHERE id ='$id' 
   ";
   
   $res= mysqli_query($conn,$sql1);
if($res==TRUE){
    $_SESSION['update'] ="<div class='success'>Admin Updated successfully.</div>";
    header("location:".SITEURL.'admin/admin-manage.php');

}
else{
    $_SESSION['delete'] =" <div class = 'error>'Try again . Failed to Update. </div>";
    header("location:".SITEURL.'admin/admin-manage.php');

}

}
?>






<?php include('partials/footer.php');?>




