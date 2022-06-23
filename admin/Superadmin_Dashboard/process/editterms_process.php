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

      $termid = $_POST['termid'];
      $payterms = $_POST['payterms'];
      $termdesc = $_POST['termdesc'];
      $termdisc = $_POST['termdisc'];


{

  mysqli_query($con,"UPDATE t_payment_terms SET terms_name='$payterms',terms_desc = '$termdesc',terms_discount='$termdisc'
  where terms_id ='$termid'")
    or die(mysqli_error($con)); 

}
}


 
  echo '<script>window.location = "../t_terms.php"</script>'; 
	


?>


