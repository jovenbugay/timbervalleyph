
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
        <form method = "POST" id="formupdate" enctype='multipart/form-data' > 
        <div class="modal-body">
         <input type="text" name="prodcode" id="prodcode" class="form-control" placeholder="Product Code" required="" autocomplete="off">
         <br>
         <input type="text" name="proddesc" id="productdesc" class="form-control" placeholder="Product Description" required="" autocomplete="off"> 
         <br>
         <input type="text" name="prodprice" id="prodprice" class="form-control" placeholder="Product price" required="" autocomplete="off"> 
         <br>
     
            <!-- <input type="file" class="form-control" id="price" name="image">   -->
            <div class="form-group">
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

        <!-- <script>
						$(document).ready(function(){
							$('#formupdate').submit(function(ee){
								ee.preventDefault();
								var prodcode2 = $('#prodcode').val();
								var proddesc2 = $('#proddesc').val();
                var prodprice2 = $('#prodprice').val();
                



							
								$.ajax({
									url: "process/addproduct_process.php",
									dataType: 'json',
									type: "post",
									data: { 
									prodcode: prodcode2,
									proddesc: proddesc2,
									prodprice: prodprice2
									 },
									success: function (data) {
                    // alert("Success");
									
                    $("#modal-overlay").modal("hide");
                    Swal.fire({
										icon: 'success',
										title: 'Sucessfully',
										text: 'User Updated',
										showConfirmButton: false,
										timer: 1500
										})
                    // $("#example1").ajax.reload();
									var dataParsed = JSON.parse(data);
									console.log(dataParsed);
									}
								});
												
							})
						})

						</script> -->



      </div>
    </div>
  </div>
  