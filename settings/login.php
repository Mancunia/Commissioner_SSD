<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if(isset($_SESSION['user_id'])){

  header ("Location:../index.php");
}
include '../requires/app_user.php';
$app=new app_user();
$error_msg="";

if(isset($_POST['login'])){

$result= $app->login($_POST['user'],$_POST['pass']);

// $result=mysqli_fetch_array($results);

if($result['username']==$_POST['user']&&$result['password']==$_POST['pass']){

  if($result['status']==0){
   echo"<div class='alert alert-danger alert-dismissible fade show bg-light' role='alert'>
   <strong>OOPS!</strong> Your account isn't active
   <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
     <span aria-hidden='true'>&times;</span>
   </button>
   </div>";
   
  }
  else{
   
$_SESSION['user_id']=$result['user_id'];
$_SESSION['role']=$result['role'];
// $_SESSION['fname']=$result['fname'];
$_SESSION['office']=$result['office_id'];
$_SESSION['grp']=$result['grp_id'];
$_SESSION['cred_1']=$result['username'];
$_SESSION['cred_2']=$result['password'];
$_SESSION['department']=$result['department_id'];
$app->lastLogin($_SESSION['user_id']);

if($result['username']==$result['password']){
  header ("Location:setpassword.php");
}
else{
header ("Location:../index.php");
}

}

}
   
   else{
       echo "<div class='alert alert-danger alert-dismissible fade show bg-light' role='alert'>
       <strong>OOPS!</strong> Your credentials are not correct or you are not supposed to be trying this.
       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
         <span aria-hidden='true'>&times;</span>
       </button>
       </div>"; 
   }
  }
?>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>
  <link rel="icon" type="image/ico" href="../image/gra.jpg" />

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

   <style>
  .bg-blue{

    background-color: #30336B;

   /* background-color: #30336B;*/ 
    /*background-image: url("../image/gra.png");*/
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
}

.sys-name{
font-size: 41pt;
color: white;
font-style: bold;


}

  </style>


</head>
<?php

echo $error_msg; 

?>
<body class="bg-blue">
  <!-- <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

   </nav> -->
   <div class="container-fluid row bg-dark ">
     <img src="../image/gra.png"><b><span class="sys-name">_SPP</span></b>
   </div>

  

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form action="" method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputEmail" class="form-control" name="user" placeholder="Email address" required="required" autofocus="autofocus">
              <label for="inputEmail">Username</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" class="form-control" name="pass" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
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
          <button type="submit" class="btn btn-primary btn-block" name="login" >Login</button>
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

</body>

</html>
