<title>Scanned Payments</title>
<?php include 'header/head.php';?>
   <?php include 'sidebar/sidebar_menu.php';?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
            
              <!-- /.card-header -->
              <div class="card-header">
                <h3 class="card-title" style="float: right;"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-overlay">
                  <!-- Scanned Documents -->
                </button></h3>
                <?php include 'modal/addterm_modal.php';?>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Order No.</th>
                    <th>Date</th>
                    <th>Customer FullName</th>
                    <th>Status</th>
                    <th>View</th>
                    <!-- <th>Download</th> -->
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                       include('include/access/connector.php');
                       $query0=mysqli_query($con,"SELECT *,DATE(a.order_date) FROM t_order_details as a
                       LEFT JOIN t_attachments as b on a.order_guest_id = b.att_guest_id
                       LEFT JOIN t_customers as c on a.order_customer_id = c.customer_id
                       ORDER BY a.order_id desc")or die(mysqli_error($con));
                        while($row=mysqli_fetch_array($query0)){
                          $id = $row['order_id'];
                          $att_path = $row['att_path'];
                          $image_path = '';
                          if(empty($att_path)){
                            $disabled = "disabled";
                          }else{
                         
                            $disabled = "";
                          }
                      ?>
                          
                      
                      <tr>
                        <td><?php echo $row['order_id'];?></td>
                        <td><?php echo $row['order_date'];?></td>
                        <td><?php echo $row['customer_fname']. " ".$row['customer_lname'];?></td>
                        <td><?php echo $row['order_payment_status'];?></td>
                        <td class="text-center">
                          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-edit<?php echo $id;?>"><i class = "fa fa-eye"></i></button>
                        <a href="download.php?image=<?php echo "https://timbervalleyph.com/customer/"."".$row['att_path'];?>"><button type="button" <?php echo $disabled;?> id="dload" name = "dload"class="btn btn-success btn-sm"><i class="fa fa-download"></i></button></a>
                      </td>
                     
                        <!-- <td></td> -->
                        <?php include 'modal/att_modal.php';?>
                        
                        
                         
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
      <strong>Copyright &copy; 2021 <a href="#">Timber Valley PH</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 0.1
      </div>
  </footer>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>



<script src="../Employee/plugins/jquery/jquery.min.js"></script>
<script src="../Employee/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../Employee/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../Employee/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../Employee/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../Employee/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

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
