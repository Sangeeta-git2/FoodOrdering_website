<?php
include('../config/constant.php'); 
// check if id and image_name value is set or not
if (isset($_GET['id']) AND isset($_GET['image_name'])){
    // get the value and delete it
    //echo "delete";
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    // remove the physical image file if available
    if($image_name != ""){
        $path = "../images/categories/".$image_name;
        //remove now
        $remove = unlink($path);
        // if failed to remove do this to stop the process
        if($remove==false)
        {
            $_SESSION['remove'] = "<div class = 'error'>Failed to remove category image.</div>";
            header("location:".SITEURL.'admin/category-manage.php.');
            die();

        }
    }
    //delete data from database
    $sql1 = "DELETE FROM tbl_category WHERE id=$id";
    // execute query
    $res = mysqli_query($conn,$sql1);
    // check whether data is deleted from database or not
    if($res==true){
        //set the success msg and redirect
        $_SESSION['delete']="<div class = 'success'> Category deleted successfully. </div>";
        header("location:".SITEURL.'admin/category-manage.php.');


    }
    else{
        //set failed msg
        $_SESSION['delete']="<div class = 'error'> Failed to delete category. </div>";
        header("location:".SITEURL.'admin/category-manage.php.');

    }
}
else{
    //redirect to manage category page
    header("location:".SITEURL.'admin/category-manage.php.');
}





?>