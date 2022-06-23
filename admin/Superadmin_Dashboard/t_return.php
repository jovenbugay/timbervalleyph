<title>Return</title>
<?php include 'header/head.php'; ?>
<?php include 'sidebar/sidebar_menu.php'; ?>



<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          

          <!-- /.card-header -->
          <div class="card-header">
          <!-- <button class="btn btn-success float-right">Export</button> -->
          <button class="btn btn-success float-right" onclick="exportData()">Export to Excel</button>
          <input type="text" class="d-none" name = "filenamedate" id="filenamedate" value="<?php echo date("Y-m-d")?>">

            <?php
            if(isset($_POST['btnupdate'])){
              $returnid = $_POST['returnid'];
              $retstatus = $_POST['retstatus'];

              $updatestatus = mysqli_query($con,"UPDATE t_return set return_status ='$retstatus' where return_id = '$returnid'");

              if($updatestatus){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Status updated successfully</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> ';
              }
            }

            ?>

            <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Product Already Exist</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div> -->
            <?php include 'modal/addterm_modal.php'; ?>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Order No.</th>
                  <th>Date</th>
                  <th>Customer FullName</th>
                  <th>Product Code</th>
                  <th>Product Name</th>
                  <th>QTY</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Action</th>


                </tr>
              </thead>
              <tbody>
                <?php
                include('include/access/connector.php');
                $query0 = mysqli_query($con, "SELECT * FROM t_return as a
                       left join t_products as b on a.return_product_id = b.product_id
                       left JOIN t_order_details as c on a.return_order_id = c.order_id
                       left join t_customers as d on c.order_customer_id = d.customer_id") or die(mysqli_error($con));
                while ($row = mysqli_fetch_array($query0)) {
                  $returnstatus = $row['return_status'];

                  if ($returnstatus == "1") {
                    $status = "Resolved";
                  } else if ($returnstatus == "2") {
                    $status = "UnResolved";
                  } else {
                    $status = "No Action Taken";
                  }




                ?>


                  <tr>
                    <td><?php echo $row['return_order_id']; ?></td>
                    <td><?php echo $row['timestamp']; ?></td>
                    <td><?php echo $row['customer_fname'] . " " . $row['customer_lname']; ?></td>
                    <td><?php echo $row['product_code']; ?></td>
                    <td><?php echo $row['product_desc']; ?></td>
                    <td><?php echo $row['return_qty']; ?></td>
                    <td>&#8369; <?php echo $row['return_amount']; ?></td>
                    <td><?php echo $status; ?></td>
                    <td><button class="btn btn-primary" data-toggle="modal" data-target="#returnid-<?php echo $row['return_id']; ?>">Update</button></td>


                    <div class="modal fade" id="returnid-<?php echo $row['return_id']; ?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" for="name">Update Status</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="" method="post">
                            <div class="modal-body">
                              <input type="text" hidden name="returnid" value="<?php echo $row['return_id']; ?>">
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-6">
                                    <label>Order No.</label>
                                    <input type="text" class="form-control" disabled name="orderno" value="<?php echo $row['return_order_id']; ?>">
                                  </div>
                                  <div class="col-6">
                                    <label>Customer Name</label>
                                    <input type="text" class="form-control" disabled name="customername" value="<?php echo $row['customer_fname'] . " " . $row['customer_lname']; ?>">
                                  </div>
                                </div>
                                <div class="row mt-2">
                                  <div class="col-6">
                                    <label>Product Code</label>
                                    <input type="text" class="form-control" disabled name="productcode" value="<?php echo $row['product_code']; ?>">
                                  </div>
                                  <div class="col-6">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" disabled name="productname" value="<?php echo $row['product_desc']; ?>">
                                  </div>
                                </div>
                                <div class="row mt-2">
                                  <div class="col-6">
                                    <label>Return Qty</label>
                                    <input type="text" class="form-control" disabled name="retqty" value="<?php echo $row['return_qty']; ?>">
                                  </div>
                                  <div class="col-6">
                                    <label>Return Amount</label>
                                    <input type="text" class="form-control" disabled name="retamt" value="&#8369; <?php echo $row['return_amount']; ?>">
                                  </div>
                                </div>
                                <div class="row mt-2">
                                  <div class="col-12">
                                    <label for=""></label>
                                    <select name="retstatus" id="" class="form-control select2">
                                      <option value="1">Resolved</option>
                                      <option value="2">UnResolved</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button class="btn btn-default" data-dismiss="modal">Close</button>
                              <button class="btn btn-primary" name="btnupdate">Update</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>


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

<table id="tblreturn" class="table table-bordered table-striped" hidden>
              <thead>
                <tr>
                  <th>Order No.</th>
                  <th>Date</th>
                  <th>Customer FullName</th>
                  <th>Product Code</th>
                  <th>Product Name</th>
                  <th>QTY</th>
                  <th>Amount</th>
                  <th>Status</th>
                  


                </tr>
              </thead>
              <tbody>
                <?php
                include('include/access/connector.php');
                $query0 = mysqli_query($con, "SELECT * FROM t_return as a
                       left join t_products as b on a.return_product_id = b.product_id
                       left JOIN t_order_details as c on a.return_order_id = c.order_id
                       left join t_customers as d on c.order_customer_id = d.customer_id") or die(mysqli_error($con));
                while ($row = mysqli_fetch_array($query0)) {
                  $returnstatus = $row['return_status'];

                  if ($returnstatus == "1") {
                    $status = "Resolved";
                  } else if ($returnstatus == "2") {
                    $status = "UnResolved";
                  } else {
                    $status = "No Action Taken";
                  }




                ?>


                  <tr>
                    <td><?php echo $row['return_order_id']; ?></td>
                    <td><?php echo $row['timestamp']; ?></td>
                    <td><?php echo $row['customer_fname'] . " " . $row['customer_lname']; ?></td>
                    <td><?php echo $row['product_code']; ?></td>
                    <td><?php echo $row['product_desc']; ?></td>
                    <td><?php echo $row['return_qty']; ?></td>
                    <td><?php echo $row['return_amount']; ?></td>
                    <td><?php echo $status; ?></td>
                  </tr>

                <?php  } ?>
              </tbody>

            </table>

<script>

function exportData(){
    /* Get the HTML data using Element by Id */
    var table = document.getElementById("tblreturn");
    var fdate = $('#filenamedate').val();
 
    /* Declaring array variable */
    var rows =[];
 
      //iterate through rows of table
    for(var i=0,row; row = table.rows[i];i++){
        //rows would be accessed using the "row" variable assigned in the for loop
        //Get each cell value/column from the row
        column1 = row.cells[0].innerText;
        column2 = row.cells[1].innerText;
        column3 = row.cells[2].innerText;
        column4 = row.cells[3].innerText;
        column5 = row.cells[4].innerText;
        column6 = row.cells[5].innerText;
        column7 = row.cells[6].innerText;
        column8 = row.cells[7].innerText;
 
    /* add a new records in the array */
        rows.push(
            [
                column1,
                column2,
                column3,
                column4,
                column5,
                column6,
                column7,
                column8
            ]
        );
 
        }
        csvContent = "data:text/csv;charset=utf-8,";
         /* add the column delimiter as comma(,) and each row splitted by new line character (\n) */
        rows.forEach(function(rowArray){
            row = rowArray.join(",");
            csvContent += row + "\r\n";
        });
 
        /* create a hidden <a> DOM node and set its download attribute */
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", fdate + "_Return_Report.csv");
        document.body.appendChild(link);
         /* download the data file named "Stock_Price_Report.csv" */
        link.click();
}

   
 
</script>


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
  $(function() {
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