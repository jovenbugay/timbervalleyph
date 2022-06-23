<?php
session_start();

error_reporting(E_ALL); // Error engine - always E_ALL!
error_reporting(E_ALL ^ E_DEPRECATED);
ini_set('ignore_repeated_errors', TRUE); // always TRUE
ini_set('display_errors',false ); // Error display - FALSE only in production environment or real server. TRUE in development environment
ini_set('log_errors', TRUE); // Error logging engine
ini_set('error_log', 'errors.log'); // Logging file path
ini_set('log_errors_max_len', 1024); // Logging file size


  include('../include/access/connector.php');

	if(isset($_POST['bill'])){
      
      
      $orderno = $_POST['orderid'];      
      $cust_name = $_POST['cust_name'];
      $total_amt = $_POST['b_amt'];
      $b_date = $_POST['b_date'];
      $total_pay = $_POST['b_pay_amt'];
      $cust_id = $_POST['cust_id'];
      
      
      
      $total_bal = $total_amt - $total_pay;


		{	
			mysqli_query($con,"INSERT INTO t_billing(billing_date,order_no,b_amount,deleted,b_pay_amt,b_balance)
			VALUES('$b_date','$orderno','$total_amt','0','$total_pay','$total_bal')")or die(mysqli_error($con));

      //  echo '<script>window.location = "../t_billing.php"</script>';
      mysqli_query($con,"UPDATE t_order_details set order_payment_status='PAID' where order_id = '$orderno'")or die(mysqli_error($con));
	

	
	
 

//   $query0=mysqli_query($con,"SELECT round(sum(b.price * b.qty - (b.price * b.qty * (c.terms_discount/100))),2) as overallprice FROM t_order_details as a 
//   LEFT join t_cart as b on a.order_guest_id = b.guest_id
//   left join t_payment_terms as c on a.order_payment_terms = c.terms_id
//  where a.order_id = '$orderno'")or die(mysqli_error());
//   while($row=mysqli_fetch_array($query0)){
//     // // $price = $row['price'];
//     // // $qty = $row['qty'];
//     // // $total_cost = $price * $qty;
//     // // $total += $total_cost; 
//     $qty = $row['overallprice'];
    
  
//   if ($total == $total_pay){
//     mysqli_query($con,"UPDATE t_order_details set order_payment_status='PAID' where order_id = '$orderno'")or die(mysqli_error($con));
//   }elseif ($total_pay > $total){
//     mysqli_query($con,"UPDATE t_order_details set order_payment_status='PAID' where order_id = '$orderno'")or die(mysqli_error($con));
//   }elseif ($total_pay < $total){
//     mysqli_query($con,"UPDATE t_order_details set order_payment_status='UNPAID' where order_id = '$orderno'")or die(mysqli_error($con));
//   }else{
//     mysqli_query($con,"UPDATE t_order_details set order_payment_status='UNPAID' where order_id = '$orderno'")or die(mysqli_error($con));

//   }



  echo '<script>window.location = "../t_billing.php"</script>';
  }
}
// }

?>





	
