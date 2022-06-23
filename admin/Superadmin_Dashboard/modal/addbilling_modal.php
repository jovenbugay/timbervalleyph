

  <div class="modal fade" id="modal-overlay" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" for="name">Add Collection</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method = "POST" action="process/addbilling_process.php" id="formupdate" enctype='multipart/form-data' > 
        <div class="modal-body">
        <select name="selectdata"  id="selectdata" class="form-control select2" style="width: 100%;" required>
        <option selected disabled></option>
        <?php
        include('include/access/connector.php');

        // SELECT * FROM t_order_details as a LEFT join t_customers as b 
        // on a.order_customer_id = b.customer_id where order_payment_status = 'UNPAID'
        $query0=mysqli_query($con," SELECT * FROM t_order_details as a LEFT join t_customers as b 
        on a.order_customer_id = b.customer_id where order_payment_status = 'UNPAID'")or die(mysqli_error($con));
        while($row=mysqli_fetch_array($query0)){
          

        ?>   
        
      <option value="<?php echo $row['order_id'];?>"><?php echo $row['order_id'];?></option>

        
        <?php }?>
    
        </select>
       
          <!-- <br> -->
          
        <br>
        <!-- <input type="text" name="cust_id" id="softwares" class="form-control" value="<?php //echo $row['customer_id'];?>" required="" autocomplete="off" readonly>  -->
         <input type="text" name="cust_name" id="cust_name" class="form-control" placeholder="Customer Name" value="<?php echo $row['order_id'];?>" required="" autocomplete="off" readonly>
         
         <br>
         <label class="control-label col-lg-12" for="price">Total Amount to Pay:</label>
         <input type="text" name="b_amt" id="b_amt" class="form-control" placeholder="0.00" required="" autocomplete="off" readonly> 
         <br>
         <!-- <label class="control-label col-lg-12" for="price">Total Balance:</label>
         <input type="text" name="b_bal" id="b_bal" class="form-control" placeholder="0.00" required="" autocomplete="off" readonly>  -->
         <br>     
         <label class="control-label col-lg-12" for="price">Payment Date:</label>
         <input type="date" name="b_date" id="b_date" class="form-control" required="" value=<?php echo date('Y-m-d'); ?>> 
          <br>
          <label class="control-label col-lg-12" for="price">Payment:</label>
          <input type="text" name="b_pay_amt" id="b_pay_amt" class="form-control"  required readonly  > 
          <input type="hidden" name="orderid" id="orderid" class="form-control" placeholder="Amount" required="" autocomplete="off" readonly> 
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
  
  <script>
    $(document).ready(function(){
     $('#selectdata').change(function(e){
       e.preventDefault();
        var selectdata = $(this).val();
        //alert(selectdata);

        //alert(tenant_id);
        $.ajax({
              url: "modal/order_details.php",
              type: "POST",
              dataType: 'JSON',
              data: { 
                selectdata : selectdata
               },
               
              success: function (data2) {
                  $('#cust_name').val(data2.fname +" " + data2.lname);
                  $('#b_amt').val(data2.total_amt);
                  $('#orderid').val(data2.orderid);
                  $('#b_pay_amt').val(data2.total_amt);
                  // $('#selectdata').val(data2.selectdata);
              //  alert(data2.fname);
                
                var dataParsed = JSON.parse(data2);
                console.log(dataParsed);
              }
            });
     });
    });
    </script>

  


</body>
</html>

<!-- <script type='text/javascript'>
$(document).ready(function(){
$('#softwares').val($('#selectdata option:selected').data('softwares'));
$(function(){
    $('#selectdata').change(function(){
        $('#softwares').val($('#selectdata option:selected').data('softwares'));
    });
});
});

</script> -->



