  <?php
   $active='Shop';
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
                        Shop
                    </li>
                </ol>
              </div>

              <div class="col-md-3">
                <?php

                include("includes/sidebar.php");

                ?>
              </div>
               
              <div class="col-md-9">        
                  <?php 

                      if (!isset($_GET['p_cat'])) {

                          if (!isset($_GET['cat'])) {

                                echo "
                                <div class='box'>
                                    <h1>Shop</h1>
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur 
                                        adipisicing elit. Repellendus, cum? Quam dolore 
                                        at quaerat sapiente.
                                    </p>
                                </div>

                                ";     
                            }

                        }

                      ?>  

                  <div class="row">
                      <?php
                          if (!isset($_GET['p_cat'])) {

                             if (!isset($_GET['cat'])) {

                                $per_page = 6;

                                if(isset($_GET['page'])) {

                                    $page = $_GET['page'];
                                    
                                }else{
                                    $page = 1;

                                }
                                $start_from = ($page-1) * $per_page;

                                $get_products = "select * from products order by 1 DESC LIMIT $start_from,$per_page";

                                $run_products = mysqli_query($con,$get_products);

                                while ($row_products = mysqli_fetch_array($run_products)) {

                                    $pro_id = $row_products['product_id'];

                                    $pro_title = $row_products['product_title'];

                                    $pro_price = $row_products['product_price'];

                                    $pro_img1 = $row_products['product_img1'];

                                    echo "
                                    
                                     <div class='col-sm-6 col-md-4 center-responsive'>
                                        
                                        <div class='product'>

                                           <a href='details.php?pro_id=$pro_id'> 
                                           
                                             <img src='admin_area/product_images/$pro_img1' class='img-fluid'>

                                           </a>

                                           <div class='text'>
                                           
                                             <h3>
                                               
                                             <a href='details.php?pro_id=$pro_id'> $pro_title </a>
                                                
                                             </h3>

                                             <p class='price'>
                                                $ $pro_price
                                            </p>

                                            <p class='button'>
                                                <a  class='btn btn-light' href='details.php?pro_id=$pro_id'>
                                                View Details
                                                </a>

                                                <a  class='btn btn-primary' href='details.php?pro_id=$pro_id'>
                                                <i class='fa fa-shopping-cart'></i> Add Cart
                                                </a>
                                            </p>

                                           </div>
                                           
                                        </div>

                                     </div>
                                    
                                    
                                    ";
                                }

                      ?>      
                  </div>
                       <center>
                          <ul class="pagination">
                              <?php
                              $query = "select * from products";

                              $result = mysqli_query($con,$query);

                              $total_records = mysqli_num_rows($result);

                              $total_pages = ceil($total_records / $per_page);

                              echo "
                              
                              <li class='page-item'>
                              
                                 <a href='shop.php?page=1' class='page-link'>".'First Page'."</a>
                              
                              </li>
                              
                              
                              ";
                              for ($i=1; $i <= $total_pages ; $i++) { 

                                echo "
                              
                                <li class='page-item'>
                                
                                  <a href='shop.php?page=".$i."' class='page-link'> ".$i." </a>
                                
                                </li>
                                
                                
                                "; 
                                  
                              };
                              echo "
                              
                              <li class='page-item'>
                              
                                 <a href='shop.php?page=$total_pages' class='page-link'>".'Last Page'."</a>
                              
                              </li>
                              
                              
                              ";

                                       
                                   }
                                }     
                                   

                              ?>                            
                          </ul>
                       </center>

                       <?php 

                          getpcatpro();
                       
                       ?>
 
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