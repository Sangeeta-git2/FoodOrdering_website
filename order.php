 <?php include('front-partial/menu.php');?>
    <?php 
    //check food is set or not
    if(isset($_GET['food_id'])){
        $food_id=$_GET['food_id'];
        //get details of selected food
        $sql1="SELECT * FROM tbl_food WHERE id=$food_id";
        $res=mysqli_query($conn,$sql1);
        $count=mysqli_num_rows($res);
        if($count==1){
            //we have data.and get data from database
            $row=mysqli_fetch_assoc($res);
            $title=$row['title'];
            $price=$row['price'];
            $image_name=$row['image_name'];

        }
        else{
            //not available food
            header('location:'.SITEURL);

        }
    }
    else{
        header('location:'.SITEURL);
    }
    
    
    
    
    ?>
    <section class="search-food">
        <div class="container">
            
            <h2 class="text-center text-green">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food_menu_image">
                        <?php
                        if($image_name==""){
                            echo "<div class ='error'>Image not available</div>";

                        }
                        else{
                            ?>
                            <img src="<?php echo SITEURL;?>images/foodko/<?php echo $image_name;?>"  class="response img-curve">

                            <?php

                        }
                        ?>


                        
                    </div>
    
                    <div class="food_menu_desc">
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="food" value="<?php echo $title;?>">

                        <p class="food_price">RS <?php echo $price;?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. sangita khatri" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. sangeekhatri12@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php
            if(isset($_POST['submit'])){
                // get details from the form
                $food =$_POST['food'];
                $price=$_POST['price'];
                $qty=$_POST['qty'];

                $total=$price * $qty;
                $order_date=date("y-m-d h:i:sa");
                $status="Ordered";
                $customer_name=$_POST['full-name'];
                $customer_contact=$_POST['contact'];
                $customer_email=$_POST['email'];
                $customer_address=$_POST['address'];

                //save order in database
                $sql2="INSERT INTO tbl_order set 
                food='$food',
                price=$price,
                quantity=$qty,
                total=$total,
                order_date='$order_date',
                status='$status',
                customer_name='$customer_name',
                customer_contact='$customer_contact',
                customer_email='$customer_email',
                customer_address='$customer_address'";
                $res2=mysqli_query($conn,$sql2);
                if($res2==true){
                    $_SESSION['order']="<div class='success text-center'>Food ordered successfully</div>";
                    header('location:'.SITEURL);

                }
                else{
                    $_SESSION['order']="<div class='error text-center'>Food ordered failed</div>";
                    header('location:'.SITEURL);


                }


            }
            
            ?>
        </div>
    </section>
            
    <?php include('front-partial/footer.php');?>