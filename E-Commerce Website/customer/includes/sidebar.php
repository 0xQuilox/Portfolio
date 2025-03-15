<div class="card sidebar-menu mb-2">
    
   <?php

    $customer_session = $_SESSION['customer_email'];

    $get_customer = "select * from customers where customer_email='$customer_session'";

    $run_customer = mysqli_query($con,$get_customer);

    $row_customer = mysqli_fetch_array($run_customer);

    $customer_image = $row_customer['customer_image'];

    $customer_name = $row_customer['customer_name'];

    if (!isset($_SESSION['customer_email'])) {
      
    }
    else{

      echo "
      
         <center>
         
            <img src='customer_images/$customer_image' class='img-fluid'>
         
         </center>
      
      ";
    }

   ?>
   
  <div class="card-body">
    <h5 class='card-title text-center'>
      Name: <?php echo $customer_name; ?>
    </h5>
    <ul class="list-group list-group-flush">
      <li class="list-group-item <?php if(isset($_GET['my_orders'])){ echo "active";} ?>">
         <a href="my_account.php?my_orders" class="list-group-item-action text-dark">
           <i class="fa fa-list"></i> My Orders
         </a>
      </li>

      <li class="list-group-item <?php if(isset($_GET['pay_offline'])){ echo "active";} ?>">
         <a href="my_account.php?pay_offline" class="list-group-item-action text-dark">
           <i class="fa fa-bolt"></i> Pay Offline
         </a>
      </li>

      <li class="list-group-item <?php if(isset($_GET['delete_account'])){ echo "active";} ?>">
         <a href="my_account.php?delete_account" class="list-group-item-action text-dark">
           <i class="fa fa-trash-o"></i> Delete Account
         </a>
      </li>

      <li class="list-group-item">
         <a href="logout.php" class="list-group-item-action text-dark">
           <i class="fa fa-sign-out"></i> Log Out
         </a>
      </li>
      
  </ul>
  </div>

</div>