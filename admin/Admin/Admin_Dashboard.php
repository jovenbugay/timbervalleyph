<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;


?>
   <?php include 'header/head.php';?>
   <?php include 'sidebar/sidebar_menu.php';?>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><i class="fa fa-users"></i></span>
                                 <?php                             
                                   include('include/access/connector.php');                              
                                       $query0=mysqli_query($con,"select * FROM t_users where access='2'")or die(mysqli_error());
                                       $row0=mysqli_num_rows($query0);

                                    ?> 
                                     
                                <div class="info-box-content">
                                    <span class="info-box-text">Employee</span>
                                    <span class="info-box-number"><?php echo $row0;?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-handshake"></i></span>
                                 <?php                             
                                   include('include/access/connector.php');                              
                                    //    $query1 = $phdb->query("select COUNT(*) as products FROM t_products")or die(mysqli_error($phdb));
                                    //    $row1 = $query1->fetch_array();
                                
            
                                    $query1=mysqli_query($con,"select *  FROM t_products")or die(mysqli_error());
                                   $row1=mysqli_num_rows($query1);
                ?>
             
                                <div  class="info-box-content  ">
                                <a href="t_productlist.php">
                                    <span class="info-box-text">Products</span>
                                    <span class="info-box-number"><?php echo $row1;?></span>
                                    </a>
                                </div>
                           
                            </div>
                         
                        </div>
                        <div class="clearfix hidden-md-up"></div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-success elevation-1"><i class="fa fa-code-branch"></i></span>
                                 <?php                             
                                   include('include/access/connector.php');                                       
                                    $query2=mysqli_query($con,"select * FROM t_customers")or die(mysqli_error());
                                    $row2=mysqli_num_rows($query2);
                                    ?> 
                                      
                                <div class="info-box-content">
                                    <span class="info-box-text">Members</span>
                                    <span class="info-box-number"><?php echo $row2;?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-universal-access"></i></span>
                                 <?php                             
                                   include('include/access/connector.php');                              
                                 $query3=mysqli_query($con,"select * FROM t_users where access = '1'")or die(mysqli_error());
                                       $row3=mysqli_num_rows($query3);

                                    ?> 
                                     
                                <div class="info-box-content">
                                    <span class="info-box-text">Admin Account</span>
                                    <span class="info-box-number"><?php echo $row3;?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </section>

             <!-- Graph Dashboard -->
             <!-- <div class="col-lg-6">
            <div class="card">
            
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Sales</h3>
                  <a href="javascript:void(0);">View Report</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">$18,230.00</span>
                    <span>Sales Over Time</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 33.1%
                    </span>
                    <span class="text-muted">Since last month</span>
                  </p>
                </div>

                <div class="position-relative mb-4">
                  <canvas id="sales-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This year
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Last year
                  </span>
                </div>
              </div>
            </div> -->
            <!-- End of Graph Dashboard  -->
       





         

        <footer class="main-footer">
            <strong>Copyright &copy; 2021 <a href="#">Timber Valley</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 0.1
            </div>
        </footer>
      </div>

        <script src="../Employee/plugins/jquery/jquery.min.js"></script>
        <script src="../Employee/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../Employee/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <script src="dist/js/adminlte.js"></script>
        <script src="dist/js/demo.js"></script>


        <script src="../Employee/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
        <script src="../Employee/plugins/raphael/raphael.min.js"></script>
        <script src="../Employee/plugins/jquery-mapael/jquery.mapael.min.js"></script>
        <script src="../Employee/plugins/jquery-mapael/maps/usa_states.min.js"></script>
        <script src="../Employee/plugins/chart.js/Chart.min.js"></script>
        <script src="dist/js/pages/dashboard2.js"></script>


        
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="dist/js/demo.js"></script>
<script src="dist/js/pages/dashboard3.js"></script>
</body>

</html>