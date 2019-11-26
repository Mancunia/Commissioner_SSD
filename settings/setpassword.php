<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if(!isset($_SESSION['user_id'])){

  header ("Location:login.php");
}
include '../requires/app_user.php';
$app=new app_user();
$error_msg="";

if(isset($_POST['newPass'])){
  $pass1=$_POST['pass1'];
  $pass2=$_POST['pass2'];

  if($pass1==$pass2){
$app->resetPassword($pass1,$_SESSION['user_id']);
$_SESSION['cred_2']=$pass1;
  }
  else{
    echo"
    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>WOW!</strong> The passwords aren't the same
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
    </div>
    ";
  }

}
?>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Set Password</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">



</head>

<body class="bg-dark">


  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form action="" method="post" onsubmit="chkpass()">
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="pass1" class="form-control" name="pass1" placeholder="Email address" required="required" autofocus="autofocus">
              <label for="pass1">New Password</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="pass2" class="form-control" name="pass2" placeholder="Password" required="required">
              <label for="pass2">Confirm Password</label>
            </div>
          </div>
          <div class="form-group">
            <!-- <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Remember Password
              </label>
            </div> -->
          </div>
          <button type="submit" class="btn btn-primary btn-block" name="newPass" >Login</button>
        </form>
        <!-- <div class="text-center">
          <a class="d-block small mt-3" href="../register.html">Register an Account</a>
          <a class="d-block small" href="../forgot-password.html">Forgot Password?</a>
        </div> -->
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <script>
  var pass1 =document.getELementById('pass1');
  var pass2=document.getELementById('pass2');
  chkpass(){
    if(pass1!=pass2){
      alert("Passwords don't match, please check");
    }
  }
  </script>

</body>


</html>
