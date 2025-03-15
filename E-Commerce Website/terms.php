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
                        Terms & Conditions | Refund
                    </li>
                </ol>
              </div>
              <div class="col-md-3">
              
                 <div class="box">
                 
                 <ul class="list-group list-group-flush"> 
                    <?php  
                    
                       $get_terms = "select * from terms LIMIT 0,1";

                       $run_terms = mysqli_query($con,$get_terms);

                       while($row_terms = mysqli_fetch_array($run_terms)) {

                          $term_title = $row_terms['term_title'];
                          $term_link = $row_terms['term_link'];

                    ?>

                    <li class="list-group-item active">

                       <a href="#<?php echo $term_link; ?>" class="text-white">
                       
                           <?php echo $term_title; ?>

                       </a>

                    </li>
                    
                    <?php } ?>

                    <?php 
                    
                      $count_terms = "select * from terms";

                      $run_count_terms = mysqli_query($con,$count_terms);

                      $count = mysqli_num_rows($run_count_terms);

                      $get_terms = "select * from terms LIMIT 1,$count";

                      $run_terms = mysqli_query($con,$get_terms);

                      while($row_terms = mysqli_fetch_array($run_terms)) {

                        $term_title = $row_terms['term_title'];
                        $term_link = $row_terms['term_link'];

                    ?>

                     <li class="list-group-item">

                      <a href="#<?php echo $term_link; ?>" class="list-group-item-action text-primary">

                          <?php echo $term_title; ?>

                      </a>

                    </li>

                    <?php } ?>

                </ul>

                 </div>

              </div>
              <div class="col-md-9">
                
                   <div class="box">

                     <div class="tab-content">
                     
                      <?php 
                      
                        $get_terms = "select * from terms LIMIT 0,1";

                        $run_terms = mysqli_query($con,$get_terms);

                        while($row_terms = mysqli_fetch_array($run_terms)) {

                           $term_title = $row_terms['term_title'];

                           $term_desc = $row_terms['term_desc'];

                           $term_link = $row_terms['term_link'];

                      ?>
                      
                      <div id="<?php echo $term_link; ?>">
                      
                        <h1 class="tabTitle"> <?php echo $term_title; ?> </h1>

                        <p class="tabDesc"> <?php echo $term_desc; ?> </p>
                      
                      </div>
                      
                      <?php } ?>

                      <?php 
                    
                      $count_terms = "select * from terms";

                      $run_count_terms = mysqli_query($con,$count_terms);

                      $count = mysqli_num_rows($run_count_terms);

                      $get_terms = "select * from terms LIMIT 1,$count";

                      $run_terms = mysqli_query($con,$get_terms);

                      while($row_terms = mysqli_fetch_array($run_terms)) {

                        $term_title = $row_terms['term_title'];

                        $term_desc = $row_terms['term_desc'];

                        $term_link = $row_terms['term_link'];

                    ?>
                    <div id="<?php echo $term_link; ?>" >
                      
                      <h1 class="tabTitle"> <?php echo $term_title; ?> </h1>

                      <p class="tabDesc"> <?php echo $term_desc; ?> </p>
                    
                    </div>

                    <?php } ?>
                     
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
