
  <div class="modal fade" id="modal-overlay">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" for="name">Add New Payment Term</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- <form action="process/addproduct_process.php" method="POST" enctype='multipart/form-data' > -->
        <form method = "POST" id="formupdate"  action="process/addterms_process.php" enctype='multipart/form-data' > 
        <div class="modal-body">
         <input type="text" name="payterm" id="payterm" class="form-control" placeholder="Payment Term" required="" autocomplete="off">
         <br>
         <input type="text" name="termdesc" id="termdesc" class="form-control" placeholder="Description" required="" autocomplete="off"> 
         <br>
         <input type="text" name="termdisc" pattern="^\d*(\.\d{0,2})?$" id="termdisc" class="form-control" placeholder="Discount" required="" autocomplete="off"> 
         <br>

      
        </div>
  


        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="term">Save</button>
        </div>
        </form>



      </div>
    </div>
  </div>
  <script>
      $(document).on('keydown', 'input[pattern]', function(e){
  var input = $(this);
  var oldVal = input.val();
  var regex = new RegExp(input.attr('pattern'), 'g');

  setTimeout(function(){
    var newVal = input.val();
    if(!regex.test(newVal)){
      input.val(oldVal); 
    }
  }, 0);
});
      </script>