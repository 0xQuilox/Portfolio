<?php

if(!isset($_SESSION['admin_email'])) {

    echo "<script> window.open('login.php','_self') </script>";
   }
   else{

?>
<?php

 if(isset($_GET['user_profile'])) {

    $edit_user = $_GET['user_profile'];

    $get_user =  "select * from admins where admin_id='$edit_user'";

    $run_user = mysqli_query($con,$get_user);

    $row_user = mysqli_fetch_array($run_user);

    $user_id = $row_user['admin_id'];

    $user_name = $row_user['admin_name'];

    $user_email = $row_user['admin_email'];

    $user_pass = $row_user['admin_pass'];

    $user_image = $row_user['admin_image'];

    $user_country = $row_user['admin_country'];

    $user_about = $row_user['admin_about'];

    $user_contact = $row_user['admin_contact'];

    $user_job = $row_user['admin_job'];
 }

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
                        <i class="fa fa-dashboard"></i> Dashboard / Edit User
                    </li>
                </ol>
         </div>
      </div>

      <div class="row">  
         <div class="col-lg-12">
             <div class="card">
                 <div class="card-body">
                     <h3 class="card-header">
                         <i class="fa fa-money fa-fw"></i>Edit User
                     </h3>
                     <form action="" method="POST"  enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label-lg"> Username</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="admin_name" value="<?php echo $user_name; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label-lg"> E-mail </label>
                            <div class="col-md-6">
                               <input type="email" class="form-control" name="admin_email" value="<?php echo $user_email; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label-lg"> Password </label>
                            <div class="col-md-6">
                               <input type="text" class="form-control" name="admin_pass" value="<?php echo $user_pass; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label-lg"> Image </label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="admin_image">
                                <br>
                                <img src="admin_images/<?php echo $user_image; ?>" width="80" height="80" alt="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label-lg"> Country </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="admin_country" value="<?php echo $user_country; ?>" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label-lg"> Contact </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="admin_contact" value="<?php echo $user_contact; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label-lg"> Job </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="admin_job" value="<?php echo $user_job; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label-lg"> About </label>
                            <div class="col-md-6">
                                <textarea name="admin_about" class="form-control"><?php echo $user_about; ?></textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                        <label for="" class="col-md-3 col-form-label-lg"></label>
                            <div class="col-md-6">
                                <input type="submit"  value="Update User" class="btn btn-primary form-control" name="update">
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

if(isset($_POST['update'])) {

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
    
    $update_user = "update admins set admin_name='$user_name',admin_email='$user_email',admin_pass='$user_pass',admin_country='$user_country',admin_contact='$user_contact',admin_job='$user_job',
    admin_image='$user_image',admin_about='$user_about' where admin_id='$user_id'";

    $run_user= mysqli_query($con,$update_user);

    if($run_user) {
        echo "<script>alert('USER ACCOUNT has been UPDATED Successfully')</script>";
        echo "<script>window.open('login.php','_self')</script>";

        session_destroy();
    }
    else{
        echo "<script>alert('USER ACCOUNT UPDATE  is Unsuccessfull❌❌❌')</script>";
    }

}

?>

<?php } ?>

