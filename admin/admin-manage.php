<?php include('partials/menu.php');?>






<!--main content-->
<div class="main_contain">
<div class="wrapper">
<h1>Manage Admin</h1>
<br />

<?php
if(isset($_SESSION['add'])){
  echo $_SESSION['add'];//for displaying session msg
  unset($_SESSION['add']);//for removing sessiob msg
}
if(isset($_SESSION['delete'])){
  echo $_SESSION['delete'];//for displaying session msg
  unset($_SESSION['delete']);
}
if(isset($_SESSION['update'])){
  echo $_SESSION['update'];//for displaying session msg
  unset($_SESSION['update']);
}
if(isset($_SESSION['user-not-found'])){
  echo $_SESSION['user-not-found'];//for displaying session msg
  unset($_SESSION['user-not-found']);
}
if(isset($_SESSION['not-match-psw'])){
  echo $_SESSION['not-match-psw'];//for displaying session msg
  unset($_SESSION['not-match-psw']);
}
if(isset($_SESSION['change-password'])){
  echo $_SESSION['change-password'];//for displaying session msg
  unset($_SESSION['change-password']);

}
?>
<br/> <br/> <br/>
<!--button for admin-->
<a href="add-admin.php" class="btn_primary">Add Admin</a>
<br />
<br /><br /><br />

<table class="tbl_full">
    <tr>
        <th>S.N</th>
        <th>Full Name</th>
        <th>UserName</th>
        <th>Actions</th>
    </tr>
<?php
//query to get all admin data
$sql1 ="SELECT * FROM tbl_admin";
$res = mysqli_query($conn,$sql1);

if($res==TRUE){
  //count rows to check data in database
  $count = mysqli_num_rows($res);
  $sn=1;//assigning value
  //check the num of rows
  if($count>0){
    while($rows=mysqli_fetch_assoc($res)){
      //while loop to gett all data from database and run as long as we have data in database
      $id=$rows['id'];
      $full_name=$rows['full_name'];
      $username=$rows['username'];
      //display values in our table
      ?>
       <tr>
        <td><?php  echo $sn++;?> .</td>
        <td><?php  echo $full_name; ?></td>
        <td><?php echo $username; ?></td>
        <td>
        <a href="update-password.php ?id=<?php echo $id; ?>" class="btn_primary">Change Password</a>
          <a href="update-admin.php ?id=<?php echo $id; ?>" class="btn_secondary">Update Admin</a>
          <a href="delete-admin.php ?id=<?php echo $id; ?>" class="btn_danger">Delete Admin</a>
        </td>
    </tr>

      <?php
    }

  }
  else{

  }
}
?>


    
</table>

</div>
</div>




<?php include('partials/footer.php');?>