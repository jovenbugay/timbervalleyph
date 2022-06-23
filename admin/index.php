<?php
// session_start();
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
</style>



<body class="hold-transition login-page" id="body-img">
  <div class="login-box">
    <div class="login-logo">
      <h3 style="text-align: center;color: #FFFAFA;"><span class="fas fa-users text-muted"></span> Login&nbsp;Details</h3>
    </div>
    <!-- /.login-logo -->
    <div class="card" style="border-top: 3px   ;box-shadow: 2px 2px 2px 2px #f0f0ad;opacity: 1;">
      <div class="card-body login-card-body">
        <!--       <p class="login-box-msg">Sign in to start your session</p> -->

        <!-- <form action="initialize/login_process.php" method="post" id="formlogin-<?php echo $id; ?>"> -->
        <form action="initialize/login_process.php" method="post">
          <div class="input-group mb-3">
            <input type="username" class="form-control" name="username" placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span style="cursor: pointer;" class="fas fa-eye" id="togglePassword"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <!-- <p>
                                <input type="checkbox" class="largerCheckbox" onclick="myFunction()">  Show Password</p>  -->
              
            </div>
            <div class="col-8">
              <div class="icheck-primary">
                <a class="nav-forgot" href="forgot-password.php">Forgot Password?</a>
              </div>

            </div>


            <!-- /.col -->
            <div class="col-4">
              <button type="submit" name="login_hr" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>


        <!-- /.social-auth-links -->
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->


  <script>
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
  </script>


  <!-- <script>
    function myFunction() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script> -->




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
    $(document).ready(function() {
      $.validator.setDefaults({
        submitHandler: function() {
          alert("Form successful submitted!");
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
        errorPlacement: function(error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
  </script>
</body>

</html>