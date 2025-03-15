   <?php
    $active='Cart';
   include("includes/header.php");
  
  ?>

  <div id="content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Cart
                        </li>
                    </ol>
              </div>

              <div id="cart" class="col-md-9">
                  <div class="box">
                      <form action="cart.php" method="POST" enctype="multipart/form-data">
                         <h1>Shopping Cart</h1>

                         <?php

                         $ip_add = getRealIpUser();

                         $select_cart = "select * from cart where ip_add='$ip_add'";

                         $run_cart = mysqli_query($con,$select_cart);

                         $count = mysqli_num_rows($run_cart);



                        ?>
                         <p class="text-muted">You currently have <?php echo $count;  ?> item(s) in your cart</p>
                         <div class="table-responsive">
                             <table class="table">
                                 <thead>
                                     <tr>
                                         <th colspan="2">Product</th>
                                         <th>Quantity</th>
                                         <th>Unit Prize</th>
                                         <th>Size</th>
                                         <th colspan="1">Delete</th>
                                         <th colspan="2">Sub-total</th>
                                     </tr>
                                 </thead>

                                 <tbody>

                                 <?php  
                                 
                                 $total = 0;
                                 
                                 while ($row_cart = mysqli_fetch_array($run_cart)) {
                                     
                                  $pro_id = $row_cart['p_id'];

                                  $pro_size = $row_cart['size'];

                                  $pro_qty = $row_cart['qty'];

                                  $get_products = "select * from products where product_id='$pro_id'";

                                  $run_products = mysqli_query($con,$get_products); 

                                  while ($row_products = mysqli_fetch_array($run_products)) {
                                      
                                    $product_title = $row_products['product_title'];

                                    $product_img1 = $row_products['product_img1'];

                                    $only_price = $row_products['product_price'];

                                    $sub_total = $row_products['product_price']*$pro_qty;

                                    $total +=$sub_total;
                                 
                                 
                                 ?>
                                     <tr>
                                         <td>
                                           <img class="img-fluid" src="admin_area/product_images/<?php echo $product_img1;   ?>" alt="">
                                         </td>

                                         <td>
                                             <a href="details.php?pro_id=<?php echo $pro_id;  ?>"><?php echo $product_title;   ?></a>
                                         </td>

                                         <td>
                                            <?php echo $pro_qty;  ?>
                                         </td>

                                         <td>
                                            <?php echo  $only_price;  ?>
                                         </td>

                                         <td>
                                           <?php echo $pro_size;  ?>
                                         </td>

                                         <td>
                                             <input type="checkbox" name="remove[]" value="<?php echo $pro_id;  ?>">
                                         </td>

                                         <td>
                                             $<?php echo $sub_total; ?>
                                         </td>
                                     </tr>

                                     <?php  } } ?>
                                 </tbody>

                                 <tfoot>
                                     <tr>
                                         <th colspan="5">Total</th>
                                         <th colspan="2"> $<?php echo $total; ?> </th>
                                     </tr>
                                 </tfoot>
                             </table>
                         </div>

                         <div class="box-footer">

                                <div class="pull-left">
                                    <a href="index.php" class="btn btn-secondary">
                                        <i class="fa fa-chevron-left"></i> Continue Shopping
                                    </a>
                                </div>

                                <div class="pull-right">
                                    <button type="submit" name="update" value="Update Cart" class="btn btn-secondary">
                                        <i class="fa fa-refresh"></i> Update Cart
                                    </button>

                                    <a href="checkout.php" class="btn btn-primary">
                                        Proceed Checkout <i class="fa fa-chevron-right"></i>
                                    </a>
                                </div>

                         </div>
                      </form>

                  </div>

                  <?php 

                   function update_cart() {
                       global $con;

                       if(isset($_POST['update'])) {

                          foreach($_POST['remove'] as $remove_id) {

                           $delete_product = "delete from cart where p_id='$remove_id'";

                           $run_delete = mysqli_query($con,$delete_product);

                           if($run_delete) {

                              echo "<script>window.open('cart.php','_self')</script>";

                           }

                          }

                       }
                   }

                    echo $up_cart = update_cart();
                  ?>
              </div>

              <div class="col-md-3">
                  <div id="order-summary" class="box">
                      <div class="box-header">
                          <h3>Order Summary</h3>
                      </div>
                      <p class="text-muted">
                          Shipping and additional cost are calculated based on value you entered
                      </p>

                      <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Order Sub-Total</td>
                                        <th> $<?php echo $total; ?> </th>
                                    </tr>

                                    <tr>
                                        <td>Shipping and Handling</td>
                                        <th>$0</th>
                                    </tr>

                                    <tr>
                                        <td>Tax</td>
                                        <th>$0</th>
                                    </tr>

                                    <tr class="total">
                                        <td>Total</td>
                                        <th> $<?php echo $total; ?> </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                  </div>
              </div>
            </div>
      </div>
  </div>

  <?php
   include("includes/footer.php");

  ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>