
  <div class="modal fade" id="modal-edit<?php echo $id;?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit User</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="process/edituser_process.php" method="POST" enctype='multipart/form-data'>
        <div class="modal-body">
        <div class="row">
        <input type="hidden" name = "userid" id="username" class="form-control" value = "<?php echo $row0['id'];?>" readonly>

        <div class="col-lg-6">
            <div class="form-group">
        <label>First Name:</label>
        <input type="text" name = "fname" class="form-control" value = "<?php echo $row0['fname'];?>" >
            </div>
        </div>

         <div class="col-lg-6">
            <div class="form-group">
        <label>Last Name:</label>
        <input type="text" name = "lname" class="form-control" value = "<?php echo $row0['lname'];?>" >
            </div>
        </div>
        </div>

        <div class="form-group">
                  <label>Email:</label>
                  <input type="email" name = "email" class="form-control" value = "<?php echo $row0['email'];?>" >
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                    <label>Username:</label>
                    <input type="text" name = "username" class="form-control" value = "<?php echo $row0['username'];?>" >            
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                    <label>Password:</label>
                    <input type="password" name = "password" class="form-control" placeholder="Enter to Change Password" >
                    </div>
                </div>
            </div>
            <div class="form-group">


                        <select name="useraccess" class="form-control" id = "access-<?php echo $id;?>">
                            <option value="1">Admin</option>
                            <option value="2">Employee</option>
                            <option value="3">Owner</option>
                        </select>
        </div>
        </div>
  
        <div class="modal-footer justify-content-between">
          <input type="hidden" value="<?php echo $row['corporate_id'];?>" name="corporate_id">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="updateuser">Update</button>
        </div>
        </form>
      </div>
    </div>
  </div>