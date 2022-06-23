<?php 
error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting(E_ALL); // Error engine - always E_ALL!
ini_set('ignore_repeated_errors', TRUE); // always TRUE
ini_set('display_errors', TRUE); // Error display - FALSE only in production environment or real server. TRUE in development environment
ini_set('log_errors', TRUE); // Error logging engine
ini_set('error_log', 'errors.log'); // Logging file path
ini_set('log_errors_max_len', 1024); // Logging file size
session_start();
include('../db/connect.php');
$customer_id = $_SESSION['customer_id']; 


if(isset($_POST['btncancel'])){
  $order_id = $_POST['order_id'];
  $result = mysqli_query($con,"UPDATE t_order_details SET order_status = '9' where order_id = '$order_id'  ");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Order Status - Timber Valley PH</title>
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <style>
    .imgfilter{
      width:100% !important;
      height:200px !important;
    }
    @media(max-width:720px){
      .imgfilter{
        width:100% !important;
        height:150px !important;
      }
      .card-list{
        margin:0 !important;
      }
    }

    .product-info{
       overflow: hidden;
       white-space: nowrap;
       text-overflow: ellipsis;
    }

    .card-list{
      margin-right:70px;
      margin-left:70px;
    }
    
    /* .card{
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.50);
    } */

    .btn-primary{
      background-color: #004d38 !important;
      border:0 !important;
    }

    .order-receipt{
        border:1px solid black;
        
    }

    .table th, td{
        width:25% !important;
        white-space: nowrap !important;
    }

    .table td{
        padding:10px !important;
    }

    .table2 td{
        padding:5px !important;
    }

    .active{
        background-color: #218838 !important;
    }

    .active-label{
      color:#218838;
    }

    
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php include('section/header.php'); ?>
  <?php include('section/sidebar.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper mt-5">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1>Home</h1> -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <!-- <div class="card-header">
     
    
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div> -->
        <div class="card-body">
            <div class="row d-flex justify-content-center align-content-center">
                <div class="col-lg-12">
                  <?php

                  $result2 = mysqli_query($con,"SELECT * FROM t_order_details where order_customer_id = '$customer_id' AND order_status = '1' OR order_status = '2' OR order_status = '3'");
                  if(mysqli_num_rows($result2) == 0){
                    echo '<h3 class="text-center">No Orders Yet</h3>';
                  }
                  else {
                  $result = mysqli_query($con,"SELECT * FROM t_order_details where order_customer_id = '$customer_id'
                  AND order_status = '1' OR order_status = '2' OR order_status = '3' order by order_id desc ");
                  while($row = mysqli_fetch_array($result)){
                    $status = $row['order_status'];
                  ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>Order Status</h4>
                        </div>
                        <div class="card-body">
                           <h3 class="text-center">#<?php echo $row['order_id']; ?></h3>
                           <div class="bs-stepper">
                                <div class="bs-stepper-header" role="tablist">

                                    <!-- your steps here -->
                                    <?php
                                   
                                   if($status == 1 || $status == 2 || $status == 3 || $status == 4){
                                       echo '
                                      <div class="step" data-target="#logins-part">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                                        <span class="bs-stepper-circle active"><i class="fa fa-clock"></i></span>
                                        <span class="bs-stepper-label active-label">Waiting for confirmation</span>
                                    </button>
                                    </div>
                                      
                                      ';
                                    }
                                    ?>
                                    

                                    <div class="line"></div>

                                    <?php
                                    if($status == 1 ){
                                      echo '
                                      <div class="step" data-target="#information-part">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                        <span class="bs-stepper-circle"><i class="fa fa-business-time"></i></span>
                                        <span class="bs-stepper-label" >Processing</span>
                                    </button>
                                    </div>
                                      
                                      ';
                                    }
                                    else if($status == 2 ||   $status == 3 || $status == 4){
                                      echo '
                                      <div class="step" data-target="#information-part">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                        <span class="bs-stepper-circle active"><i class="fa fa-business-time"></i></span>
                                        <span class="bs-stepper-label active-label" >Processing</span>
                                    </button>
                                    </div>

                                      
                                      ';
                                    }

                                    ?>

                                    
                                    <div class="line"></div>

                                    <?php
                                    if($status == 1 || $status == 2 ){
                                      echo '
                                       <div class="step" data-target="#information-part">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                        <span class="bs-stepper-circle"><i class="fa fa-truck"></i></span>
                                        <span class="bs-stepper-label" >In Transit</span>
                                    </button>
                                    </div>
                                      
                                      ';
                                    }
                                    else if($status == 3 || $status == 4){
                                      echo '                                      
                                       <div class="step" data-target="#information-part">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                        <span class="bs-stepper-circle active"><i class="fa fa-truck"></i></span>
                                        <span class="bs-stepper-label active-label" >In Transit</span>
                                    </button>
                                    </div>
                                      ';
                                    }


                                    ?>

                                    <div class="line"></div>

                                                                        <?php
                                    if($status == 1 || $status == 2 || $status == 3){
                                      echo '
                                    <div class="step" data-target="#information-part">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                        <span class="bs-stepper-circle"><i class="fa fa-box"></i></span>
                                        <span class="bs-stepper-label">Completed</span>
                                    </button>
                                    </div>
                                      
                                      ';
                                    }
                                    else if($status == 4){
                                      echo '                                      
                                        <div class="step" data-target="#information-part">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                        <span class="bs-stepper-circle active"><i class="fa fa-box"></i></span>
                                        <span class="bs-stepper-label active-label">Completed</span>
                                    </button>
                                    </div>
                                      ';
                                    }


                                    ?>
                                    
                                   


                                </div>
                                <div class="bs-stepper-content">
                                    <!-- your steps content here -->
                                    <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger"></div>
                                    <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <form method="POST">
                            <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                            <button type="submit" name="btncancel" class="btn btn-danger float-right"><i class="fa fa-times"></i>&ensp;Cancel Order</button>
                            </form>
                        </div>
                    </div>
                  <?php } }?>

                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <!-- <div class="card-footer">
          Footer
        </div> -->
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php include('section/footer.php'); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
