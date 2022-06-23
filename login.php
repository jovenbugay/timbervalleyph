<?php
include('db/connect.php');
error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting(E_ALL); // Error engine - always E_ALL!
ini_set('ignore_repeated_errors', TRUE); // always TRUE
ini_set('display_errors', FALSE); // Error display - FALSE only in production environment or real server. TRUE in development environment
ini_set('log_errors', TRUE); // Error logging engine
ini_set('error_log', 'errors.log'); // Logging file path
ini_set('log_errors_max_len', 1024); // Logging file size

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - Timber Valley PH</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    

    <style>
        h1 {
            font-size: 30px !important;
            font-weight: bold;

        }

        .form-control {
            width: 300px;
            /* background: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5));
                color: #FFF !important; */
        }

        input.largerCheckbox {
            width: 20px;
            height: 20px;
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
                <h1 class="mx-auto my-0 text-uppercase">Sign In</h1>
                <?php
                if (isset($_POST['btnlogin'])) {
                    $emailusername = $_POST['emailusername'];
                    $password = $_POST['password'];
                    $result = mysqli_query($con, "SELECT * FROM t_customers where customer_email = '$emailusername' OR customer_username = '$emailusername' AND customer_password = '$password'  ");
                    if (mysqli_num_rows($result) == 1) {
                        $row = mysqli_fetch_array($result);
                        session_start();
                        if (!$_SESSION['guest_id']) {
                            $query5 = "SELECT COUNT(*) FROM t_user_auth ";
                            $result5 = mysqli_query($con, $query5);
                            $row3 = mysqli_fetch_array($result5);
                            $total2 = $row3[0];
                            $total3 = $total2 + 1;
                            //$total3 = md5($total3);
                            $_SESSION['guest_id'] = $total3;
                            $query = "INSERT INTO t_user_auth(cookie_value,status) values('$total3','1')";
                            $result = mysqli_query($con, $query);
                        }
                        $_SESSION['customer_id'] = $row['customer_id'];
                        $_SESSION['username'] = $row['customer_username'];
                        $_SESSION['email'] = $row['customer_email'];
                        // header('location:customer/');
                        header('location:loginpost.php');
                    } else {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Invalid Credentials
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>';
                    }
                }

                ?>
                <div class="container mb-3">

                    <form method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" name="emailusername" placeholder="Email/Username" required>
                        </div>
                        <!-- <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                
                            </div> -->
                        <!-- <div class="form-group"> -->
                            <div class="input-group mb-3">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span style="cursor: pointer;" class="fas fa-eye" id="togglePassword" onclick="myFunction()"></span>
                                    </div>
                                </div>
                            </div>
                        <!-- </div> -->

                        <!-- <div class="form-group">
                            <p style="color: white;">
                                <input type="checkbox" class="largerCheckbox" onclick="myFunction()"> Show Password
                            </p>


                        </div> -->

                        <div class="form-group">
                            <a class="nav-forgot" href="forgot-password.php">Forgot Password?</a>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="btnlogin">Sign In</button>
                        </div>
                    </form>
                </div>




            </div>
        </div>
    </header>
    <!-- About-->
    <script>
        function myFunction() {
            var x = document.getElementById("password");
            // var eye = document.getElementById("togglePassword");
            
            if (x.type === "password") {
                x.type = "text";
                
                // eye.classList.toggle("fas fa-eye");
                
            } else {
                x.type = "password";
                // eye.classList.toggle("fas fa-eye-slash");
                
                
            }
        }
    </script>

    <!-- <script>
      $(document).ready(function() {
      const togglePassword = document.querySelector('#togglePassword');
      const password = document.querySelector('#password');
    })
    togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye / eye slash icon
    this.classList.toggle('fas fa-eye');
});
    </script> -->


  

    <!-- Footer-->
    <footer class="footer bg-black small text-center text-white-50">
        <div class="container">Copyright &copy; Timber Valley PH 2021</div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>