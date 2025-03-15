  <?php
   $active='Home';    
   include("includes/header.php");
  
  ?>
      <!----------------Slider Image------------>
  <div class="container" id="slider">
    <div class="row">
      <div class="col-md-12">
         <div id="mycarousel" class="carousel slide" data-ride="carousel">
           <div class="carousel-inner">
              <?php
                
                $get_slides = "select * from slider LIMIT 0,1";
                $run_slides = mysqli_query($con,$get_slides);
                while($row_slides=mysqli_fetch_array($run_slides)){
                  $slide_name =$row_slides['slide_name'];
                  $slide_image =$row_slides['slide_image'];
                  $slide_url =$row_slides['slide_url'];
                  echo "
                    <div class ='carousel-item active'>

                     <a href='$slide_url'>
                      <img src='admin_area/slides_images/$slide_image'>
                     </a> 

                    </div>
                  ";
                }

                $get_slides = "select * from slider LIMIT 1,4";
                $run_slides = mysqli_query($con,$get_slides);
                while($row_slides=mysqli_fetch_array($run_slides)){
                  $slide_name =$row_slides['slide_name'];
                  $slide_image =$row_slides['slide_image'];
                  $slide_url =$row_slides['slide_url'];
                  echo "
                    <div class ='carousel-item'>

                     <a href='$slide_url'>
                      <img src='admin_area/slides_images/$slide_image'>
                     </a> 

                    </div>
                  ";
                }

              ?>
            </div>
            <ol class="carousel-indicators">
                <li data-target="#mycarousel" data-slide-to="0" class="active"></li>
                <li data-target="#mycarousel" data-slide-to="1"></li>
                <li data-target="#mycarousel"data-slide-to="2"></li>
                <li data-target="#mycarousel" data-slide-to="3"></li>
                <li data-target="#mycarousel" data-slide-to="4"></li>
            </ol>
            <a class="carousel-control-prev" href="#mycarousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon bg-primary" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#mycarousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon bg-primary" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
         </div>
      </div>
    </div>
  </div>

  <div id="advantages">
     <div class="container">
       <div class="row">

        <?php

          $get_boxes = "select * from boxes_section";

          $run_boxes = mysqli_query($con,$get_boxes);

          while($run_boxes_section = mysqli_fetch_array($run_boxes)) {
            
             $box_id = $run_boxes_section['box_id'];

             $box_title = $run_boxes_section['box_title'];

             $box_desc = $run_boxes_section['box_desc'];
         
        ?>
        
         <div class="col-sm-4">
           <div class="box same-height">
             <div class="icon">
                <i class="fa fa-heart"></i>
             </div>
             <h3><a href="#"><?php echo $box_title; ?></a></h3>
             <p><?php echo $box_desc; ?>.</p>
           </div>
         </div>

        <?php  }  ?>

       </div>
     </div>
  </div>

  <div id="hot">
    <div class="box">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2>
              Our Latest Products
            </h2>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="content" class="container">
    <div class="row">
       <?php
         getPro();  

       ?>
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