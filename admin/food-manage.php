<?php include('partials/menu.php');?>
<div class="main_contain">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br />

            <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn_primary">Add Food</a>
          <br />
         <br /><br /><br />

             <?php
             if(isset($_SESSION['added'])){
                echo $_SESSION['added'];
                 unset($_SESSION['added']);
                     }
                if(isset($_SESSION['delete'])){
                  echo $_SESSION['delete'];
                  unset($_SESSION['delete']);
                  }
                  if(isset($_SESSION['remove'])){
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                    }
                    if(isset($_SESSION['unauthorize'])){
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);
                    }
                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['upload'])){
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                
                   ?>
                   <br><br><br>

                     <table class="tbl_full">
                    <tr>
        <th>S.N</th>
        <th>Title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
    </tr>
    <?php 

    $sql1 = "SELECT * FROM tbl_food";
    $res = mysqli_query($conn,$sql1);
    $count = mysqli_num_rows($res);
    $sn=1;
    if($count>0)
    {
        while($row = mysqli_fetch_assoc($res)){
            $id = $row['id'];
            $title= $row['title'];
            $price =$row['price'];
            $image_name =$row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];
            ?>
               <tr>
                   <td><?php echo $sn++;?>.</td>
                    <td><?php echo $title;?></td>
                    <td><?php echo $price;?></td>
                    <td>
                     <?php 
                     if($image_name==""){
                         echo "<div class = 'error'>Image is not added.</div>";
                       
                    }
                    else{
                        ?>
                        <img src="<?php echo SITEURL;?>images/foodko/<?php echo $image_name; ?>" width="110px">
                        <?php
                       
                    }
     
                    ?>

                     
                     
                    </td>
        
                     <td><?php echo $featured;?></td>
                     <td><?php echo $active;?></td>
                    <td>
                        <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id; ?>"class="btn_secondary">Update Food</a>
                     <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="btn_danger">Delete Food</a>
                     </td>
               </tr>


               
               <?php 



        }
    }
    else{
        echo "<tr><td colspan='7' class ='error'> Food is not added yet.</td></tr>";
    }
    
    
    
    
    ?>
   
    </table>

    </div>
</div>


<?php include('partials/footer.php');?>