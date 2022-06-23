<?php

//fetch_data.php

include('../db/connect.php');



if(isset($_POST["action"]))
{
	$query = "
		SELECT * FROM t_products
	";

	if(isset($_POST["searchprod"]) && !empty($_POST["searchprod"]))
	{
		$query .= "
		 AND product_price like '%".$_POST["searchprod"]."%'
		";
	}

	// AND product_desc = '".$_POST["searchprod"]."'


	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '';
	if($total_row > 0)
	{
		foreach($result as $row)
		{
			$output .= '
			
			<div class="col-lg-3 col-md-6 col-6 mb-4 px-2 mb-3 ">
                  <div class="card product-card card-static pb-3">

                    <a class="card-img-top d-block overflow-hidden" href="#">
                      <img src="../admin/image/'. $row['product_img'].'" alt="Product" class=" imgfilter" /></a>
                    <div class="card-body py-2">
                      <div class="product-info">
                        <span class="product-meta d-block font-size-xs pb-1" href="#">'.$row['product_code'].'</span>
                        <span class="product-title font-size-sm overflow-hidden font-weight-bold">'.$row['product_desc'].'</span><br>
                        <?php echo $status; ?>
                      </div>

                      <div class="mt-3">
                        <button class="btn btn-primary" style="width:100%" type="button" data-toggle="modal" data-target="#exampleModal-'.$row['product_id'].'">Add to cart</button>
                      </div>


                      <div class="modal fade" id="exampleModal-'.$row['product_id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">'.$row['product_code'].'</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="img-modal d-flex justify-content-center align-content-center mb-5">
                                <img src="../admin/image/'.$row['product_img'].'" width="200" height="200">
                              </div>

                              <div class="prodinfo-modal d-flex justify-content-between">
                                <h4>'.$row['product_code'].'</h4>
                                <span class="text-muted" style="font-size:20px;">&#8369; '.number_format($row['product_price'], 2).'</span>
                              </div>
                              <div class="prodinfo2-modal">
                                <span class="text-muted">'.$row['product_desc'].'</span>
                              </div>

                              <form method="POST" id="cart_form2-'.$row['product_id'].'">
                                <div class="d-flex product-btn mb-3">

                                  <input type="text" id="account_id-'.$row['product_id'].'" name="account_id" value="'.$_SESSION['customer_id'].'">
                                  <input type="text" id="guest_id-'.$row['product_id'].'" name="guest_id" value="'.$_SESSION['guest_id'].'">
                                  <input type="text" id="prod_id-'.$row['product_id'].'" name="prod_id" value="'.$row['product_id'].'">
                                  <input type="text" id="prod_price-'.$row['product_id'].'" name="prod_price" value="'.$row['product_price'].'">
                                </div>



                            </div>
                            <div class="modal-footer d-flex justify-content-lg-between">
                              <div class="input-group" style="width:200px;">
                                <span class="input-group-prepend">
                                  <button type="button" class="quantity-left-minus btn btn-default btn-number" data-type="minus" data-field="">
                                    <span class="fa fa-minus"></span>
                                  </button>
                                </span>
                                <input type="text" id="quantity" name="quantity" class="form-control input-number text-center" value="1"  onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                <span class="input-group-append">
                                  <button type="button" class="quantity-right-plus btn btn-default btn-number" data-type="plus" data-field="">
                                    <span class="fa fa-plus"></span>
                                  </button>
                                </span>
                              </div>
                              <button type="submit" class="btn btn-primary">Add to Cart</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>

                  </div>
                </div>

			

			';
			
		}
	}
	else
	{
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