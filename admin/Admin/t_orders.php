<?php include 'header/head.php';?>
   <?php include 'sidebar/sidebar_menu.php';?>
<style>
h5 {
  display: block;
  font-size: 30px;
  margin-top: 0.67em;
  margin-bottom: 0.67em;
  margin-left: 0;
  margin-right: 0;
  font-weight: bold;
}
h2 {
  display: block;
  font-size: 14px;
  margin-top: 0.67em;
  margin-bottom: 0.67em;
  margin-left: 0;
  margin-right: 0;
  font-weight: bold;
}


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

    .table td,th{
        font-size:14px;
    }

    .hidden{
      display:none;
    }
    





</style>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-header">
                <!-- <h3 class="card-title" style="float: right;"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-overlay">
                  Add Branches
                </button></h3> -->
                <?php include 'modal/addbranches_modal.php';?>
              </div>
              <div class="card-body">
              <table id="example1" class="table table-hover table-nowrap">
                <thead>
                <tr>
                  <th>Order #</th>
                  <th>Name</th>
                 
                  <th>Contact</th>
                  <th>Status</th>
                 
                </tr>
              </thead>
              <tbody>
              <?php
              $result = mysqli_query($con,"SELECT * FROM t_order_details as a 
              LEFT JOIN t_shipping_details as b ON a.order_shipping_id = b.sd_id
              LEFT JOIN t_payment_terms as c ON a.order_payment_terms = c.terms_id ORDER BY a.order_id DESC ");
              while($row = mysqli_fetch_array($result))
              {
                $guest_id = $row['order_guest_id'];
                $orderid = $row['order_id']
              ?>
              
                <tr data-toggle="modal" data-target=".bd-example-modal-lg-<?php echo $row['order_id']; ?>">
                  <td><?php echo $row['order_id']; ?></td>
                  <td><?php echo $row['sd_fullname']; ?></td>
                  
                  <td><?php echo $row['sd_mobile']; ?></td>
                  <td>
                    <?php
                    if($row['order_status'] == '1'){
                      echo '<h6><span class="badge badge-primary">Pending</span></h6>';
                    }
                    else if($row['order_status'] == '2'){
                      echo '<h6><span class="badge badge-warning">Processing</span></h6>';
                    }
                    else if($row['order_status'] == '3'){
                      echo '<h6><span class="badge badge-info">In Transit</span></h6>';
                    }
                    else if($row['order_status'] == '4'){
                      echo '<h6><span class="badge badge-success">Completed</span></h6>';
                    } else if($row['order_status'] == '0'){
                        echo '<h6><span class="badge badge-danger">Failed</span></h6>';
                    }
                    else if($row['order_status'] == '9'){
                      echo '<h6><span class="badge badge-danger">Cancelled</span></h6>';
                  }
                    ?>
                  </td>
                </tr>
                <?php //include 'modal/orderlist_modal.php';?>
               

             
                <div class="modal fade bd-example-modal-lg-<?php echo $row['order_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">#<?php echo $row['order_id']; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                 
                      <div class="modal-body">
                     


                     
                      <div class="row">
                     
                      <!-- Item details -->
                      <div class="col-lg-6">
                      <div class="card">
                      <div class="card-header">
                      <?php
                        $resultcart = mysqli_query($con,"SELECT * FROM t_order_details as a 
                        LEFT JOIN t_cart as b ON a.order_guest_id = b.guest_id
                        LEFT JOIN t_products as c on b.product_id = c.product_id
                        where a.order_id = '$orderid' ");
                        while($rowcart = mysqli_fetch_array($resultcart)){
                            $price = $rowcart['price'];
                            $qty = $rowcart['qty'];
                            $total_cost = $price * $qty;
                            $total += $total_cost;
                        ?>
                        <div class="card">
                        <div class="card-body">
                        <div class="info d-flex justify-content-between">
                        <div class="product-info">
                        <span class="font-weight-bold"><?php echo $rowcart['product_code']; ?></span><br>
                        <span class="text-muted" style="font-size:14px;"><?php echo $rowcart['product_desc']; ?></span><br>
                        <span class="text-muted" style="font-size:12px;">Qty: <?php echo $rowcart['qty']; ?></span><br>
                        </div>
                        <div class="product-cost">
                                    <span class="text-muted float-right" style="font-size:14px;">Php <?php echo number_format($rowcart['price'],2); ?></span><br>
                                    <span class="font-weight-bold float-right">Php <?php echo number_format($total_cost,2); ?></span><br>
                                    <!-- <span class="text-danger float-right" style="font-size:12px;"><i class="fa fa-trash-alt"></i>&ensp;Delete</span><br> -->
                                </div>
                      
                        </div>
                        
                        </div>
                        </div>

                        



                            <?php }?>

                      </div>
                      </div>
                      </div>
                      <!-- End of item details -->


                   
                     <!-- ORDER DETAILS -->
                     <div class="col-lg-6">
                      <div class="card">
                      <div class="card-header">
                      <h2 class="text-left">Sipping Details</h>
                      </div>
                      <?php
                      echo 
                            '
                            <span class="p-2">' .$row['sd_fullname'].'</span>
                            <span class="text-muted p-2">' .$row['sd_address'].'</span>
                            <span class="text-muted p-2">' .$row['sd_mobile'].'</span><br>
                            ';
                            
                            ?>
                         
                      </div>
                
                      <div class="card">
                      <div class="card-header">
                      <form method ="POST" enctype = "multipart/form-data">
                      <input type="hidden" name = "orderno" class="form-control" value = "<?php echo $row['order_id'];?>" >            
                      <select name="pay_stat" class="form-control" required>
                            <option value="" disabled="disabled" selected="selected">Select Status</option>
                            <!-- admin - 1 employee 2 -->
                            <option value="1">Pending</option>
                            <option value="2">Processing</option>
                            <option value="3">In Transit</option>
                            <option value="4">Completed</option>
                            <option value="0">Failed</option>
                            <option value="9">Cancelled</option>
                            <!-- <option value="HR Assistant">&rarr; HR Assistant</option> -->
                        </select>
                        <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" name="upstat">Update Status</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     
                      </form>
                      <?php }?>
                      
             
                       
                     
                      </div>



                      </div>
                      </div>
                      
                     
                      </div>
                      <!-- END OF ORDER DETAILS -->
                      
                      </div>
                      

                    
                      
              


                    </div>
                  </div>
                </div>
               
                <?php
                if(isset($_POST['upstat']))
                      {
                        $pay_stat = $_POST['pay_stat'];
                        $orderno = $_POST['orderno'];
                        include('include/access/connector.php');
                          mysqli_query($con,"UPDATE t_order_details set order_status='$pay_stat' 
                          where order_id='$orderno' ")
                         or die(mysqli_error($con)); 
                         echo '<script>window.location = "t_orders.php"</script>';
                      }
                   
                           
                        ?>
               
   
            
             
              </tbody>
                  <tfoot>
                  <tr>
                  <th>Order #</th>
                  <th>Name</th>
                  
                  <th>Contact</th>
                  <th>Status</th>
                
                </tr>
                  </tfoot>
                  </table>


   

                 
              </div>
                
              
        
                   
                  
                  </form>
           
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
    $("#example3").DataTable({
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

