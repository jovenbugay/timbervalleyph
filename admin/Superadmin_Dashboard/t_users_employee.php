
<?php include 'header/head.php';?>
   <?php include 'sidebar/sidebar_menu.php';?>
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
  margin: 20px 0; }
  h5{ 
  display: block;
  font-size: 18px;
  margin-top: 5px;
  margin-bottom: 0.83em;
  margin-left: 0;
  margin-right: 0;
  /* font-weight: regular; */
}

.form-control:focus{
border: 1px solid green !important;

}

   </style>
<div class="cointainer">
    <div class="main_container">
      <div class="right_col" role="main">
        <div class="row m-1">
          <div class="col-lg-4">
            <div class="card">
              <!-- <div class="card-header">
              <h5>Select Filter <i class = "fa fa-filter"></i></h5>
              </div> -->
              <div class="card-body">
              <div class="filter">
              <h5>Add User <i class = "fa fa-users" style = "color:blue;" ></i></h5>
              <hr>
              <form method="POST" enctype = "multipart/form-data" action = "process/add_user.php">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                    <label>First Name:</label>
                    <input type="text" name = "fname" id = "password" class="form-control " required >                
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                    <label>Last Name:</label>
                    <input type="text" name = "lname" id = "password" class="form-control" required >
                    </div>
                </div>
            </div>

            <div class="form-group">
                  <label>Email:</label>
                  <input type="email" name = "uemail" id = "password" class="form-control" required >
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                    <label>Username:</label>
                  <input type="text" name = "username" id = "username" class="form-control" required>               
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                    <label>Password:</label>
                  <input type="password" name = "password" id = "password" class="form-control" required >
                    </div>
                </div>
            </div>

             
                <div class="form-group">
                  
                  
                 
                  
                  <label>Access Type:</label>
                  
                  <select name="useraccess" class="form-control" required>
                            <option value="" disabled="disabled" selected="selected">Select Access Type</option>
                            <!-- admin - 1 employee 2 -->
                            <option value="1">Admin</option>
                            <option value="2">Employee</option>
                            <!-- <option value="HR Assistant">&rarr; HR Assistant</option> -->
                        </select>
                        


                  <hr>
                  <button type="submit" name = "display" class="btn btn-block btn-primary"><i class = "fa fa-save"></i> Save</button>
                </div>

              </form>
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

          <div class="col-lg-8">
            <div class="card">    
                <div class="card-body">

                <div class="filter">
                <h5><b>Sales Report</b></h5>
                <!-- <h5><b>Sales Report From <?php echo date("M d, Y",strtotime($datefrom))." to ".date("M d, Y",strtotime($dateto));?></b></h5> -->
                <hr>
                </div>
    
                <!-- <table id="example1" class="table table-striped table-bordered nowrap"> -->
                <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>User No.</th>
                          <th>Full Name</th>
                          <th>Email Address</th>
                          <th>Username</th>
                          <th>Password</th>
                          <th>Access Level</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include('include/access/connector.php');
                      // $result = $phdb->query("SELECT * FROM `t_products`");
                      // // if($result->num_rows === 0) echo'<div class="alert alert-warning" role="alert">No Record Found!!!</div>';
                      //  while ($row = $result->fetch_array()){

                        $query0=mysqli_query($con,"SELECT * FROM t_users order by id desc")or die(mysqli_error());
                        while($row0=mysqli_fetch_array($query0)){
                          $id=$row0['id'];
                          $access=$row0['access'];
                          
                      ?>
                      <tr>
                       
                        <td><?php echo $row0['id'];?></td>
                        <td><?php echo $row0['fname']. " " .$row0['lname'];?></td>
                        <td><?php echo $row0['email'];?></td>
                        <td><?php echo $row0['username'];?></td>
                        <td>••••••••••</td>
                        <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-edit<?php echo $id;?>">Edit</button> | <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete<?php echo $id;?>">Delete</button></td>
                         <?php include 'modal/edituser_modal.php';?>
                         <?php include 'modal/deleteproduct_modal.php';?>
                      </tr>

                     <?php  } ?>
                </div>
                <div class="card-footer">
                
                </div>
              </div>
          </div>
         </div>
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