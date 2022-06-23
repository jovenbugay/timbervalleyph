<?php
session_start();
include ('../../db/connect.php');


$ordernumber = $_GET['ordernumber'];

$result = mysqli_query($con,"SELECT * FROM t_order_details as a
left JOIN t_cart as b on a.order_guest_id = b.guest_id
left join t_products as c on b.product_id = c.product_id
where a.order_id='$ordernumber'");

$city_arr = array();

while($row = mysqli_fetch_array($result)){
    $city_arr[] = array("product_id" => $row['product_id'],
                        "product_code" => $row['product_code']);
}
echo json_encode($city_arr);
?>