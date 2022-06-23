<?php
session_start();



include ('../../db/connect.php');

$productid =$_GET['prodid'];
$ordernumber = $_GET['orderid'];



$result = mysqli_query($con,"SELECT * FROM t_order_details as a
left JOIN t_cart as b on a.order_guest_id = b.guest_id
left join t_products as c on b.product_id = c.product_id
where a.order_id='$ordernumber' and c.product_id ='$productid'");

$row = mysqli_fetch_array($result);
 
$test = $row['product_desc'];
// "productname" => $row['product_desc'], 
if($result){
  echo json_encode( array(
    "productname" => $row['product_desc'], 
    "productqty" => $row['qty'],
    "success" =>"1"));
}
else{
  echo json_encode( array("success" =>"0"));
}





// $data = array("product_name" => $row['product_desc'], "productqty" => $row['qty']);
//     array_push($data_arr["data"], $data);

//     echo json_encode(array("status" => "1", "data" => array($data)));

// if(mysqli_num_rows($result) !==""){
 

// }


?>