<?php 
include('db/connect.php');
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
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Reset Password - Timber Valley PH</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />

        <style>
            h1{
                font-size:30px !important;
                font-weight:bold;
     
            }

            .form-control{
                width:300px;
                /* background: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5));
                color: #FFF !important; */   
            }


        </style>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">Timber Valley</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="register.php">Sign Up</a></li>
       
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container d-flex h-100 align-items-center">
                <div class="mx-auto text-center">
                    <h1 class="mx-auto my-0 text-uppercase">Reset<br></h1>

                   <div class="container mb-3">
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
                        $mail->Body ='Dear Our Valued Customer,<br><br>
                        Please click the link below to reset your password.<br><br>
                        https://timbervalleyph.com/new_password.php?ref='.$email;
                        
                        
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
                            
                        }else{
                            echo "error";
                        }
                        
                    }

                   ?>
                        <form method="POST">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Enter Email Address" required>
                            </div>

                            

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="btnreset">Reset Password</button>
                            </div>
                        </form>
                   </div>
                        
                    

                    
                </div>
            </div>
        </header>
        <!-- About-->
      
        <!-- Footer-->
        <footer class="footer bg-black small text-center text-white-50"><div class="container">Copyright &copy; Timber Valley PH 2021</div></footer>
        <!-- Bootstrap core JS-->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
