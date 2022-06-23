<?php

include('../include/access/connector.php');

if (isset($_POST['login_hr'])) {
    session_start();
    $username = $_POST['username'];
    $password   = $_POST['password'];
    // $accesstype  = $_POST['useraccess'];
    $pword = md5($password);

          ////////////////////////////////////////////////////////Owner////////////////////////////////////////////////////////
   
        $query  = mysqli_query($con,"SELECT * FROM t_users WHERE username='$username' AND password='$pword'");
        $row     = mysqli_fetch_array($query);
        $num_row = mysqli_num_rows($query);
        
  
    


        if ($num_row > 0 && $row['deleted'] == "0") {
            $_SESSION['id'] = $row['id'];
            $_SESSION['access'] = $row['access'];
            echo "<script type='text/javascript'>alert('Login Successfully!!');document.location = '../Superadmin_Dashboard/Superadmin_Dashboard.php'</script>";
            
            
        } else if ($num_row > 0 && $row['deleted'] == "1"){
            echo "<script type='text/javascript'>alert('This User is no longer active');document.location = '../index.php'</script>";
        }
        
        else {
            echo "<script type='text/javascript'>alert('Invalid Email or Password,Please try again!');document.location = '../index.php'</script>";
      
    }
        
}
?>

<?php echo $num_row;?>
