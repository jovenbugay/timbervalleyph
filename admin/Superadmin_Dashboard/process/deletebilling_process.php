<?php

  include('../include/access/connector.php');
  error_reporting(E_ALL); // Error engine - always E_ALL!
error_reporting(E_ALL ^ E_DEPRECATED);
ini_set('ignore_repeated_errors', TRUE); // always TRUE
ini_set('display_errors',false ); // Error display - FALSE only in production environment or real server. TRUE in development environment
ini_set('log_errors', TRUE); // Error logging engine
ini_set('error_log', 'errors.log'); // Logging file path
ini_set('log_errors_max_len', 1024); // Logging file size

	if(isset($_POST['delete'])){

      $orderiddelete = $_POST['order_id'];
      $cust_name = $_POST['cust_name'];
      $b_date = $_POST['b_date'];
      $b_price = $_POST['b_price'];

{
  mysqli_query($con,"UPDATE t_billing SET deleted='1' where order_no = '$orderiddelete'")
    or die(mysqli_error($con)); 
    
}
  



      mysqli_query($con,"UPDATE t_order_details set order_payment_status='UNPAID' where order_id = '$orderiddelete'")or die(mysqli_error($con));

    
  echo '<script>window.location = "../t_billing.php"</script>'; 
	}


?>

