
<?php include('front-partial/menu.php');?>
  <?php
  if(isset($_GET['category_id']))
  {
      $category_id=$_GET['category_id'];
      $sql ="SELECT title FROM tbl_category WHERE id=$category_id";
      $res =mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($res);
      $category_title=$row['title'];

  }
  else
  {
      header('location;'.SITEURL);

  }

   ?>
    <!--food search ko starting-->
    <section class="search-food text-center">
        <div class="container">
           <h2>
               your searched food on:
               <a href="#" class="text-green">"<?php echo $category_title?>"</a> 
           </h2>
        </div>   
    </section>
    <!--food search ko ending lagi-->

    
    
<!--food menu ko startslagi-->

    <section class="food_menu">
        <div class="container">
            <h2 class="text-center">Foods menu</h2>
            <?php 
            $sql2="SELECT * FROM tbl_food WHERE category_id =$category_id";
            $res2=mysqli_query($conn,$sql2);
            $count2=mysqli_num_rows($res2);
            if($count2>0)
            {
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $id=$row2['id'];
                    $title =$row2['title'];
                    $price=$row2['price'];
                    $description =$row2['description'];
                    $image_name =$row2['image_name'];

                    ?>
                    <div class="food_menu_box">
                      <div class="food_menu_image">
                          <?php
                          
                          if($image_name=="")
                          {
                              echo "<div class ='error'> Image not available</div>";

                          }
                          else
                          {
                              //image available
                              ?>
                              <img src="<?php echo SITEURL; ?>images/foodko/<?php echo $image_name; ?>" class ="response img-curve">
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
                //food not available
                echo "<div class ='error'>Foods are not available</div>";
            }
            
            ?>
            
            
           
            
           
            

            <div class="clearfix"></div>
        </div>
        </section>
    <!--food menu ko ending-->
    
    
    <?php include('front-partial/footer.php');?>
    