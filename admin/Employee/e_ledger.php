<?php include 'header/head.php';?>
   <?php include 'sidebar/sidebar_menu.php';?>

   <style>
   .ln_solid {
  border-top: 1px solid #e5e5e5;
  color: #ffffff;
  background-color: #ffffff;
  height: 1px;
  margin: 20px 0; }
</style>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-header">
               
                
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Customer Ledger No.</th>
                    <th>Date</th>
                    <th>Customer Name</th>
                    <th>Order No.</th>
                    <th>Total</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                       include('include/access/connector.php');
                      // $result = $phdb->query("SELECT * FROM `t_products`");
                      // // if($result->num_rows === 0) echo'<div class="alert alert-warning" role="alert">No Record Found!!!</div>';
                      //  while ($row = $result->fetch_array()){

                        $query0=mysqli_query($con,"SELECT * FROM t_products")or die(mysqli_error());
                        while($row0=mysqli_fetch_array($query0)){
                          $id=$row0['product_id'];
                          
                      ?>
                      <tr>
                        <!-- <td><img style="width:80px;height:60px" src="../dist/uploads/<?php echo $row0['product_img'];?>"</td> -->
                        <td>Test</td>
                        <!-- <td><?php //echo $row0['product_code'];?></td> -->
                        <td>Test</td>
                        <td>Test</td>
                        <td>Test</td>
                        <td>Test</td>
                        <td>Test</td>
                    
                      </tr>

                     <?php  } ?>
                  </tbody>

                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <footer class="main-footer">
      <strong>Copyright &copy; 2021 <a href="#">Timber Valley</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 0.1
      </div>
  </footer>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>

<script src="../Admin_Dashboard/plugins/jquery/jquery.min.js"></script>
<script src="../Admin_Dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../Admin_Dashboard/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../Admin_Dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../Admin_Dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../Admin_Dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
