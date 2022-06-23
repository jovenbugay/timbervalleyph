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

	if(isset($_POST['display'])){
      
      
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $email = $_POST['uemail'];
      $username = $_POST['username'];
      $password = $_POST['password'];
      $access = $_POST['useraccess'];
      $encrypt_pass = md5($password);
      
      
    
  $query2=mysqli_query($con,"select * from t_users where username='$username' or email = '$email'")or die(mysqli_error($con));
		$count=mysqli_num_rows($query2);

		if ($count>0)
		{
			// echo json_encode(array("status" => "failed"));
			echo "<script type='text/javascript'>alert('User/Email already exist!');</script>";
			echo '<script>window.location = "../t_users.php"</script>'; 
		}
		else
		{	
			

			mysqli_query($con,"INSERT INTO t_users(username,password,access,email,fname,lname)
			VALUES('$username','$encrypt_pass','$access','$email','$fname','$lname')")or die(mysqli_error($con));
            echo '<script>window.location = "../t_users.php"</script>';
	

	
		}
  }


?>
	
