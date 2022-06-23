<title>User Accounts</title>
<?php include 'header/head.php'; ?>
<?php include 'sidebar/sidebar_menu.php'; ?>
<?php
session_start();
$accesstype = $_SESSION['access'];
?>
<style>
  .ln_solid {
    border-top: 1px solid #e5e5e5;
    color: #ffffff;
    background-color: #ffffff;
    height: 1px;
    margin: 20px 0;
  }

  h5 {
    display: block;
    font-size: 18px;
    margin-top: 5px;
    margin-bottom: 0.83em;
    margin-left: 0;
    margin-right: 0;
    /* font-weight: regular; */
  }

  .form-control:focus {
    border: 1px solid green !important;

  }
</style>
<div class="cointainer">
  <div class="main_container">
    <div class="right_col" role="main">
      <div class="row m-1">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">

              <div class="filter">
                <h5><b>Customer</b></h5>

                <hr>
              </div>

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>User No.</th>
                    <th>Full Name</th>
                    <th>Email Address</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th>Action</th>
                 
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include('include/access/connector.php');
             

                  $query0 = mysqli_query($con, "SELECT * FROM t_customers order by customer_id desc") or die(mysqli_error($con));
                  while ($row0 = mysqli_fetch_array($query0)) {
                    $id = $row0['id'];
                    $access = $row0['access'];

                  ?>
                    <tr>

                      <td><?php echo $row0['customer_id']; ?></td>
                      <td><?php echo $row0['customer_fname'] . " " . $row0['customer_lname']; ?></td>
                      <td><?php echo $row0['customer_email']; ?></td>
                      <td><?php echo $row0['customer_username']; ?></td>
                      <td><?php
                          if ($row0['deleted'] == "1") {
                            echo 'Deleted';
                          } else if ($row0['deleted'] == "0") {
                            echo 'Active';
                          }
                          ?></td>
                      <td>
                     

                      </td>
                      <?php include 'modal/edituser_modal.php'; ?>
                      <?php include 'modal/deleteuser_modal.php'; ?>
                      <?php include 'modal/restoreuser_modal.php'; ?>
                    </tr>

                  <?php  } ?>
            </div>
            <div class="card-footer">

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


    </div>
  </div>
</div>





<script src="../Superadmin_Dashboard/plugins/jquery/jquery.min.js"></script>
<script src="../Superadmin_Dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../Superadmin_Dashboard/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../Superadmin_Dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../Superadmin_Dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../Superadmin_Dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

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