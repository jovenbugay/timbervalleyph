<?php
session_start();
include('../db/connect.php');
error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting(E_ALL); // Error engine - always E_ALL!
ini_set('ignore_repeated_errors', TRUE); // always TRUE
ini_set('display_errors', FALSE); // Error display - FALSE only in production environment or real server. TRUE in development environment
ini_set('log_errors', TRUE); // Error logging engine
ini_set('error_log', 'errors.log'); // Logging file path
ini_set('log_errors_max_len', 1024); // Logging file size
$date = new DateTime("now", new DateTimeZone('Asia/Manila'));
$new = $date->format('Y-m-d H:i:s');
?>
<?php
if (isset($_POST['btnadd'])) {
  $fullname = $_POST['fullname'];
  $account = $_SESSION['customer_id'];
  $address = $_POST['address'];
  $mobile = $_POST['mobile'];
  $city = $_POST['city'];
  $region = $_POST['region'];
  $address2 = $_POST['address2'];
  $postal = $_POST['postal'];
  $resultaddup = mysqli_query($con, "UPDATE t_shipping_details SET sd_default = '0' where sd_account_id = '$account' ");
  $resultadd = mysqli_query($con, "INSERT INTO t_shipping_details (sd_account_id,sd_fullname,sd_address,sd_mobile,sd_default,sd_address2,sd_region,sd_city,sd_postal) 
  VALUES ('$account','$fullname','$address','$mobile','1','$address2','$region','$city','$postal') ");
}
?>

<?php
if (isset($_POST['btndefault'])) {
  $sd_id = $_POST['sd_id'];
  $account = $_SESSION['customer_id'];
  $resultaddup = mysqli_query($con, "UPDATE t_shipping_details SET sd_default = '0' where sd_account_id = '$account' ");
  $resultdefault = mysqli_query($con, "UPDATE t_shipping_details SET sd_default = '1' where sd_account_id = '$account' and sd_id = '$sd_id' ");
}

?>

<?php
if (isset($_POST['btndelete'])) {
  $sd_id = $_POST['sd_id'];
  $resultdelete = mysqli_query($con, "DELETE FROM t_shipping_details where sd_id = '$sd_id' ");
}

?>

<?php
if (isset($_POST['btncartdelete'])) {
  $cart_id = $_POST['cart_id'];
  $resultcd = mysqli_query($con, "DELETE FROM t_cart where cart_id = '$cart_id' ");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Checkout - Timber Valley PH</title>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
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

    .table td,
    th {
      font-size: 14px;
    }

    .hidden {
      display: none;
    }



    .file-upload {
      background-color: #ffffff;

    }

    .file-upload-btn {
      width: 100%;
      margin: 0;
      color: #fff;
      background: #1FB264;
      border: none;
      padding: 10px;
      border-radius: 4px;
      border-bottom: 4px solid #15824B;
      transition: all .2s ease;
      outline: none;
      text-transform: uppercase;
      font-weight: 700;
    }

    .file-upload-btn:hover {
      background: #1AA059;
      color: #ffffff;
      transition: all .2s ease;
      cursor: pointer;
    }

    .file-upload-btn:active {
      border: 0;
      transition: all .2s ease;
    }

    .file-upload-content {
      display: none;
      text-align: center;
    }

    .file-upload-input {
      position: absolute;
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
      outline: none;
      opacity: 0;
      cursor: pointer;
    }

    .image-upload-wrap {
      margin-top: 20px;
      border: 4px dashed #1FB264;
      position: relative;
    }

    .image-dropping,
    .image-upload-wrap:hover {
      background-color: #1FB264;
      border: 4px dashed #ffffff;
    }

    .image-title-wrap {
      padding: 0 15px 15px 15px;
      color: #222;
    }

    .drag-text {
      text-align: center;
    }

    .drag-text h3 {
      font-weight: 100;
      text-transform: uppercase;
      color: #15824B;
      padding: 60px 0;
    }

    .file-upload-image {
      max-height: 200px;
      max-width: 200px;
      margin: auto;
      padding: 20px;
    }

    .remove-image {
      width: 200px;
      margin: 0;
      color: #fff;
      background: #cd4535;
      border: none;
      padding: 10px;
      border-radius: 4px;
      border-bottom: 4px solid #b02818;
      transition: all .2s ease;
      outline: none;
      text-transform: uppercase;
      font-weight: 700;
    }

    .remove-image:hover {
      background: #c13b2a;
      color: #ffffff;
      transition: all .2s ease;
      cursor: pointer;
    }

    .remove-image:active {
      border: 0;
      transition: all .2s ease;
    }

    /* Signature Pad   */

    .m-signature-pad {
      position: relative;
      font-size: 10px;
      width: 100%;
      height: 220px;
      border: 1px solid #e8e8e8;
      background-color: #fff;
      box-shadow: 0 1px 4px rgba(0, 0, 0, 0.27), 0 0 40px rgba(0, 0, 0, 0.08) inset;
      border-radius: 4px;
    }

    .m-signature-pad:before,
    .m-signature-pad:after {
      position: absolute;
      z-index: -1;
      content: "";
      width: 40%;
      height: 10px;
      left: 20px;
      bottom: 10px;
      background: transparent;
      -webkit-transform: skew(-3deg) rotate(-3deg);
      -moz-transform: skew(-3deg) rotate(-3deg);
      -ms-transform: skew(-3deg) rotate(-3deg);
      -o-transform: skew(-3deg) rotate(-3deg);
      transform: skew(-3deg) rotate(-3deg);
      box-shadow: 0 8px 12px rgba(0, 0, 0, 0.4);
    }

    .m-signature-pad:after {
      left: auto;
      right: 20px;
      -webkit-transform: skew(3deg) rotate(3deg);
      -moz-transform: skew(3deg) rotate(3deg);
      -ms-transform: skew(3deg) rotate(3deg);
      -o-transform: skew(3deg) rotate(3deg);
      transform: skew(3deg) rotate(3deg);
    }

    .m-signature-pad--body {
      position: absolute;
      left: 10px;
      right: 10px;
      top: 10px;
      bottom: 10px;
      border: 1px solid #f4f4f4;
    }

    .m-signature-pad--body canvas {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      border-radius: 4px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.02) inset;
    }

    @media screen and (max-width: 1024px) {
      .m-signature-pad {
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        /*width: 50%;
    height: auto;*/
        width: 100%;
        height: 180px;
        min-width: 100px;
        min-height: 100px;

      }

      #github {
        display: none;
      }
    }

    @media screen and (min-device-width: 768px) and (max-device-width: 1024px) {
      /* .m-signature-pad { */
      /*margin: 10%;*/
      /* } */
    }

    @media screen and (max-height: 320px) {
      .m-signature-pad--body {
        left: 0;
        right: 0;
        top: 0;
        bottom: 32px;
      }

      .m-signature-pad--footer {
        left: 20px;
        right: 20px;
        bottom: 4px;
        height: 28px;
      }

      .m-signature-pad--footer .description {
        font-size: 1em;
        margin-top: 1em;
      }
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
          <div class="card-body card-list">
            <div class="page-title" style="text-align:center">
              <h2>SALES QUOTATION</h2>
              <div class="alert alert-danger alert-dismissible fade show d-none" id="errorcheckout" role="alert">
                <strong>We're sorry but you cannot proceed to check out because your order doesn't meet the minimum order quantity</strong>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h5 class="text-center">Your Cart</h5>
                  </div>
                  <div class="card-body">

                    <?php
                    $resultcart = mysqli_query($con, "SELECT * FROM t_cart as a LEFT JOIN t_products as b ON a.product_id = b.product_id where a.guest_id = '$gid' order by a.cart_id desc");
                    while ($rowcart = mysqli_fetch_array($resultcart)) {
                      $price = $rowcart['price'];
                      $qty = $rowcart['qty'];
                      $total_cost = $price * $qty;
                      $total += $total_cost;
                      $totalqty += $rowcart['qty'];
                    ?>
                      <div class="card">
                        <div class="card-body">
                          <div class="info d-flex justify-content-between">
                            <img style="width:100px;height:100px" src="../admin/image/<?php echo $rowcart['product_img']; ?>" alt="">

                            <div class="product-info">
                              <span class="font-weight-bold"><?php echo $rowcart['product_code']; ?></span><br>
                              <span class="text-muted" style="font-size:14px;"><?php echo $rowcart['product_desc']; ?></span><br>
                              <!-- <span class="text-muted" style="font-size:12px;">Qty: <?php echo $rowcart['qty']; ?></span><br> -->
                              <input type="hidden" value="<?php echo $rowcart['cart_id']; ?>" id="cartid-<?php echo $rowcart['product_id'] ?>">
                              <input type="hidden" value="<?php echo $rowcart['product_id']; ?>" id="prodcodecart-<?php echo $rowcart['product_id'] ?>">


                              <!-- <button style="padding: 0 0 0 0;" class="btn btn-link text-success"  style="font-size:12px;">Change QTY</button> -->


                              <div class="input-group" style="width:150px;">
                                <span class="input-group-prepend">
                                  <button type="button" class="quantity-left-minus-<?php echo $rowcart['product_id']; ?> btn btn-default btn-number" data-type="minus" data-field="">
                                    <span class="fa fa-minus"></span>
                                  </button>
                                </span>
                                <input type="text" id="quantity-<?php echo $rowcart['product_id']; ?>" name="quantity" class="form-control input-number text-center" value="<?php echo $rowcart['qty']; ?>" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                <span class="input-group-append">
                                  <button type="button" class="quantity-right-plus-<?php echo $rowcart['product_id']; ?> btn btn-default btn-number" data-type="plus" data-field="">
                                    <span class="fa fa-plus"></span>
                                  </button>
                                </span>
                              </div>


                              <script>
                                $(document).ready(function() {

                                  // var quantitiy = 1;
                                  var cartid = $('#cartid-<?php echo $rowcart['product_id'] ?>').val();
                                  var prodcodecart = $('#prodcodecart-<?php echo $rowcart['product_id'] ?>').val();



                                  $('.quantity-right-plus-<?php echo $rowcart['product_id']; ?>').click(function(e) {
                                    e.preventDefault();
                                    var quantity = parseInt($('#quantity-<?php echo $rowcart['product_id']; ?>').val());
                                    $('#quantity-<?php echo $rowcart['product_id']; ?>').val(quantity + 1);

                                    var addqty = quantity + 1;


                                    $.ajax({
                                      url: "functions/updateco_qty.php",
                                      type: "post",
                                      data: {
                                        cartid: cartid,
                                        prodcodecart: prodcodecart,
                                        addqty: addqty
                                      },
                                      success: function(data) {

                                        location.reload();

                                        var dataParsed = JSON.parse(data);
                                        console.log(dataParsed);
                                      }
                                    });



                                  });

                                  $('.quantity-left-minus-<?php echo $rowcart['product_id']; ?>').click(function(e) {
                                    e.preventDefault();
                                    var quantity = parseInt($('#quantity-<?php echo $rowcart['product_id']; ?>').val());
                                    if (quantity > 1) {
                                      $('#quantity-<?php echo $rowcart['product_id']; ?>').val(quantity - 1);
                                      var addqty = quantity - 1;
                                      $.ajax({
                                        url: "functions/updateco_qty.php",
                                        type: "post",
                                        data: {
                                          cartid: cartid,
                                          prodcodecart: prodcodecart,
                                          addqty: addqty
                                        },
                                        success: function(data) {

                                          location.reload();

                                          var dataParsed = JSON.parse(data);
                                          console.log(dataParsed);
                                        }
                                      });
                                    }
                                  });

                                  // $("#quantity-<?php echo $rowcart['product_id']; ?>").on('change',function() {
                                  //   var addqty = $('#quantity-<?php echo $rowcart['product_id']; ?>').val();
                                  //   $.ajax({
                                  //       url: "functions/updateco_qty.php",
                                  //       type: "post",
                                  //       data: {
                                  //         cartid: cartid,
                                  //         prodcodecart: prodcodecart,
                                  //         addqty: addqty
                                  //       },
                                  //       success: function(data) {

                                  //         location.reload();

                                  //         var dataParsed = JSON.parse(data);
                                  //         console.log(dataParsed);
                                  //       }
                                  //     });
                                  // });

                                  $("#quantity-<?php echo $rowcart['product_id']; ?>").on('keyup',function(e) {
                                    var addqty = $('#quantity-<?php echo $rowcart['product_id']; ?>').val();
                                    if (e.key === 'Enter' || e.keyCode === 13){
                                      $.ajax({
                                        url: "functions/updateco_qty.php",
                                        type: "post",
                                        data: {
                                          cartid: cartid,
                                          prodcodecart: prodcodecart,
                                          addqty: addqty
                                        },
                                        success: function(data) {

                                          location.reload();

                                          var dataParsed = JSON.parse(data);
                                          console.log(dataParsed);
                                        }
                                      });
                                    }
                                 

                                  });


                                  // $('#quantity-<?php echo $rowcart['product_id']; ?>').on('change keydown paste input', function() {
                                  //   var addqty = $('#quantity-<?php echo $rowcart['product_id']; ?>').val();
                                  //   alert(addqty);
                                  //   $.ajax({
                                  //       url: "functions/updateco_qty.php",
                                  //       type: "post",
                                  //       data: {
                                  //         cartid: cartid,
                                  //         prodcodecart: prodcodecart,
                                  //         addqty: addqty
                                  //       },
                                  //       success: function(data) {

                                  //         location.reload();

                                  //         var dataParsed = JSON.parse(data);
                                  //         console.log(dataParsed);
                                  //       }
                                  //     });
                                  // });


                                  // const source = document.getElementById('quantity-<?php echo $rowcart['product_id']; ?>');
                                  // const inputResult = function(e) {
                                  //   alert('test')
                                  // }

                                  // source.addEventListener('input', inputResult);
                                  // source.addEventListener('propertychange', inputResult);

                                });
                              </script>






                            </div>
                            <div class="product-cost">
                              <span class="text-muted float-right" style="font-size:14px;">Php <?php echo number_format($rowcart['price'], 2); ?></span><br>
                              <span class="font-weight-bold float-right">Php <?php echo number_format($total_cost, 2); ?></span><br>

                              <div class="float-right">
                                <form method="POST">
                                  <input type="hidden" name="cart_id" value="<?php echo $rowcart['cart_id']; ?>">

                                  <button type="submit" name="btncartdelete" class="btn btn-link text-danger" style="font-size:12px;"><i class="fa fa-trash-alt"></i>&ensp;Delete</button>
                                </form>
                              </div>

                              <!-- <span class="text-danger float-right" style="font-size:12px;"><i class="fa fa-trash-alt"></i>&ensp;Delete</span><br> -->
                            </div>
                          </div>

                        </div>
                      </div>
                    <?php } ?>
                  </div>
                  <div class="card-footer ">
                    <div class="total-price d-flex justify-content-between">
                      <div class="total">
                        <span class="font-weight-bold">Total</span>
                      </div>
                      <div class="total2 float-right">
                        <input type="hidden" name="totalqty" id="totalqty" value=<?php echo $totalqty; ?>>
                        <span class="font-weight-bold text-right">Php. <?php echo number_format($total, 2); ?></span>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <label>Shipping Details</label>
                      <a href="" class="text-danger" data-toggle="modal" data-target="#ModalShipping">Edit</a>
                      <div class="modal fade" id="ModalShipping" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Select Shipping Address</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <?php
                              $resultsd2 = mysqli_query($con, "SELECT * FROM t_shipping_details 
                              as a 
                                left join t_city as b on a.sd_city = b.city_id
                                left join t_region as c on a.sd_region = c.region_id
                              where sd_account_id = '$aid' ");
                              while ($rowsd2 = mysqli_fetch_array($resultsd2)) {
                                $lastcityid = $rowsd2['sd_city'];
                                $lastcityname = $rowsd2['city_name'];
                              ?>
                                <div class="card ">
                                  <div class="card-body ">
                                    <div class="sd " id="sd-<?php echo $rowsd2['sd_id']; ?>">
                                      <span class="font-weight-bold"><?php echo $rowsd2['sd_fullname']; ?></span><br>
                                      <span class="text-muted"><?php echo $rowsd2['sd_address']; ?></span><br>
                                      <span class="text-muted"><?php echo $rowsd2['sd_address2']; ?></span><br>
                                      <span class="text-muted"><?php echo $rowsd2['sd_mobile']; ?></span><br>
                                    </div>
                                    <div class="sdedit hidden" id="sdedit-<?php echo $rowsd2['sd_id']; ?>">
                                      <form method="POST" id="edit-form-<?php echo $rowsd2['sd_id']; ?>">
                                        <input type="hidden" value="<?php echo $rowsd2['sd_id']; ?>" id="shipping-<?php echo $rowsd2['sd_id']; ?>">
                                        <input type="hidden" value="<?php echo $rowsd2['sd_city']; ?>" id="lastcityid-<?php echo $rowsd2['sd_id']; ?>">
                                        <div class="form-group">
                                          <label>Full Name</label>
                                          <input type="text" name="fullname" class="form-control" id="fullname-<?php echo $rowsd2['sd_id']; ?>" value="<?php echo $rowsd2['sd_fullname']; ?>">
                                        </div>
                                        <div class="form-group">
                                          <label>Complete Address</label>
                                          <input type="text" name="address" class="form-control" id="address-<?php echo $rowsd2['sd_id']; ?>" value="<?php echo $rowsd2['sd_address']; ?>">
                                          <br>
                                          <input type="text" name="address2" class="form-control" id="address2-<?php echo $rowsd2['sd_id']; ?>" value="<?php echo $rowsd2['sd_address2']; ?>">
                                        </div>
                                        <div class="form-group">
                                          <div class="row">
                                            <div class="col-6">
                                              <select name="region" id="regionedit-<?php echo $rowsd2['sd_id']; ?>" class="form-control select2bs4">
                                                <?php
                                                $getregion = mysqli_query($con, "SELECT * from t_region");
                                                while ($regionrow = mysqli_fetch_array($getregion)) {
                                                ?>
                                                  <option value="<?php echo $regionrow['region_id']; ?>"><?php echo $regionrow['region_name']; ?></option>
                                                <?php } ?>

                                              </select>
                                            </div>
                                            <div class="col-6">
                                              <select name="city" id="cityedit-<?php echo $rowsd2['sd_id']; ?>" class="form-control select2bs4">
                                                <option value="<?php echo $lastcityid ?>"><?php echo $lastcityname; ?></option>
                                              </select>
                                              <!-- <input type="text" class="form-control" value="<?php echo $rowsd2['sd_city']; ?>" name="cityedit-<?php echo $rowsd2['sd_id']; ?>" id="cityedit-<?php echo $rowsd2['sd_id']; ?>"> -->
                                            </div>
                                          </div>
                                        </div>



                                        <script>
                                          $(document).ready(function() {
                                            $('#regionedit-<?php echo $rowsd2['sd_id']; ?>').change(function(e) {
                                              e.preventDefault();
                                              var regiontype = $(this).val();
                                              $.ajax({
                                                url: 'getcity.php',
                                                type: 'GET',
                                                data: {
                                                  regiontype: regiontype
                                                },
                                                dataType: 'json',
                                                success: function(response) {
                                                  var len = response.length;
                                                  $('#cityedit-<?php echo $rowsd2['sd_id']; ?>').empty();
                                                  for (var i = 0; i < len; i++) {
                                                    var cityid = response[i]['city_id'];
                                                    var cityname = response[i]['city_name'];
                                                    $("#cityedit-<?php echo $rowsd2['sd_id']; ?>").append("<option value='" + cityid + "'>" + cityname + "</option>").trigger('change');
                                                  }
                                                }
                                              })
                                            })
                                          })
                                        </script>


                                        <div class="form-group">
                                          <div class="row">
                                            <div class="col-6">
                                              <label>Postal Code</label>
                                              <input type="text" name="postal" maxlength="4" class="form-control" id="postal-<?php echo $rowsd2['sd_id']; ?>" value="<?php echo $rowsd2['sd_postal']; ?>">
                                            </div>
                                            <div class="col-6">
                                              <label>Mobile Number</label>
                                              <input type="text" name="mobile" maxlength="11" class="form-control" id="mobile-<?php echo $rowsd2['sd_id']; ?>" value="<?php echo $rowsd2['sd_mobile']; ?>">
                                            </div>

                                          </div>

                                        </div>

                                        <div class="form-group">
                                          <button type="button" class="btn btn-danger hidden" id="btncancel-<?php echo $rowsd2['sd_id']; ?>"><i class="fa fa-times"></i>&ensp;Cancel</button>
                                          <button type="submit" class="btn btn-success" id="btnsave"><i class="fa fa-check"></i>&ensp;Save</button>
                                        </div>
                                      </form>
                                      <script>
                                        $(document).ready(function() {
                                          $('#edit-form-<?php echo $rowsd2['sd_id']; ?>').submit(function(e) {
                                            e.preventDefault();
                                            var shipping = $('#shipping-<?php echo $rowsd2['sd_id']; ?>').val();
                                            var fullname = $('#fullname-<?php echo $rowsd2['sd_id']; ?>').val();
                                            var address = $('#address-<?php echo $rowsd2['sd_id']; ?>').val();
                                            var mobile = $('#mobile-<?php echo $rowsd2['sd_id']; ?>').val();
                                            var region = $('#regionedit-<?php echo $rowsd2['sd_id']; ?>').val();
                                            var city = $('#cityedit-<?php echo $rowsd2['sd_id']; ?>').val();
                                            var address2 = $('#address2-<?php echo $rowsd2['sd_id']; ?>').val();
                                            var postal = $('#postal-<?php echo $rowsd2['sd_id']; ?>').val();
                                            var lastcity = $('lastcityid-<?php echo $rowsd2['sd_id']; ?>').val();

                                            //alert(fullname);
                                            $.ajax({
                                              url: "functions/edit_shipping.php",
                                              type: "post",
                                              data: {
                                                s_id: shipping,
                                                fullname: fullname,
                                                address: address,
                                                mobile: mobile,
                                                region: region,
                                                city: city,
                                                address2: address2,
                                                postal: postal,
                                                lastcity: lastcity

                                              },
                                              success: function(data) {
                                                //  $('.shipping_details').load('checkout.php .shipping_details');
                                                //  $('#sdedit-<?php //echo $rowsd2['sd_id']; 
                                                                ?>').addClass('hidden');
                                                // $('.product-table').load('index.php .product-table');
                                                // // $('.table-responsive').load('index.php .table-responsive');
                                                location.reload();

                                                var dataParsed = JSON.parse(data);
                                                console.log(dataParsed);
                                              }
                                            });
                                          });
                                        });
                                      </script>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                      <div class="delete" id="delete-<?php echo $rowsd2['sd_id']; ?>">
                                        <form method="POST">
                                          <input type="hidden" name="sd_id" value="<?php echo $rowsd2['sd_id']; ?>">
                                          <button type="submit" name="btndelete" class="btn btn-link text-danger"><i class="fa fa-trash-alt"></i>&ensp;Delete</button>
                                        </form>
                                      </div>
                                      <div class="edit">
                                        <form method="POST">
                                          <input type="hidden" name="sd_id" value="<?php echo $rowsd2['sd_id']; ?>">
                                          <button type="button" class="btn btn-link text-success" id="btnedit-<?php echo $rowsd2['sd_id']; ?>"><i class="fa fa-edit"></i>&ensp;Edit</button>
                                        </form>
                                        <script>
                                          $(document).ready(function() {
                                            $('#btnedit-<?php echo $rowsd2['sd_id']; ?>').click(function() {
                                              $('#sd-<?php echo $rowsd2['sd_id']; ?>').addClass('hidden');
                                              $('#sdedit-<?php echo $rowsd2['sd_id']; ?>').removeClass('hidden');
                                              $('#btnedit-<?php echo $rowsd2['sd_id']; ?>').addClass('hidden');
                                              $('#btncancel-<?php echo $rowsd2['sd_id']; ?>').removeClass('hidden');
                                              $('#delete-<?php echo $rowsd2['sd_id']; ?>').addClass('hidden');
                                              $('#default-<?php echo $rowsd2['sd_id']; ?>').addClass('hidden');
                                            });
                                            $('#btncancel-<?php echo $rowsd2['sd_id']; ?>').click(function() {
                                              $('#sd-<?php echo $rowsd2['sd_id']; ?>').removeClass('hidden');
                                              $('#sdedit-<?php echo $rowsd2['sd_id']; ?>').addClass('hidden');
                                              $('#btnedit-<?php echo $rowsd2['sd_id']; ?>').removeClass('hidden');
                                              $('#btncancel-<?php echo $rowsd2['sd_id']; ?>').addClass('hidden');
                                              $('#delete-<?php echo $rowsd2['sd_id']; ?>').removeClass('hidden');
                                              $('#default-<?php echo $rowsd2['sd_id']; ?>').removeClass('hidden');

                                            });
                                          });
                                        </script>
                                      </div>

                                      <?php
                                      if ($rowsd2['sd_default'] == 1) {
                                        echo '
                                                <div class="default" id="default-' . $rowsd2['sd_id'] . '">
                                                <form method="POST">
                                                <button type="submit" name="btndelete" class="btn btn-link text-muted" disabled><i class="fa fa-check"></i>&ensp;Default</button>
                                                </form>
                                                </div>
                                               
                                                ';
                                      } else { ?>
                                        <div class="default" id="default-<?php echo $rowsd2['sd_id']; ?>">
                                          <form method="POST">
                                            <input type="hidden" name="sd_id" value="<?php echo $rowsd2['sd_id']; ?>">
                                            <button type="submit" name="btndefault" class="btn btn-link text-info"><i class="fa fa-check"></i>&ensp;Set as default</button>
                                          </form>
                                        </div>

                                      <?php
                                      }
                                      ?>

                                    </div>

                                  </div>
                                </div>
                              <?php
                              }
                              ?>
                              <div class="card">
                                <div class="card-body  text-center">
                                  <button class="btn btn-link text-info" data-toggle="modal" data-target="#exampleModal" id="btnModal">Add Shipping Details</button>
                                </div>
                              </div>
                            </div>
                            <!-- <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div> -->
                          </div>
                        </div>
                      </div>
                    </div>

                    <script>
                      $(document).ready(function() {
                        $('#btnModal').click(function() {
                          $('#ModalShipping').modal('hide');
                        });
                      });
                    </script>

                    <div class="form-group">
                      <?php
                      $resultsd = mysqli_query($con, "SELECT * FROM t_shipping_details 
                        as a 
                        left join t_city as b on a.sd_city = b.city_id
                        left join t_region as c on a.sd_region = c.region_id
                      where sd_account_id = '$aid' AND sd_default = '1' ");
                      if (mysqli_num_rows($resultsd) == 1) {
                        $rowsd = mysqli_fetch_array($resultsd);
                        echo
                        '
                            <span class="">' . $rowsd['sd_fullname'] . '</span><br>
                            <span class="text-muted">' . $rowsd['sd_mobile'] . '</span><br>
                            <span class="text-muted">' . $rowsd['sd_address'] . '</span><br>
                            <span class="text-muted">' . $rowsd['sd_address2'] . '</span><br>
                            <span class="text-muted">' . $rowsd['city_name'] . ', ' . $rowsd['region_name'] . '</span><br>
                            
                            ';
                      } else {
                        echo
                        '<a href="" data-toggle="modal" data-target="#exampleModal">
                                Add Details
                            </a>';
                      }
                      ?>

                    </div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Shipping Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form method="POST">
                              <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="fullname" class="form-control">
                              </div>
                              <div class="form-group">
                                <label>Complete Address</label>
                                <input type="text" name="address" class="form-control">
                                <br>
                                <input type="text" name="address2" id="" class="form-control">
                              </div>
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-6">
                                    <select name="region" id="region" class="form-control select2bs4">
                                      <?php
                                      $getregion = mysqli_query($con, "SELECT * from t_region");
                                      while ($regionrow = mysqli_fetch_array($getregion)) {
                                      ?>
                                        <option value="<?php echo $regionrow['region_id']; ?>"><?php echo $regionrow['region_name']; ?></option>
                                      <?php } ?>

                                    </select>
                                  </div>
                                  <div class="col-6">
                                    <select name="city" id="city" class="form-control select2bs4">
                                    </select>
                                    <!-- <input type="text" name="city" id="city" class="form-control"> -->

                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-6">
                                    <label>Postal Code</label>
                                    <input type="text" name="postal" id="" maxlength="4" class="form-control">
                                  </div>
                                  <div class="col-6">
                                    <label>Mobile Number</label>
                                    <input type="text" name="mobile" maxlength="11" class="form-control">
                                  </div>
                                </div>

                              </div>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="btnadd">Add Details</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <form method="POST" action="payment_page.php" id="form_payment" enctype="multipart/form-data">

                  <div class="card">
                    <div class="card-body">
                      <?php
                      $resultsp = mysqli_query($con, "SELECT * FROM t_shipping_details where sd_account_id = '$aid' AND sd_default = '1'");
                      $rowsp = mysqli_fetch_array($resultsp);
                      ?>
                      <input type="hidden" name="shipping_id" value="<?php echo $rowsp['sd_id']; ?>">
                      <label>Payment Terms</label>
                      <div class="form-group">
                        <select class="form-control" name="payment_terms" id="payment_terms">
                          <option selected disabled>Please select</option>
                          <?php
                          $resultterms = mysqli_query($con, "SELECT * FROM t_payment_terms");
                          while ($rowterms = mysqli_fetch_array($resultterms)) {
                          ?>
                            <option value="<?php echo $rowterms['terms_id']; ?>"><?php echo $rowterms['terms_desc']; ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>


                    </div>
                  </div>

                  <div class="card div-payment">
                    <div class="card-body">
                      <label>Payment Method</label>
                      <div class="form-group">
                        <select class="form-control" name="payment_method" id="payment_method">

                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="card d-none" id="file_upload">
                    <div class="card-body">
                      <label>Upload File</label>
                      <div class="form-group">
                        <div class="file-upload">
                          <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>

                          <div class="image-upload-wrap">
                            <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" name="fileToUpload" id="imgInp" />
                            <div class="drag-text">
                              <h3>Drag and drop a file or select add Image</h3>
                            </div>
                          </div>
                          <div class="file-upload-content">
                            <img class="file-upload-image" src="#" alt="your image" />
                            <div class="image-title-wrap">
                              <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>



                  <!-- <div class="card">
                    <div class="card-body">
                      <label>Signature</label>
                      <div class="form-group">
                        <div class="container">
                          <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-lg-12">
                              <div id="signature-pad-1" class="m-signature-pad">
                                <div class="m-signature-pad--body">
                                  <canvas id="pad" class="pad"></canvas>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12" style="display:none;">
                              <img id="imgs" name="sign" src="http://via.placeholder.com/600x220" style="width:600px; height:220px" alt="">
                              <input id="SignupImage1" type="text" name="base64" />
                            </div>
                          </div>
                        </div>

                        <div class="m-signature-pad--footer d-flex justify-content-center align-items-center mt-3">
                          <button type="button" id='btnRest' class="btn btn-info"><i class="fa fa-undo"></i>&ensp;Clear</button>&nbsp;
                        </div>
                      </div>
                    </div>
                  </div> -->



              </div>

            </div>

          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button class="btn btn-success" disabled name="btncheckout" id="btncheckout">Proceed to Checkout</button>
            <!-- <input type="hidden" name="cmd" value="_xclick">
          <input type="hidden" name="business" value="sb-auspc6279168@business.example.com">
          <input type="hidden" name="lc" value="PH">
          <input type="hidden" name="button_subtype" value="services">
          <input type="hidden" name="no_note" value="1">
          <input type="hidden" name="no_shipping" value="1">
          <input type="hidden" name="currency_code" value="PHP">
          <input type="hidden" name="item_name" value="burat">
          <input type="hidden" name="return" value="http://localhost:8080/timber/customer/success.php">
          <input type="hidden" name="amount" value="<?php //echo $total; 
                                                    ?>">
          <input type="hidden" name="custom" value="<?php //echo $_SESSION['guest_id']; 
                                                    ?>">
          <input type="hidden" name="bn" value="PP-BuyNowBF:btn_paynowCC_LG.gif:NonHosted">-->
            </form>
          </div>
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
      $('#region').change(function(e) {
        e.preventDefault();
        var regiontype = $(this).val();
        $.ajax({
          url: 'getcity.php',
          type: 'GET',
          data: {
            regiontype: regiontype
          },
          dataType: 'json',
          success: function(response) {
            var len = response.length;
            $('#city').empty();
            for (var i = 0; i < len; i++) {
              var cityid = response[i]['city_id'];
              var cityname = response[i]['city_name'];
              $("#city").append("<option value='" + cityid + "'>" + cityname + "</option>").trigger('change');
            }
          }
        })
      })
    })
  </script>


  <script>
    $(document).ready(function() {
      var totalamout = $('#totalqty').val();
      if (totalamout > 999) {
        $('#btncheckout').removeAttr("disabled", "false");

      } else {
        $('#errorcheckout').removeClass('d-none');
        $('#btncheckout').attr("disabled", "true");
      }
    })
  </script>
  <script>
    $(document).ready(function() {
      $('#payment_terms').on('change', function() {
        var payment = $(this).val();
        if (payment == 1) {
          $('#payment_method').empty();
          $('#payment_method').append('<option selected value="paypal">Paypal</option>').trigger('change');
          $('#payment_method').append('<option value="check">Check (Open & Post Dated)</option>');
          $('#payment_method').append('<option value="bank_transfer">Bank Transfer</option>');
          $('.div-payment').addClass('d-block');
          $('.div-payment').removeClass('d-none');
        } else if (payment == 2) {
          $('#payment_method').empty();
          $('#payment_method').append('<option selected value="cod">Cash On Delivery</option>').trigger('change');
          $('.div-payment').addClass('d-block');
          $('.div-payment').removeClass('d-none');
          $('#file_upload').addClass('d-none');
          $('#imgInp').prop('required', false);

        } else if (payment == 3) {
          $('#payment_method').empty();
          $('#payment_method').append('<option selected value="none"></option>').trigger('change');
          $('.div-payment').addClass('d-none');
          $('.div-payment').removeClass('d-block');
          $('#file_upload').addClass('d-none');
          $('#imgInp').prop('required', false);

        } else if (payment == 4) {
          $('#payment_method').empty();
          $('#payment_method').append('<option selected value="none"></option>').trigger('change');
          $('.div-payment').addClass('d-none');
          $('.div-payment').removeClass('d-block');
          $('#file_upload').addClass('d-none');
          $('#imgInp').prop('required', false);

        }
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#payment_method').change(function(e) {
        var pm = $(this).val();
        if (pm == 'paypal') {
          $('#file_upload').addClass('d-none');
          $('#imgInp').prop('required', false);

        } else if (pm == 'check') {
          $('#file_upload').removeClass('d-none');
          $('#imgInp').prop('required', true);

        } else if (pm == 'bank_transfer') {
          $('#file_upload').removeClass('d-none');
          $('#imgInp').prop('required', true);

        }

      });
    });
  </script>

  <script>
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $(".image-upload-wrap").hide();

          $(".file-upload-image").attr("src", e.target.result);
          $(".file-upload-content").show();

          $(".image-title").html(input.files[0].name);
        };

        reader.readAsDataURL(input.files[0]);
      } else {
        removeUpload();
      }
    }

    function removeUpload() {
      $(".file-upload-input").replaceWith($(".file-upload-input").clone());
      $(".file-upload-content").hide();
      $(".image-upload-wrap").show();
    }
    $(".image-upload-wrap").bind("dragover", function() {
      $(".image-upload-wrap").addClass("image-dropping");
    });
    $(".image-upload-wrap").bind("dragleave", function() {
      $(".image-upload-wrap").removeClass("image-dropping");
    });
  </script>
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <script>
    var wrapper1 = document.getElementById("signature-pad-1"),
      canvas1 = wrapper1.querySelector("canvas"),
      signaturePad1;

    function resizeCanvas(canvas) {
      var ratio = window.devicePixelRatio || 1;
      canvas.width = canvas.offsetWidth * ratio;
      canvas.height = canvas.offsetHeight * ratio;
      canvas.getContext("2d").scale(ratio, ratio);
    }

    $(window).on("load", function() {
      resizeCanvas(canvas1);
      signaturePad1 = new SignaturePad(canvas1, {
        backgroundColor: 'rgb(0,0,0,0)',

        onBegin: function() {
          console.log('onbegin');
        },
        onEnd: function() {
          console.log('onEnd');
          var data = signaturePad1.toDataURL('image/png');
          $('#SignupImage1').val(data);

          var data_uri = signaturePad1.toDataURL();
          //convert to base64         
          var base64Data = data_uri.replace(/^data:image\/\w+;base64,/, "");
          $("#imgs").attr("src", data_uri);

        }
      });

      //var saveButton1 = document.getElementById('btnSubmit');
      var clearButton1 = document.getElementById('btnRest');

      //saveButton1.addEventListener('click', function (event) {
      // var data = signaturePad1.toDataURL('image/png');
      //console.log(data);
      //window.open(data);
      // $('#SignupImage1').val(data);
      // });

      clearButton1.addEventListener('click', function(event) {
        signaturePad1.clear();
      });



    })
  </script>
</body>

</html>