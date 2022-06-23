<?php

include('../include/access/connector.php');

if (isset($_POST['login_hr'])) {
    session_start();
    $username = $_POST['username'];
    $password   = $_POST['password'];
    $accesstype  = $_POST['useraccess'];
    $pword = md5($password);

          ////////////////////////////////////////////////////////Owner////////////////////////////////////////////////////////
    if ($accesstype == "3") {
        $query  = $phdb->query("SELECT * FROM t_users WHERE username='$username' AND password='$pword' AND access='$accesstype'");
        $row     = mysqli_fetch_array($query);
        $num_row = mysqli_num_rows($query);
        if ($num_row > 0) {
            echo "<script type='text/javascript'>alert('Login Successfully!!');document.location = '../Superadmin_Dashboard/Superadmin_Dashboard.php'</script>";
            
            $_SESSION['id'] = $row['id'];
            $_SESSION['useraccess'] = $row['useraccess'];
        } else {
            echo "<script type='text/javascript'>alert('Invalid Email or Password,Please try again!');document.location = '../index.php'</script>";
        }

        ////////////////////////////////////////////////////////////Admin////////////////////////////////////////////////////
        
	    } else if ($accesstype == "1") {
	        $query   = $phdb->query("SELECT * FROM t_users WHERE username='$username'  AND password='$pword' AND access='$accesstype'");
	        $row     = mysqli_fetch_array($query);
	        $num_row = mysqli_num_rows($query);
	        if ($num_row > 0) {
	            
	            echo "<script type='text/javascript'>alert('Login Successfully!!');document.location = '../Admin/Admin_Dashboard.php'</script>";
	           $_SESSION['id'] = $row['id'];
	        } else {
	            
	            echo "<script type='text/javascript'>alert('Invalid Email or Password,Please try again!');document.location = '../index.php'</script>";
	        }
	    
	   ////////////////////////////////////////////////////////////Employee//////////////////////////////////////////////////////

     } else if ($accesstype == "2") {
        $query   = $phdb->query("SELECT * FROM t_users WHERE username='$username' AND password='$pword' AND access='$accesstype'");
        $row     = mysqli_fetch_array($query);
        $num_row = mysqli_num_rows($query);
        if ($num_row > 0) {
            
            echo "<script type='text/javascript'>alert('Login Successfully!!');document.location = '../Employee/Employee_Dashboard.php'</script>";
           $_SESSION['id'] = $row['id'];
        } else {
            
            echo "<script type='text/javascript'>alert('Invalid Email or Password,Please try again!');document.location = '../index.php'</script>";
        }
    }
        
}
?>

<input type="text" class="form-control" placeholder="Username" name="username" value=<?php echo $accesstype; ?> />
<input type="text" class="form-control" placeholder="Username" name="username" value=<?php echo $num_row; ?> />
