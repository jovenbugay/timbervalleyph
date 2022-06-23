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
      // $corporate_id = $phdb->real_escape_string($_POST['corporate_id']);
      // $corporate_name = $phdb->real_escape_string($_POST['corporate_name']);
      $prodid = $_POST['prod_id'];
 




    mysqli_query($con,"UPDATE t_products SET product_desc='$prodcode', product_desc = '$proddesc',
     product_price = '$prodprice', product_img = '$pic' where product_id = '$prodid'")
    or die(mysqli_error($con)); 
    echo '<script>window.location = "../t_productlist.php"</script>';

	}


?>