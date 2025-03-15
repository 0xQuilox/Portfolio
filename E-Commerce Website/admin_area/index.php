<?php

   session_start();
   include("includes/db.php");

   if(!isset($_SESSION['admin_email'])) {

    echo "<script> window.open('login.php','_self') </script>";
   }
   else{

      $admin_session = $_SESSION['admin_email'];

      $get_admin = "select * from admins where admin_email='$admin_session'";

      $run_admin = mysqli_query($con,$get_admin);

      $row_admin = mysqli_fetch_array($run_admin);

      $admin_id = $row_admin['admin_id'];

      $admin_name = $row_admin['admin_name'];

      $admin_email = $row_admin['admin_email'];

      $admin_image = $row_admin['admin_image'];

      $admin_country = $row_admin['admin_country'];

      $admin_about = $row_admin['admin_about'];

      $admin_contact = $row_admin['admin_contact'];

      $admin_job = $row_admin['admin_job'];
      
      $get_products = "select * from products";

      $run_products = mysqli_query($con,$get_products);

      $count_products = mysqli_num_rows($run_products);

      $get_customers = "select * from customers";

      $run_customers = mysqli_query($con,$get_customers);

      $count_customers = mysqli_num_rows($run_customers);

      $get_p_categories = "select * from product_categories";

      $run_p_categories = mysqli_query($con,$get_p_categories);

      $count_p_categories = mysqli_num_rows($run_p_categories);

      $get_pending_orders = "select * from pending_orders";

      $run_pending_orders = mysqli_query($con,$get_pending_orders);

      $count_pending_orders = mysqli_num_rows($run_pending_orders);

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
    <link rel="stylesheet" href="css/style.css">
    <title>M-DEV-STORE ADMIN AREA</title>
  </head>
  <body>
     
      <div id="wrapper">

         <?php include("includes/sidebar.php"); ?>

         <div class="page-wrapper">
            <div class="container-fluid">
               
                <?php
                
                  if(isset($_GET['dashboard'])) {

                    include("dashboard.php");
                    
                  }
                  if(isset($_GET['insert_product'])) {

                    include("insert_product.php");
                  }
                  if(isset($_GET['view_products'])) {

                    include("view_products.php");
                  }
                  if(isset($_GET['delete_product'])) {

                    include("delete_product.php");
                  }
                  if(isset($_GET['edit_product'])) {

                    include("edit_product.php");
                  }
                  if(isset($_GET['insert_p_cat'])) {

                     include("insert_p_cat.php");
                  }
                  if(isset($_GET['view_p_cats'])) {

                    include("view_p_cats.php");
                  }
                  if(isset($_GET['delete_p_cat'])) {

                    include("delete_p_cat.php");
                  }
                  if(isset($_GET['edit_p_cat'])) {

                    include("edit_p_cat.php");
                  }
                  if(isset($_GET['insert_cat'])) {

                    include("insert_cat.php");
                  }
                  if(isset($_GET['view_cats'])) {

                    include("view_cats.php");
                  }
                  if(isset($_GET['edit_cat'])) {

                    include("edit_cat.php");
                  }
                  if(isset($_GET['delete_cat'])) {

                    include("delete_cat.php");
                  }
                  if(isset($_GET['insert_slide'])) {

                    include("insert_slide.php");
                  }
                  if(isset($_GET['view_slides'])) {

                    include("view_slides.php");
                  }
                  if(isset($_GET['delete_slide'])) {

                    include("delete_slide.php");
                  }
                  if(isset($_GET['edit_slide'])) {

                    include("edit_slide.php");
                  }
                  if(isset($_GET['view_customers'])) {

                    include("view_customers.php");
                  }
                  if(isset($_GET['delete_customer'])) {

                    include("delete_customer.php");
                  }
                  if(isset($_GET['view_orders'])) {

                    include("view_orders.php");
                  }
                  if(isset($_GET['delete_order'])) {

                    include("delete_order.php");
                  }
                  if(isset($_GET['view_payments'])) {

                    include("view_payments.php");
                  }
                  if(isset($_GET['delete_payment'])) {

                    include("delete_payment.php");
                  }
                  if(isset($_GET['view_users'])) {

                    include("view_users.php");
                  }
                  if(isset($_GET['delete_user'])) {

                    include("delete_user.php");
                  }
                  if(isset($_GET['user_profile'])) {

                    include("user_profile.php");
                  }
                  if(isset($_GET['insert_user'])) {

                    include("insert_user.php");
                  }
                  if(isset($_GET['insert_box'])) {

                    include("insert_box.php");
                  }
                  if(isset($_GET['view_boxes'])) {

                    include("view_boxes.php");
                  }
                  if(isset($_GET['delete_box'])) {

                    include("delete_box.php");
                  }
                  if(isset($_GET['edit_box'])) {

                    include("edit_box.php");
                  }
                  if(isset($_GET['insert_term'])) {

                    include("insert_term.php");
                  }
                  if(isset($_GET['view_terms'])) {

                    include("view_terms.php");
                  }
                  if(isset($_GET['edit_term'])) {

                    include("edit_term.php");
                  }
                  if(isset($_GET['delete_term'])) {

                    include("delete_term.php");
                  }
                  if(isset($_GET['edit_css'])) {

                    include("edit_css.php");
                  }
                  

                ?>

            </div>
         </div>
      </div>

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