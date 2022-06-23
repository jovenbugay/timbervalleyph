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

	if(isset($_POST['savecity'])){
      
      
      $cityname = $_POST['cityname'];
	  $regionid = $_POST['regionname'];
 
 
      
      
    
  $query2=mysqli_query($con,"select * from t_city where city_name='$cityname'")or die(mysqli_error($con));
		$count=mysqli_num_rows($query2);

		if ($count>0)
		{
			// echo json_encode(array("status" => "failed"));
			echo "<script type='text/javascript'>alert('City already exist!');</script>";
			echo '<script>window.location = "../t_region.php"</script>'; 
		}
		else
		{	
			

			mysqli_query($con,"INSERT INTO t_city(city_region_id,city_name)
			VALUES('$regionid','$cityname')")or die(mysqli_error($con));
            echo '<script>window.location = "../t_region.php"</script>';
	

	
		}
  }



  if(isset($_POST['savenewcityname'])){
$cityeditid = $_POST['cityeditid'];
$lastregionid = $_POST['lastregionid'];
$editcityname = $_POST['editcityname'];
$editregion = $_POST['editregionid'];


if($lastregionid !== $editregion){
	$editcity = mysqli_query($con,"UPDATE t_city set city_region_id = '$editregion',city_name = '$editcityname' where city_id ='$cityeditid'");
	echo '<script>window.location = "../t_region.php"</script>';
}else{
	$editcity = mysqli_query($con,"UPDATE t_city set city_name = '$editcityname' where city_id ='$cityeditid'");
	echo '<script>window.location = "../t_region.php"</script>';
}

  }


  if(isset($_POST['deletecity'])){
	  $citydeleteid = $_POST['citydeleteid'];

	  $deletecity = mysqli_query($con,"DELETE from t_city where city_id ='$citydeleteid'");


	  if($deletecity){
		echo '<script>window.location = "../t_region.php"</script>';
	  }
  }


?>
	
