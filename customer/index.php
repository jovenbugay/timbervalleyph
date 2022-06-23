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

  <script src="dist/js/jquery-ui.js"></script>
  <script src="dist/js/jquery-1.10.2.min.js"></script>
  <link rel="stylesheet" href="dist/css/jquery-ui.css">
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
    .card-img-top{
      cursor:default;
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

          <div class="card-body card-list">
            <div class="page-title" style="text-align:center">
              <h2 class="test">HOME</h2>
            </div>
            <div class="list-group">
              <div class="search-bar mb-4">
                <input type="hidden" id="custid" value="<?php echo $_SESSION['customer_id'];?>">
                <input type="hidden" id="guestid" value="<?php echo $_SESSION['guest_id'];?>">
                <input type="text" class="form-control" id="searchprod" placeholder="Search products">
              </div>
            </div>

            
            <!-- <div class="row no-gutters mx-n2">

              
            </div> -->
    
    
              <div class="row filter_data">

           


              
              </div>
         
        




            <!-- <div class="row no-gutters mx-n2">



            </div> -->
          </div>


        </div>


      </section>

    </div>

   


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

      filter_data();

      function filter_data() {
        
        var action = 'fetch_data';
        var searchprod = $('#searchprod').val();
        var custid = $('#custid').val();
        var guestid = $('#guestid').val();




        $.ajax({
          url: "fetch_data.php",
          method: "POST",
          data: {
            action: action,
            searchprod: searchprod,
            custid:custid,
            guestid:guestid
          },
          success: function(data) {
            $('.filter_data').html(data);


          }
        });
      }

      // $('#searchprod').change(function() {
      //   filter_data();
      // });



      const source = document.getElementById('searchprod');
const inputResult = function(e){
  filter_data();
}

source.addEventListener('input', inputResult);
source.addEventListener('propertychange', inputResult);
   

     

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
</body>

</html>