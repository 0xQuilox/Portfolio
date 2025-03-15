  <?php
   $active='Contact';
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
                        Contact Us
                    </li>
                </ol>
              </div>

              <div class="col-md-9">
                <div class="box">
                  <div class="box-header">
                    <center>
                      <h2>Feel free to Contact Us</h2>

                      <p class="text-muted">
                        If you have any question,feel free  to contact us via our customer service,works <strong>24/7.</strong>
                      </p>
                    </center>
                    <form action="contact.php" method="POST">
                      <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" required>
                      </div>

                      <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" required>
                      </div>

                      <div class="form-group">
                        <label for="">Subject</label>
                        <input type="text" class="form-control" name="subject" required>
                      </div>

                      <div class="form-group">
                        <label for="">Message</label>
                        <textarea name="message" class="form-control"></textarea>
                      </div>

                      <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-primary">
                         <i class="fa fa-user-md"></i> Send Message
                        </button> 
                      </div>
                    </form>

                      <?php  
                      
                        if(isset($_POST['submit'])) {
                          // Admin Receives Message with this
                          
                          $sender_name = $_POST['name'];

                          $sender_email = $_POST['email'];

                          $sender_subject = $_POST['subject'];

                          $sender_message = $_POST['message'];

                          $receiver_email = "bankolediamond10@gmail.com";

                          mail($receiver_email,$sender_name,$sender_subject,$sender_message,$sender_email);

                          // Auto Reply to sender with this

                          $email = $_POST['email'];

                          $subject = "Welcome to my website";

                          $msg = "Thanks for sending us message. ASAP we will reply your message";

                          $from = "bankolediamond10@gmail.com";

                          mail($email,$subject,$msg,$from);

                          echo "<h2 align='center'>Your Message has been sent successfully</h2>";
                           
                        }
                      
                      ?>

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