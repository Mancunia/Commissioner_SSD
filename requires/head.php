<?php
session_start();
if(!isset($_SESSION['user_id'])){

  header ("Location:./settings/login.php");
}

if($_SESSION['cred_1']==$_SESSION['cred_2']){
  header ("Location:./settings/setpassword.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/ico" href="/image/gra.jpg" />

  <title>Service Providers Payment</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">


<link href="css/this.css" rel="stylesheet">
</head>
