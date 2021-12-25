<?php include('../config/constant.php');?>

<html>
<head>
<title>Loginko food_order system</title>
<link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text_center">Login</h1>
        <br> <br>
        <?php
          if(isset($_SESSION['login']))
          {
              echo $_SESSION['login'];
              unset($_SESSION['login']);

          }

          if(isset($_SESSION['no-login-msg']))
          {
              echo $_SESSION['no-login-msg'];
              unset($_SESSION['no-login-msg']);

          }
        
        
        ?>
        <br> <br>
        


        <!--login ko start-->
        <form action="" method="POST" class ="text_center">
        Username:<br><br>
        <input type="text" name="userName"  placeholder="Enter your username"><br> <br>
           
            Password:<br><br>
                <input type="password" name="Password" placeholder="Enter your password"><br> <br>
            
                    <input type="submit" name="submit" value="Login" class="btn_primary"><br> <br>

        </form>

        <!--loginko end-->

        <p class="text_center">Created by <a href="#">Sangita and sujit</a></p>
    </div>
</body>

</html>
<?php

if(isset($_POST['submit']))
{

      $userName=mysqli_real_escape_string($conn,$_POST['userName']);
      
      $Password=md5($_POST['Password']);
      //echo $Password;
      $sql1="SELECT * FROM tbl_admin WHERE username='$userName' AND pass='$Password'";
    $res = mysqli_query($conn,$sql1);

        $count = mysqli_num_rows($res);
        if($count==1){
            $_SESSION['login']= "<div class='success text_center'>login success.</div>";
            $_SESSION['user'] =$userName; 
            header("location:".SITEURL.'admin/');

        }
        else{
            $_SESSION['login']= "<div class='text_center'>username or password didnot match.</div>";
            header("location:".SITEURL.'admin/login.php');
            
        }




    
}
   
?>

    