<?php
// session_start();
// if(!isset($_SESSION['user_id'])){
//   header("Location:index.php");
// }
//  require_once 'includes/conn.php';
 $conn=new Database();
$db=$conn->getdbconnect();
?>

<?php
//adding new company which do not exist 
if(isset($_POST['submit'] )){
    // $cid = htmlspecialchars(['company_id']);
    $companyName = htmlspecialchars($_POST['name']);
    $tin = htmlspecialchars($_POST['tin']);
    $contact = htmlspecialchars($_POST['contact']);
    $description = htmlspecialchars($_POST['description']);

    $sql = "INSERT INTO company (name, tin, contact, description)
VALUES ('$companyName', '$tin', '$contact','$description')";
 mysqli_query($db,$sql);
 
 header("Location: add_pay.php");

}

//adding existing company with payment records
// if(isset($_POST['submitBtn'] )){
//     // $pid = htmlspecialchars(['payment_id']);
//     $uid = $_SESSION['user_id'];
//     $cid = htmlspecialchars($_POST['company']);
//     $amount = htmlspecialchars($_POST['amount']);
//     $period = htmlspecialchars($_POST['period']);
//     $year = htmlspecialchars($_POST['year']);
//     $remark = htmlspecialchars($_POST['note']);
//     $amc_st = htmlspecialchars($_POST['amc_startDate']);
//     $amc_ed = htmlspecialchars($_POST['amc_endDate']);
//     $due_Date = htmlspecialchars($_POST['dueDate']);
//     $office=htmlspecialchars($_POST['office']);
//     $service=htmlspecialchars($_POST['service']);
//     $status="Awaiting";
//     if($_POST['rank']=="staff"){
//         $status="Stand By";
//     }
//     $combinedDT = date("Y-m-d");
    

//     $sql1 = "INSERT INTO payment  (company_id, amount, period,year,status,AMC_start,AMC_end,due_date,office,service_provided,date )
//     VALUES ('$cid', '$amount', '$period','$year','$status','$amc_st','$amc_ed','$due_Date','$office','$service',NOW())";

   
//     mysqli_query($db,$sql1);

//     $last_id=mysqli_query($db,"SELECT payment_id FROM payment ORDER BY payment_id DESC LIMIT 1");
//     $last_id=mysqli_fetch_array($last_id);
//     $pid=$last_id['payment_id'];

//      $sql2 = "INSERT INTO remark  (user_id, payment_id, note,date)
//     VALUES ('$uid', '$pid', '$remark',NOW())";

//     mysqli_query($db,$sql2);
 
//  header("Location: add_pay.php");

// }

if(isset($_POST['addservice'])){
    $serviceName = htmlspecialchars($_POST['name']); 
    $sql = "INSERT INTO service (title)
VALUES ('$serviceName')";
 mysqli_query($db,$sql);
}

if(isset($_POST['newPeriod'])){
    $periodName = htmlspecialchars($_POST['period']); 
    $sql = "INSERT INTO period (period_title)
VALUES ('$periodName')";
 mysqli_query($db,$sql);
}

 ?>
   