<title>Customer Ledger</title>
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
             
                        $query0=mysqli_query($con,"SELECT a.order_id,b.customer_fname,b.customer_lname,SUM(c.price * c.qty) as total_price,a.order_date,
                        round(sum(c.price * c.qty - (c.price * c.qty * (d.terms_discount/100))),2) as total_price_discount,a.order_status
                        FROM t_order_details as a 
                        LEFT join t_customers as b 
                        on a.order_customer_id = b.customer_id 
                        left join t_cart as c on c.guest_id = a.order_guest_id
                        left join t_payment_terms as d on a.order_payment_terms = d.terms_id group by a.order_id")or die(mysqli_error());
                        while($row0=mysqli_fetch_array($query0)){
                          $id=$row0['product_id'];
                          
                      ?>
                      <tr>
                        <!-- <td><img style="width:80px;height:60px" src="../dist/uploads/<?php echo $row0['product_img'];?>"</td> -->
                        <td><?php echo $row0['order_date'];?></td>
                        <td><?php echo $row0['customer_fname']. " " .$row0['customer_lname'];?></td>
                        <td><?php echo $row0['order_id'];?></td>
                        <td>&#8369; <?php echo $row0['total_price_discount'];?></td>
                        <td>
                    <?php
                    if($row0['order_status'] == '1'){
                      echo '<h6><span class="badge badge-primary">Pending</span></h6>';
                    }
                    else if($row0['order_status'] == '2'){
                      echo '<h6><span class="badge badge-warning">Processing</span></h6>';
                    }
                    else if($row0['order_status'] == '3'){
                      echo '<h6><span class="badge badge-info">In Transit</span></h6>';
                    }
                    else if($row0['order_status'] == '4'){
                      echo '<h6><span class="badge badge-success">Completed</span></h6>';
                    } else if($row0['order_status'] == '0'){
                        echo '<h6><span class="badge badge-danger">Failed</span></h6>';
                    }
                    else if($row0['order_status'] == '9'){
                      echo '<h6><span class="badge badge-danger">Cancelled</span></h6>';
                  }
                    ?>
                  </td>


                       
                      
                    
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
