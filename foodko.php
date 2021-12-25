
    <?php include('front-partial/menu.php');?>

    <!--food search ko starting-->
    <section class="search-food text-center">
        <div class="container">
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="search for food">
               <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
        </div>   
    </section>
    <!--food search ko ending lagi-->

    
<!--food menu ko startslagi-->

    <section class="food_menu">
        <div class="container">
            <h2 class="text-center">Foods menu</h2>
            <?php
            // display ffod that are active
            $sql = "SELECT * FROM tbl_food WHERE active ='Yes'";
            $res =mysqli_query($conn ,$sql);
            $count =mysqli_num_rows($res);
            //check whether the foods are available or not
            if($count>0)
            {
                //foods available
                while($row =mysqli_fetch_assoc($res))
                {
                    //get values
                    $id =$row['id'];
                    $title =$row['title'];
                    $description =$row['description'];
                    $price =$row['price'];
                    $image_name =$row['image_name'];
                    ?>
                 <div class="food_menu_box">
                      <div class="food_menu_image">
                          <?php
                          //check if image is avialble or not
                          if($image_name==""){
                              //image is not available
                              echo "<div class ='error'> Image is not available</div>";
                          }
                          else
                          {
                             ?>
                              <img src="<?php echo SITEURL;?>images/foodko/<?php echo $image_name;?>"class="response" >

                             <?php



                          }
                          
                          ?>
                           
                     </div>
                      <div class="food_menu_desc">
                           <h4><?php echo $title; ?></h4>
                            <p class="food_price"><?php echo $price; ?></p>
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
                echo"<div class ='error'> food are not available.</div>";

            }
            
            ?>


           
           
            
           
            
           
            

            <div class="clearfix"></div>
        </div>
        </section>
    <!--food menu ko ending-->
    
    
    <?php include('front-partial/footer.php');?>