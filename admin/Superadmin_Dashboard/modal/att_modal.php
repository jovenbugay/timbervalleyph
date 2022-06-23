


  <div class="modal fade" id="modal-edit<?php echo $id;?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Payment Attachment</h4>
          <?php echo $error;?>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <input type="text" name = "img_url" class="form-control" value = "<?php echo "https://timbervalleyph.com/customer/"."".$row['att_path'];?>" readonly>

        <label class="control-label col-lg-12" for="price">Attachments:</label>
                              <img style="width:400px;height:300px" src="https://timbervalleyph.com/customer/<?php
                              if(empty($att_path)){
                                echo 'bank/noatt.png';
                                }else if(file_exists('https://timbervalleyph.com/customer/'."$att_path")) {
                                  echo 'bank/noatt.png';
                                } else {
                                  echo $att_path;
                                }
                                  
                                ;?>">

            
  
       
        </div>
     
        <div class="modal-footer justify-content-between">
        <form method="POST">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <!-- <button type="submit" class="btn btn-primary" name="download" id ="download" download>Download Image</button> -->
        </form>
        </div>
        
      </div>
    </div>
    
  </div>
  
  <?php
	if(ISSET($_REQUEST['image'])){
		$exp=explode("/", $_REQUEST['image']);
		$image=$exp[1];
		
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=".basename($image));
		header("Content-Type: application/octet-stream;");
		header("Content-Transfer-Encoding: binary");
		readfile("uploads/".$image);
	}
?>
