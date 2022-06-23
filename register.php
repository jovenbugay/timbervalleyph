<?php
include('db/connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sign Up - Timber Valley PH</title>
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
                    <li class="nav-item"><a class="nav-link" href="login.php">Sign In</a></li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container d-flex h-100 align-items-center">
            <div class="mx-auto text-center">
                <h1 class="mx-auto my-0 text-uppercase">Sign Up</h1>


                <!-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Product Already Exist</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div> -->




                <div class="container mb-3 align-items-center">
                    <?php
                    if (isset($_POST['btnregister'])) {
                        $fname = $_POST['fname'];
                        $lname = $_POST['lname'];
                        $mobile = $_POST['mobile'];
                        $email = $_POST['email'];
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $passlen = strlen($password);

                        $checkemail = mysqli_query($con, "SELECT * from t_customers where customer_email = '$email' or customer_username='$username'");

                        if (mysqli_num_rows($checkemail) > 0) {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Email/Username already exist please select different Email/Username</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                        } else if($passlen < 8){
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Password at least 8 characters</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>';
                        }
                        else {
                            $result = mysqli_query($con, "INSERT INTO t_customers (customer_fname,customer_lname,customer_mobile,customer_username,customer_email,customer_password) VALUES ('$fname','$lname','$mobile','$username','$email','$password') ");
                            if ($result) {
                                header('location:success.php');
                            }
                            
                            
                        }


                        // $result = mysqli_query($con,"INSERT INTO t_customers (customer_fname,customer_lname,customer_mobile,customer_username,customer_email,customer_password) VALUES ('$fname','$lname','$mobile','$username','$email','$password') ");

                        // if($result){
                        //     header('location:success.php');
                        // }

                    }

                    ?>
                    <form method="POST">
                     


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="fname" placeholder="First Name" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="lname" placeholder="Last Name" required>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="mobile" placeholder="Mobile Number" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                                </div>
                            </div>
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="Password" minlength="8" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="btnregister">Sign Up</button>
                        </div>
                    </form>
                </div>




            </div>
        </div>
    </header>
    <!-- About-->

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