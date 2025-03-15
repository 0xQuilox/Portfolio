<?php

session_start();

include("includes/db.php");
include("functions/functions.php");


?>
<?php

if(isset($_GET['pro_id'])) {

  $product_id = $_GET['pro_id'];

  $get_product = "select * from products where product_id='$product_id'";

  $run_product = mysqli_query($con,$get_product);

  $row_product = mysqli_fetch_array($run_product);

  $p_cat_id = $row_product['p_cat_id'];

  $pro_title = $row_product['product_title'];

  $pro_price = $row_product['product_price'];

  $pro_desc = $row_product['product_desc'];

  $pro_img1 = $row_product['product_img1'];

  $pro_img2 = $row_product['product_img2'];

  $pro_img3 = $row_product['product_img3'];

  $get_p_cat = "select * from product_categories where p_cat_id='$p_cat_id'";

  $run_p_cat = mysqli_query($con,$get_p_cat);

  $row_p_cat = mysqli_fetch_array($run_p_cat);

  $p_cat_title = $row_p_cat['p_cat_title'];

}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/style.css">
    <title>M-DEV-STORE</title>
  </head>
  <body>
      
      <!---------------Top BEGINS------------------>
      <div id="top">
         <div class="container">
            <div class="row">
              <div class="col-md-6 offer">
                <a href="#" class="btn btn-success btn-sm">
                
                  <?php  
                  
                  if (!isset($_SESSION['customer_email'])) {

                      echo "Welcome: Guest";
           
                  }
                  else{
                    
                    echo "Welcome: " .$_SESSION['customer_email'] . "";

                  }

                  ?>
                
                </a>
                <a href="checkout.php"><?php items(); ?> Items In Your Cart | Total Price:<?php  total_price();  ?></a>
              </div>

              <div class="col-md-6">
                <ul class="menu">
                  <li>
                    <a href="customer_register.php">Register</a>
                  </li>
                  <li>
                    <a href="customer/my_account.php">My Account</a>
                  </li>
                  <li>
                      <a href="cart.php">Go To Cart</a>
                  </li>
                  <li>
                      <a href="checkout.php"> 
                         
                      <?php  
                  
                        if (!isset($_SESSION['customer_email'])) {

                            echo "<a href='checkout.php'> Login </a>";
                
                        }
                        else{
                          
                          echo "<a href='logout.php'> Log Out </a>";

                        }

                       ?>

                      </a>
                  </li>
                </ul>
              </div>
            </div> 
         </div>
      </div>
      <!-------------Top Ends----------------------->
  

      <!------------navbar navbar-default------>
     

  <nav class="navbar navbar-expand-lg">
    <!-- <div class="container"> -->
    <a href="index.php" class="navbar-brand home ">
      <img src="images/ecom-store-logo.png" alt="M-Dev-Store logo" class="d-none d-md-block">
      <img src="images/ecom-store-logo-mobile.png" alt="M-Dev-Store logo Mobile" class="d-md-none">
    </a>
    <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon bg-dark"></span>
    </button>

    <div class="collapse navbar-collapse" id="navigation">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item <?php if($active=='Home') echo "active"; ?>" >
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item <?php if($active=='Shop') echo "active"; ?>">
          <a class="nav-link" href="shop.php">Shop</a>
        </li>
        <li class="nav-item <?php if($active=='Account') echo "active"; ?>">
          
           <?php    
           
             if (!isset($_SESSION['customer_email'])) {
                
               echo "<a  class='nav-link' href='checkout.php'>My Account</a>";

             }
             else {

              echo "<a  class='nav-link' href='customer/my_account.php?my_orders'>My Account</a>";

             }
           
           ?>

        </li>
        <li class="nav-item <?php if($active=='Cart') echo "active"; ?>">
          <a class="nav-link" href="cart.php">Shopping Cart</a>
        </li>
        <li class="nav-item <?php if($active=='Contact') echo "active"; ?>">
          <a class="nav-link" href="contact.php">Contact Us</a>
        </li>
      </ul>
      <form class="form-inline" id="btn" method="get" action='search_product.php'>
        <div class="input-group mr-1">
          <input type="search" class="form-control" 
          value="" placeholder="Search product, category and brand" name="search_data" required>
          <!-- <button class="input-group-append btn btn-primary" value="search"  type="submit">
              <i class="fa fa-search"></i>
          </button> -->
          <input type="submit" value='Search' class='btn btn-outline-primary' 
          name='search_data_product'>
        </div>
          <a href="cart.php" class=" btn btn-primary" id="four">
              <i class="fa fa-shopping-cart"></i>
              <span><?php items(); ?> Items In Your Cart</span>
          </a>
      </form>
    </div>
    <!-- </div> -->
  </nav>
    