<?php

   if(!isset($_SESSION['admin_email'])) {

    echo "<script> window.open('login.php','_self') </script>";
   }
   else{

?>
<nav class="navbar navbar-inverse fixed-top navbar-dark bg-dark" id="first-nav">
    <div class="navbar-header">
    
        <button class="navbar-toggler mr-2" id="basttoggle" type="button" data-toggle="collapse" data-target=".navbar-ex1-collapse">

            <span class="navbar-toggler-icon"></span>
            
        </button>
        
        <a href="index.php?dashboard" class="navbar-brand">Admin Area</a>

    </div>
    <ul class="nav navbar-right top-nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
               <i class="fa fa-user"></i> <?php echo $admin_name; ?>
            </a>
            <ul class="dropdown-menu">
              <li>
                <a class="nav-link" href="index.php?user_profile=<?php echo $admin_id; ?>">
                   <i class="fa fa-fw fa-user"></i> Profile
                </a>
              </li>

               <li>
                 <a class="nav-link" href="index.php?view_products">
                    <i class="fa fa-fw fa-envelope"></i> Products
                    <span class="badge"><?php echo $count_products; ?></span>
                 </a>
               </li>
                
                <li>
                  <a class="nav-link" href="index.php?view_customers">
                    <i class="fa fa-fw fa-users"></i> Customer
                    <span class="badge"><?php echo $count_customers; ?></span>
                  </a>
                </li>
                
                <div class="dropdown-divider"></div>
                
                <li>
                  <a class="nav-link" href="logout.php">
                    <i class="fa fa-fw fa-power-off"></i> Log Out
                  </a>
                </li>
                
            </ul>
        </li>
    </ul>
    <div class=" navbar-collapse navbar-ex1-collapse">
        <ul class="nav side-nav" id="side-nav">
            <li>
                <a class="nav-link" href="index.php?dashboard">
                  <i class="fa fa-fw fa-dashboard"></i> Dashboard
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" data-target="#products">
                  <i class="fa fa-fw fa-tag"></i> Products
                </a>
                <ul class="dropdown-menu">
                  <a class="dropdown-item" href="index.php?insert_product"> Insert Product </a>
                  <a class="dropdown-item" href="index.php?view_products"> View Products </a>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" data-target="#products">
                  <i class="fa fa-fw fa-edit"></i> Products Categories
                </a>
                <ul class="dropdown-menu">
                  <a class="dropdown-item" href="index.php?insert_p_cat"> Insert Products category </a>
                  <a class="dropdown-item" href="index.php?view_p_cats"> View Products Categories </a>
                </ul>
            </li>

            <li>
                <a  class="nav-link" href="index.php?view_customers">
                  <i class="fa fa-fw fa-users"></i> View Customers
                </a>
            </li>

            <li>
                <a  class="nav-link" href="index.php?view_orders">
                  <i class="fa fa-fw fa-book"></i> View Orders
                </a>
            </li>

            <li>
                <a  class="nav-link" href="index.php?view_payments">
                  <i class="fa fa-fw fa-money"></i> View Payments
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" data-target="#products">
                  <i class="fa fa-fw fa-users"></i> Users
                </a>
                <ul class="dropdown-menu">
                  <a class="dropdown-item" href="index.php?insert_user"> Insert User </a>
                  <a class="dropdown-item" href="index.php?view_users"> View Users </a>
                  <a class="dropdown-item" href="index.php?user_profile=<?php echo $admin_id; ?>"> Edit User Profile </a>
                </ul>
            </li>

            <li>
                <a class="nav-link" href="logout.php">
                  <i class="fa fa-fw fa-power-off"></i> Log Out
                </a>
            </li>


        </ul>
    </div>
</nav>
<?php } ?> 