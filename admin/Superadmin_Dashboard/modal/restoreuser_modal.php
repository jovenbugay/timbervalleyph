
  <div class="modal fade" id="modal-recover<?php echo $id;?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Restore User</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="process/deleteuser_process.php" method="POST" enctype='multipart/form-data'>
        <div class="modal-body">
        <input type="text" name = "userid" class="form-control" value = "<?php echo $row0['id'];?>" readonly>
        </br>
        <input type="text" name = "username" class="form-control" value = "<?php echo $row0['username'] ;?>" readonly>
        </div>
     
        <div class="modal-footer justify-content-between">
          
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" name="restore">Restore</button>
        </div>
        </form>
      </div>
    </div>
  </div>