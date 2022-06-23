
  <div class="modal fade" id="modal-edit<?php echo $id;?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Collection</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="process/editbilling_process.php" method="POST" enctype='multipart/form-data'>
        <div class="modal-body">
        <input type="text" name = "order_id" class="form-control" value = "<?php echo $row['order_id'];?>" readonly>
        </br>
        <input type="text" name = "cust_name" class="form-control" value = "<?php echo $row['customer_fname']. " " .$row['customer_lname'] ;?>" readonly>
        </br>
        <input type="date" name = "b_date" class="form-control" value = "<?php echo $row['billing_date'];?>" >
        </br>
        <!-- <input type="text" name = "b_price" class="form-control" value = "<?php //echo number_format($row['b_amount'],2);?>" > -->
        <input type="text" name = "b_price" class="form-control" value = "<?php echo $row['b_pay_amt'];?>" >
        <input type="hidden" name = "b_total" class="form-control" value = "<?php echo $row['b_amount'];?>" >
        <input type="hidden" name = "b_bal" class="form-control" value = "<?php echo $row['b_balance'];?>" >
        </div>
     
        <div class="modal-footer justify-content-between">
          
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="update">Update</button>
        </div>
        </form>
      </div>
    </div>
  </div>