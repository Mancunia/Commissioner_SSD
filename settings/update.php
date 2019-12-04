<?php
include 'includes/com_ssd.php';
$com_ssd= new com_ssd();

session_start();
if(!isset($_SESSION['user_id'])){
  header("Location:index.php");
}


if(isset($_POST['edit'])){
$payid=$_POST['id'];
$amnt=$_POST['newAmt'];
$amc_in=$_POST['newAmc_in'];
$amc_out=$_POST['newAmc_out'];
$due_date=$_POST['newDue_date'];
$period=$_POST['newPeriod'];
$year=$_POST['newYear'];

$com_ssd->editPayment($payid,$amnt,$amc_in,$amc_out,$due_date,$period,$year,$_SESSION['rank']);

$com_ssd->addRemark($payid,$_SESSION['user_id'],$_POST['note']);
$link="Location:review.php?payid=".$payid;

header($link);
}


//page actions..........................................................................
if(isset($_GET['payid'])){
$feed= $com_ssd->deletePayment($_GET['payid']);
echo $feed;
  header("Location:home.php");
}


if( isset($_POST['comment']) ){
    $pay_id=$_POST['id'];
    
  //just a message
  $com_ssd->addRemark($pay_id,$_SESSION['user_id'],$_POST['note']);
  
  }
  
  //declined
  if(isset($_POST['declined'])){
    $pay_id=$_POST['id'];
    $uid=$_SESSION['rank'];
    
    //Declined
    $status="";
switch ($uid){
  case "AC":
  $status="Denied";
  break;
  case "DC":
  $status="Revise";
  break;
  case "Commissioner":
  $status="Declined"; 
  break;
  default:
  $status="Halt";
}

$com_ssd->updateStatus($pay_id,$_SESSION['rank'],$_SESSION['user_id'],$_POST['note'],$status);

$com_ssd->addRemark($pay_id,$_SESSION['user_id'],$_POST['note']);
    
    }
  
    //Accepted
    if(isset($_POST['approval'])){
        $pay_id=$_POST['id'];
        $uid=$_SESSION['rank'];
      //Approved
      switch ($uid){
        case "AC":
        $status="Submitted";
        break;
        case "DC":
        $status="Recommended";
        break;
        case "Commissioner":
        $status="Approved"; 
        break;
        default:
        $status="Halt";
      }

    $com_ssd->updateStatus($pay_id,$_SESSION['rank'],$_SESSION['user_id'],$_POST['note'],$status);
    
    $com_ssd->addRemark($pay_id,$_SESSION['user_id'],$_POST['note']);
      }

?>