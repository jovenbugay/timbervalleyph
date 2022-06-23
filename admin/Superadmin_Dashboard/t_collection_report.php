<title>Collection Report</title>
<?php include 'header/head.php';?>
   <?php include 'sidebar/sidebar_menu.php';?>
   <?php
session_start();
?>
   <style>
   .ln_solid {
  border-top: 1px solid #e5e5e5;
  color: #ffffff;
  background-color: #ffffff;
  height: 1px;
  margin: 20px 0; }
  h5{ 
  display: block;
  font-size: 18px;
  margin-top: 5px;
  margin-bottom: 0.83em;
  margin-left: 0;
  margin-right: 0;
  /* font-weight: regular; */
}

   </style>
<div class="cointainer">
    <div class="main_container">
      <div class="right_col" role="main">
        <div class="row m-1">
          <div class="col-lg-4">
            <div class="card">
              <!-- <div class="card-header">
              <h5>Select Filter <i class = "fa fa-filter"></i></h5>
              </div> -->
              <div class="card-body">
              <div class="filter">
              <h5>Select Filter <i class = "fa fa-filter"></i></h5>
              <hr>
              <form method="POST" enctype = "multipart/form-data">
                <div class="form-group">
                  <label>Date From:</label>
                  <input type="date" name = "datefrom" class="form-control" required value=<?php echo date('Y-m-d'); ?>>
                  <label>Date To:</label>
                  <input type="date" name = "dateto" class="form-control" required value=<?php echo date('Y-m-d'); ?>>
                  <hr>
                  <button type="submit" name = "collection" class="btn btn-block btn-success"><i class = "fa fa-save"></i> Process</button>
                </div>
              </form>
              </div>
              
              
              </div>
            </div>
          </div>



          <footer class="main-footer">
          <strong>Copyright &copy; 2021 <a href="#">Timber Valley PH</a>.</strong>
          All rights reserved.
          <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 0.1
          </div>
          </footer>

         

          <div class="col-lg-8">
            <div class="card">    
                <div class="card-body">

                <div class="filter">
                <h5><b>Collection Rerport </b></h5>
                
                <hr>
                </div>
    
                <!-- <table id="example1" class="table table-striped table-bordered nowrap"> -->
                <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Order No.</th>
                          <th>Customer Fullname</th>
                          <th>Payment</th>
                          <th>Balance</th>
                          <th>Total Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      if(isset($_POST['collection']))
                      {
                          $datefrom = $_POST['datefrom'];
                          $dateto = $_POST['dateto'];

                      $result = mysqli_query($con," SELECT a.order_id,b.customer_fname,b.customer_lname,SUM(c.price * c.qty) as total_price,d.b_balance,d.billing_date,
                      d.b_amount,b_pay_amt
                       FROM t_order_details as a LEFT join t_customers as b 
                      on a.order_customer_id = b.customer_id 
                      left join t_cart as c on c.guest_id = a.order_guest_id  
                      left join t_billing as d on a.order_id = d.order_no and d.deleted='0'
                      where DATE(d.billing_date) between '$datefrom' and '$dateto'
                      group by a.order_id "); 
                      while ($row=mysqli_fetch_array($result)){
                        // $totalcoll += $row['total_price'];
                        ?>
                        
                        <tr>
                        <td><?php echo $row['billing_date'];?></td>
                        <td><?php echo $row['order_id'];?></td>
                        <td><?php echo $row['customer_fname']. " " .$row['customer_lname'];?></td>
                        <td>&#8369; <?php echo number_format ($row['b_pay_amt'],2);?></td>
                        <td>&#8369; <?php echo number_format ($row['b_balance'],2);?></td>
                        <td>&#8369; <?php echo number_format($row['b_amount'],2);?></td>
                        
                        </tr>

                        <?php }?>
                       

                   
               
                        
                <?php }?>

                <?php
                $gettotal = mysqli_query($con,"SELECT *,SUM(b_pay_amt) as total_amt from t_billing
                where DATE(billing_date) between '$datefrom' and '$dateto' and deleted='0'");
                $rowtotal = mysqli_fetch_array($gettotal);
                $totalcoll = $rowtotal['total_amt'];
                ?>
                <tr>
                          <td>Total Collection</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td><h4><b>&#8369; <?php echo number_format($totalcoll,2);?></b></h4></td>
                        </tr>

    			   <tr>
                          <td>From</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td><?php echo $datefrom;?></td>
                          </tr>

                          <tr>
                          <td>To</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td><?php echo $dateto;?></td>                          
                      </tr>

                        </tbody>
  
                        </table>
                        <a href="t_collection_pdf.php?datefrom=<?php echo $datefrom .'&dateto='. $dateto?>">

<button class="btn btn-primary float-right">Print to PDF</button>
</a>
                </div>
                <div class="card-footer">
                
                </div>
              </div>
          </div>
         </div>
      </div>
    </div>
</div>


<script src="../Superadmin_Dashboard/plugins/jquery/jquery.min.js"></script>
<script src="../Superadmin_Dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../Superadmin_Dashboard/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../Superadmin_Dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../Superadmin_Dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../Superadmin_Dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="../Superadmin_Dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../Superadmin_Dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../Superadmin_Dashboard/plugins/jszip/jszip.min.js"></script>
<script src="../Superadmin_Dashboard/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../Superadmin_Dashboard/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../Superadmin_Dashboard/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../Superadmin_Dashboard/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../Superadmin_Dashboard/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,  "paging" : false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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