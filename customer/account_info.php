<?php 
error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting(E_ALL); // Error engine - always E_ALL!
ini_set('ignore_repeated_errors', TRUE); // always TRUE
ini_set('display_errors', FALSE); // Error display - FALSE only in production environment or real server. TRUE in development environment
ini_set('log_errors', TRUE); // Error logging engine
ini_set('error_log', 'errors.log'); // Logging file path
ini_set('log_errors_max_len', 1024); // Logging file size
session_start();
include('../db/connect.php');
$customer_id = $_SESSION['customer_id']; 

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Account Information - Timber Valley PH</title>
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
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Account Information</h4>
                        </div>
                        <div class="card-body">
                        <?php
                          if(isset($_POST['btnsave'])){
                            $fname2 = $_POST['fname'];
                            $lname2 = $_POST['lname'];
                            $email2 = $_POST['email'];
                            $mobile2 = $_POST['mobile'];
                            $username2 = $_POST['username'];
                            $password2 = $_POST['password'];
                            $result2 = mysqli_query($con,"UPDATE t_customers set 
                            customer_fname = '$fname2',
                            customer_lname = '$lname2',
                            customer_mobile = '$mobile2',
                            customer_username = '$username2',
                            customer_email = '$email2',
                            customer_password = '$password2'
                            where customer_id = '$customer_id' 
                            ");

                            echo '
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                              <strong>Account Updated Successfully</strong>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            ';
                          }

                          ?>
                            <form method="POST">
                            <?php
                            $result = mysqli_query($con,"SELECT * FROM t_customers where customer_id = '$customer_id'");
                            while($row = mysqli_fetch_array($result)){
                            $fname = $row['customer_fname'];
                            $lname = $row['customer_lname'];
                            $mobile = $row['customer_mobile'];
                            $username = $row['customer_username'];
                            $email = $row['customer_email'];
                            $password = $row['customer_password'];
                            ?>
                                <div class="row">
                                    <div class="col-lg-6 form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name="fname" value="<?php echo $fname; ?>">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" name="lname" value="<?php echo $lname; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label>Mobile Number</label>
                                        <input type="text" class="form-control" name="mobile" value="<?php echo $mobile; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" value="<?php echo $password; ?>">
                                    </div>
                                </div>
                                <?php } ?>
                            
                        </div>
                        <div class="card-footer ">
                            <button type="submit" class="btn btn-success float-right" name="btnsave">Save Changes</button>
                            </form>
                        </div>
                    </div>
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
