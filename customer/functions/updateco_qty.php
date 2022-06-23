<?php
 include('../../db/connect.php');
 
 $cartid = $_POST['cartid'];
 $prodcodecart = $_POST['prodcodecart'];
 $quantity = $_POST['addqty'];




$result = mysqli_query($con,"UPDATE t_cart set qty = '$quantity' where cart_id = '$cartid' and product_id = '$prodcodecart'");

// if ($lastcity !== $city){
//     $result = mysqli_query($con,"UPDATE t_shipping_details
//     SET sd_fullname = '$fullname', sd_address = '$address', sd_mobile = '$mobile' ,sd_region='$region',
//     sd_city ='$city',sd_postal = '$postal',sd_address2 = '$address2'
//      where sd_id = '$s_id' ");
// }else{
//     $result = mysqli_query($con,"UPDATE t_shipping_details
//     SET sd_fullname = '$fullname', sd_address = '$address', sd_mobile = '$mobile' ,sd_postal = '$postal',sd_address2 = '$address2'
//      where sd_id = '$s_id' ");
// }




 

?>