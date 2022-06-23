

  <div class="modal fade" id="modal-edit<?php echo $id;?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Payment Terms</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="process/editterms_process.php" method="POST" enctype='multipart/form-data'>
        <div class="modal-body">
            
  <input type="hidden" name = "termid" id="termid" class="form-control" value = "<?php echo $row['terms_id'];?>" readonly>
        
        <input type="text" name = "payterms" id="payterms" class="form-control" value = "<?php echo $row['terms_name'];?>">
        <br>
        <input type="text" name = "payterms" id="payterms" class="form-control" value = "<?php echo $row['terms_desc'];?>"> 
        <br>
        <input type="text" name = "payterms" id="payterms" class="form-control" value = "<?php echo $row['terms_discount'];?>">

       
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



