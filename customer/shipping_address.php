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


?>

<?php
if (isset($_POST['btnadd'])) {
  $fullname = $_POST['fullname'];
  $account = $_SESSION['customer_id'];
  $address = $_POST['address'];
  $mobile = $_POST['mobile'];
  $region = $_POST['region'];
  $city = $_POST['city'];
  $postal = $_POST['s_postal'];
  $resultaddup2 = mysqli_query($con, "UPDATE t_shipping_details SET sd_default = '0' where sd_account_id = '$account' ");
  $resultadd = mysqli_query($con, "INSERT INTO t_shipping_details (sd_account_id,sd_fullname,sd_address,sd_mobile,sd_default,sd_region,sd_city,sd_postal) VALUES ('$account','$fullname','$address','$mobile','1','$region','$city','$postal') ");
  header('location:shipping_address.php');
}
?>

<?php
if (isset($_POST['btndefault'])) {
  $sd_id = $_POST['sd_id'];
  $account = $_SESSION['customer_id'];
  $resultaddup = mysqli_query($con, "UPDATE t_shipping_details SET sd_default = '0' where sd_account_id = '$account' ");
  $resultdefault = mysqli_query($con, "UPDATE t_shipping_details SET sd_default = '1' where sd_account_id = '$account' and sd_id = '$sd_id' ");
  header('location:shipping_address.php');
}

?>

<?php
if (isset($_POST['btndelete'])) {
  $sd_id = $_POST['sd_id'];
  $resultdelete = mysqli_query($con, "DELETE FROM t_shipping_details where sd_id = '$sd_id' ");
  header('location:shipping_address.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shipping Address - Timber Valley PH</title>
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

    .hidden {
      display: none;
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
                    <h4>Shipping Address</h4>
                  </div>
                  <div class="card-body">
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
                            <span class="text-muted"><?php echo $rowsd2['sd_mobile']; ?></span><br>
                            <span class="text-muted"><?php echo $rowsd2['city_name'] .', '. $rowsd2['region_name'] ; ?> </span><br>
                          </div>
                          <div class="sdedit hidden" id="sdedit-<?php echo $rowsd2['sd_id']; ?>">
                            <form method="POST" id="edit-form-<?php echo $rowsd2['sd_id']; ?>">
                              <input type="hidden" value="<?php echo $rowsd2['sd_id']; ?>" id="shipping-<?php echo $rowsd2['sd_id']; ?>">
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
                              <input type="text" class="form-control" disabled value="Philippines">
                              </div>

                              <div class="form-group">
                                <div class="row">
                                  <div class="col-6">
                                    <select name="regionedit" class="form-control" id="regionedit-<?php echo $rowsd2['sd_id']; ?>" >
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
                                    <!-- <input type="text" name="cityedit" id="cityedit-<?php echo $rowsd2['sd_id']; ?>" class="form-control" placeholder="City" value="<?php echo $rowsd2['sd_city']; ?>"> -->
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-6">
                                  <label>Postal Code</label>
                                <input type="text" name="postaledit" maxlength="5" class="form-control" id="postaledit-<?php echo $rowsd2['sd_id']; ?>" value="<?php echo $rowsd2['sd_postal']; ?>">
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
                                  var postal = $('#postaledit-<?php echo $rowsd2['sd_id']; ?>').val();
                                  var address2 = $('#address2-<?php echo $rowsd2['sd_id']; ?>').val();

                                  //alert(fullname);
                                  $.ajax({
                                    url: "functions/edit_shipping.php",
                                    type: "post",
                                    data: {
                                      s_id: shipping,
                                      fullname: fullname,
                                      address: address,
                                      mobile: mobile,
                                      region:region,
                                      city:city,
                                      postal:postal,
                                      address2:address2
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
                                <input type="text" name="country" id="" class="form-control" disabled value="Philippines">
                              </div>
                              <div class="from-group">
                                <div class="row">
                                  <div class="col-6">
                                  <select name="region" id="region" class="form-control select2bs4">
                                    <option value="" disabled>Region</option>
                                      <?php
                                      $getregion = mysqli_query($con, "SELECT * from t_region");
                                      while ($regionrow = mysqli_fetch_array($getregion)) {
                                      ?>
                                        <option value="<?php echo $regionrow['region_id']; ?>"><?php echo $regionrow['region_name']; ?></option>
                                      <?php } ?>

                                    </select>
                                  </div>
                                  <div class="col-6">
                                    <!-- <input type="text" name="s_city" id="" class="form-control" placeholder="City"> -->
                                    <select name="city" id="city" class="form-control select2bs4">
                                    <option value="" disabled>City</option>
                                    </select>
                                  </div>
                                </div>
                              </div>

                              <div class="form-group">
                                <br>
                                <div class="row">
                                  <div class="col-6">
                                    <label>Postal Code</label>
                                    <input type="text" name="s_postal" maxlength="5" class="form-control">
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
                  <!-- <div class="card-footer ">
                            <button class="btn btn-success float-right">Save Changes</button>
                        </div> -->
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