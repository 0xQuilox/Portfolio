<?php

if(!isset($_SESSION['admin_email'])) {

    echo "<script> window.open('login.php','_self') </script>";
   }
   else{

?>

<!-- <!doctype html>
<html lang="en">
  <head> -->
    <!-- Required meta tags -->
    <!-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/style.css"> -->
    <!-- <title>Insert User</title>
  </head>
  <body> -->
  <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12 mt-5">
               <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Dashboard / Insert User
                    </li>
                </ol>
         </div>
      </div>

      <div class="row">  
         <div class="col-lg-12">
             <div class="card">
                 <div class="card-body">
                     <h3 class="card-header">
                         <i class="fa fa-money fa-fw"></i>Insert User
                     </h3>
                     <form action="" method="POST"  enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label-lg"> Username</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="admin_name" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label-lg"> E-mail </label>
                            <div class="col-md-6">
                               <input type="email" class="form-control" name="admin_email" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label-lg"> Password </label>
                            <div class="col-md-6">
                               <input type="password" class="form-control" name="admin_pass" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label-lg"> Image </label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="admin_image" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label-lg"> Country </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="admin_country" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label-lg"> Contact </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="admin_contact" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label-lg"> Job </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="admin_job" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label-lg"> About </label>
                            <div class="col-md-6">
                                <textarea name="admin_about"  class="form-control" required></textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                        <label for="" class="col-md-3 col-form-label-lg"></label>
                            <div class="col-md-6">
                                <input type="submit"  value="Insert User" class="btn btn-primary form-control" name="submit">
                            </div>
                        </div>
                    
                    </form>
                 </div>
             </div>
         </div>
       </div>
    </div>
    
<!-- 
    <script src="js/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({selector:'textarea'});</script> -->
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script> -->

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  <!-- </body>
</html> -->

<?php

if(isset($_POST['submit'])) {

    $user_name = $_POST['admin_name'];
    $user_email = $_POST['admin_email'];
    $user_pass = $_POST['admin_pass'];
    $user_country = $_POST['admin_country'];
    $user_contact = $_POST['admin_contact'];
    $user_job = $_POST['admin_job'];
    
    $user_image = $_FILES['admin_image'] ['name'];
    $temp_admin_image = $_FILES['admin_image'] ['tmp_name'];

    $user_about = $_POST['admin_about'];

    move_uploaded_file($temp_admin_image,"admin_images/$user_image");
    
    $insert_user = "insert into admins
    (admin_name,admin_email,admin_pass,admin_country,admin_contact,admin_job,admin_image,admin_about) values
    ('$user_name','$user_email','$user_pass','$user_country','$user_contact','$user_job','$user_image','$user_about')";

    $run_user= mysqli_query($con,$insert_user);

    if($run_user) {
        echo "<script>alert('USER has been Registered to your ADMIN successfully')</script>";
        echo "<script>window.open('index.php?view_users','_self')</script>";
    }
    else{
        echo "<script>alert('USER Registration is Unsuccessfull❌❌❌')</script>";
    }

}

?>

<?php } ?>

