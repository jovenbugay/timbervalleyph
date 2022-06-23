<title>Orders</title>
<?php include 'header/head.php'; ?>
<?php include 'sidebar/sidebar_menu.php'; ?>
<?php
require __DIR__ . '/../../vendor/autoload.php';


use Twilio\Rest\Client;

$account_sid = 'AC55002d14ff85987b3e98a9d11b68749d';
$auth_token = '7e406202fe3d776219d620d53836d37a';
$twilio_number = "+18507211391";
?>

<style>
  h5 {
    display: block;
    font-size: 30px;
    margin-top: 0.67em;
    margin-bottom: 0.67em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
  }

  h2 {
    display: block;
    font-size: 14px;
    margin-top: 0.67em;
    margin-bottom: 0.67em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
  }


  .imgfilter {
    width: 100% !important;
    height: 200px !important;
  }

  @media(max-width:720px) {
    .imgfilter {
      width: 100% !important;
      height: 150px !important;
    }

    .card-list {
      margin: 0 !important;
    }
  }

  .product-info {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
  }

  .card-list {
    margin-right: 70px;
    margin-left: 70px;
  }

  /* .card{
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.50);
    } */

  .table td,
  th {
    font-size: 14px;
  }

  .hidden {
    display: none;
  }
</style>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <!-- /.card-header -->
          <div class="card-header">
            <!-- <h3 class="card-title" style="float: right;"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-overlay">
                  Add Branches
                </button></h3> -->
            <?php include 'modal/addbranches_modal.php'; ?>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-hover table-nowrap">
              <thead>
                <tr>
                  <th>Order #</th>
                  <th>Name</th>

                  <th>Contact</th>
                  <th>Status</th>

                </tr>
              </thead>
              <tbody>
                <?php
                $result = mysqli_query($con, "SELECT * FROM t_order_details as a 
              LEFT JOIN t_shipping_details as b ON a.order_shipping_id = b.sd_id
              LEFT JOIN t_payment_terms as c ON a.order_payment_terms = c.terms_id
              LEFT JOIN t_customers as d ON a.order_customer_id = d.customer_id ORDER BY a.order_id DESC ");
                while ($row = mysqli_fetch_array($result)) {
                  $guest_id = $row['order_guest_id'];
                  $orderid = $row['order_id'];
                ?>

                  <tr data-toggle="modal" data-target=".bd-example-modal-lg-<?php echo $row['order_id']; ?>">
                    <td><?php echo $row['order_id']; ?></td>
                    <td><?php echo $row['sd_fullname']; ?></td>

                    <td><?php echo $row['sd_mobile']; ?></td>
                    <td>
                      <?php
                      if ($row['order_status'] == '1') {
                        echo '<h6><span class="badge badge-primary">Pending</span></h6>';
                      } else if ($row['order_status'] == '2') {
                        echo '<h6><span class="badge badge-warning">Processing</span></h6>';
                      } else if ($row['order_status'] == '3') {
                        echo '<h6><span class="badge badge-info">In Transit</span></h6>';
                      } else if ($row['order_status'] == '4') {
                        echo '<h6><span class="badge badge-success">Completed</span></h6>';
                      } else if ($row['order_status'] == '0') {
                        echo '<h6><span class="badge badge-danger">Failed</span></h6>';
                      } else if ($row['order_status'] == '9') {
                        echo '<h6><span class="badge badge-danger">Cancelled</span></h6>';
                      }
                      ?>
                    </td>
                  </tr>
                  <?php //include 'modal/orderlist_modal.php';
                  ?>



                  <div class="modal fade bd-example-modal-lg-<?php echo $row['order_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">#<?php echo $row['order_id']; ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                        <div class="modal-body">
                          <div class="row">
                            <!-- Order Details -->

                            <div class="col-lg-6">
                              <!-- ITEM DETAILS -->
                              <?php
                              $resultcart = mysqli_query($con, "SELECT * FROM t_order_details as a 
                              LEFT JOIN t_cart as b ON a.order_guest_id = b.guest_id
                              LEFT JOIN t_products as c on b.product_id = c.product_id
                              LEFT JOIN t_payment_terms as d on a.order_payment_terms = d.terms_id
                              LEFT JOIN t_signature as e on a.order_guest_id = e.sign_guest
                              where a.order_id = '$orderid' ");
                              while ($rowcart = mysqli_fetch_array($resultcart)) {
                                $oid = $rowcart['order_id'];
                                $price = $rowcart['price'];
                                $qty = $rowcart['qty'];
                                $total_cost = $price * $qty;
                                $total += $total_cost;
                                $discount = $rowcart['terms_discount'];
                                $overall = $total - ($total * ($discount / 100));
                                $signpath = $rowcart['sign_path'];

                              ?>
                                <div class="card">
                                  <div class="card-body">
                                    <div class="info d-flex justify-content-between">
                                      <div class="product-info">
                                        <span class="font-weight-bold"><?php echo $rowcart['product_code']; ?></span><br>
                                        <span class="text-muted" style="font-size:14px;"><?php echo $rowcart['product_desc']; ?></span><br>
                                        <span class="text-muted" style="font-size:12px;">Qty: <?php echo $rowcart['qty']; ?></span><br>
                                      </div>
                                      <div class="product-cost">
                                        <span class="text-muted float-right" style="font-size:14px;">Php <?php echo number_format($rowcart['price'], 2); ?></span><br>
                                        <span class="font-weight-bold float-right">Php <?php echo number_format($total_cost, 2); ?></span><br>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              <?php } ?>
                            </div><!-- END OF ITEM DETAILS -->

                            <?php
                            $resultcart2 = mysqli_query($con, "SELECT round(sum(b.price * b.qty - (b.price * b.qty * (d.terms_discount/100))),2) as total_price_discount,e.sign_path,DATE(a.order_date) as order_date,f.att_path
                         FROM t_order_details as a 
                        LEFT JOIN t_cart as b ON a.order_guest_id = b.guest_id
                        LEFT JOIN t_payment_terms as d on a.order_payment_terms = d.terms_id
                        LEFT JOIN t_signature as e on a.order_guest_id = e.sign_guest
                        LEFT JOIN t_attachments as f on a.order_guest_id = f.att_guest_id
                        where a.order_id = '$orderid' ");
                            while ($rowcart2 = mysqli_fetch_array($resultcart2)) {
                              $oid = $rowcart2['order_id'];
                              $overall2 = $rowcart2['total_price_discount'];
                              $signpath2 = $rowcart2['sign_path'];
                              $orderdate = $rowcart2['order_date'];
                              $att_path = $rowcart2['att_path'];
                              $pay_method = $row['order_payment_method'];
                            }
                            ?>

                            <div class="col-lg-6">
                              <!-- Customer Details -->
                              <div class="card">
                                <div class="card-header">
                                  <h2 class="text-left">Sipping Details</h>
                                </div>
                                <div class="card-body">

                                  <?php

                                  if ($pay_method == "cod") {
                                    $payment = "Cash on Delivery";
                                  } else if ($pay_method == "paypal") {
                                    $payment = "Paypal";
                                  } else if ($pay_method == "check") {
                                    $payment = "Checking Account";
                                  } else if ($pay_method == "bank_transfer") {
                                    $payment = "Bank Transfer";
                                  } else if ($pay_method == "none") {
                                    $payment = "No Payment Yet";
                                  }
                                  echo
                                  '
                                    <span>' . $row['sd_fullname'] . '</span><br>
                                    <span class="text-muted">' . $row['sd_address'] . '</span><br>
                                    <span class="text-muted">' . $row['sd_mobile'] . '</span><br><br>
				<span class="text-muted">Payment Method: ' . $payment . '</span><br>
                                    <span>ORDER DATE: ' . date("F j, Y", strtotime($orderdate)) . '</span><br>
                                    ';
                                  ?>
                                </div>
                              </div>
                              <!-- <div class="card">
                                <div class="card-body">
                                  <label class="control-label col-lg-12" for="price">Signature:</label>
                                  <img style="width:100px;height:100px" src="https://timbervalleyph.com/customer/<?php
                                                                                                                  if (empty($signpath)) {
                                                                                                                    echo 'sign/nosign.jpg';
                                                                                                                  } else {
                                                                                                                    echo $signpath;
                                                                                                                  }; ?>">

                                  <label class="control-label col-lg-12" for="price">Total Amount:</label>
                                  <input type="text" name="orderno" class="form-control" value="<?php echo number_format($overall2, 2); ?>" readonly>

                                </div>
                              </div> -->


                              <div class="card">
                                <div class="card-body">
                                  <label class="control-label col-lg-12" for="price">Attachments:</label>
                                  <img style="width:150px;height:150px" src="https://timbervalleyph.com/customer/<?php
                                                                                                                  if (empty($att_path)) {
                                                                                                                    echo 'bank/noatt.png';
                                                                                                                  } else if (file_exists('https://timbervalleyph.com/customer/' . "$att_path")) {
                                                                                                                    echo 'bank/noatt.png';
                                                                                                                  } else {
                                                                                                                    echo $att_path;
                                                                                                                  }; ?>">
                                </div>
                              </div>

                              <div class="card">
                                <div class="card-header">
                                  <form method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="orderno" class="form-control" value="<?php echo $row['order_id']; ?>">
                                    <input type="hidden" name="customerid" class="form-control" value="<?php echo $row['customer_id']; ?>">
                                    <input type="hidden" name="sd_mobile" value="<?php echo substr($row['sd_mobile'],-10,10) ; ?>">
                                    <select name="pay_stat" class="form-control" required>
                                      <option value="" disabled="disabled" selected="selected">Select Status</option>
                                      <!-- admin - 1 employee 2 -->
                                      <option value="1">Pending</option>
                                      <option value="2">Processing</option>
                                      <option value="3">In Transit</option>
                                      <option value="4">Completed</option>
                                      <option value="0">Failed</option>
                                      <option value="9">Cancelled</option>
                                      <!-- <option value="HR Assistant">&rarr; HR Assistant</option> -->
                                    </select>
                                    <div class="modal-footer">
                                      <a href="t_orders_pdf.php?orderno=<?php echo $orderid; ?>"><button type="button" class="btn btn-success" name="printpdf">Export to PDF</button></a>
                                      <button type="submit" class="btn btn-primary" name="upstat">Update Status</button>
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>


                                  </form>

                                </div>
                              </div>
                            </div>
                          </div><!-- END OF CUSTOMER Details -->




                        </div> <!-- End of Order Details -->
                      </div>
                    </div>
                  </div>
                <?php } ?>


                <?php




                if (isset($_POST['upstat'])) {

                  $pay_stat = $_POST['pay_stat'];
                  $orderno = $_POST['orderno'];
                  $customer_id = $_POST['customerid'];
                  $mobilenumber = '+63'. $_POST['sd_mobile'];

                  
                  

                  $date = date('Y-m-d H:i:s');
                  include('include/access/connector.php');
                  mysqli_query($con, "UPDATE t_order_details set order_status='$pay_stat' 
                          where order_id='$orderno' ")
                    or die(mysqli_error($con));
                  //  echo '<script>window.location = "t_orders.php"</script>';
                  echo "<script type='text/javascript'>alert('Status Updated!!');document.location = 't_orders.php'</script>";
                }

                $query0 = mysqli_query($con, "select * from t_notification where notif_order_id ='$orderno'") or die(mysqli_error($con));
                $notif_count = mysqli_num_rows($query0);



                if ($pay_stat == '1') {

                  $client = new Client($account_sid, $auth_token);
                  $client->messages->create(
                    // Where to send a text message (your cell phone?)
                    $mobilenumber,
                    array(
                      'from' => $twilio_number,
                      'body' => 'Your order '.$orderno.' is now preparing'
                    )
                  );




                  mysqli_query($con, "INSERT into t_notification(notif_order_id,notif_message,notif_status,notif_customer_id,notif_date)
                        values('$orderno','Your order is preparing','0','$customer_id','$date')")
                    or die(mysqli_error($con));
                } else if ($pay_stat == '2') {

                  $client = new Client($account_sid, $auth_token);
                  $client->messages->create(
                    // Where to send a text message (your cell phone?)
                    $mobilenumber,
                    array(
                      'from' => $twilio_number,
                      'body' => 'Your order '.$orderno.' is now processing'
                    )
                  );


                  mysqli_query($con, "INSERT into t_notification(notif_order_id,notif_message,notif_status,notif_customer_id,notif_date)
                        values('$orderno','Your order is now processing','0','$customer_id','$date')")
                    or die(mysqli_error($con));
                } else if ($pay_stat == '3') {


                  $client = new Client($account_sid, $auth_token);
                  $client->messages->create(
                    // Where to send a text message (your cell phone?)
                    $mobilenumber,
                    array(
                      'from' => $twilio_number,
                      'body' => 'Your order '.$orderno.' is in transit'
                    )
                  );

                  mysqli_query($con, "INSERT into t_notification(notif_order_id,notif_message,notif_status,notif_customer_id,notif_date)
                        values('$orderno','Your order is in transit','0','$customer_id','$date')")
                    or die(mysqli_error($con));
                } else if ($pay_stat == '4') {

                  $client = new Client($account_sid, $auth_token);
                  $client->messages->create(
                    // Where to send a text message (your cell phone?)
                    $mobilenumber,
                    array(
                      'from' => $twilio_number,
                      'body' => 'Your order '.$orderno.' is completed'
                    )
                  );


                  mysqli_query($con, "INSERT into t_notification(notif_order_id,notif_message,notif_status,notif_customer_id,notif_date)
                        values('$orderno','Your order is completed','0','$customer_id','$date')")
                    or die(mysqli_error($con));
                } else if ($pay_stat == '9') {


                  $client = new Client($account_sid, $auth_token);
                  $client->messages->create(
                    // Where to send a text message (your cell phone?)
                    $mobilenumber,
                    array(
                      'from' => $twilio_number,
                      'body' => 'Order '.$orderno.' has been Cancelled'
                    )
                  );

                  mysqli_query($con, "INSERT into t_notification(notif_order_id,notif_message,notif_status,notif_customer_id,notif_date)
                        values('$orderno','Order Cancelled','0','$customer_id','$date')")
                    or die(mysqli_error($con));
                } else if ($pay_stat == '0') {
                  $client = new Client($account_sid, $auth_token);
                  $client->messages->create(
                    // Where to send a text message (your cell phone?)
                    $mobilenumber,
                    array(
                      'from' => $twilio_number,
                      'body' => 'Order '.$orderno.' Failed'
                    )
                  );
                  mysqli_query($con, "INSERT into t_notification(notif_order_id,notif_message,notif_status,notif_customer_id,notif_date)
                        values('$orderno','Order Failed','0','$customer_id','$date')")
                    or die(mysqli_error($con));
                }



                ?>



              </tbody>
              <tfoot>
                <tr>
                  <th>Order #</th>
                  <th>Name</th>

                  <th>Contact</th>
                  <th>Status</th>

                </tr>
              </tfoot>
            </table>





          </div>





          </form>

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

<script src="../Employee/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../Employee/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../Employee/plugins/jszip/jszip.min.js"></script>
<script src="../Employee/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../Employee/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../Employee/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../Employee/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../Employee/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "order": [
        [0, "desc"]
      ],
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
</body>

</html>