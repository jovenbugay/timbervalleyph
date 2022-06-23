<?php
 include('../include/access/connector.php');
error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting(E_ALL); // Error engine - always E_ALL!
ini_set('ignore_repeated_errors', TRUE); // always TRUE
ini_set('display_errors', TRUE); // Error display - FALSE only in production environment or real server. TRUE in development environment
ini_set('log_errors', TRUE); // Error logging engine
ini_set('error_log', 'errors.log'); // Logging file path
ini_set('log_errors_max_len', 1024); // Logging file size



// SELECT a.order_id,b.customer_fname,b.customer_lname,SUM(c.price * c.qty) as total_price,d.b_balance FROM t_order_details as a LEFT join t_customers as b 
// on a.order_customer_id = b.customer_id 
// left join t_cart as c on c.guest_id = a.order_guest_id
// left join t_billing as d on a.order_id = d.order_no and d.deleted='0'
// where a.order_id ='$selectdata'
// group by a.order_id
$selectdata = $_POST['selectdata'];
$result = mysqli_query($con,"SELECT a.order_id,b.customer_fname,b.customer_lname,SUM(c.price * c.qty) as total_price,d.b_balance,e.terms_discount,
round(sum(c.price * c.qty - (c.price * c.qty * (e.terms_discount/100))),2) as total_price_discount
FROM t_order_details as a LEFT join t_customers as b 
on a.order_customer_id = b.customer_id 
left join t_cart as c on c.guest_id = a.order_guest_id
left join t_billing as d on a.order_id = d.order_no and d.deleted='0'
left join t_payment_terms as e on a.order_payment_terms = e.terms_id
where a.order_id ='$selectdata'
group by a.order_id");

$row = mysqli_fetch_array($result);

    $fname = $row['customer_fname'];
    $lname = $row['customer_lname'];
    
    $total_bal = $row['b_balance'];
    $orderid = $row['order_id'];
    if ($total_bal > 0){
        $total_amt = $row['b_balance'];
      
    }else{
        $total_amt = $row['total_price_discount'];
        
    }
    

    // "total_amt" => $row['total_price'],
    // if($result){
        echo json_encode(array(
            "fname" => $row['customer_fname'],
            "lname" => $row['customer_lname'],
            "total_amt" => $total_amt,
            "total_bal" => $row['b_balance'],
            "orderid" => $row['order_id'],
            "order_id" => $selectdata
        
        ));
    // }





?>