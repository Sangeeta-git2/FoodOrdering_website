<?php 
include('partials/menu.php');

?>
<div class="main_contain">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br> <br>
        <?php
        if(isset($_SESSION['added'])){// check for whether the session is set or not
            echo $_SESSION['added'];//for displaying session msg
            unset($_SESSION['added']);//remove session msg
        }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
        }
        ?>
        <br><br>
        <!- Add category ko  form start -->
        <form action="" method="POST" enctype="multipart/form-data"> <!--enctype is property  to allow add images or some files-->

        <table class="tbl_wid">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" placeholder="Category Title">
            </td>
            </tr>
            <tr>
            <td>Select Image:</td>
            <td>
            <input type="file" name="image">     
            </td>
            
            </tr>
            <tr>
                <td>Featured:</td>
                <td>
                    <input type="radio" name="featured"  value="Yes">Yes
                    <input type="radio" name="featured"  value="No">No
                </td>
            </tr>
            <tr>
            <td>Active</td>
            <td>
                <input type="radio" name="active" value="Yes">Yes
                <input type="radio" name="active" value="No">No
            </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Category" class="btn_secondary">

                </td>
            </tr>
        </table>
        </form>
        <?php
        //processing value from form and save in database
          //check if the submit button is clicked or not
          if(isset($_POST['submit'])){
              //echo "clicked";
              //1.get data from form
              $title = $_POST['title'];
              // for radio input type ,we have to check if button  is selected or not
              if(isset($_POST['featured']))
              {
                  //get the value from form
                  $featured= $_POST['featured'];

                  
              }
              else{
                  //see the default value
                  $featured= "No";

              }
              if (isset($_POST['active']))
              {
                  $active= $_POST['active'];
              }
              else{
                  $active= 'No';
              }

              //checking whether images is selected or not and set value for images
              //print_r($_FILES['image']);
              //die(); // break the code here

              if(isset($_FILES['image']['name']))
              {
                  //upload the image . to upload image we need image name ,source path and destination
                  $image_name =$_FILES['image']['name'];
                  //upload if image name is available
                  if($image_name !=""){
                 
                   // for auto rename image.for this first get extension of image like(momo.jpg,etc)
                         $ext= end(explode('.',$image_name));//explode is to break image name
                            // now rename image
                            $image_name="food_category_" .rand(000,999).'.'.$ext;
                            $source_path = $_FILES['image']['tmp_name'];
                            $destination_path = "../images/categories/".$image_name;
                            // now upload the image
                            $upload =move_uploaded_file($source_path,$destination_path);
                            //checking whether image is uploaded or not
                  // if image is not uploaded stop and redirect with error msg
                  if($upload==false){
                      //set msg
                      $_SESSION['upload']="<div class ='error'>Failed to upload image.</div>";
                      //redirect to  add category page
                      header("location:".SITEURL.'admin/Add_category.php.');
                      // now stop the process.if we failed to upload image then we dont want to data to insert to database
                      die();
                  }

                }



              }
              else{
                  //dont upload image and set the image_name value as blank
                  $image_name=""; 
              }



              // 2. creating sql query to insert in database
              $sql1 = "INSERT INTO tbl_category (title,image_name,featured,active) VALUES('$title','$image_name','$featured','$active')";
              // 3 executing the query
              $res = mysqli_query($conn,$sql1);
              // 4. checking whether query is executed or not and data added or not
              if($res== true){
                  //Query executed and added category
                  $_SESSION['added']=" <div class ='success'> category is added succesfully.</div>";
                  //redirecting page
                  header("location:".SITEURL.'admin/category-manage.php');

              }
              else{
                  // faile to add category
                  $_SESSION['added']=" <div class ='error'> Category is failed to add .</div>";
                  //redirecting page
                  header("location:".SITEURL.'admin/Add_category.php.');

              }
          }
        
        
        ?>

       
    </div>
</div>








<?php 
include('partials/footer.php');
?>