<div class="box">

    <div class="box-header">

        <center>
           
            <h1>Login</h1>

             <p class="lead"> Already have an account...? </p>

             <p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Exercitationem, officiis.
              Eveniet dolores ea et cupiditate ullam tempora laborum, eligendi dignissimos!</p>
        
        </center>
        
    </div>

    <form action="checkout.php" method="GET">
    
      <div class="form-group">
      
        <label>Email</label>

        <input type="email" name="c_email" class="form-control" required>

      </div>

      <div class="form-group">
      
        <label >Password</label>

        <input type="password" name="c_pass" class="form-control" required>

      </div>

      <div class="text-center">
      
        <button class="btn btn-primary" name="login"  value="Login">
        
          <i class="fa fa-sign-in"></i> Login
        
        </button>
      
      </div>
    
    </form>

    <center>
    
      <a href="customer_register.php">
      
        <h3>Dont have an account..? Register here</h3>
      
      </a>
    
    </center>

</div>

<?php

  if (isset($_GET['login'])) {
         
     $customer_email = $_GET['c_email'];

     $customer_pass = $_GET['c_pass'];

     $select_customer = "select * from customers where customer_email = '$customer_email' AND
      customer_pass='$customer_pass'";

     $run_customer = mysqli_query($con,$select_customer);
     
     $get_ip = getRealIpUser();

     $check_customer = mysqli_num_rows($run_customer);

     $select_cart = "select * from cart where ip_add='$get_ip'";

     $run_cart = mysqli_query($con,$select_cart);

     $check_cart = mysqli_num_rows($run_cart);

     if ($check_customer==0) {
         
        echo "<script> alert('Your email or password is not valid') </script>";

        exit();
     }
     if ($check_customer==1 AND $check_cart==0) {
         
        $_SESSION['customer_email']=$customer_email;

        echo "<script> alert('Your are Logged in') </script>";

        echo "<script> window.open('customer/my_account.php?my_orders','_self') </script>";
     }
     else {
        $_SESSION['customer_email']=$customer_email;

        echo "<script> alert('Your are Logged in') </script>";

        echo "<script> window.open('checkout.php','_self') </script>";
     }
  }

?>
