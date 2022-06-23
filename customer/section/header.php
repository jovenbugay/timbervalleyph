<style>
.cart-count, .notif-count{
    font-size:10px;
    font-weight:bold;
}


</style>
<?php include('functions/cart_count.php'); ?>
<?php include('functions/notif_count.php'); ?>
<?php
$gid = $_SESSION['guest_id'];
$aid = $_SESSION['customer_id'];
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-shopping-cart"></i>
          <div class="notif-count">
          <span class="badge badge-danger navbar-badge "><?php echo $totalcount; ?></span>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Cart</span>
          <div class="product-table" style="height:200px;overflow:auto;">

          <?php
          $resultcart = mysqli_query($con,"SELECT * FROM t_cart as a LEFT JOIN t_products as b ON a.product_id = b.product_id where a.guest_id = '$gid' order by a.cart_id desc");
          while($rowcart = mysqli_fetch_array($resultcart)){
          ?>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <?php echo $rowcart['product_code']; ?>
            <span class="float-right text-muted text-sm"><?php echo number_format($rowcart['price'],2); ?></span>
            <span class="text-muted" style="font-size:14px;">x<?php echo $rowcart['qty']; ?></span>
          </a>
          <div class="dropdown-divider"></div>
          <?php } ?>
          </div>
          <a href="checkout.php" class="dropdown-item dropdown-footer font-weight-bold"><i class="fa fa-credit-card"></i>&ensp;Checkout</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge notif-count2"><?php echo $totalcount2; ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right bg-light">
          <!-- <span class="dropdown-item dropdown-header">0 Notifications</span> -->
          <div class="dropdown-divider"></div>
          <?php
          $resultn = mysqli_query($con,"SELECT * FROM t_notification as a
          LEFT JOIN t_order_details as b ON a.notif_order_id = b.order_id
          where b.order_customer_id = '$aid' order by notif_id desc
          ");
          while($rown = mysqli_fetch_array($resultn)){
          ?>
          <a href="notification.php" class="dropdown-item">
            <span class="" style="font-size:12px;"><i class="fas fa-bell mr-2"></i><?php echo $rown['notif_message']; ?><br>
              <span class="text-muted"><i class="fas fa-minus mr-2"></i>Order # <?php echo $rown['notif_order_id']; ?></span>
            </span>
            <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
          </a>
<div class="dropdown-divider"></div>
          <?php
          }
          ?>

          
          <a href="notification.php" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
    </ul>
  </nav>