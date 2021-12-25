<?php include('front-partial/menu.php');?>

    <!--food search ko starting-->
    <section class="search-food text-center">
        <div class="container">
            <?php
            //get the search keyword
            $search =mysqli_real_escape_string($conn,$_POST['search']);//mysqli_real_escape is used to protect our databse from sql injection attack.
            ?>
           <h2>
               Foods on your search. =>
               <a href="#" class="text-green"><?php echo $search; ?></a>
           </h2>
        </div>   
    </section>
    <!--food search ko ending lagi-->

    
<!--food menu ko startslagi-->

    <section class="food_menu">
        <div class="container">
            <h2 class="text-center">Foods menu</h2>
            <?php
            $sql ="SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
            $res = mysqli_query($conn,$sql);
            $count =mysqli_num_rows($res);
            // check whether food available or not
            if($count>0)
            {
                //food available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the detail
                    $id =$row['id'];
                    $title =$row['title'];
                    $price =$row['price'];
                    $description =$row['description'];
                    $image_name =$row['image_name'];

                    ?>
                     <div class="food_menu_box">
                          <div class="food_menu_image">
                              <?php
                              //check whether image_name is available nor not
                              if($image_name=="")
                              {
                                   //image is not available
                                   echo "<div class ='error'> Image not available</div>";
                              }
                              else
                              {
                                  //image available
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
                               <a href="#" class="btn-primary">Order Now</a>
                         </div>
                      </div>

                    <?php

                }

            }
            else
            {
                echo "<div class ='error'>Food not found</div>";

            }
            
            ?>
           
           
           
            
           
            

            <div class="clearfix"></div>
        </div>
        </section>
    <!--food menu ko ending-->
    
    
    <?php include('front-partial/footer.php');?>