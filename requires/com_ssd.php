<?php
require 'requires/conn.php';

class com_ssd{
//Get payments details

function testDB(){
    $db = Database::getInstance();
    $mysqli = $db->getConnection(); 
    echo mysqli_get_server_info($mysqli);
    // $d= mysqli_fetch_array($result);
    // return $d[0];
}

function status($status){
    if($status=="Submitted"){
          return "<button class='btn btn-outline-primary'>".$status."...</button>";
        }
        else if($status=="Recommended"){
          return "<button class='btn btn-primary'>".$status."</button>";
        }
        else if($status=="Approved"){
          return "<button class='btn btn-success'>".$status."</button>";
        }
        else if($status=="Stand By"){
          return "<button class='btn btn-info'>".$status."</button>";
        }
        else if($status=="Revise"){
          return "<button class='btn btn-warning'>".$status."</button>";
        }
        else if($status=="Declined"){
          return "<button class='btn btn-outline-warning'>".$status."</button>";
        }
        else{
          return "<button class='btn btn-outline-danger'>".$status."</button>";
        }
        
}

function getPaymentDetails($payID){
    try{
        $conn = Database::getInstance();
        $db = $conn->getConnection(); 
//         $conn = new Database();
// $db=$conn->getdbconnect();
$result=mysqli_query($db,"SELECT p.*, c.*,s.service_title , v.period_title FROM payment p join company c  on p.company_id=c.company_id join service s on p.service_id=s.service_id join period v on p.period_id=v.period_id  
where p.payment_id='$payID' and p.alive=1");

    return $result;
    }
    catch (Exception $ex){
            echo $ex->getMessage();
            }
}

//add payment
function addPayments($uid,$cid,$amnt,$period,$year,$amc_st,$amc_end,$due_D,$depart,$service,$role){
    try{
        $conn = Database::getInstance();
            $db = $conn->getConnection();
        $status="Submitted";
        if($role=="1"){
            $status="Stand By";
        }

        // INSERT INTO `com_ssd`.`payment`

        mysqli_query($db,"INSERT INTO payment (`company_id`, `service_id`, `period_id`, `department_id`, `added_id`, `year`,`amount`, `amc_start`, `amc_end`, `due_date`, `status`, `created_date`) 
        VALUES ('$cid', '$service', '$period', '$depart', '$uid', '$year','$amnt', '$amc_st','$amc_end', '$due_D', '$status',NOW() ) ");

$last_id=mysqli_query($db,"SELECT payment_id FROM payment ORDER BY payment_id DESC LIMIT 1");
$last_id=mysqli_fetch_array($last_id);
$pid=$last_id['payment_id'];

return $pid;
    } 
    catch (Exception $ex){
        echo $ex->getMessage();
        }

}


    //Get payments for tables via role
    function getPayments($role,$depart){
        try{
            $conn = Database::getInstance();
            $db = $conn->getConnection();
            $status="";
            // $db=$conn->getdbconnect();
            
$this_yr=date("Y")."%";

switch ($role) {
    case 6:
        $status="Recommended";
        $result=mysqli_query($db,"SELECT p.payment_id,p.amount,p.created_date,p.due_date, p.status as payment_status, c.*,s.*, v.period_title, d.* FROM payment p 
join company c  on p.company_id=c.company_id join service s on p.service_id=s.service_id 
join period v on p.period_id=v.period_id
join department d on p.department_id=d.department_id
where p.created_date like '$this_yr' and d.department_id='$depart' and p.status='$status' and p.alive=1 ORDER BY p.payment_id desc");

        # code...
        break;

       case 3:
        $status="Recommended";
        $result=mysqli_query($db,"SELECT p.payment_id,p.amount,p.created_date,p.due_date, p.status as payment_status, c.*,s.*, v.period_title, d.* FROM payment p 
join company c  on p.company_id=c.company_id join service s on p.service_id=s.service_id 
join period v on p.period_id=v.period_id
join department d on p.department_id=d.department_id
where p.created_date like '$this_yr' and d.department_id='$depart' and p.status='$status' and p.alive=1 ORDER BY p.payment_id desc");

        # code...
        break; 

    case 5:
         $status="Submitted";
         $result=mysqli_query($db,"SELECT p.payment_id,p.amount,p.created_date,p.due_date, p.status as payment_status, c.*,s.*, v.period_title, d.* FROM payment p 
join company c  on p.company_id=c.company_id join service s on p.service_id=s.service_id 
join period v on p.period_id=v.period_id
join department d on p.department_id=d.department_id
where p.created_date like '$this_yr' and d.department_id='$depart' and p.status='$status' and p.alive=1 ORDER BY p.payment_id desc");

    break;
case 2:
         $status="Submitted";
         $result=mysqli_query($db,"SELECT p.payment_id,p.amount,p.created_date,p.due_date, p.status as payment_status, c.*,s.*, v.period_title, d.* FROM payment p 
join company c  on p.company_id=c.company_id join service s on p.service_id=s.service_id 
join period v on p.period_id=v.period_id
join department d on p.department_id=d.department_id
where p.created_date like '$this_yr' and d.department_id='$depart' and p.status='$status' and p.alive=1 ORDER BY p.payment_id desc");

    break;
    case 4:
        
        $result=mysqli_query($db,"SELECT p.alive,p.payment_id,p.amount,p.created_date,p.due_date, p.status as payment_status, c.company_name,s.service_title, v.period_title, d.* FROM payment p 
        join company c  on p.company_id=c.company_id join service s on p.service_id=s.service_id 
        join period v on p.period_id=v.period_id
        join department d on p.department_id=d.department_id
    where p.created_date like '$this_yr' and d.department_id='$depart' and p.status='Stand By' and p.alive=1 ORDER BY p.payment_id desc");

    break;

    
    default:
    $result=mysqli_query($db,"SELECT p.alive,p.payment_id,p.amount,p.created_date,p.due_date, p.status as payment_status, c.company_name,s.service_title, v.period_title, d.* FROM payment p 
    join company c  on p.company_id=c.company_id join service s on p.service_id=s.service_id 
    join period v on p.period_id=v.period_id
    join department d on p.department_id=d.department_id
    where p.created_date like '$this_yr' and p.department_id='$depart' and p.alive=1 and p.status IS NOT NULL ORDER BY p.payment_id desc");
    
    
        # code...
}



return $result;



        }
        catch (Exception $ex){
            echo $ex->getMessage();
            }
        }

      



        //function for adding Remarks
        function addRemark($payID,$userID,$note){
try{
    $conn = Database::getInstance();
            $db = $conn->getConnection();
    $combinedDT = date("Y-m-d");

mysqli_query($db,"INSERT INTO `com_ssd`.`remark` ( `payment_id`,`added_id`, `note`, `date_created`) 
VALUES ( '$payID','$userID', '$note', NOW()) ");
$link="Location:review.php?payid=".$payID;
header ($link);

}
            catch (Exception $ex){
                echo $ex->getMessage();
                }
        }

//get remarks
        function getRemark($payID){
            try{
                $conn = Database::getInstance();
            $db = $conn->getConnection();

                $result=mysqli_query($db,"SELECT p.first_name,p.last_name,u.role,r.* FROM remark r join user u on r.added_id=u.user_id join person p on u.person_id=p.person_id where r.payment_id='$payID'  order by r.date_created desc");

                return $result;


            }
            catch (Exception $ex){
                echo $ex->getMessage();
                }

        }


//update status by role and id

        function updateStatus($payID,$role,$userID,$status)
        {
            try{
                $conn = Database::getInstance();
            $db = $conn->getConnection();

            $feed=mysqli_query($db,"UPDATE `com_ssd`.`payment` SET `status`='$status' WHERE `payment_id`='$payID'");

            if($feed){
                return "
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Great!</strong> Everything looks good
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
        </div>
                ";
            }
            else{
                return"
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>WOOW!</strong> Something isn't right
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
        </div>
                ";
            }
            //switch role of user
            // switch($role){
            //     case 4:
            //         mysqli_query($db,"UPDATE payment SET status='$status', modified_date=NOW() where payment_id='$payID'");


            //         $link="Location:review.php?payid=".$payID;
            //         header ($link);
            //     break;

            //     case 6||3:
                        
            //         mysqli_query($db,"UPDATE payment SET status='$status', modified_date=NOW() where payment_id='$payID'");

            //         $link="Location:review.php?payid=".$payID;
            //         header ($link);
            //     break;

            //     case 5||2: 
            //          //for DC
            //         mysqli_query($db,"UPDATE payment SET status='$status', modified_date=NOW() where payment_id='$payID'");

            //         $link="Location:review.php?payid=".$payID;
            //         header ($link);
            //     break;

            //     default:
            //     return 0;

            // }
               
//                
            

            }
            catch (Exception $ex){
                echo $ex->getMessage();
                }
        }


        function uploadFile($pid,$uid,$file_loc,$file_name){
        try{   
            $conn = Database::getInstance();
            $db = $conn->getConnection();

            mysqli_query($db,"INSERT INTO `com_ssd`.`attachment` (`payment_id`, `added_by`,`file_name`, `file_location`) 
            VALUES ('$pid', '$uid','$file_name','$file_loc')");

            // File upload configuration
            //  $fileName=$filename['file']['name'];
            // $fileTmpName=$filename['file']['tmp_name'];
            // $fileSize=$filename['file']['size'];
            // $fileError=$filename['file']['error'];
            // $filetype=$filename['file']['type'];
            // $fileExt=explode('.',$fileName);

            // $fileActualExt=strtolower(end($fileExt));
            // $allowed=array('jpg','jpeg','pdf','png','docx','csv','rtf','zip','txt');
            // if(in_array($fileActualExt,$allowed)){
            // if($fileError===0){
            // if($fileSize < 1000000){
            // $fileNameNew=uniqid('',true).".".$fileActualExt;
            // $fileDestination='docs/'.$fileNameNew;
            // move_uploaded_file($fileTmpName,$fileDestination);

            // header("Location:add_pay?uploadSuccess");

            // }
            // else{
            // echo "<script>
            // alert('file is too large')
            // </script>";

            // }
            // }else{
            // echo "<script>
            // alert('There was an error uploading file')
            // </script>";
            
            // }
            // }
            // else{
            // echo "<script>
            // alert('Unsupported file format')
            // </script>";
            
            // }



   


        }
        catch (Exception $ex){
            echo $ex->getMessage();
            }
        }
//get files attached
        function getFiles($pid){
            $conn = Database::getInstance();
            $db = $conn->getConnection();

            $result=mysqli_query($db," Select a.file_name,a.file_location, p.first_name,p.last_name from attachment a 
            join user u on a.added_by=u.user_id join person p on u.person_id=p.person_id
             where a.payment_id='$pid' and a.alive =1;");
             return $result;
        }


        function reArray($filePost){
          $file_ary=array();
          $file_count=count($filePost["name"]);
          $file_keys=array_keys($filePost);
          for($i=0;$i<$file_count; $i++){
              foreach ($file_keys as $key) {
                  $file_ary[$i][$key]=$filePost[$key][$i];
              }
          }
          return $file_ary;  
        }

        //get Service
        // function getService(){
        //     $conn = Database::getInstance();
        //     $db = $conn->getConnection();

        //     $result = mysqli_query($db,"SELECT * FROM service where status=1"); 
        //     return $result;
        // }

         //Company
//         function getCompany($id){
//             $conn = Database::getInstance();
//             $db = $conn->getConnection();
// if($id==4){
//     $result = mysqli_query($db,"SELECT * FROM company "); 
        
// }
//           else{
//               $result = mysqli_query($db,"SELECT * FROM company where alive=1 "); 
           
//           }
//              return $result;
//         }

         //get Period
        // function getPeriod(){
        //     $conn = Database::getInstance();
        //     $db = $conn->getConnection();

        //     $result = mysqli_query($db,"SELECT * FROM period");
        //     return $result;
        // }

         //Fly Payment 
        function deletePayment($payid){
            try{   
                $conn = Database::getInstance();
    $db = $conn->getConnection();
    
                // FLY payment
            mysqli_query($db,"UPDATE `com_ssd`.`payment` SET `alive`='0' WHERE `payment_id`='$payid'");
       
    return "
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Great!</strong> Payment Deleted
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
        </div>
    ";
            }
            catch (Exception $ex){
                echo $ex->getMessage();
                } 
        }

         //get Restore Payment

        function restorePayment($payid){
            try{   
                $conn = Database::getInstance();
    $db = $conn->getConnection();
    
                // FLY payment
            mysqli_query($db,"UPDATE `com_ssd`.`payment` SET `alive`='1' WHERE `payment_id`='$payid'");
       
    echo "
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Great!</strong> Payment Restored
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
        </div>
    ";
            }
            catch (Exception $ex){
                echo $ex->getMessage();
                }   
        }



        //Every Thing there is only the active ones tho ;-)

        function everyThing($role){
            try{   
                $conn = Database::getInstance();
    $db = $conn->getConnection();

                $spl="";
                
                $st_year=2019;
                $year=date("Y");
                

                


           
            do{
                
                if($role="super")
                {
                    
                    $result=mysqli_query($db,"SELECT p.*, c.*,s.*,v.* FROM payment p join company c  on p.company_id=c.company_id join service s on p.service_provided=s.service_id join period v on p.period=v.period_id
                    where p.year ='$year' and p.status IS NOT NULL ORDER BY p.payment_id desc");
                }
                else{
                    $result=mysqli_query($db,"SELECT p.*, c.*,s.*,v.* FROM payment p join company c  on p.company_id=c.company_id join service s on p.service_provided=s.service_id join period v on p.period=v.period_id
                    where p.year= '$year'and p.alive=1 and p.status IS NOT NULL ORDER BY p.payment_id desc");
                    
                }

                

                if(mysqli_num_rows($result)==0){
                    exit;
                }
                $i=1;
                while($table=mysqli_fetch_array($result))
                { 
  echo"
  <tr>
  <td>".$i."</td>
  <td>".$table['name']."</td>
  <td>".$table['title']."</td>
  <td>".$table['date']."</td>
  <td>".$table['period_title']."<span class='badge'>".$table['year']."</span></td>

  <td>".$table['amount']."</td>";
if($table['status']=="Submitted"){
  echo"<td ><button class='btn btn-outline-primary'>".$table['status']."...</button></td>";
}
if($table['status']=="Recommended"){
  echo"<td ><button class='btn btn-primary'>".$table['status']."</button></td>";
}
if($table['status']=="Approved"){
  echo"<td ><button class='btn btn-success'>".$table['status']."</button></td>";
}
if($table['status']=="Revise"){
  echo"<td ><button class='btn btn-warning'>".$table['status']."</button></td>";
}
if($table['status']=="Stand By"){
  echo"<td ><button class='btn btn-info'>".$table['status']."</button></td>";
}
if($table['status']=="Declined"){
  echo"<td ><button class='btn btn-danger'>".$table['status']."</button></td>";
}
if($table['status']=="Denied"){
  echo"<td ><button class='btn btn-danger'>".$table['status']."</button></td>";
}
  echo"<td><a href='review.php?payid=".$table['payment_id']."' class='btn btn-dark'> Open</a></td>
  </tr>
  ";
  $i+=1;
}
                $year-=1;
                echo'
                <br><br>
                <hr class="mb-4">

                ';
            }
            while($year>=$st_year);

            
            
            }

            catch (Exception $ex){
                echo $ex->getMessage();
                } 
        }


        //edit payment
        function editPayment($payid,$amnt,$amc_st,$amc_end,$due_date,$period,$year,$serve,$role,$status){
            try{   
                $conn = Database::getInstance();
    $db = $conn->getConnection();
                // $status="Submitted";
    
                // // File edit
                // if($role==1){
                //     $status="Stand By";

                // }
mysqli_query($db," UPDATE `com_ssd`.`payment` SET `service_id`='$serve', `period_id`='$period', `year`='$year', `amount`='$amnt', `amc_start`='$amc_st', `amc_end`='$amc_end', `due_date`='$due_date', `status`='$status' WHERE `payment_id`='$payid'
");

                // $feed="
                // <div class='alert alert-success alert-dismissible fade show' role='alert'>
                //     <strong>Great!</strong> Successfully Edited
                //     <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                //       <span aria-hidden='true'>&times;</span>
                //     </button>
                //     </div>
                // ";

                // return $feed;

       
    
    
            }
            catch (Exception $ex){
                echo $ex->getMessage();
                }  
        }

//         function addCompany($companyName, $tin, $contact,$description){
//             try {
//                 $conn = Database::getInstance();
//     $db = $conn->getConnection();

//                 $sql = "INSERT INTO company (name, tin, contact, description)
// VALUES ('$companyName', '$tin', '$contact','$description')";
// mysqli_query($db,$sql);
//             } catch (Exception $ex){
//                 echo $ex->getMessage();
//                 } 
//         }

        function addService($serviceName){
            try {
                
                $conn = Database::getInstance();
                $db = $conn->getConnection();
                
                $sql = "INSERT INTO service (service_title)
                VALUES ('$serviceName')";
                mysqli_query($db,$sql);


            } catch (Exception $ex){
                echo $ex->getMessage();
                } 
        }

        function addPeriod($periodName){
            try {
                $conn = Database::getInstance();
    $db = $conn->getConnection();

                $sql = "INSERT INTO period (period_title)
VALUES ('$periodName')";
mysqli_query($db,$sql);

            } catch (Exception $ex){
                echo $ex->getMessage();
                } 
        }

        function addCompany($companyName,$TIN,$email,$web,$p1,$p2,$p3,$address,$desc){
            $conn = Database::getInstance();
            $db = $conn->getConnection();

            $com_p=mysqli_query($db,"SELECT * FROM company WHERE company_name='$companyName' and TIN='$TIN'");
            
            $com_p=mysqli_num_rows($com_p);
            if($com_p>=1){
                return "
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                   <strong>Attention!</strong> Company already exits
                 <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
                 </div>
                ";
            }
            else{
                if(strlen($TIN) == 11){

                if (!preg_match("/^[C].*[A-Z0-9]$/im", $TIN)) {
                    return "
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                   <strong>Attention!</strong> TIN isn't correct 
                 <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
                 </div>
                ";
                } 
                else
                 {
                     mysqli_query($db,"INSERT INTO `com_ssd`.`company` (`company_name`, `TIN`, `phone`, `phone_2`, `phone_3`, `address`, `email`, `website`, `description`, `date_add`) 
            VALUES ('$companyName', '$TIN', '$p1', '$p2', '$p3', '$address', '$email', '$web', '$desc', NOW()) ");
            // $link="Location:".;

            header('Location: '.$_SERVER['REQUEST_URI']);
                }
            }
            else{
                return "
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                   <strong>Attention!</strong> TIN must be <b>11</b> characters
                 <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
                 </div>
                ";
            }


           
        } 
    
    }

         function serviceOn($id){
            $conn = Database::getInstance();
            $db = $conn->getConnection();

            mysqli_query($db,"UPDATE `service` SET `status`='1' WHERE `service_id`='$id");
         }









         // the UI stuff 
         function getRecommended($depart){
             $this_yr=date("Y")."%";
//recommmended
            $conn = Database::getInstance();
            $db = $conn->getConnection();
            
            $result=mysqli_query($db,"SELECT * From payment where department_id='$depart' and status='Recommended' and alive=1 and created_date like '$this_yr'");
            return mysqli_num_rows($result);


         }

        function getDeclined($depart){
//Declined
            $this_yr=date("Y")."%";

            $conn = Database::getInstance();
            $db = $conn->getConnection();

            $result=mysqli_query($db,"SELECT * From payment where department_id='$depart' and status='Declined' and alive=1 and created_date like '$this_yr'");
            return mysqli_num_rows($result);

         }

        function getApproved($depart){
//Approved
            $this_yr=date("Y")."%";

            $conn = Database::getInstance();
            $db = $conn->getConnection();

            $result=mysqli_query($db,"SELECT * From payment where department_id='$depart' and status='Approved' and alive=1 and created_date like '$this_yr'");
            return mysqli_num_rows($result);

         }

         function getDenied($depart){
//Canceled
            $this_yr=date("Y")."%";

            $conn = Database::getInstance();
            $db = $conn->getConnection();

            $result=mysqli_query($db,"SELECT * From payment where department_id='$depart' and status='Denied' and alive=1 and created_date like '$this_yr'");
            return mysqli_num_rows($result);

         }
//Services
        function getServices($uid,$page){
            $conn = Database::getInstance();
            $db = $conn->getConnection();
            if($uid==4||$uid==3){
                if($page!='/com_ssd/service.php'){
                   $result=mysqli_query($db,"SELECT * FROM service where status=1");
                }else{
                    
                    $result=mysqli_query($db,"SELECT * FROM service"); 
                }
                
            }
            else{
             $result=mysqli_query($db,"SELECT * FROM service where status=1");
            }
            // $result=mysqli_query($db,"SELECT * FROM service");
            return $result;

        }

        //Period
        function getPeriods($uid,$page){
            $conn = Database::getInstance();
            $db = $conn->getConnection();

            if($uid==4||$uid==3){
                if($page!='/com_ssd/period.php'){
                   $result=mysqli_query($db,"SELECT * FROM period where status=1"); 
                }else{
                    $result=mysqli_query($db,"SELECT * FROM period");
                }
                
            }
            else{

                $result=mysqli_query($db,"SELECT * FROM period where status=1");
            }

            
            return $result;

        }

        //company
        function getCompanies($uid,$page){
            $conn = Database::getInstance();
            $db = $conn->getConnection();

            if($uid==4||$uid==3){
                if($page!='/com_ssd/company.php'){
                   $result=mysqli_query($db,"SELECT * FROM company where alive=1"); 
                }else{
                    $result=mysqli_query($db,"SELECT * FROM company");
                }
                
            }else{

                $result=mysqli_query($db,"SELECT * FROM company where alive=1");
            }

            
            return $result;

        }

        




}
?>