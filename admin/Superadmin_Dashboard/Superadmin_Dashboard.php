<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;


?>
<style type="text/css">


#chart-container {
    width: 100%;
    height: auto;
}
</style>
<title>Dashboard</title>
   <?php include 'header/head.php';?>
   <?php include 'sidebar/sidebar_menu.php';?>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Employee -->
                        <div class="col-lg-3 col-6">
                                    <?php                             
                                   include('include/access/connector.php');                              
                                       $query0=mysqli_query($con,"select * FROM t_users where access='2'")or die(mysqli_error());
                                       $row0=mysqli_num_rows($query0);
                                    ?> 
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?php echo $row0;?></sup></h3>
                                        <p>Employee</p>
                                </div>
                                    <div class="icon">
                                        <i class="ion ion-android-person"></i>
                                    </div>
                                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
          <!-- End of Employee -->


                        <!-- Product -->
                        <div class="col-lg-3 col-6">
                            <?php                             
                                include('include/access/connector.php');                              
                                $query1=mysqli_query($con,"select *  FROM t_products")or die(mysqli_error());
                                $row1=mysqli_num_rows($query1);
                                    ?>
                                <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?php echo $row1;?></sup></h3>

                                    <p>Products</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="t_productlist.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- End of Product -->


                            <!-- Members -->
                            <div class="col-lg-3 col-6">
                            <?php                             
                                   include('include/access/connector.php');                                       
                                    $query2=mysqli_query($con,"select * FROM t_customers")or die(mysqli_error());
                                    $row2=mysqli_num_rows($query2);
                                    ?> 
                            
                                <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?php echo $row2;?></h3>

                                    <p>Members</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- End of Members -->


                            <!-- Admin Account -->
                            <div class="col-lg-3 col-6">
                            <?php                             
                                   include('include/access/connector.php');                              
                                 $query3=mysqli_query($con,"select * FROM t_users where access = '1'")or die(mysqli_error());
                                       $row3=mysqli_num_rows($query3);

                                    ?> 
                                <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3><?php echo $row3;?></h3>

                                    <p>Admin Account</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- End of Admin Account -->
                        
                    </div>
                </div>
                
             </section>




             
             <script type="text/javascript" src="js/jquery.min.js"></script>
              <script type="text/javascript" src="js/Chart.min.js"></script>
           
              <div class="row">
                        <!-- Graph -->
                        <div class="col-lg-8">
                            <div class="card-body">
                                <div id="chart-container">
                                    <canvas id="graphCanvas"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- End of Graph -->
               
                        <div class="col-lg-4">
                            <div class="card-body">
                                <div class="filter">
                                    <h5><b>Filter</b></h5>
                                    <hr>
                                    <form method = "POST">
                                    <input type="date" name="datefrom" id="datefrom" class="form-control" required="" value=<?php echo date('Y-m-d'); ?>> 
                                    <br>
                                    <input type="date" name="dateto" id="dateto" class="form-control" required="" value=<?php echo date('Y-m-d'); ?>> 
                                    <br>
                                    <button type="submit" class="btn btn-primary" style = "float:right" name="graphprocess">Process</button>
                                    </form>
                                </div>
                            </div>
                            
                                    <div class="col-lg-12">
                                        <div class="card-body">
                                            <h5><b>Filter</b></h5>
                                            <hr>
                                        </div>
                                    </div>
                        </div>
        



                    </div>






<?php
              if(isset($_POST['graphprocess']))
 {

 	$datefrom = $_POST['datefrom'];
 	$dateto = $_POST['dateto'];
 }
?>

    <script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("data.php?datefrom=<?php echo $datefrom;?>&dateto=<?php echo $dateto;?>",
                function (data)
                {
                    console.log(data);
                     var name = [];
                    var marks = [];

                    for (var i in data) {
                        name.push(data[i].order_date);
                        marks.push(data[i].total_price);
                    }

                    var chartdata = {
                        labels: name,
                        datasets: [
                            {
                                label: 'Sales',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#000000',
                                hoverBorderColor: '#FFFFFF',
                                data: marks
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });
            }
        }
        </script>



         

        <footer class="main-footer">
            <strong>Copyright &copy; 2021 <a href="#">Timber Valley</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 0.1
            </div>
        </footer>
      <!-- </div> -->

        <script src="../Superadmin_Dashboard/plugins/jquery/jquery.min.js"></script>
        <script src="../Superadmin_Dashboard/plugins/chart.js/Chart.min.js"></script>
        <script src="../Superadmin_Dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../Superadmin_Dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        
        
        <script src="dist/js/adminlte.js"></script>
        <script src="dist/js/demo.js"></script>




        
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<!-- <script src="dist/js/adminlte.js"></script> -->

<!-- OPTIONAL SCRIPTS -->

<script src="dist/js/demo.js"></script>
<script src="dist/js/pages/dashboard3.js"></script>
</body>

</html>

