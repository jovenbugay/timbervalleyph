
  <div class="modal fade" id="modal-overlay">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" for="name">Add New Product</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="process/addproduct_process.php" method="POST" enctype='multipart/form-data'>
        <div class="modal-body">
         <input type="text" name="prodcode" class="form-control" placeholder="Product Code" required="" autocomplete="off">
         <br>
         <input type="text" name="productdesc" class="form-control" placeholder="Product Description" required="" autocomplete="off"> 
         <br>
         <input type="text" name="prodprice" class="form-control" placeholder="Product price" required="" autocomplete="off"> 
         <br>
     
            <!-- <input type="file" class="form-control" id="price" name="image">   -->
            <div class="form-group">
          <label class="control-label col-lg-3" for="price">Picture</label>
          <div class="col-lg-9">
            <input type="file" class="form-control" id="price" name="image">  
          </div>
        </div>
        </div>
        
        <div class="modal-body">
  
        </div>


        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="prod">Save</button>
        </div>
        </form>
      </div>
    </div>
  </div>