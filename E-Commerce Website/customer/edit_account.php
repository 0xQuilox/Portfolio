<?php

  $customer_session = $_SESSION['customer_email'];

  $get_customer = "select * from customers where customer_email = '$customer_session'";

  $run_customer = mysqli_query($con,$get_customer);

  $row_customer = mysqli_fetch_array($run_customer);

  $customer_id = $row_customer['customer_id'];

  $customer_name = $row_customer['customer_name'];

  $customer_email = $row_customer['customer_email'];

  $customer_country = $row_customer['customer_country'];

  $customer_city = $row_customer['customer_cty'];

  $customer_contact = $row_customer['customer_contact'];

  $customer_address = $row_customer['customer_address'];

  $customer_image = $row_customer['customer_image'];

?>

<h1 class="text-center">Edit Your Account</h1>

<form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
      <label for=""> Customer Name: </label>
      <input type="text" class="form-control" name="c_name" value="<?php echo $customer_name; ?>" required>
  </div>

  <div class="form-group">
      <label for=""> Customer Email: </label>
      <input type="email" class="form-control" name="c_email" value="<?php echo $customer_email; ?>" required>
  </div>

  <div class="form-group">
      <label for=""> Customer Country: </label>
      <input type="text" class="form-control" name="c_country" value="<?php echo $customer_country; ?>" required>
  </div>

  <div class="form-group">
      <label for=""> Customer City: </label>
      <input type="text" class="form-control" name="c_city" value="<?php echo $customer_city; ?>" required>
  </div>

  <div class="form-group">
      <label for=""> Customer Contact: </label>
      <input type="text" class="form-control" name="c_contact" value="<?php echo $customer_contact; ?>" required>
  </div>

  <div class="form-group">
      <label for=""> Customer Address: </label>
      <input type="text" class="form-control" name="c_address" value="<?php echo $customer_address; ?>" required>
  </div>

  <div class="form-group">
      <label for=""> Customer Image: </label>
      <input type="file" class="form-control" name="c_image" >
      <img src="customer_images/<?php echo $customer_image; ?>" alt="customer image" class="img-fluid">
  </div>

  <div class="text-center">
    <button type="submit" name="update" class="btn btn-primary">
        <i class="fa fa-user-md"></i> Update Now
    </button> 
  </div> 

</form>

<?php  

  if(isset($_POST['update'])) {

    $update_id = $customer_id;

    $c_name = $_POST['c_name'];

    $c_email = $_POST['c_email'];

    $c_country = $_POST['c_country'];

    $c_city = $_POST['c_city'];

    $c_address = $_POST['c_address'];

    $c_contact = $_POST['c_contact'];

    $c_image = $_FILES['c_image'];

    $c_image_tmp = $_FILES['c_image']['tmp_name'];

    move_uploaded_file ($c_image_tmp,"customer_images/$c_image");

    $update_customer = "update customers set
    customer_name='$c_name',customer_email='$c_email',customer_country='$c_country',customer_cty='$c_city',customer_address='$c_address',customer_contact='$c_contact',customer_image='$c_image' where
    customer_id='$update_id'";

    $run_customer = mysqli_query($con,$update_customer);
    
    if($run_customer) {

        echo "<script> alert('Your account has been edited, to complete the process, Please Re-login') </script>";

        echo "<script> window.open('logout.php','_self') </script>";
    }
}

?>