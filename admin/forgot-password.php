<?php 
error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting(E_ALL); // Error engine - always E_ALL!
ini_set('ignore_repeated_errors', TRUE); // always TRUE
ini_set('display_errors', FALSE); // Error display - FALSE only in production environment or real server. TRUE in development environment
ini_set('log_errors', TRUE); // Error logging engine
ini_set('error_log', 'errors.log'); // Logging file path
ini_set('log_errors_max_len', 1024); // Logging file size

$date = new DateTime("now", new DateTimeZone('Asia/Manila') );
$new = $date->format('Y-m-d H:i:s');
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';
require 'PHPMailer/PHPMailer/src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
require 'PHPMailerAutoload.php';

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<style>
  /* .login-card-body,
.register-card-body {
  background: white;
  border-top: 0;
  color: #666;
  padding: 20px;
  opacity:1.5 !important;
  background-color: rgba(50, 50, 245, 0.4);
  
} */

.btn-primary {
  color: #fff;
  background-color: #64a19d;
  border-color: #64a19d;
}
.btn-primary:hover {
  color: #fff;
  background-color: #548b87;
  border-color: #4f837f;
}

h1{
font-size:30px !important;
font-weight:bold;
font-family: "Varela Round", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  font-size: 2.5rem;
  line-height: 2.5rem;
  letter-spacing: 0.8rem;
  background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0));
  -webkit-text-fill-color: transparent;
  -webkit-background-clip: text;
          background-clip: text;

}
h1, h2, h3, h4, h5, h6,
.h1, .h2, .h3, .h4, .h5, .h6 {
  margin-bottom: 0.5rem;
  font-weight: 500;
  line-height: 1.2;
}
h1, .h1 {
  font-size: 2.5rem;
}  
.masthead h1 {
  font-family: "Varela Round", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  font-size: 2.5rem;
  line-height: 2.5rem;
  letter-spacing: 0.8rem;
  background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0));
  -webkit-text-fill-color: transparent;
  -webkit-background-clip: text;
          background-clip: text;
}       
</style>



<body class="login-page" id="body-img">
  
    <div class="login-box">

    <?php
                    if(isset($_POST['btnreset'])){
                        $email = $_POST['email'];
                        $mail = new PHPMailer;
                        $mail->isSMTP();
                        $mail->SMTPDebug = 0;
                        $mail->Host = 'smtp.hostinger.com';
                        $mail->Port = 587;
                        $mail->SMTPAuth = true;
                        $mail->Username = 'reset@timbervalleyph.com';
                        $mail->Password = 'P@55w0rd1230';
                        $mail->setFrom('reset@timbervalleyph.com', 'Timber Valley PH');
                        $mail->addReplyTo('reset@timbervalleyph.com', 'Timber Valley PH');
                        //$mail->addAddress('support@aristocrat.com.ph', 'IT Help Desk');
                        $mail->addAddress($email);
                        $mail->Subject = 'Reset Password - Timber Valley PH';
                        //$mail->msgHTML(file_get_contents('message.html'), __DIR__);
                        $mail->Body ='Dear User,<br><br>
                        Please click the link below to reset your password.<br><br>
                        https://timbervalleyph.com/admin/new-password.php?ref='.$email;
                        
                        
                        $mail->IsHTML(true);
                        if($mail->send()){

                            echo '
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span style="font-size:12px;"><b>Success!</b><br>Please check your email address</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            
                            ';
                            //echo "<script type='text/javascript'>document.location = 'index.php'</script>";
  
                        }else{
                            echo "error";
                        }
                        
                    }

                   ?>

    <div class="mx-auto text-center">
                    <h1 class="mx-auto my-0 text-uppercase">Reset<br></h1>


                <form method="POST">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Enter Email Address">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                   
                    <div class="row">
                        
                        <!-- /.col -->
                        <div class="col-6">
                            <button type="submit" name="btnreset" class="btn btn-primary btn-block">Reset Password</button>
                        </div>
                        <div class="col-6">
                          <input type="button" value="Login" class="btn btn-primary btn-block" id="btnHome" onClick="Javascript:window.location.href = 'index.php';" />
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
    </div>






    <!-- /.login-box -->




    <script src="../Superadmin_Dashboard/plugins/jquery/jquery.min.js"></script>
<script src="../Superadmin_Dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../Superadmin_Dashboard/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../Superadmin_Dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../Superadmin_Dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../Superadmin_Dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>





    <script src="../../dist/js/demo.js"></script>
<script type="text/javascript">
$(document).ready(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      alert( "Form successful submitted!" );
    }
  });
  $('#quickForm').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 5
      },
      terms: {
        required: true
      },
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
</body>

</html>