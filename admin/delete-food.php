
<?php
include('../config/constant.php'); 
if (isset($_GET['id']) AND isset($_GET['image_name'])){
    // get the value and delete it
   // echo "delete";
   $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    // remove the physical image file if available
    if($image_name != ""){
        $path = "../images/foodko/".$image_name;
        //remove now
        $remove = unlink($path);
        // if failed to remove do this to stop the process
        if($remove==false)
        {
            $_SESSION['remove'] = "<div class = 'error'>Failed to remove image file.</div>";
            header("location:".SITEURL.'admin/food-manage.php.');
            die();

        }
    }
    //delete data from database
    $sql1 = "DELETE FROM tbl_food WHERE id=$id";
    // execute query
    $res = mysqli_query($conn,$sql1);
    // check whether data is deleted from database or not
    if($res==true){
        //set the success msg and redirect
        $_SESSION['delete']="<div class = 'success'> Food deleted successfully. </div>";
        header("location:".SITEURL.'admin/food-manage.php.');


    }
    else{
         //set failed msg
         $_SESSION['delete']="<div class = 'error'> Failed to delete food. </div>";
         header("location:".SITEURL.'admin/food-manage.php.');
    }
}
else{
    //redirect to manage food page
    $_SESSION['unauthorize']="<div class = 'error'>Unauthorized Access </div>";
      header("location:".SITEURL.'admin/food-manage.php.');
}

?>