
  <div class="modal fade" id="modal-delete<?php echo $id;?>">
  <!-- <div class="modal fade" id="modal-overlay"> -->
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Corporate</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <form action="process/deleteproduct_process.php" method="POST">
        <div class="modal-body">
         <!-- <input type="text" name="corporate_name" value="<?php echo $row['corporate_name'];?>" class="form-control" required="" autocomplete="off" readonly> -->
         <input type="hidden" name = "prod_id" class="form-control" value = "<?php echo $row0['product_id'];?>" readonly>
         <input type="text" name = "prod_code" class="form-control" value = "<?php echo $row0['product_code'];?>" readonly>
         <div class="ln_solid"></div>
         <input type="text" name = "prod_desc" class="form-control" value = "<?php echo $row0['product_desc'];?>" readonly>
         <div class="ln_solid"></div>
         <input type="text" name = "prod_code" class="form-control" value = "<?php echo $row0['product_price'];?>" readonly>
        </div>
        <div class="modal-footer justify-content-between">
          <input type="hidden" value="<?php echo $row['corporate_id'];?>" name="corporate_id">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger" name="delete">Delete</button>
        </div>
        </form>
      </div>
    </div>
  </div>