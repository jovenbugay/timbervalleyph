<?php
session_start();

  include('../include/access/connector.php');

	if(isset($_POST['prod'])){
      
      // $corporate_name = $phdb->real_escape_string($_POST['corporate_name']);
      $prodcode = $_POST['prodcode'];
      $proddesc = $_POST['productdesc'];
      $prodprice = $_POST['prodprice'];
   


  $query2=mysqli_query($con,"select * from t_products where product_code='$prodcode'")or die(mysqli_error($con));
		$count=mysqli_num_rows($query2);

		if ($count>0)
		{
			echo "<script type='text/javascript'>alert('Product already exist!');</script>";
			echo "<script>document.location='../e_productlist.php'</script>";  
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
			VALUES('$prodcode','$proddesc',$prodprice,'1','$pic')")or die(mysqli_error($con));

			echo "<script type='text/javascript'>alert('Successfully added new product!');</script>";
    //   echo '<script>window.location = "../e_productlist.php"</script>';
		}
  }


?>
