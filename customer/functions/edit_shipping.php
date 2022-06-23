<?php
 include('../../db/connect.php');
 $s_id = $_POST['s_id'];
 $fullname = $_POST['fullname'];
 $address = $_POST['address'];
 $mobile = $_POST['mobile'];
$region = $_POST['region'];
$city = $_POST['city'];
$address2 = $_POST['address2'];
$postal = $_POST['postal'];
$lastcity = $_POST['lastcity'];



if ($lastcity !== $city){
    $result = mysqli_query($con,"UPDATE t_shipping_details
    SET sd_fullname = '$fullname', sd_address = '$address', sd_mobile = '$mobile' ,sd_region='$region',
    sd_city ='$city',sd_postal = '$postal',sd_address2 = '$address2'
     where sd_id = '$s_id' ");
}else{
    $result = mysqli_query($con,"UPDATE t_shipping_details
    SET sd_fullname = '$fullname', sd_address = '$address', sd_mobile = '$mobile' ,sd_postal = '$postal',sd_address2 = '$address2'
     where sd_id = '$s_id' ");
}




 

?>