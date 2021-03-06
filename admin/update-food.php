
<?php include('partials/menu.php');?>
<div class="main_contain">
    <div  class="wrapper">
       <h1>Update Food</h1>
      <br> <br>
      <?php
       if(isset($_GET['id']))
         {
           $id = $_GET['id'];
            $sql2 = "SELECT * FROM tbl_food WHERE id =$id";
             $res2 = mysqli_query($conn,$sql2);
        
           // get the data
             $row2 = mysqli_fetch_assoc($res2);
             $title = $row2['title'];
             $description =$row2['description'];
             $price =$row2['price'];
             $current_image = $row2['image_name'];
             $current_category= $row2['category_id'];
             $featured = $row2['featured'];
             $active = $row2['active'];
        
        }
       else{
        header("location:".SITEURL.'admin/food-manage.php.');
        }
         ?>



     <form action="" method="POST" enctype="multipart/form-data">
          <table class="tbl_wid">
                <tr>
                  <td>Title:</td>
                    <td>
                      <input type="text" name="title" value="<?php echo $title; ?>">
                  </td>
             </tr>
             <tr>
                  <td>Description:</td>
                  <td>
                      <textarea name="description" cols="30" rows="5"><?php echo $description ;?></textarea>
                  </td>
               </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>" >
                    </td>
             </tr>
                <tr>
                 <td>Current Image:</td>
                   <td>
                   <?php
                  if($current_image== ""){
                    echo "<div class = 'error'> Image is not available</div>";
                  
                     }
                    else{
                   ?>
                   <img src="<?php echo SITEURL;?>images/foodko/<?php echo $current_image; ?>" width="110px">
                  <?php
                   
                    }
            
            
                   ?>   
                    </td>
            
               </tr>
               <tr>
               <td>Select New image </td>
               <td>
               <input type="file" name="image">
               </td>

               </tr>

               <tr>
                   <td>Category:</td>
                    <td>
                       <select name="category">
                       <?php
                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                    $res = mysqli_query($conn,$sql);
                    $count = mysqli_num_rows($res);

                    if($count>0)
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $category_id = $row['id'];
                            $category_title = $row['title'];
                              
                            ?>
                            <option <?php if($current_category==$category_id){echo "selected";}?> value="<?php echo $category_id; ?>"><?php echo $category_title;?></option>
                            <?php

                        }
                    }
                    else{
                        ?>
                        <option value="0">Categories not available</option>

                        <?php
                    }
                     
                    ?>
                        
                 </select>
                   </td>
                </tr>
               <tr>
                  <td>Featured:</td>
                  <td>
                     <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes

                     <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
                    </td>
              </tr>
               <tr>
                     <td>Active:</td>
                  <td>
                     <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                     <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                   </td>
               </tr>
              <tr>
                   <td>
                     <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                      <input type="hidden" name="id" value="<?php echo $id; ?>">
                       <input type="submit" name="submit" value="Update Category" class="btn_secondary">

                    </td>
               </tr>
            </table>
        </form>
        <?php
        if(isset($_POST['submit']))
        {
            $id =$_POST['id'];
            $title = $_POST['title'];
            $description =$_POST['description'];
            $price=$_POST['price'];
            $current_image = $_POST['current_image'];
            $category =$_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            if(isset($_FILES['image']['name'])){
                $image_name = $_FILES['image']['name'];
                if($image_name !="")
                {
                    
                    $ext= end(explode('.',$image_name));
                    $image_name="food-name-" .rand(000,999).'.'.$ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/foodko/".$image_name;
                    $upload =move_uploaded_file($source_path,$destination_path);
                   if($upload==false)
                   {
                     $_SESSION['upload']="<div class ='error'>Failed to upload image.</div>";
                       header("location:".SITEURL.'admin/food-manage.php');
                       die();
                    }
                  if($current_image!=="")
                    {
                        $remove_path = "../images/foodko/".$current_image;
            
                      $remove = unlink($remove_path);
                      if($remove==FALSE)
                        {
                         $_SESSION['remove-fail'] = "<div class='error'>Failed to remove current image</div>";
                          header("location:".SITEURL.'admin/food-manage.php');
                         die();
                        }

                   }
           
                }
                else
                {
                    $image_name = $current_image;

                }
            }
            else
            {
                $image_name = $current_image;
            }
            $sql3 = "UPDATE tbl_food SET 
            title='$title',
            description = '$description',
            price =$price,
            image_name ='$image_name',
            category_id ='$category',
            featured='$featured',
            active='$active'
            WHERE id=$id
            ";

            $res3 = mysqli_query($conn,$sql3);
            if($res3 ==TRUE)
            {
                $_SESSION['update'] = "<div class = 'success'> Food is updated successfully</div>";
                header("location:".SITEURL.'admin/food-manage.php');
                

            }
            else{
                $_SESSION['update'] = "<div class = 'error'> food is failed to update.</div>";
                header("location:".SITEURL.'admin/food-manage.php');
            }
            
        }
        
        
        ?>




    </div>

</div>


<?php include('partials/footer.php');?>



