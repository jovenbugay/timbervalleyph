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

	if(isset($_POST['term'])){
      
      
      $payterm = $_POST['payterm'];
      $termdesc = $_POST['termdesc'];
      $termdisc = $_POST['termdisc'];

      
      
    
  $query2=mysqli_query($con,"select * from t_payment_terms where terms_name='$payterm' or terms_desc = '$termdesc'")or die(mysqli_error($con));
		$count=mysqli_num_rows($query2);

		if ($count>0)
		{
			// echo json_encode(array("status" => "failed"));
			echo "<script type='text/javascript'>alert('Payment Term is Already Exist!');</script>";
			echo '<script>window.location = "../t_terms.php"</script>'; 
		}
		else
		{	
			

			mysqli_query($con,"INSERT INTO t_payment_terms(terms_name,terms_desc,terms_discount)
			VALUES('$payterm','$termdesc','$termdisc')")or die(mysqli_error($con));
            echo '<script>window.location = "../t_terms.php"</script>';
	

	
		}
  }


?>
	
