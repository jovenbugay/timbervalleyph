<?php
session_start();
  include('../include/access/connector.php');

	if(isset($_POST['delete'])){

  $userid = $_POST['userid'];
  $access = $_SESSION['access'];
  // mysqli_query($con,"DELETE from t_users where id ='$userid'")
  mysqli_query($con,"UPDATE t_users set deleted = 1  where id ='$userid'")
 or die(mysqli_error($con)); 
 if ($access == "1"){
  echo '<script>window.location = "../t_users_admin.php"</script>';
 }else if($access == "3"){
  echo '<script>window.location = "../t_users.php"</script>';
 }
 
  }


  if(isset($_POST['restore'])){

    $userid = $_POST['userid'];
  
    // mysqli_query($con,"DELETE from t_users where id ='$userid'")
    mysqli_query($con,"UPDATE t_users set deleted = 0  where id ='$userid'")
   or die(mysqli_error($con)); 
   echo '<script>window.location = "../t_users.php"</script>';
    }




?>