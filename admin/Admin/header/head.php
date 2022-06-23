<?php

  session_start();
  if(empty($_SESSION['id'])):
    header('Location:../index.php');
    endif;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Admin | Dashboard</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../Employee/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../Employee/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
      <!-- daterange picker -->
    <link rel="stylesheet" href="../Employee/plugins/daterangepicker/daterangepicker.css">
     <!-- Select2 -->
  <link rel="stylesheet" href="../Employee/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../Employee/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

      <!-- DataTables -->
  <link rel="stylesheet" href="../Employee/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../Employee/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>


<style>
.pdfobject-container { height: 30rem; border: 1rem solid rgba(0,0,0,.1); }

.sidebar-dark-primary{
background-image: url('../image/timber.jpg') !important;
/* background: green !important; */
}

</style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed body-img "  >
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>


            <ul class="navbar-nav ml-auto">
     
                <!-----User with setting--->
                <?php

                   error_reporting(0);

                   include('include/access/connector.php');

                   $id = trim($_SESSION['id']);
                 

                //    $sql = $phdb->query("SELECT * FROM t_users where id = '$id'") or die (mysqli_error($phdb));

                //    $row = mysqli_fetch_array($sql);
                $query0=mysqli_query($con,"SELECT * FROM t_users where id = '$id'")or die(mysqli_error());
                while($row0=mysqli_fetch_array($query0)){

                   $hr_email = $row0['username'];

                ?>
                <?php } ?>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        </i><b>Welcome!,</b> <?php echo htmlentities($hr_email)?> <i class="fa fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <i class="fa fa-user-cog"></i> Account Setting
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="log_out.php" class="dropdown-item">
                            <i class="fa fa-power-off"></i> Log Out
                        </a>

                </li>
                <!-----End user with setting--->
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="Superadmin_Dashboard.php" class="brand-link">
                <img src="dist/img/logo.jpg" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Timber Valley PH</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo htmlentities($hr_email)?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item has-treeview menu-open">
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="Superadmin_Dashboard.php" class="nav-link active">
                                        <i class="nav-icon fas fa-tachometer-alt"></i>
                                        <!-- <p>Dashboard</p> -->
                                        <p>Dashboard</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                       
                            <a href="t_productlist.php" class="nav-link">
                                <i class="nav-icon fa fa-qrcode"></i>
                               
                                <p>

                                    Product List
                                    <i class="fas fa-angle-right right"></i>
                                 
                                  
                                </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="t_terms.php" class="nav-link">
                                <i class="nav-icon fas fa-code-branch"></i>
                             
                                <p>
                                    Terms
                                    <i class="fas fa-angle-right right"></i>
                                  
                                </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="t_orders.php" class="nav-link">
                                <i class="nav-icon fas fa-handshake"></i>
                                <p>Orders<i class="fas fa-angle-right right"></i></p>
                            </a>
                            <!-- <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="Add_employee.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Order List</p>
                                    </a>
                                </li>
                            </ul> -->
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="t_billing.php" class="nav-link">
                                <i class="nav-icon fas fa-money-bill-alt"></i>
                                <p>
                                    Collection
                                    <i class="fas fa-angle-right right"></i>
                                </p>
                            </a>
                        </li>
                        <!-- <li class="nav-item has-treeview">
                            <a href="t_collection.php" class="nav-link">
                                <i class="nav-icon fas fa-money-check"></i>
                                <p>
                                    Collection
                                    <i class="fas fa-angle-right right"></i>
                                </p>
                            </a>
                        </li> -->

                        <li class="nav-item has-treeview">
                            <a href="t_sales.php" class="nav-link">
                                <i class="nav-icon fas fa-print"></i>
                                <p>
                                    Sales Report
                                    <i class="fas fa-angle-right right"></i>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="t_collection_report.php" class="nav-link">
                                <i class="nav-icon fas fa-money-bill-wave"></i>
                                <p>
                                    Collection Report
                                    <i class="fas fa-angle-right right"></i>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="t_ledger.php" class="nav-link">
                                <i class="nav-icon fas fa-user-check"></i>
                                <p>
                                    Customer Ledger
                                    <i class="fas fa-angle-right right"></i>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="t_accounts_r.php" class="nav-link">
                                <i class="nav-icon fas fa-user-friends"></i>
                                <p>
                                    Accounts Receivable
                                    <i class="fas fa-angle-right right"></i>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="t_users.php" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Manage Users
                                    <i class="fas fa-angle-right right"></i>
                                </p>
                            </a>
                        </li>


                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fab fa-cc-visa"></i>
                                <p>
                                    Scanned Payment
                                    <i class="fas fa-angle-right right"></i>
                                </p>
                            </a>
                        </li>

                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
