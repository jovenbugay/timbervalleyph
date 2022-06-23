<?php

  include('../../db/connect.php');
  $guest_id = $_POST['guest_id'];
  $account_id = $_POST['account_id'];
  $product_id = $_POST['prod_id'];
  $qty = $_POST['qty'];
  $price = $_POST['price'];
  $resultcheck = mysqli_query($con,"SELECT * FROM t_cart where guest_id = '$guest_id' AND product_id = '$product_id'");
  if(mysqli_num_rows($resultcheck) == 1){
    $rowcheck = mysqli_fetch_array($resultcheck);
    $exist_qty = $rowcheck['qty'];
    $new_qty = $exist_qty + $qty;
    $resultupdate = mysqli_query($con,"UPDATE t_cart SET qty = '$new_qty' where guest_id = '$guest_id' AND product_id = '$product_id'");
    
  }

  else {
    $resulta = mysqli_query($con,"INSERT INTO t_cart (guest_id,account_id,product_id,price,qty) values ('$guest_id','$account_id','$product_id','$price','$qty') ");
  }

?>