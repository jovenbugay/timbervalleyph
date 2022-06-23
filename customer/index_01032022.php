<?php
session_start();
include('../db/connect.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home - Timber Valley PH</title>
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

    .card {
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.50);
    }

    .btn-primary {
      background-color: #004d38 !important;
      border: 0 !important;
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
              <h2 class="test">HOME</h2>
            </div>
            <div class="search-bar mb-4">
              <input type="text" class="form-control" placeholder="Search products">
            </div>
            <div class="mb-3">
              <h4>Popular</h4>
            </div>
            <div class="row no-gutters mx-n2">

              <?php
              $result = mysqli_query($con, "SELECT * FROM t_products ");
              while ($row = mysqli_fetch_array($result)) {
                $product_status = $row['product_status'];
                if ($product_status == '0') {
                  $disabled = 'disabled';
                  $status = '<span class="badge badge-danger">Out of Stock</span>';
                } else if ($product_status == '1') {
                  $disabled = '';
                  $status = '<span class="badge badge-success">In Stock</span>';
                }
              ?>

                <div class="col-lg-3 col-md-6 col-6 mb-4 px-2 mb-3 ">
                  <div class="card product-card card-static pb-3">

                    <a class="card-img-top d-block overflow-hidden" href="#">
                      <img src="../admin/image/<?php echo $row['product_img']; ?>" alt="Product" class=" imgfilter" /></a>
                    <div class="card-body py-2">
                      <div class="product-info">
                        <span class="product-meta d-block font-size-xs pb-1" href="#"><?php echo $row['product_code']; ?></span>
                        <span class="product-title font-size-sm overflow-hidden font-weight-bold"><?php echo $row['product_desc']; ?></span><br>
                        <?php echo $status; ?>
                      </div>

                      <div class="mt-3">
                        <button class="btn btn-primary" style="width:100%" type="button" data-toggle="modal" data-target="#exampleModal-<?php echo $row['product_id']; ?>" <?php echo $disabled; ?>>Add to cart</button>
                      </div>


                      <div class="modal fade" id="exampleModal-<?php echo $row['product_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><?php echo $row['product_code']; ?></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="img-modal d-flex justify-content-center align-content-center mb-5">
                                <img src="../admin/image/<?php echo $row['product_img']; ?>" width="200" height="200">
                              </div>

                              <div class="prodinfo-modal d-flex justify-content-between">
                                <h4><?php echo $row['product_code']; ?></h4>
                                <span class="text-muted" style="font-size:20px;">&#8369; <?php echo number_format($row['product_price'], 2); ?></span>
                              </div>
                              <div class="prodinfo2-modal">
                                <span class="text-muted"><?php echo $row['product_desc']; ?></span>
                              </div>

                              <form method="POST" id="cart_form2-<?php echo $row['product_id']; ?>">
                                <div class="d-flex product-btn mb-3">

                                  <input type="hidden" id="account_id-<?php echo $row['product_id']; ?>" name="account_id" value="<?php echo $_SESSION['customer_id']; ?>">
                                  <input type="hidden" id="guest_id-<?php echo $row['product_id']; ?>" name="guest_id" value="<?php echo $_SESSION['guest_id']; ?>">
                                  <input type="hidden" id="prod_id-<?php echo $row['product_id']; ?>" name="prod_id" value="<?php echo $row['product_id']; ?>">
                                  <input type="hidden" id="prod_price-<?php echo $row['product_id']; ?>" name="prod_price" value="<?php echo $row['product_price']; ?>">
                                </div>



                            </div>
                            <div class="modal-footer d-flex justify-content-lg-between">
                              <div class="input-group" style="width:200px;">
                                <span class="input-group-prepend">
                                  <button type="button" class="quantity-left-minus-<?php echo $row['product_id']; ?> btn btn-default btn-number" data-type="minus" data-field="">
                                    <span class="fa fa-minus"></span>
                                  </button>
                                </span>
                                <!-- <input type="text" id="quantity-<?php echo $row['product_id']; ?>" name="quantity" class="form-control input-number text-center" value="1"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"> -->
                                <input type="text" id="quantity-<?php echo $row['product_id']; ?>" name="quantity" class="form-control input-number text-center" value="1" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                <span class="input-group-append">
                                  <button type="button" class="quantity-right-plus-<?php echo $row['product_id']; ?> btn btn-default btn-number" data-type="plus" data-field="">
                                    <span class="fa fa-plus"></span>
                                  </button>
                                </span>
                              </div>
                              <button type="submit" class="btn btn-primary">Add to Cart</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- <input type="number" id="qty-" name="qty" class="form-control float-right qtyw" value="1" min="1" style="" min="1" required>-->
                    </div>

                  </div>
                </div>


                <script>
                  $(function() {
                    $('#cart_form2-<?php echo $row['product_id']; ?>').submit(function(ee) {

                      Swal.fire({

                        icon: 'success',
                        title: 'Added to Cart',
                        text: 'Thank you for ordering',
                        showConfirmButton: false,
                        timer: 1500
                      })
                      ee.preventDefault();
                      var prod_id2 = $('#prod_id-<?php echo $row['product_id']; ?>').val();
                      var guest2 = $('#guest_id-<?php echo $row['product_id']; ?>').val();
                      var account2 = $('#account_id-<?php echo $row['product_id']; ?>').val();
                      var qty2 = $('#quantity-<?php echo $row['product_id']; ?>').val();
                      var price2 = $('#prod_price-<?php echo $row['product_id']; ?>').val();
                      //$('#qty-'+prod_id2+'').val('1');
                      //alert(prod_id2);

                      $.ajax({
                        url: "functions/add_cart.php",
                        type: "post",
                        data: {
                          account_id: account2,
                          guest_id: guest2,
                          prod_id: prod_id2,
                          qty: qty2,
                          price: price2
                        },
                        success: function(data) {
                          $('.notif-count').load('index.php .notif-count');
                          $('.product-table').load('index.php .product-table');
                          // $('.table-responsive').load('index.php .table-responsive');
                          $('#exampleModal-<?php echo $row['product_id']; ?>').modal('hide');

                          var dataParsed = JSON.parse(data);
                          console.log(dataParsed);
                        }
                      });
                    });
                  });
                </script>
                <script>
                  $(document).ready(function() {

                    var quantitiy = 1;
                    $('.quantity-right-plus-<?php echo $row['product_id']; ?>').click(function(e) {
                      e.preventDefault();
                      var quantity = parseInt($('#quantity-<?php echo $row['product_id']; ?>').val());
                      $('#quantity-<?php echo $row['product_id']; ?>').val(quantity + 1);
                    });

                    $('.quantity-left-minus-<?php echo $row['product_id']; ?>').click(function(e) {
                      e.preventDefault();
                      var quantity = parseInt($('#quantity-<?php echo $row['product_id']; ?>').val());
                      if (quantity > 1) {
                        $('#quantity-<?php echo $row['product_id']; ?>').val(quantity - 1);
                      }
                    });

                  });
                </script>
              <?php } ?>


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