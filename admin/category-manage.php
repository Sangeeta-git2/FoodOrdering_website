<?php include('partials/menu.php');?>
<div class="main_contain">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br> 
        <?php
        if(isset($_SESSION['added'])){// check for whether the session is set or not
            echo $_SESSION['added'];//for displaying session msg
            unset($_SESSION['added']);//remove session msg
        }
        if(isset($_SESSION['remove'])){
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['category_no_found'])){
            echo $_SESSION['category_no_found'];
            unset($_SESSION['category_no_found']);
        }
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if(isset($_SESSION['remove-fail'])){
            echo $_SESSION['remove-fail'];
            unset($_SESSION['remove-fail']);
        }


        ?>
        <br /><br /><br />
        
<a href="<?php echo SITEURL; ?>admin/Add_category.php" class="btn_primary">Add category</a>
        <br />
<br /><br /><br />

<table class="tbl_full">
    <tr>
        <th>S.N</th>
        <th>Title</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
    </tr>
    <?php
    //query to get all data from database
    $sql1="SELECT * FROM tbl_category";
    // execute query
    $res = mysqli_query($conn,$sql1);
    //count rows
    $count = mysqli_num_rows($res);

    // create serial no variable and assign value as 1
    $sn=1;
    // checking if data exist in database
    if($count>0){
        // that means we have data in database
        while($row = mysqli_fetch_assoc($res)){
            $id = $row['id'];
            $title= $row['title'];
            $image_name =$row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];

            ?>
               <tr>
               <td><?php echo $sn++;?></td>
               <td><?php echo $title;?></td>

               <td>
               <?php 
               //check if image is available .if not then display msg
               if($image_name!=""){
                   // display image
                   ?>
                   <img src="<?php echo SITEURL;?>images/categories/<?php echo $image_name; ?>" width="110px">
                   <?php
               }
               else{
                   echo "<div class = 'error'>Image is not added.</div>";
               }

               ?>
               </td>

               <td><?php echo $featured;?></td>
               <td><?php echo $active;?></td>
               <td>
               <a href="<?php echo SITEURL;?>admin/update_category.php?id=<?php echo $id; ?>" class="btn_secondary">Update Category</a>
               <a href="<?php echo SITEURL;?>admin/delete_category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="btn_danger">Delete Category</a>
               </td>
               </tr>
        
        
        
        
        
        
        
          
            <?php
        }
    }
    else{
        //we dont have data in database. then display msg in inside table
        ?>
        <tr>
        <td colspan="6"><div class="error">No category added</div></td>
        </tr>


        <?php

    }
    ?>

    
    
</table>



    </div>
</div>


<?php include('partials/footer.php');?>