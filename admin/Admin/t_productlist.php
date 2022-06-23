   <?php include 'header/head.php';?>
   <?php include 'sidebar/sidebar_menu.php';?>

   <style>
   .ln_solid {
  border-top: 1px solid #e5e5e5;
  color: #ffffff;
  background-color: #ffffff;
  height: 1px;
  margin: 20px 0; }


  .zoom {
  /* padding: 50px; */
  /* background-color: green; */
  transition: transform .2s; /* Animation */
  width: 200px;
  height: 200px;
  margin: 0 auto;
}

.zoom:hover {
  transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}

</style>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row" >
          <div class="col-12">
            <div class="card" >
              <!-- /.card-header -->
              <div class="card-header">
                <h3 class="card-title" style="float: right;"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-overlay">
                  Add Product
                </button></h3>
                <?php include 'modal/addcorporate_modal.php';?>
              </div>
              <div class="card-body" >
              <?php 
              	if(isset($_POST['prod'])){
      
                  // $corporate_name = $phdb->real_escape_string($_POST['corporate_name']);
                  $prodcode = $_POST['prodcode'];
                  $proddesc = $_POST['proddesc'];
                  $prodprice = $_POST['prodprice'];
                  // $image = $_POST['image'];
                  
            
            
              $query2=mysqli_query($con,"select * from t_products where product_code='$prodcode'")or die(mysqli_error($con));
                $count=mysqli_num_rows($query2);
            
                if ($count>0)
                {
                  // echo json_encode(array("status" => "failed"));
                  // echo "<script type='text/javascript'>alert('Product already exist!');</script>";
                  // echo "<script>document.location='../t_productlist.php'</script>";  
                  echo '
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Product Already Exist</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  ';
                }
                else
                {	
                  
            
                  $pic = $_FILES["image"]["name"];
                  if ($pic=="")
                  {
                    $pic="default.png";
                  }
                  else
                  {
            
                    $pic = $_FILES["image"]["name"];
                    $type = $_FILES["image"]["type"];
                    $size = $_FILES["image"]["size"];
                    $temp = $_FILES["image"]["tmp_name"];
                    $error = $_FILES["image"]["error"];
                  
                    if ($error > 0){
                      die("Error uploading file! Code $error.");
                      }
                    else{
                      if($size > 100000000000) //conditions for the file
                        {
                        die("Format is not allowed or file size is too big!");
                        }
                    else
                          {
                            // move_uploaded_file($temp, '..//image/'.$pic);
                            move_uploaded_file($temp, "../../image/".$pic);
            
                            
                          }
                      }
                  }	
           
                  $result = mysqli_query($con,"INSERT INTO t_products
                  (product_code,product_desc,product_price,product_status,product_img)
                  VALUES('$prodcode','$proddesc',$prodprice,'1','$pic')");
                  // echo json_encode(array("status" => "success"));
            
              // 		echo "<script type='text/javascript'>alert('Successfully added new product!');</script>";
                //   echo '<script>window.location = "../t_productlist.php"</script>';
                  if($result){
                    echo '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Added Successfully</strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    ';
                  }
                  else {
                    echo '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Insert Failed</strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    ';
                  }
                 
              
                }
              }
           
                
              
              ?>
                <table id="example1" class="table table-bordered table-striped" >
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Product Code</th>
                    <th>Product Description</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                       include('include/access/connector.php');
                      // $result = $phdb->query("SELECT * FROM `t_products`");
                      // // if($result->num_rows === 0) echo'<div class="alert alert-warning" role="alert">No Record Found!!!</div>';
                      //  while ($row = $result->fetch_array()){

                        $query0=mysqli_query($con,"SELECT * FROM t_products order by product_id desc")or die(mysqli_error());
                        while($row0=mysqli_fetch_array($query0)){
                          $id=$row0['product_id'];
                          
                      ?>
                      <tr>
                        <!-- <td><img style="width:80px;height:60px" src="../dist/uploads/<?php echo $row0['product_img'];?>"</td> -->
                        <td><img style="width:40px;height:40px" src="../image/<?php echo $row0['product_img'];?>"></td>
                        <td><?php echo $row0['product_code'];?></td>
                        <td><?php echo $row0['product_desc'];?></td>
                        <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-edit<?php echo $id;?>">Edit</button> | <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete<?php echo $id;?>">Delete</button></td>
                         <?php include 'modal/editcorporate_modal.php';?>
                         <?php include 'modal/deleteproduct_modal.php';?>
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

<!-- <script src="../Employee/plugins/jquery/jquery.min.js"></script> -->
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
