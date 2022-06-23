
  <div class="modal fade" id="modal-overlay">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" for="name">Add New Product</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- <form action="process/addproduct_process.php" method="POST" enctype='multipart/form-data' > -->
        <form method = "POST" id="formupdate" enctype="multipart/form-data" > 
        <div class="modal-body">
         <input type="text" name="prodcode" id="prodcode" class="form-control" placeholder="Product Code" required="" autocomplete="off">
         <br>
         <input type="text" name="proddesc" id="productdesc" class="form-control" placeholder="Product Description" required="" autocomplete="off"> 
         <br>
         <input type="text" name="prodprice" id="prodprice" class="form-control" placeholder="Product price" required="" autocomplete="off"> 
         <br>
         <label class="control-label col-lg-12" for="price">Product Availability</label>
      
          <select name="prod_stat" class="form-control">
          <option value="1"  selected="selected">In Stock</option>
            <!-- <option value="1">In Stock</option> -->
            <option value="0">Out of Stock</option>
          </select>
   
  
     
      
            <div class="form-group">
              <br>
          <label class="control-label col-lg-3" for="price">Picture</label>
          <div class="col-lg-9">
            <input type="file" class="form-control" id="image" name="image">  
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
  