<?php


$datefrom = $_GET['datefrom'];
 	$dateto = $_GET['dateto'];

header('Content-Type: application/json');
include('../include/access/connector.php');
error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting(E_ALL); // Error engine - always E_ALL!
ini_set('ignore_repeated_errors', TRUE); // always TRUE
ini_set('display_errors', TRUE); // Error display - FALSE only in production environment or real server. TRUE in development environment
ini_set('log_errors', TRUE); // Error logging engine
ini_set('error_log', 'errors.log'); // Logging file path
ini_set('log_errors_max_len', 1024); // Logging file size


$con = mysqli_connect("localhost","u911304685_user","P@55w0rd1230","u911304685_timber");




$result = mysqli_query($con,"SELECT a.order_id,b.customer_fname,b.customer_lname,round(sum(c.price * c.qty - (c.price * c.qty * (d.terms_discount/100))),2)as total_price,DATE(a.order_date) as order_date
FROM t_order_details as a LEFT join t_customers as b 
on a.order_customer_id = b.customer_id 
left join t_cart as c on c.guest_id = a.order_guest_id
left join t_payment_terms as d on a.order_payment_terms = d.terms_id
where DATE(a.order_date) between '$datefrom' and '$dateto'
group by DATE(a.order_date)");


$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($con);

echo json_encode($data);

?>