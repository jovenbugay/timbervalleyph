
  <div class="modal fade" id="modal-delete<?php echo $id;?>">
  <!-- <div class="modal fade" id="modal-overlay"> -->
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Terms</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <form action="process/deleteterms_process.php" method="POST">
        <div class="modal-body">
         <input type="hidden" name = "termid" class="form-control" value = "<?php echo $row['terms_id'];?>" readonly>
         <input type="text" name = "payterms" class="form-control" value = "<?php echo $row['terms_name'];?>" readonly>
         <br>
         <input type="hidden" name = "term_desc" class="form-control" value = "<?php echo $row['terms_desc'];?>" readonly>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger" name="delete">Delete</button>
        </div>
        </form>
      </div>
    </div>
  </div>