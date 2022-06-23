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

	if(isset($_POST['updateuser'])){
      
      
      $userid = $_POST['userid'];
	  $fname = $_POST['fname'];
	  $lname = $_POST['lname'];
	  $email = $_POST['email'];
	  $username = $_POST['username'];
	  $password = $_POST['password'];
	  $useraccess = $_POST['useraccess'];
	//   $pass = md5($password);
 
    if ($password ==''){
		mysqli_query($con,"UPDATE t_users SET username='$username', fname = '$fname',lname = '$lname', 
		email = '$email',access = '$useraccess' where id='$userid'")
	 or die(mysqli_error($con)); 
	}
	else
	{
		$pass = md5($password);
		mysqli_query($con,"UPDATE t_users SET username='$username', password='$pass' ,fname = '$fname',lname = '$lname', 
		email = '$email',access = '$useraccess' where id='$userid'")
	 or die(mysqli_error($con)); 

	}
	echo "<script type='text/javascript'>alert('Successfully updated user details!');</script>";
	echo '<script>window.location = "../t_users.php"</script>';

  }


?>

	
