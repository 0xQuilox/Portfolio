<?php

if(!isset($_SESSION['admin_email'])) {

    echo "<script> window.open('login.php','_self') </script>";
   }
   else{

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/style.css"> -->
    <title>Insert Product</title>
  </head>
  <body>
  <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12 mt-5">
               <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Dashboard / Insert Products
                    </li>
                </ol>
         </div>
      </div>

      <div class="row">  
         <div class="col-lg-12">
             <div class="card">
                 <div class="card-body">
                     <h3 class="card-header">
                         <i class="fa fa-money fa-fw"></i>Insert Product
                     </h3>
                     <form action="" method="POST"  enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label-lg"> Product Title</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="product_title" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label-lg"> Product Category</label>
                            <div class="col-md-6">
                                <select name="product_cat" class="form-control">
                                    <option>Select a Category Product</option>
                                    <?php
                                    $get_p_cats = "select * from product_categories";
                                    $run_p_cats = mysqli_query($con,$get_p_cats);

                                    while($row_p_cats = mysqli_fetch_array($run_p_cats)) {

                                        $p_cat_id = $row_p_cats['p_cat_id'];
                                        $p_cat_title = $row_p_cats['p_cat_title'];
                                        
                                        echo "
                                          
                                         <option value='$p_cat_id'> $p_cat_title </option>

                                        ";

                                    }

                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label-lg"> Category</label>
                            <div class="col-md-6">
                                <select name="cat" class="form-control">
                                    <option>Select a Category</option>
                                    <?php
                                    $get_cat = "select * from categories";
                                    $run_cat = mysqli_query($con,$get_cat);

                                    while($row_cat = mysqli_fetch_array($run_cat)) {

                                        $cat_id = $row_cat['cat_id'];
                                        $cat_title = $row_cat['cat_title'];
                                        
                                        echo "
                                          
                                         <option value='$cat_id'> $cat_title </option>

                                        ";

                                    }

                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label-lg"> Product Image 1</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="product_img1" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label-lg"> Product Image 2</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="product_img2" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label-lg"> Product Image 3</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="product_img3">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label-lg"> Product Price</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="product_price" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label-lg"> Product keywords</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="product_keywords" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label-lg"> Product Desc</label>
                            <div class="col-md-6">
                                <textarea name="product_desc" cols="19" rows="6" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="" class="col-md-3 col-form-label-lg"></label>
                            <div class="col-md-6">
                                <input type="submit"  value="Insert Product" class="btn btn-primary form-control" name="submit">
                            </div>
                        </div>
                    
                    </form>
                 </div>
             </div>
         </div>
       </div>
    </div>
    

    <script src="js/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({selector:'textarea'});</script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script> -->

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>

<?php

if(isset($_POST['submit'])) {

    $product_title = $_POST['product_title'];
    $product_cat = $_POST['product_cat'];
    $cat = $_POST['cat'];
    $product_price = $_POST['product_price'];
    $product_keywords = $_POST['product_keywords'];
    $product_desc = $_POST['product_desc'];

    $product_img1 = $_FILES['product_img1'] ['name'];
    $product_img2 = $_FILES['product_img2'] ['name'];
    $product_img3 = $_FILES['product_img3'] ['name'];

    $temp_name1 = $_FILES['product_img1'] ['tmp_name'];
    $temp_name2 = $_FILES['product_img2'] ['tmp_name'];
    $temp_name3 = $_FILES['product_img3'] ['tmp_name'];

    move_uploaded_file($temp_name1,"product_images/$product_img1");
    move_uploaded_file($temp_name2,"product_images/$product_img2");
    move_uploaded_file($temp_name3,"product_images/$product_img3");

    $insert_product = "insert into products(p_cat_id,cat_id,date,product_title,product_img1,product_img2,product_img3,product_price,product_keywords,product_desc) values
    ('$product_cat','$cat',NOW(),'$product_title','$product_img1','$product_img2','$product_img3','$product_price','$product_keywords','$product_desc')";

    $run_product = mysqli_query($con,$insert_product);

    if($run_product) {
        echo "<script>alert('Product has been inserted successfully')</script>";
        echo "<script>window.open('index.php?view_products','_self')</script>";
    }
    else{
        echo "<script>alert('Product insert Unsuccessfull❌❌❌')</script>";
    }

}

?>

<?php } ?>
