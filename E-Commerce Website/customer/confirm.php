<?php

  session_start();

  if(!isset($_SESSION['customer_email'])) {

     echo "<script> window.open('../checkout.php','_self') </script>";

  }
  else{

  include("includes/db.php");
  include("functions/functions.php");

  if (isset($_GET['order_id'])) {
     
    $order_id = $_GET['order_id'];
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
                <a href="checkout.php"> <?php items(); ?> Items In Your Cart | Total Price:<?php  total_price();  ?> </a>
              </div>

              <div class="col-md-6">
                <ul class="menu">
                  <li>
                    <a href="../customer_register.php">Register</a>
                  </li>
                  <li>
                    <a href="my_account.php">My Account</a>
                  </li>
                  <li>
                      <a href="../cart.php">Go To Cart</a>
                  </li>
                  <li>
                      <a href="../checkout.php">
                      
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
      
  <nav class="navbar navbar-expand-lg">
    <!-- <div class="container"> -->
    <a href="../index.php" class="navbar-brand home ">
      <img src="images/ecom-store-logo.png" alt="M-Dev-Store logo" class="d-none d-md-block">
      <img src="images/ecom-store-logo-mobile.png" alt="M-Dev-Store logo Mobile" class="d-md-none">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navigation">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../shop.php">Shop</a>
        </li>
        <li class="nav-item active bg-secondary">
          <a href="my_account.php" class="nav-link">My Account</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../cart.php">Shopping Cart</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../contact.php">Contact Us</a>
        </li>
      </ul>
      <form class="form-inline" id="btn">
        <div class="input-group mr-1">
          <input type="text" class="form-control" placeholder="Search" name="user_query" required>
          <button class="input-group-append btn btn-primary" value="search" name="search" type="submit">
              <i class="fa fa-search"></i>
          </button>
        </div>
          <a href="cart.php" class=" btn btn-primary" id="four">
              <i class="fa fa-shopping-cart"></i>
              <span><?php items(); ?> Items In Your Cart</span>
          </a>
      </form>
    </div>
    <!-- </div> -->
  </nav>

  <div id="content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active">
                        My Account
                    </li>
                </ol>
              </div>

              <div class="col-md-3">
                <?php

                include("includes/sidebar.php");

                ?>
              </div>
              <div class="col-md-9">

                <div class="box">
                    <h1 align="center"> Please Confirm Payment</h1>
                    <form action="confirm.php?update_id=<?php echo $order_id; ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Invoice No:</label>
                            <input type="text" class="form-control" name="invoice_no" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="">Amount Sent:</label>
                            <input type="text" class="form-control" name="amount_sent" required>
                        </div>

                        <div class="form-group">
                            <label for="">Select Payment Mode:</label>
                            <select name="payment_mode"  class="form-control" required>
                               <option> Select Payment Mode </option>
                               <option> Back Code </option>
                               <option>  Paypall </option>
                               <option>  Pyoneer </option>
                               <option>  Western Union </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for=""> Transaction / Refrence ID:</label>
                            <input type="text" class="form-control" name="ref_no" required>
                        </div>

                        <div class="form-group">
                            <label for=""> Paypall / Payooner / Western Union: </label>
                            <input type="text" class="form-control" name="code" required>
                        </div>

                        <div class="form-group">
                            <label for=""> Payment Date: </label>
                            <input type="text" class="form-control" name="date" required>
                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary btn-lg" name="confirm_payment">
                                <i class="fa fa-user-md"></i> Confirm Payment
                            </button>
                        </div>


                    </form>

                    <?php 
                     
                      if (isset($_POST['confirm_payment'])) {
                         
                         $update_id = $_GET['update_id'];
                        
                         $invoice_no = $_POST['invoice_no'];

                         $amount = $_POST['amount_sent'];

                         $payment_mode = $_POST['payment_mode'];

                         $ref_no = $_POST['ref_no'];

                         $code = $_POST['code'];

                         $payment_date = $_POST['date'];

                         $complete = "Complete";

                         $insert_payment = "insert into payments (invoice_no,amount,payment_mode,ref_no,code,payment_date) values
                          ('$invoice_no','$amount','$payment_mode','$ref_no','$code','$payment_date')";

                          $run_payment = mysqli_query($con,$insert_payment);

                          $update_customer_order = "update customer_orders set order_status='$complete' where order_id='$update_id'";

                          $run_customer_order = mysqli_query($con,$update_customer_order);

                          $update_pending_order = "update pending_orders set order_status='$complete' where order_id='$update_id'";

                          $run_pending_order = mysqli_query($con,$update_pending_order);

                          if ($run_pending_order) {
                              
                             echo "<script> alert('Thank You for purchasing, your orders will be completed within 24hours of work') </script>";

                             echo " <script> window.open('my_account.php?my_orders','_self') </script> ";
                          }

                        }
                    
                    ?>
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
<?php  } ?>