<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-3">
               
             <h4>Pages</h4>

              <ul>
                  <li><a href="cart.php">Shopping Cart</a></li>
                  <li><a href="contact.php">Contact Us</a></li>
                  <li><a href="shop.php">Shop</a></li>
                  <li><a href="customer/my_account.php">My Account</a></li>
              </ul>
             
              <hr class="d-md-none d-lg-none d-sm-none">
            </div>

            <div class="col-sm-6 col-md-3">

               <h4>Top Products Category</h4>
               
               <ul>
                   <?php

                    $get_p_cats = "select * from product_categories";

                    $run_p_cats = mysqli_query($con,$get_p_cats);

                    while ($row_p_cats = mysqli_fetch_array($run_p_cats)) {

                        $p_cat_id = $row_p_cats['p_cat_id'];
                        $p_cat_title = $row_p_cats['p_cat_title'];

                        echo "
                           
                           <li>
                              <a href='shop.php?p_cat=$p_cat_id'>
                                
                                $p_cat_title
                              
                              <?a>
                           </li>
                        
                        ";

                    }
                   
                   ?>
               </ul>

               <hr class="d-md-none d-lg-none">
            </div>

            <div class="col-sm-6 col-md-3">
              
              <h4>Find Us</h4>

              <p>

                <strong>E-COM Media inc.</strong>
                <br>Ciburbur
                <br>Ciracas
                <br>0818-0683-3157
                <br>ecomstore@gmail.com
                <br><strong>E-COM</strong>

              </p>

              <a href="contact.php">Check Our Contact Page</a>
             
              <hr class="d-md-none d-lg-none">
            </div>

            <div class="col-sm-6 col-md-3">
                <h4>Get the News</h4>

                <p class="text-muted">
                    Don`t miss our latest Update
                </p>
                <form action="" method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control" name="email">

                        <span class="input-group-btn">
                            <input type="submit" value="Subscribe" class="btn btn-light">
                        </span>

                    </div>
                </form>

                <hr>

                <h4>Keep In Touch</h4>

                <p class="social">
                    <a href="#" class="fa fa-facebook"></a>
                    <a href="#" class="fa fa-twitter"></a>
                    <a href="#" class="fa fa-instagram"></a>
                    <a href="#" class="fa fa-google-plus"></a>
                    <a href="#" class="fa fa-envelope"></a>
                </p>
            </div>
        </div>
    </div>
</div>

<div id="copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="text-center">&copy; 2022 E-COM Store All Rights Reserved</p>
            </div>
        </div>
    </div>
</div>