<?php
 
  session_start();
  include("includes/db.php");
  
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
    <link rel="stylesheet" href="css/login.css">
    <title>M-DEV-STORE ADMIN AREA</title>
  </head>
<body>
    
    <div class="container">
        <form action="" class="form-login" method="GET">
            <h2 class="form-login-heading"> Admin Login </h2>

            <input type="text" class="form-control" placeholder="Email Address" name="admin_email" required>

            <input type="password" class="form-control" placeholder="Your Password" name="admin_pass" required>

            <button type="submit" class="btn btn-lg btn-primary btn-block" name="admin_login">
             
              Login
            
            </button>
        </form>
    </div>

</body>
</html>

<?php 

  if(isset($_GET['admin_login'])) {

    $admin_email = $_GET['admin_email'];

    $admin_pass = $_GET['admin_pass'];

    $get_admin = "select * from admins where admin_email='$admin_email' AND admin_pass='$admin_pass'";
    
    $run_admin = mysqli_query($con,$get_admin);

    $count = mysqli_num_rows($run_admin);

    if($count==1) {

        $_SESSION['admin_email'] = $admin_email;

        echo "<script> alert('Logged in.Welcome Back') </script>";

        echo "<script> window.open('index.php?dashboard','_self') </script>";
    }
    else{

        echo "<script> alert('Email or Password is wrong ! ! !') </script>";
    }
  }

?>