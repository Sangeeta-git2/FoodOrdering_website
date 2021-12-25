<?php include('partials/menu.php');?>
<div class="main_contain">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <?php
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
    }
        
        ?>

        <br><br>
        <form action="" method="POST" enctype="multipart/form-data"> <!--enctype is property  to allow add images or some files-->

        <table class="tbl_wid">
            <tr>
                <td>Title:</td>
                 <td>
                     <input type="text" name="title" placeholder="Title for the food">
                     </td>
          </tr>
         <tr>
                <td>Description:</td>
               <td>
                  <textarea name="description" cols="30" rows="6" placeholder="Description of the food"></textarea>
               </td>
            </tr>

            <tr>
                <td>Price:</td>
                 <td>
                     <input type="number" name="price" >
                </td>
            </tr>
            <tr>
            
              <td>Select Image:</td>
              <td>
                 <input type="file" name="image">     
                </td>
            
            </tr>

            <tr>
                <td>Category:</td>
                <td>
                    <select name="category">
                    <?php
                    //to display categories from database
                    // 1..sql queries from active categories from database
                    $sql1 = "SELECT * FROM tbl_category WHERE active='Yes'";
                    $res = mysqli_query($conn,$sql1);
                    $count = mysqli_num_rows($res);

                    if($count>0){
                        //we have categories
                        while($row=mysqli_fetch_assoc($res)){
                            //get details of categories
                            $id = $row['id'];
                            $title = $row['title'];
                              
                            ?>

                            <option value="<?php echo $id; ?>"><?php echo $title;?></option>
                            <?php

                        }
                    }
                    else{
                        // no categories
                        ?>
                        <option value="0">Categories not found</option>

                        <?php
                    }
                    
                    
                    
                    ?>

                    </select>
                
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
        //check whether button is clicked or not
        if(isset($_POST['submit'])){
          //  echo " clicked";
          // 1. get data from form
          $title = $_POST['title'];
          $description = $_POST['description'];
          $price = $_POST['price'];
          $category = $_POST['category'];
          // check whether radio button for featured and active button are checked or not
          if(isset($_POST['featured']))
              {
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
          //2. upload image if selected
          // check whether the selected image is clicked or not
          if(isset($_FILES['image']['name']))
              {
                  //getting the details of selected image
                  $image_name =$_FILES['image']['name'];
                  //upload if image name is available
                  if($image_name !=""){
                 
                   // for auto rename image.for this first get extension of image like(momo.jpg,etc)
                         $ext= end(explode('.',$image_name));//explode is to break image name
                            // now rename image
                            $image_name="Food_Name_" .rand(000,999).'.'.$ext;
                            $source_path = $_FILES['image']['tmp_name'];
                            $destination_path = "../images/foodko/".$image_name;
                            // now upload the image
                            $upload =move_uploaded_file($source_path,$destination_path);
                            //checking whether image is uploaded or not
                  // if image is not uploaded stop and redirect with error msg
                  if($upload==false){
                      //set msg
                      $_SESSION['upload']="<div class ='error'>Failed to upload image.</div>";
                      //redirect to  add category page
                      header("location:".SITEURL.'admin/add-food.php.');
                      // now stop the process.if we failed to upload image then we dont want to data to insert to database
                      die();
                  }

                }

              }
              else{
                //dont upload image and set the image_name value as blank
                $image_name=""; 
            }
          //3. insert into databse
          $sql2= "INSERT INTO tbl_food (title,description,price,image_name,category_id,featured,active) VALUES('$title', '$description',$price,'$image_name',$category,'$featured','$active')";
          
          // 3 executing the query
          $res2 = mysqli_query($conn,$sql2);
          //  checking whether query is executed or not and data added or not
          if($res2== true){
            //Query executed and added 
            $_SESSION['added']=" <div class ='success'>Food is added succesfully.</div>";
            //redirecting  to food page
            header("location:".SITEURL.'admin/food-manage.php');

        }
        else{
            $_SESSION['added']=" <div class ='error'>Failed to add food.</div>";
            //redirecting page
            header("location:".SITEURL.'admin/food-manage.php');


        }
    
        }
        
        ?>
        
        </div>

</div>
<?php include('partials/footer.php');?>




