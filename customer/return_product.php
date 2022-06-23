<?php
error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting(E_ALL); // Error engine - always E_ALL!
ini_set('ignore_repeated_errors', TRUE); // always TRUE
ini_set('display_errors', FALSE); // Error display - FALSE only in production environment or real server. TRUE in development environment
ini_set('log_errors', TRUE); // Error logging engine
ini_set('error_log', 'errors.log'); // Logging file path
ini_set('log_errors_max_len', 1024); // Logging file size
session_start();
include('../db/connect.php');
$customer_id = $_SESSION['customer_id'];

$date = new DateTime("now", new DateTimeZone('Asia/Manila'));
$new = $date->format('Y-m-d H:i:s');
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';
require 'PHPMailer/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailerAutoload.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Return Product - Timber Valley PH</title>
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <style>
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

    .btn-primary {
      background-color: #004d38 !important;
      border: 0 !important;
    }

    .order-receipt {
      border: 1px solid black;

    }

    .table th,
    td {
      width: 25% !important;
      white-space: nowrap !important;
    }

    .table td {
      padding: 10px !important;
    }

    .table2 td {
      padding: 5px !important;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <?php include('section/header.php'); ?>
    <?php include('section/sidebar.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper mt-5">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <!-- <h1>Home</h1> -->
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card">
          <!-- <div class="card-header">
     
    
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div> -->
          <div class="card-body">
            <div class="row d-flex justify-content-center align-content-center">
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Return Product</h4>
                  </div>
                  <div class="card-body">
                    <?php
                    if (isset($_POST['btnrequest'])) {
                      $item = $_POST['item'];
                      $qty = $_POST['qty'];
                      $amount = $_POST['amount2'];
                      $address = $_POST['address'];
                      $ordernumber = $_POST['ordernumber'];
                      $prodcode = $_POST['prodcode'];
                      $origqty = $_POST['origqty'];

                       $checkreturn = mysqli_query($con,"SELECT sum(return_qty) as returnqty FROM t_return
                        where return_order_id ='$ordernumber' and return_product_id = '$prodcode'");
                        $rowcheckreturn = mysqli_fetch_array($checkreturn);
                        $lastreturn = $rowcheckreturn['returnqty'];
                        $validateqty = $lastreturn + $qty;

                        if($origqty > $validateqty){
                          $refund = mysqli_query($con,"INSERT INTO t_return(return_order_id,
                          return_product_id,
                          return_qty,
                          return_amount,
                          return_address,
                          return_status,
                          timestamp) values('$ordernumber','$prodcode','$qty','$amount','$address','0','$new')");
                       
                    
                      $mail = new PHPMailer;
                      $mail->isSMTP();
                      $mail->SMTPDebug = 0;
                      $mail->Host = 'smtp.hostinger.com';
                      $mail->Port = 587;
                      $mail->SMTPAuth = true;
                      $mail->Username = 'return@timbervalleyph.com';
                      $mail->Password = 'P@55w0rd1230';
                      $mail->setFrom('return@timbervalleyph.com', 'Timber Valley PH');
                      $mail->addReplyTo('return@timbervalleyph.com', 'Timber Valley PH');
                      //$mail->addAddress('support@aristocrat.com.ph', 'IT Help Desk');
                      $mail->addAddress('timbervalleyph@gmail.com');
                      $mail->Subject = 'Return Item - Timber Valley PH';
                      //$mail->msgHTML(file_get_contents('message.html'), __DIR__);
                      $mail->Body = '
                          <p><b>Return Item</b></p>
                          <p>Item:' . $item . '</p>
                          <p>Qty:' . $qty . '</p>
                          <p>Amount:' . $amount . '</p>
                          <p>Address:' . $address . '</p>
                          ';


                      $mail->IsHTML(true);
                      if ($mail->send()) {

                        echo '
                              <div class="alert alert-success alert-dismissible fade show" role="alert">
                              <strong>Request Submitted Successfully!</strong>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                              </div>
                              ';
                      } else {
                        echo "error";
                      }


                    }
                    else{
                      echo '
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Invalid QTY input you have already returned '.$lastreturn.'!</strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      </div>
                      ';
                    }


                

                    }

                    ?>
                    <form method="POST" autocomplete="on">
                      <div class="row">
                        <div class="col-lg-6 form-group">
                          <label>Order Number</label>
                          <select name="ordernumber" id="ordernumber" class="form-control select2">
                            <option value="">Select Order ID</option>
                            <?php
                            $getorder = mysqli_query($con, "SELECT * FROM t_order_details where order_customer_id = '$customer_id'
                            AND order_payment_status = 'PAID' order by order_id desc");
                            while ($roworder = mysqli_fetch_array($getorder)) {
                            ?>
                              <option value="<?php echo $roworder['order_id']; ?>"><?php echo $roworder['order_id']; ?></option>

                            <?php } ?>
                          </select>
                        </div>
                        <div class="col-lg-6 form-group">
                          <label>Product Code</label>
                          <select name="prodcode" id="prodcode" class="form-control select2">

                          </select>
                        </div>
                        <div class="col-lg-6 form-group">
                          <label>Product Name</label>
                          <input type="text" class="form-control" name="item" id="item" disabled required>
                        </div>
                        <div class="col-lg-6 form-group">
                          <label>Quantity</label>
                          <input type="text" class="form-control" name="qty" id="qty" required>
                          <input type="text" name="origqty" id="origqty" class="d-none">
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Amount to Refund</label>
                        <input type="text" class="form-control" name="amount" id="amount" disabled required>
                        <input type="text" name="amount2" id="amount2" class="d-none">
                        
                      </div>
                      <div class="form-group">
                        <label>Complete Address</label>
                        <input type="text" class="form-control" name="address" required>
                      </div>


<div class="alert alert-danger  d-none" id="erroralert">Invalid QTY Input, QTY must be equal or less than ordered QTY</div>

                  </div>
                  <div class="card-footer ">
                    <button type="submit" name="btnrequest" id="btnrequest" class="btn btn-success float-right">Submit Request</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <!-- <div class="card-footer">
          Footer
        </div> -->
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php include('section/footer.php'); ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->


  <script>
    $(document).ready(function() {
      $('#ordernumber').change(function(e) {
        e.preventDefault();
        var ordernumber = $(this).val();
        $.ajax({
          url: 'functions/getproduct.php',
          type: 'GET',
          data: {
            ordernumber: ordernumber
          },
          dataType: 'json',
          success: function(response) {
            var len = response.length;
            $('#prodcode').empty();
            for (var i = 0; i < len; i++) {
              var productid = response[i]['product_id'];
              var productcode = response[i]['product_code'];
              $("#prodcode").append("<option value='" + productid + "'>" + productcode + "</option>").trigger('change');

            }
          }
        })
      })
    })
  </script>


  <script>
    $(document).ready(function() {
      $('#prodcode').change(function(e) {
        // e.preventDefault();
        var prodid = $(this).val();
        var orderid = $('#ordernumber').val();
        // alert(prodid);
        $.ajax({
          url: 'functions/getcartdetails.php',
          type: 'GET',
          data: {
            prodid: prodid,
            orderid: orderid
          },
          dataType: 'json',
          success: function(data) {
            // alert(data2.productname);
            $('#item').val(data.productname);
            $('#qty').val(data.productqty);
            $('#origqty').val(data.productqty);
            $('#erroralert').addClass('d-none');

          }
        })
      })
    })
  </script>

  <script>
    $(document).ready(function() {
       $('#qty').on("keyup", function() {
var productid = $('#prodcode').val();
var ordernumber = $('#ordernumber').val();
var origqty =  parseInt($('#origqty').val());
var refundqty =  parseInt($(this).val());
if(refundqty < origqty){

  $.ajax({
          url: 'functions/getrefundamount.php',
          type: 'GET',
          data: {
            productid: productid,
            ordernumber: ordernumber,
            refundqty:refundqty

          },
          dataType: 'json',
          success: function(data) {
            // alert(data2.productname);
            // $('#amount').val(data.refundamount);
            $('#amount').val(parseFloat(data.refundamount).toFixed(2));
            $('#amount2').val(parseFloat(data.refundamount).toFixed(2));
            $('#btnrequest').prop('disabled', false);
            $('#erroralert').addClass('d-none');

          }
        })




}else if (refundqty > origqty || refundqty == 0)  {
  // alert("di pwede");
  $('#amount').val('');
  $('#btnrequest').prop('disabled', true);
$('#erroralert').removeClass('d-none');

}

      })
    })
  </script>

  <script>
    $(function() {
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })
  </script>




  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>






</body>

</html>