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

      $termid = $_POST['termid'];
   


{

  mysqli_query($con,"DELETE from t_payment_terms where terms_id ='$termid'")
    or die(mysqli_error($con)); 

}
}


 
  echo '<script>window.location = "../t_terms.php"</script>'; 
	


?>


