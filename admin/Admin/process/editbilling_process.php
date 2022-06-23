<?php

  include('../include/access/connector.php');
  error_reporting(E_ALL); // Error engine - always E_ALL!
error_reporting(E_ALL ^ E_DEPRECATED);
ini_set('ignore_repeated_errors', TRUE); // always TRUE
ini_set('display_errors',false ); // Error display - FALSE only in production environment or real server. TRUE in development environment
ini_set('log_errors', TRUE); // Error logging engine
ini_set('error_log', 'errors.log'); // Logging file path
ini_set('log_errors_max_len', 1024); // Logging file size

	if(isset($_POST['update'])){

      $orderid = $_POST['order_id'];
      $cust_name = $_POST['cust_name'];
      $b_date = $_POST['b_date'];
      $b_price = $_POST['b_price']; //Yung binayad
      $b_total = $POST['b_total']; //Yung Total ng babayaran
      $b_balance = $POST['b_bal']; //Remaining Balance
      $total_bal = $b_total - $b_price;

{

  mysqli_query($con,"UPDATE t_billing SET b_pay_amt='$b_price',billing_date = '$b_date', b_balance=b_amount-b_pay_amt
   where order_no = '$orderid' and deleted = '0'")
    or die(mysqli_error($con)); 

}
  


    $query0=mysqli_query($con,"SELECT * FROM t_order_details as a 
    LEFT join t_cart as b on a.order_guest_id = b.guest_id
   where a.order_id = '$orderid'")or die(mysqli_error());
    while($row=mysqli_fetch_array($query0)){
      $price = $row['price'];
      $qty = $row['qty'];
      $total_cost = $price * $qty;
      $total2 += $total_cost; 
      
      if (is_numeric($total2)){
        $total_val = number_format($total2,2);
      }


    if ($total_val == $b_price){
      mysqli_query($con,"UPDATE t_order_details set order_payment_status='PAID' where order_id = '$orderid'")or die(mysqli_error($con));
      // echo '<script>window.location = "../t_billing.php"</script>';  
    }
    elseif ($total_val < $b_price){
      mysqli_query($con,"UPDATE t_order_details set order_payment_status='PAID' where order_id = '$orderid'")or die(mysqli_error($con)); 

    }
    else if ($total_val > $b_price){
      mysqli_query($con,"UPDATE t_order_details set order_payment_status='UNPAID' where order_id = '$orderid'")or die(mysqli_error($con));
    }

    
  }
  echo '<script>window.location = "../t_billing.php"</script>'; 
	}


?>


