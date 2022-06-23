
  <div class="modal fade" id="modal-overlay">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" for="name">Add Billing</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- <form action="process/addproduct_process.php" method="POST" enctype='multipart/form-data' > -->
        <form method = "POST" action="process/addbilling_process.php" id="formupdate" enctype='multipart/form-data' > 
        <div class="modal-body">
        <select name="order_no"  id="selectdata" class="form-control select2" style="width: 100%;" required>
        <!-- <option value="" disabled="disabled" selected="selected">Select Order Number</option> -->
        <?php
        include('include/access/connector.php');
        $query0=mysqli_query($con,"SELECT * from t_billing as a
        left join t_order_details as b on a.order_no = b.order_id
        left join t_customers as c on b.order_customer_id = c.customer_id")or die(mysqli_error());
        while($row=mysqli_fetch_array($query0)){
        ?>   
        <!-- <option value = "<?php //echo $row['order_id'];?>"><?php //echo $row['order_id'];?></option> -->
        <?php
        echo "<option value='".$row['billing_no']."' data-softwares='".$row['customer_fname']. " " .$row['customer_lname']. "'>".$row['order_id']."</option>";
        ?>
        <?php }?>
        
        </select>
    

        <br>
         <input type="text" name="cust_name" id="softwares" class="form-control" placeholder="Customer Name" value="<?php echo $row['order_id'];?>" required="" autocomplete="off" readonly>
         <br>
         <input type="date" name="b_date" id="b_date" class="form-control" required="" autocomplete="off"> 
         <br>
         <input type="text" name="b_amt" id="b_amt" class="form-control" placeholder="Amount" required="" autocomplete="off"> 
         <input type="text" name="cust_name" id="softwares2" class="form-control" placeholder="Customer Name" value="<?php echo $row['order_id'];?>" required="" autocomplete="off" readonly>
         <br>     
      
        <div class="form-group">
       
     
          
                        
          
        </div>
        </div>
        
        <div class="modal-body">
   
  
        </div>


        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="bill">Save</button>
        </div>
        </form>

     



      </div>
    </div>
  </div>
  



<!-- Bootstrap 4 -->
<script src="../Superadmin_Dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="../Superadmin_Dashboard/plugins/select2/js/select2.full.min.js"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="../Superadmin_Dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../Superadmin_Dashboard/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

</body>
</html>

<script type='text/javascript'>
$(document).ready(function(){
$('#softwares').val($('#selectdata option:selected').data('softwares'));
$(function(){
    $('#selectdata').change(function(){
        $('#softwares').val($('#selectdata option:selected').data('softwares'));
    });
});
});


$(document).ready(function(){
$('#softwares2').val($('#selectdata option:selected').data('softwares2'));
$(function(){
    $('#selectdata').change(function(){
        $('#softwares2').val($('#selectdata option:selected').data('softwares2'));
    });
});
});



</script>