<?php include('front-partial/menu.php');?>
    
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore foods Here</h2>
            <?php
            // display all categories that are active
            $sql ="SELECT * FROM tbl_category WHERE active ='Yes'";
            $res =mysqli_query($conn,$sql);
            $count =mysqli_num_rows($res);

            // check whether categories available or not
            if($count>0)
            {
                // category available
                while($row =mysqli_fetch_assoc($res))
                {
                    $id =$row['id'];
                    $title =$row['title'];
                    $image_name =$row['image_name'];
                    ?>
                    <a href="<?php echo SITEURL; ?>categories-food.php?category_id=<?php echo $id; ?>">
                     <div class="box3 float-container">
                         <?php
                         if($image_name=="")
                         {
                             //image  not available

                         }
                         else
                          {
                              //image available
                              ?>
                               <img src="<?php echo SITEURL;?>images/categories/<?php echo $image_name; ?>" class ="response img-curve">

                              <?php

                         }
                         ?>

                         
                          <h3 class="float-text text-violet"><?php echo $title; ?></h3>
                     </div>
                   </a>

                    <?php


                }

            }
            else{
                echo "<div class ='error'> Category not found</div>";
            }
            
            
            ?>




            
        <div class="clearfix"></div>
        </div>
    </section>





    <?php include('front-partial/footer.php');?>