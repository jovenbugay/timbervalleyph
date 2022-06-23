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
              <h3 class="card-title" style="float: left;">Collection</h3>
                <h3 class="card-title" style="float: right;"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-overlay">
                  Add Collection
                </button></h3>
                <?php include 'modal/addbilling_modal.php';?>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Collection No.</th>
                    <th>Date</th>
                    <th>Customer Name</th>
                    <th>Order No.</th>
                    <th>Payment</th>
                    <th>Balance</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      // where b.order_payment_status='UNPAID'
                       include('include/access/connector.php');
                       $query0=mysqli_query($con,"SELECT * FROM t_billing as a 
                       LEFT join t_order_details as b on a.order_no = b.order_id
                      left join t_customers as c on b.order_customer_id = c.customer_id
                      where a.deleted = '0' ")or die(mysqli_error());
                        while($row=mysqli_fetch_array($query0)){
                          $id = $row['order_id'];
                          
                      ?>
                          
                      
                      <tr>
                        <td><?php echo $row['billing_no'];?></td>
                        <td><?php echo $row['billing_date'];?></td>
                        <td><?php echo $row['customer_fname']. " " .$row['customer_lname'];?></td>
                        <td><?php echo $row['order_no'];?></td>
                        <td><?php echo number_format($row['b_pay_amt'],2);?></td>
                        <td><?php echo number_format($row['b_balance'],2);?></td>
                        <td><?php echo number_format($row['b_amount'],2);?></td>
                        <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-edit<?php echo $id;?>">Edit</button> | <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete<?php echo $id;?>">Delete</button></td>
                         <?php include 'modal/editbilling_modal.php';?>
                         <?php include 'modal/deletebilling_modal.php';?>
                         
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

<script src="../Superadmin_Dashboard/plugins/jquery/jquery.min.js"></script>
<script src="../Superadmin_Dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../Superadmin_Dashboard/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../Superadmin_Dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../Superadmin_Dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../Superadmin_Dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
