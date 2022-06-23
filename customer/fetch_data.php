<?php

//fetch_data.php

include('../db/connect.php');
$accountid = $_POST['custid'];
$guestid = $_POST['guestid'];



if (isset($_POST["action"])) {
  $query = "
		SELECT * FROM t_products
	";

  if (isset($_POST["searchprod"]) && !empty($_POST["searchprod"])) {
    $query .= "
		 where product_code like '%".$_POST["searchprod"]."%'
		";
  }

  // AND product_desc = '".$_POST["searchprod"]."'


  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  $total_row = $statement->rowCount();
  $output = '';
  if ($total_row > 0) {
    foreach ($result as $row) {

      $product_status = $row['product_status'];
      if ($product_status == '0') {
        $disabled = 'disabled';
        $status = '<span class="badge badge-danger">Out of Stock</span>';
      } else if ($product_status == '1') {
        $disabled = '';
        $status = '<span class="badge badge-success">In Stock</span>';
      }


      $output .= '
			<div class="col-lg-3 col-md-6 col-6 mb-4 px-2 mb-3 ">
                  <div class="card product-card card-static pb-3">

                    <a class="card-img-top d-block overflow-hidden" href="#">
                      <img src="../admin/image/' . $row['product_img'] . '" alt="Product" class=" imgfilter" /></a>
                    <div class="card-body py-2">
                      <div class="product-info">
                        <span class="product-meta d-block font-size-xs pb-1" href="#">' . $row['product_code'] . '</span>
                        <span class="product-title font-size-sm overflow-hidden font-weight-bold">' . $row['product_desc'] . '</span><br>
                        '. $status.'
                      </div>

                      <div class="mt-3">
                        <button class="btn btn-primary" '.$disabled.' style="width:100%" type="button" data-toggle="modal" data-target="#exampleModal-' . $row['product_id'] . '">Add to cart</button>
                      </div>


                      <div class="modal fade" id="exampleModal-' . $row['product_id'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">' . $row['product_code'] . '</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="img-modal d-flex justify-content-center align-content-center mb-5">
                                <img src="../admin/image/' . $row['product_img'] . '" width="200" height="200">
                              </div>

                              <div class="prodinfo-modal d-flex justify-content-between">
                                <h4>' . $row['product_code'] . '</h4>
                                <span class="text-muted" style="font-size:20px;">&#8369; ' . number_format($row['product_price'], 2) . '</span>
                              </div>
                              <div class="prodinfo2-modal">
                                <span class="text-muted">' . $row['product_desc'] . '</span>
                              </div>

                              <form method="POST" id="cart_form2-' . $row['product_id'] . '">
                              <div class="d-flex product-btn mb-3">
                              <input type="hidden" id="account_id-' . $row['product_id'] . '" name="account_id" value="' . $accountid . '">
                              <input type="hidden" id="guest_id-' . $row['product_id'] . '" name="guest_id" value="' . $guestid . '">
                              <input type="hidden" id="prod_id-' . $row['product_id'] . '" name="prod_id" value="' . $row['product_id'] . '">
                              <input type="hidden" id="prod_price-' . $row['product_id'] . '" name="prod_price" value="' . $row['product_price'] . '">
                              </div>
                              <button type="submit"  class="btn btn-primary float-right">Add to Cart</button>
                              </form>
                            

                            </div>
                            
                            <div class="modal-footer d-flex justify-content-lg-between">
                      
                              <div class="input-group" style="width:200px;">
                                <span class="input-group-prepend">
                                  <button type="button" class="quantity-left-minus-' . $row['product_id'] . ' btn btn-default btn-number" data-type="minus" data-field="">
                                    <span class="fa fa-minus"></span>
                                  </button>
                                </span>
                                <input type="text" id="quantity-' . $row['product_id'] . '" name="quantity" class="form-control input-number text-center" value="1"  onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                <span class="input-group-append">
                                  <button type="button" class="quantity-right-plus-' . $row['product_id'] . ' btn btn-default btn-number" data-type="plus" data-field="">
                                    <span class="fa fa-plus"></span>
                                  </button>
                                </span>
                              </div>

                              
                              <button type="submit"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                              
                            </div>
                            
                          </div>
                        </div>
                      </div>

                    </div>

                  </div>
                </div>

			

			'; ?>



    
      <script>
        $(function() {
          $('#cart_form2-<?php echo $row['product_id']; ?>').submit(function(ee) {


            Swal.fire({

              icon: 'success',
              title: 'Added to Cart',
              text: 'Thank you for ordering',
              showConfirmButton: false,
              timer: 1500
            })
            ee.preventDefault();


            var prod_id2 = $('#prod_id-<?php echo $row['product_id']; ?>').val();
            var guest2 = $('#guest_id-<?php echo $row['product_id']; ?>').val();
            var account2 = $('#account_id-<?php echo $row['product_id']; ?>').val();
            var qty2 = $('#quantity-<?php echo $row['product_id']; ?>').val();
            var price2 = $('#prod_price-<?php echo $row['product_id']; ?>').val();


            $.ajax({
              url: "functions/add_cart.php",
              type: "POST",
              data: {
                account_id: account2,
                guest_id: guest2,
                prod_id: prod_id2,
                qty: qty2,
                price: price2
              },
              success: function(data) {
                $('.notif-count').load('index.php .notif-count');
                $('.product-table').load('index.php .product-table');
                // $('.table-responsive').load('index.php .table-responsive');
                $('#exampleModal-<?php echo $row['product_id']; ?>').modal('hide');

                var dataParsed = JSON.parse(data);
                console.log(dataParsed);
              }
            });
          });
        });
      </script>

    

      <script>
        $(document).ready(function() {

          var quantitiy = 1;
          $('.quantity-right-plus-<?php echo $row['product_id']; ?>').click(function(e) {
            e.preventDefault();
            var quantity = parseInt($('#quantity-<?php echo $row['product_id']; ?>').val());
            $('#quantity-<?php echo $row['product_id']; ?>').val(quantity + 1);
          });

          $('.quantity-left-minus-<?php echo $row['product_id']; ?>').click(function(e) {
            e.preventDefault();
            var quantity = parseInt($('#quantity-<?php echo $row['product_id']; ?>').val());
            if (quantity > 1) {
              $('#quantity-<?php echo $row['product_id']; ?>').val(quantity - 1);
            }
          });

        });
      </script>

<?php
    }
  } else {
    $output = '<h3>No Data Found</h3>';
  }
  echo $output;
}

?>





<!-- 
<div class="col-sm-4 col-lg-3 col-md-3">
				<div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:450px;">
					<img src="../admin/image/'. $row['product_img'] .'" alt="" class="img-responsive" >
					<p align="center"><strong><a href="#">'. $row['product_desc'] .'</a></strong></p>
					<h4 style="text-align:center;" class="text-danger" >'. $row['product_price'] .'</h4>
					<p>Camera : '. $row['product_code'].' MP<br />
					Brand : '. $row['product_status'] .' <br />
					RAM : '. $row['product_id'] .' GB<br />
					Storage : '. $row['product_desc'] .' GB </p>
				</div>

			</div> -->