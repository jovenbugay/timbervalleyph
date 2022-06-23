<title>Payment Terms</title>
<?php include 'header/head.php';?>
   <?php include 'sidebar/sidebar_menu.php';?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
            
              <!-- /.card-header -->
              <div class="card-header">
                <h3 class="card-title" style="float: right;"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-overlay">
                  Add Payment Terms
                </button></h3>
                <?php include 'modal/addterm_modal.php';?>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Payment Terms</th>
                    <th>Description</th>
                    <th>Discount</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                       include('include/access/connector.php');
                       $query0=mysqli_query($con,"SELECT * FROM t_payment_terms")or die(mysqli_error());
                        while($row=mysqli_fetch_array($query0)){
                          $id = $row['terms_id'];
                          
                      ?>
                          
                      
                      <tr>
                        <td><?php echo $row['terms_id'];?></td>
                        <td><?php echo $row['terms_name'];?></td>
                        <td><?php echo $row['terms_desc'];?></td>
                        <td><?php echo $row['terms_discount'];?></td>
                        <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-edit<?php echo $id;?>">Edit</button> | <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete<?php echo $id;?>">Delete</button></td>
                        <?php include 'modal/editterms_modal.php';?>
                         <?php include 'modal/deleteterms_modal.php';?>
                         
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
  $(function () {
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
