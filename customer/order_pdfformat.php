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
$guest_id = $_SESSION['guest_id'];
$result = mysqli_query($con,"SELECT * FROM t_order_details as a 
LEFT JOIN t_shipping_details as b ON a.order_shipping_id = b.sd_id
LEFT JOIN t_payment_terms as c ON a.order_payment_terms = c.terms_id
where a.order_guest_id = '$guest_id' ");
$row = mysqli_fetch_array($result);
$order_id = $row['order_id'];
$discount_percentage = $row['terms_discount'] * 100;
$discount_raw = $row['terms_discount'];
$terms_name = $row['terms_desc'];
if($row['order_payment_method'] == 'paypal'){
    $payment_method = 'Paypal';
}
else if($row['order_payment_method'] == 'check'){
    $payment_method = 'Checking Account';
}
else if($row['order_payment_method'] == 'bank_transfer'){
    $payment_method = 'Bank Transfer';
}
else if($row['order_payment_method'] == 'none'){
    $payment_method = 'No Payment Yet';
}
else if($row['order_payment_method'] == 'cod'){
    $payment_method = 'Cash On Delivery';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Order Placed - Timber Valley PH</title>
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://timbervalleyph.com/customer/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://timbervalleyph.com/customer/dist/css/adminlte.min.css">
  
  <style>
  
    .imgfilter{
      width:100% !important;
      height:200px !important;
    }
    @media(max-width:720px){
      .imgfilter{
        width:100% !important;
        height:150px !important;
      }
      .card-list{
        margin:0 !important;
      }
    }

    .product-info{
       overflow: hidden;
       white-space: nowrap;
       text-overflow: ellipsis;
    }

    .card-list{
      margin-right:70px;
      margin-left:70px;
    }
    
    /* .card{
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.50);
    } */

    .btn-primary{
      background-color: #004d38 !important;
      border:0 !important;
    }

    .order-receipt{
        border:1px solid black;
        
    }

    .table th, td{
        width:25% !important;
        white-space: nowrap !important;
    }

    .table td{
        padding:10px !important;
        font-size:13px;
    }

    .table2 td{
        padding:5px !important;
    }



    
  </style>
</head>
<body >

 

  <!-- Content Wrapper. Contains page content -->

  

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
    
        <div class="card-body">
            <div class="row d-flex justify-content-center align-content-center">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="left">
                                    <div class="left-row d-flex justify-content-start">
                                        <div class="left-row-l">
                                        <img src="../logo.jpg" width="100">
                                        </div>
                                        <div class="left-row-r">
                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="right text-right">
                                <span class="font-weight-bold" style="font-size:14px;">Philippine Timber Valley Trading Corporation</span><br>
                                        <span class="text-muted" style="font-size:12px;">18B Elisco Road,Taguig City,Metro Manila</span><br>
                                        <span class="text-muted" style="font-size:12px;">+63 (2) 8 628 3520<br>+63 (2) 8 643 5426</span><br>
                                </div>
                            </div>
                            <div class="order-id mt-5">
                                <h3 class="text-center text-muted">ORDER</h3>
                                <h5 class="text-center">#<?php echo $order_id; ?></h5>
                            </div>

                            <div class="shipping-info mt-5 d-flex justify-content-between">
                                <div class="si-left">
                                    <span class="font-weight-bold"><?php echo $row['sd_fullname']; ?></span><br>
                                    <span class="text-muted" style="font-size:12px;"><?php echo $row['sd_address']; ?></span><br>
                                    <span class="text-muted" style="font-size:12px;"><?php echo $row['sd_mobile']; ?></span><br>
                                </div>
                                <div class="si-right text-right">
                                    <span class="font-weight-bold text-success"><i class="fa fa-check"></i>&ensp;Order has been placed</span><br>
                                    <span class="text-muted" style="font-size:12px;">Payment Terms: <?php echo $terms_name; ?></span><br>
                                    <span class="text-muted" style="font-size:12px;"><?php echo $payment_method; ?><br>
                                </div>
                            </div>
                            
                            <div class="order-list mt-5">
                               <div class="table-responsive">
                               <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Item</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Qty</th>                                          
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $resultcart = mysqli_query($con,"SELECT * FROM t_cart as a LEFT JOIN t_products as b ON a.product_id = b.product_id where a.guest_id = '$guest_id' order by a.cart_id desc");
                                    while($rowcart = mysqli_fetch_array($resultcart)){
                                        $price = $rowcart['price'];
                                        $qty = $rowcart['qty'];
                                        $total_cost = $price * $qty;
                                        $total += $total_cost;
                                        $total_discount = $total * $discount_raw;
                                        $grand_total = $total - $total_discount;
                                    ?>
                                    <tr>
                                        <td><?php echo $rowcart['product_code']; ?></td>
                                        <td><?php echo $rowcart['product_desc']; ?></td>
                                        <td><?php echo number_format($rowcart['price'],2); ?></td>
                                        <td>x<?php echo $rowcart['qty']; ?></td>                                      
                                        <td>Php <?php echo number_format($total_cost,2); ?></td>
                                    </tr>
                                    <?php } ?>

                                   
                                </table>
                                <table class="table2">
                                <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Subtotal</td>
                                        <td><span class="font-weight-bold">Php <?php echo number_format($total,2); ?></span></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Discount (<?php echo $discount_percentage; ?>%)</td>
                                        <td><span class="font-weight-bold text-danger">- Php <?php echo number_format($total_discount,2); ?></span></td>
                                    </tr>
                                    
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Grand Total</td>
                                        <td><span class="font-weight-bold">Php <?php echo number_format($grand_total,2); ?></span></td>
                                    </tr>
                                </table>
                               </div>
                            </div>

                            <?php
                            $resultsign = mysqli_query($con,"SELECT * FROM t_signature where sign_guest = '$guest_id' ");
                            $rowsign = mysqli_fetch_array($resultsign);
                            ?>

                            <div class="signature mt-5">
                              <div class="sign">
                                <img src="<?php echo $rowsign['sign_path']; ?>" width="150"/>
                              </div>
                              <div class="sign-name" style="margin-top:-20px;">
                                <span class="font-weight-bold"><?php echo $row['sd_fullname']; ?></span>
                              </div>
                            </div>
                            
                            <div class="order-status mt-5 text-center">
                                <a class="text-info " href="order_status.php">Click to track the status of your order</a>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-lg-12 d-flex justify-content-center align-content-center">
                  <a href="order_print.php?orderno=<?php echo $guest_id?>" target="_blank" rel="noopener noreferrer">
                  <button class="btn btn-primary btn-lg"> <i class="fa fa-print"></i> Print</button>
                  <button onclick="PrintOrder()">Print</button>
                </a>
              
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
  
  <!-- /.content-wrapper -->

 
<script>
    function PrintOrder(){
        var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    mywindow.document.write('<html><head>');
    mywindow.document.write('<title>Order Placed - Timber Valley PH</title>' + 
  '<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />' +
 '<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />'+
  '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">'+
  '<link rel="stylesheet" href="https://timbervalleyph.com/customer/plugins/fontawesome-free/css/all.min.css">'+
  '<link rel="stylesheet" href="https://timbervalleyph.com/customer/dist/css/adminlte.min.css">');
  mywindow.document.write('<section class="content">'+
'<div class="card">'+
  '<div class="card-body">'+
      '<div class="row d-flex justify-content-center align-content-center">'+
          '<div class="col-lg-7">'+
            '  <div class="card">'+
                 ' <div class="card-body">'+
                  '    <div class="d-flex justify-content-between">'+
                        '  <div class="left">'+
                            '  <div class="left-row d-flex justify-content-start">'+
                                '  <div class="left-row-l">'+
                                '  <img src="../logo.jpg" width="100">'+
                                '  </div>'+
                                 ' <div class="left-row-r">'+
                                  
                               '   </div>'+
                           '   </div>'+
                       '   </div>'+
                          '<div class="right text-right">'+
                        '  <span class="font-weight-bold" style="font-size:14px;">Philippine Timber Valley Trading Corporation</span><br>'+
                                 ' <span class="text-muted" style="font-size:12px;">18B Elisco Road,Taguig City,Metro Manila</span><br>'+
                                  '<span class="text-muted" style="font-size:12px;">+63 (2) 8 628 3520<br>+63 (2) 8 643 5426</span><br>'+
                          '</div>'+
                      '</div>'+
                     ' <div class="order-id mt-5">'+
                       '   <h3 class="text-center text-muted">ORDER</h3>'+
                         ' <h5 class="text-center">#10000</h5>'+
                  '    </div>'+

                      '<div class="shipping-info mt-5 d-flex justify-content-between">'+
                          '<div class="si-left">'+
                             ' <span class="font-weight-bold">Fullname</span><br>'+
                             ' <span class="text-muted" style="font-size:12px;">Address</span><br>'+
                             ' <span class="text-muted" style="font-size:12px;">09123456</span><br>'+
                      '    </div>'+
                        '  <div class="si-right text-right">'+
                           '   <span class="font-weight-bold text-success"><i class="fa fa-check"></i>&ensp;Order has been placed</span><br>'+
                            '  <span class="text-muted" style="font-size:12px;">Payment Terms: Termsname</span><br>'+
                            '  <span class="text-muted" style="font-size:12px;">Payment method<br>'+
                         ' </div>'+
                    '  </div>'+
                      
                     ' <div class="order-list mt-5">'+
                        ' <div class="table-responsive">'+
                        ' <table class="table table-striped">'+
                            '  <thead>'+
                                '  <tr>'+
                                   '   <th scope="col">Item</th>'+
                                    '  <th scope="col">Description</th>'+
                                     ' <th scope="col">Price</th>'+
                                     ' <th scope="col">Qty</th>  '+                                        
                                    '  <th scope="col">Total</th>'+
                                 ' </tr>'+
                             ' </thead>'+
                      
                           '   <tr>'+
                                  '<td>product code</td>'+
                                  '<td>product desc</td>'+
                                 ' <td>1,000.00</td>'+
                                  '<td>x5</td> '+                                     
                                '  <td>Php 20000</td>'+
                             ' </tr>'+
                       

                             
                          '</table>'+
                         ' <table class="table2">'+
                        '  <tr>'+
                                 ' <td></td>'+
                                 ' <td></td>'+
                               '   <td></td>'+
                                '  <td>Subtotal</td>'+
                                '  <td><span class="font-weight-bold">Php 3000</span></td>'+
                             ' </tr>'+
                             ' <tr>'+
                                 ' <td></td>'+
                                 ' <td></td>'+
                                  '<td></td>'+
                                  '<td>Discount (10%)</td>'+
                                  '<td><span class="font-weight-bold text-danger">- Php 100</span></td>'+
                             ' </tr>'+
                              
                            '  <tr>'+
                                  '<td></td>'+
                                  '<td></td>'+
                                  '<td></td>'+
                                 ' <td>Grand Total</td>'+
                                  '<td><span class="font-weight-bold">Php 10023</span></td>'+
                             ' </tr>'+
                         ' </table>'+
                        ' </div>'+
                    '  </div>'+

                    

                     ' <div class="signature mt-5">'+
                       ' <div class="sign">'+
                        '  <img src="../logo.jpg" width="150"/>'+
                      '  </div>'+
                       ' <div class="sign-name" style="margin-top:-20px;">'+
                         ' <span class="font-weight-bold">fullname</span>'+
                       ' </div>'+
                    '  </div>'+
                      
                


                 ' </div>'+
              '</div>'+
         ' </div>'+
         
     ' </div>'+
   
  '</div>'+



'</div>'+



'</section>');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<h1>' + document.title  + '</h1>');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
    }
</script>


<!-- ./wrapper -->

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


