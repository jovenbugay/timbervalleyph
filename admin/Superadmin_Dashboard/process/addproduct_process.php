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

	if(isset($_POST['prod'])){
      
      // $corporate_name = $phdb->real_escape_string($_POST['corporate_name']);
      $prodcode = $_POST['prodcode'];
      $proddesc = $_POST['proddesc'];
      $prodprice = $_POST['prodprice'];
      // $image = $_POST['image'];
      


  $query2=mysqli_query($con,"select * from t_products where product_code='$prodcode'")or die(mysqli_error($con));
		$count=mysqli_num_rows($query2);

		if ($count>0)
		{
			// echo json_encode(array("status" => "failed"));
			// echo "<script type='text/javascript'>alert('Product already exist!');</script>";
			// echo "<script>document.location='../t_productlist.php'</script>";  
		}
		else
		{	
			

			$pic = $_FILES["image"]["name"];
			if ($pic=="")
			{
				$pic="default.png";
			}
			else
			{

				$pic = $_FILES["image"]["name"];
				$type = $_FILES["image"]["type"];
				$size = $_FILES["image"]["size"];
				$temp = $_FILES["image"]["tmp_name"];
				$error = $_FILES["image"]["error"];
			
				if ($error > 0){
					die("Error uploading file! Code $error.");
					}
				else{
					if($size > 100000000000) //conditions for the file
						{
						die("Format is not allowed or file size is too big!");
						}
				else
				      {
                // move_uploaded_file($temp, '..//image/'.$pic);
                move_uploaded_file($temp, "../../image/".$pic);

                
				      }
					}
			}	

			mysqli_query($con,"INSERT INTO t_products(product_code,product_desc,product_price,product_status,product_img)
			VALUES('$prodcode','$proddesc',$prodprice,'1','default.png')")or die(mysqli_error($con));
			// echo json_encode(array("status" => "success"));

	// 		echo "<script type='text/javascript'>alert('Successfully added new product!');</script>";
    //   echo '<script>window.location = "../t_productlist.php"</script>';
	

	
		}
  }


?>
	
