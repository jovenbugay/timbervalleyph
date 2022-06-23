
  <div class="modal fade" id="modal-edit<?php echo $id;?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Product</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="process/editcorporate_process.php" method="POST" enctype='multipart/form-data'>
        <div class="modal-body">
        <input type="hidden" name = "prod_id" class="form-control" value = "<?php echo $row0['product_id'];?>" readonly>
        <input type="text" name = "prod_code" class="form-control" value = "<?php echo $row0['product_code'];?>" readonly>
        <div class="ln_solid"></div>
        <input type="text" name = "prod_desc" class="form-control" value = "<?php echo $row0['product_desc'];?>" >
        <div class="ln_solid"></div>
        <input type="text" name = "prod_price" class="form-control" value = "<?php echo number_format($row0['product_price'],2);?>" >
        <input type="hidden" name = "prod_img" class="form-control" value = "<?php echo $row0['product_img'];?>" ><br>
        <label class="control-label col-lg-12" for="price">Product Availability</label>
        <!-- <input type="checkbox" name="mycheckbox" id ="mycheckbox" <?php echo $checked;?> data-bootstrap-switch data-off-color="danger" data-on-color="success"> -->
        <select name="prod_status" class="form-control" required>
                            <option value="1" selected="selected" >In Stock</option>
                            <option value="0">Out of Stock</option>
                        </select>
        </div>
        <div class="form-group p-2">
          <label class="control-label col-lg-12 p-2" for="price">Picture</label>
          <div class="col-lg-9">
            <input type="file" class="form-control" id="image" name="image">  
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <input type="hidden" value="<?php echo $row['corporate_id'];?>" name="corporate_id">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="update">Update</button>
        </div>
        </form>



        

      </div>
    </div>
  </div>

  

  
