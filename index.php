<?php include('front-partial/menu.php');?>

    <!--food search ko starting-->
    <section class="search-food text-center">
        <div class="container">
            <form action="<?php echo SITEURL ;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="search for food">
               <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
        </div>   
    </section>
    <!--food search ko ending lagi-->
    <?php
    if(isset($_SESSION['order'])){
        echo $_SESSION['order'];
        unset($_SESSION['order']);
}
    
    ?>

    <!--categories starts here-->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore foods Here</h2>
            <?php
            // sql query to display categories from database
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            $res = mysqli_query($conn,$sql);
            $count =mysqli_num_rows($res);

            if($count>0)
            {
                // categories available
                while($row=mysqli_fetch_assoc($res))
                {
                    // get their id title and image name
                    $id =$row['id'];
                    $title =$row['title'];
                    $image_name =$row['image_name'];
                    ?>
                    
                     <a href="<?php echo SITEURL; ?>categories-food.php?category_id=<?php echo $id; ?>">
                          <div class="box3 float-container">
                              <?php 
                              // check if image is available or not
                              if($image_name =="")
                              {
                                  //display msg
                                  echo "<div class ='error'> Image is not available</div>";

                              }
                              else
                              {
                                  //image available
                                  ?>
                                  <img src="<?php echo SITEURL;?>images/categories/<?php echo $image_name; ?>" class ="response img-curve">


                                  <?php

                              }
                              ?>
                             
                                <h3 class="float-text text-violet"><?php echo $title ;?></h3>
                          </div>
                      </a>

                    <?php

                }

            }
            else{
                // categories not available
                echo "<div class = 'error'> Categories not added.</div>";

            }
            

            
            
            
            ?>




       
        <div class="clearfix"></div>
        </div>
    </section>
    <!--categories ko end lagi-->
    
<!--food menu ko startslagi-->

    <section class="food_menu">
        <div class="container">
            <h2 class="text-center">Foods menu</h2>
            <?php
            // get foods from database that are active and featured
            $sql2 ="SELECT * FROM tbl_food WHERE active ='Yes' AND featured ='Yes' LIMIT 6";
            $res2 = mysqli_query($conn,$sql2);
            $count2 =mysqli_num_rows($res2);
            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res2))
                {
                    // get their id title and image name
                    $id =$row['id'];
                    $title =$row['title'];
                    $price =$row['price'];
                    $description =$row['description'];
                    $image_name =$row['image_name'];
                    ?>
                    <div class="food_menu_box">
                       <div class="food_menu_image">
                           <?php
                           if($image_name =="")
                           {
                               echo "<div class ='error'> Image is not available</div>";

                           }
                           else
                           {
                               //image available
                               ?>
                               <img src="<?php echo SITEURL;?>images/foodko/<?php echo $image_name; ?>" class ="response img-curve">
                               <?php
                           }
                            ?>

                       </div>
                       <div class="food_menu_desc">
                          <h4><?php echo $title; ?></h4>
                          <p class="food_price">RS <?php echo $price; ?></p>
                          <p class="food_detail"><?php echo $description; ?></p>
                          <br>
                          <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id ;?>" class="btn-primary">Order Now</a>
                      </div>
                  </div>
                   <?php
                }
            }
                    
            
            else
            {
             echo "<div class = 'error'> Food not added.</div>";
            }


            
            

            
            
            
            ?>




            
            
            


            
            
           
            
           
            

            <div class="clearfix"></div>
        </div>
        </section>
    <!--food menu ko ending-->
    
    
    <?php include('front-partial/footer.php');?>
    
   
