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

	if(isset($_POST['saveregion'])){
      
      
      $region = $_POST['regionname'];
 
 
      
      
    
  $query2=mysqli_query($con,"select * from t_region where region_name='$region'")or die(mysqli_error($con));
		$count=mysqli_num_rows($query2);

		if ($count>0)
		{
			// echo json_encode(array("status" => "failed"));
			echo "<script type='text/javascript'>alert('Region already exist!');</script>";
			echo '<script>window.location = "../t_region.php"</script>'; 
		}
		else
		{	
			

			mysqli_query($con,"INSERT INTO t_region(region_name)
			VALUES('$region')")or die(mysqli_error($con));
            echo '<script>window.location = "../t_region.php"</script>';
	

	
		}
  }



  if(isset($_POST['savenewregion'])){
	  $newregionname = $_POST['newregionname'];
	  $regionid = $_POST['regionid'];

	  $editregion = mysqli_query($con,"UPDATE t_region set region_name ='$newregionname'
	   where region_id='$regionid'");
	  if ($editregion){
		echo '<script>window.location = "../t_region.php"</script>';
	  }
  }


  if(isset($_POST['deleteregion'])){
	  $regiondeleteid = $_POST['regiondeleteid'];

	  $deleteregion = mysqli_query($con,"DELETE from t_region where region_id ='$regiondeleteid'");


	  if($deleteregion){
		echo '<script>window.location = "../t_region.php"</script>';
	  }
  }


?>
	
