<?php
include('../db/connect.php');
if(!empty($_GET['cm'])){
    $guest = $_GET['cm'];
    $result = mysqli_query($con,"UPDATE t_order_details SET order_status = '1', order_payment_status = 'PAID'  where order_guest_id = '$guest'  ");
    header('location:order_placed.php');
}




?>