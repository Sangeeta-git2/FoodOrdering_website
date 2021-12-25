<?php include('partials/menu.php');?>
<div class="main_contain">
    <div  class="wrapper">
       <h1>Update Order</h1>
      <br> <br>
      <?php
      if(isset($_GET['id']))
      {
          $id=$_GET['id'];
          $sql="SELECT * FROM tbl_order WHERE id=$id";
          $res=mysqli_query($conn,$sql);
          $count =mysqli_num_rows($res);
          if($count==1)
          {
            $row=mysqli_fetch_assoc($res);
            $food=$row['food'];
            $price=$row['price'];
            $quantity=$row['quantity'];
            $status=$row['status'];
            $customer_name=$row['customer_name'];
            $customer_contact=$row['customer_contact'];
            $customer_email=$row['customer_email'];
            $customer_address=$row['customer_address'];

          }
          else{
            header("location:".SITEURL.'admin/order-manage.php');

          }
      }
      else{
        header("location:".SITEURL.'admin/order-manage.php');
      }
      
      ?>

      <form action="" method="POST">
          <table class="tbl_wid">
                <tr>
                  <td>Food Name</td>
                  <td> <b> <?php echo $food; ?> </b></td>
             </tr>
             <tr>
                 <tr>
                     <td>Price:</td>
                     <td>RS <?php echo $price; ?></td>
                 </tr>
                  <td>Quantity</td>
                  <td>
                      <input type="number" name="quantity" value="<?php echo $quantity; ?>">
                  </td>
               </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                        <option <?php if($status=="Ordered"){echo "selected";}?> value="Ordered">Ordered</option>
                        <option <?php if($status=="On Delivery"){echo "selected";}?> value="On Delivery">On Delivery</option>
                        <option <?php if($status=="Delivered"){echo "selected";}?> value="Delivered">Delivered</option>
                        <option <?php if($status=="Cancelled"){echo "selected";}?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
             </tr>
             <tr>
                 <td>Customer Name:</td>
                 <td>
                     <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                 </td>
             </tr>
             <tr>
                 <td>Customer Contact:</td>
                 <td>
                     <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                 </td>
             </tr>
             <tr>
                 <td>Customer Email:</td>
                 <td>
                     <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                 </td>
             </tr>
             <tr>
                 <td>Customer Address:</td>
                 <td>
                     <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                 </td>
             </tr>
             <tr>
                 <td colspan="2">
                     <input type="hidden" name="id" value="<?php echo $id; ?>">
                     <input type="hidden" name="price" value="<?php echo $price; ?>">
                     <input type="submit" name="submit" value="update order" class="btn_secondary">
                 </td>
             </tr>
          </table>
      </form>

      <?php
      if(isset($_POST['submit']))
      {
         $id=$_POST['id'];
         $price=$_POST['price'];
         $quantity=$_POST['quantity'];

         $total=$price+$quantity;

         $status=$_POST['status'];
         $customer_name=$_POST['customer_name'];
         $customer_contact=$_POST['customer_contact'];
         $customer_email=$_POST['customer_email'];
         $customer_address=$_POST['customer_address'];

         $sql1="UPDATE tbl_order SET
         quantity=$quantity,
         total=$total,
         status='$status',
         customer_name='$customer_name',
         customer_contact='$customer_contact',
         customer_email='$customer_email',
         customer_address='$customer_address'
         WHERE id =$id
          ";
          $res1=mysqli_query($conn,$sql1);
          if($res1==true)
          {
             $_SESSION['update']="<div class='success'>Order updated successfully</div>";
             header("location:".SITEURL.'admin/order-manage.php');
             }
         else
         {
            $_SESSION['update']="<div class='error'>Failed to update order</div>";
            header("location:".SITEURL.'admin/order-manage.php');



         }





      }
      
      ?>
    </div>
</div>


<?php include('partials/footer.php');?>