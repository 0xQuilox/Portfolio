  <?php
   $active='Account';
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
                        Register
                    </li>
                </ol>
              </div>

              <div class="col-md-12">
                <div class="box">
                  <div class="box-header">
                    <center>
                      <h2>Register a New Account</h2>
                    </center>
                    <form action="customer_register.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="">Your Name</label>
                        <input type="text" class="form-control" name="c_name" required>
                      </div>

                      <div class="form-group">
                        <label for="">Your Email</label>
                        <input type="email" class="form-control" name="c_email" required>
                      </div>

                      <div class="form-group">
                        <label for="">Your Password</label>
                        <input type="password" class="form-control" name="c_pass" required>
                      </div>

                      <div class="form-group">
                        <label for="">Your Country</label>
                        <input type="text" class="form-control" name="c_country" required>
                      </div>

                      <div class="form-group">
                        <label for="">Your City</label>
                        <input type="text" class="form-control" name="c_city" required>
                      </div>

                      <div class="form-group">
                        <label for="">Your Contact</label>
                        <input type="text" class="form-control" name="c_contact" required>
                      </div>

                      <div class="form-group">
                        <label for="">Your Address</label>
                        <input type="text" class="form-control" name="c_address" required>
                      </div>

                      <div class="form-group">
                        <label for="">Your Profile Picture</label>
                        <input type="file" class="form-control form-height-custom" name="c_image" required>
                      </div>

                      <div class="text-center">
                        <button type="submit" name="register" class="btn btn-primary">
                         <i class="fa fa-user-md"></i> Register
                        </button> 
                      </div>
                    </form>
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


<?php          

if (isset($_POST['register'])) {

  $c_name = $_POST['c_name'];

  $c_email = $_POST['c_email'];

  $c_pass = $_POST['c_pass'];

  $c_country = $_POST['c_country'];

  $c_city = $_POST['c_city'];

  $c_contact = $_POST['c_contact'];

  $c_address = $_POST['c_address'];

  $c_image = $_FILES['c_image']['name'];

  $c_image_tmp = $_FILES['c_image']['tmp_name'];

  $c_ip = getRealIpUser();

  move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");

  $insert_customer = "insert into customers
  (customer_name,customer_email,customer_pass,customer_country,customer_cty,customer_contact,customer_address,customer_image,customer_ip) values
  ('$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image','$c_ip')";

   $run_customer = mysqli_query($con,$insert_customer);

   $sel_cart = "select * from cart where ip_add='$c_ip'";

   $run_cart = mysqli_query($con,$sel_cart);

   $check_cart = mysqli_num_rows($run_cart);

   if ($check_cart>0) {

      // if the user has item in cart

    $_SESSION['customer_email']= $c_email;

    echo "<script> alert('You have been registered successfully') </script>";

    echo " <script> window.open('checkout.php','_self') </script> ";
     
   }
   else{
    
    // if the user dosen't has item in cart

    $_SESSION['customer_email']= $c_email;

    echo "<script> alert('You have been registered successfully') </script>";

    echo " <script> window.open('index.php','_self') </script> "; 

   }
  
}





?>