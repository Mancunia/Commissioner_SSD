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


function getPaymentDetails($payID){
    try{
        $conn = Database::getInstance();
        $db = $conn->getConnection(); 
//         $conn = new Database();
// $db=$conn->getdbconnect();
$result=mysqli_query($db,"SELECT p.*, c.*,s.* , v.* FROM payment p join company c  on p.company_id=c.company_id join service s on p.service_provided=s.service_id join period v on p.period=v.period_id  
where p.payment_id='$payID' and p.alive=1");
    return $result;
    }
    catch (Exception $ex){
            echo $ex->getMessage();
            }
}

//add payment
function addPayments($uid,$cid,$amnt,$period,$year,$amc_st,$amc_end,$due_D,$office,$service, $role){
    try{
        $conn = new Database();
        $status="Submitted";
        $db=$conn->getdbconnect();
        if($role=="staff"){
            $status="Stand By";
        }

        mysqli_query($db,"INSERT INTO `com_ssd`.`payment` (`company_id`, `amount`, `period`, `year`, `status`, `AMC_start`, `AMC_end`, `due_date`, `office`, `service_provided`, `date`,`by`) 
        VALUES ('$cid', '$amnt', '$period', '$year', '$status', '$amc_st', '$amc_end', '$due_D', '$office', '$service',NOW(),'$uid' ) ");

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
    function getPayments($role,$office){
        try{
            $conn = new Database();
            $status="";
            $db=$conn->getdbconnect();
            
$this_yr=date("Y")."%";
//if it's AC
if($role=="Commissioner")
{
    $status="Recommended";
    $result=mysqli_query($db,"SELECT p.*, c.*,s.*, v.*, d.* FROM payment p 
    join company c  on p.company_id=c.company_id join service s on p.service_provided=s.service_id 
    join period v on p.period=v.period_id
    join department d on p.office=d.department_id
    where p.date like '$this_yr' and d.department_id='$office' and p.status='$status' and p.alive=1 ORDER BY p.payment_id desc");

    return $result;
}

//if it's any other
elseif($role=="DC"){
    $status="Submitted";
    $result=mysqli_query($db,"SELECT p.*, c.*,s.*,v.* FROM payment p 
    join company c  on p.company_id=c.company_id join service s on p.service_provided=s.service_id 
    join period v on p.period=v.period_id
    join department d on p.office=d.department_id
    where p.date like '$this_yr' and d.department_id='$office' and p.status='$status' and p.alive=1 ORDER BY p.payment_id desc");
    //return results
    // $results= mysqli_fetch_array($result);
    return $result;
}

elseif($role=="AC"){
    $status="Stand By";

    $result=mysqli_query($db,"SELECT p.*, c.*,s.*,v.* FROM payment p 
    join company c  on p.company_id=c.company_id join service s on p.service_provided=s.service_id 
    join period v on p.period=v.period_id
    join department d on p.office=d.department_id
    where p.date like '$this_yr' and d.department_id='$office' and p.status='$status' and p.alive=1 ORDER BY p.payment_id desc");

    return $result;
}

else{
    
    $result=mysqli_query($db,"SELECT p.*, c.*,s.*,v.* FROM payment p 
    join company c  on p.company_id=c.company_id join service s on p.service_provided=s.service_id 
    join period v on p.period=v.period_id
    join department d on p.office=d.department_id
    where p.date like '$this_yr' and d.department_id='$office' and p.alive=1 and p.status IS NOT NULL ORDER BY p.payment_id desc");
    return $result;
}




        }
        catch (Exception $ex){
            echo $ex->getMessage();
            }
        }

      



        //function for adding Remarks
        function addRemark($payID,$userID,$note){
try{
    $conn = new Database();
                $db=$conn->getdbconnect();
    $combinedDT = date("Y-m-d");

mysqli_query($db,"INSERT INTO `com_ssd`.`remark` (`user_id`, `payment_id`, `note`, `date`) 
VALUES ('$userID', '$payID', '$note', NOW()) ");
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
                $conn = new Database();
                $db=$conn->getdbconnect();

                $result=mysqli_query($db,"SELECT u.fname,u.lname,u.role,r.* FROM remark r join users u on r.user_id=u.user_id where r.payment_id='$payID' ORDER BY r.payment_id desc");

                return $result;


            }
            catch (Exception $ex){
                echo $ex->getMessage();
                }

        }


//update status by role and id

        function updateStatus($payID,$role,$userID,$note,$status)
        {
            try{
                $conn = new Database();
                $db=$conn->getdbconnect();
                //for DC
                if($role=="DC"){
                    
                mysqli_query($db,"UPDATE payment SET status='$status', modified_date=NOW() where payment_id='$payID'");

                
//                 mysqli_query($db,"INSERT INTO `com_ssd`.`remark` (`user_id`, `payment_id`, `note`, `date`) 
// VALUES ('$userID', '$payID', '$note', NOW()) ");

$link="Location:review.php?payid=".$payID;
header ($link);

            }
//for commissioner
            if($role=="Commissioner"){
                
            mysqli_query($db,"UPDATE payment SET status='$status', modified_date=NOW() where payment_id='$payID'");

          
//             mysqli_query($db,"INSERT INTO `com_ssd`.`remark` (`user_id`, `payment_id`, `note`, `date`) 
// VALUES ('$userID', '$payID', '$note', NOW()) ");

$link="Location:review.php?payid=".$payID;
header ($link);
        }

        //for AC
        if($role="AC"){
             mysqli_query($db,"UPDATE payment SET status='$status', modified_date=NOW() where payment_id='$payID'");

            
//             mysqli_query($db,"INSERT INTO `com_ssd`.`remark` (`user_id`, `payment_id`, `note`, `date`) 
// VALUES ('$userID', '$payID', '$note', NOW()) ");

$link="Location:review.php?payid=".$payID;
header ($link);
        }
            

            }
            catch (Exception $ex){
                echo $ex->getMessage();
                }
        }


        function uploadFile($payID,$filename){
        try{   
            $conn = new Database();
            $db=$conn->getdbconnect();

            // File upload configuration
   


        }
        catch (Exception $ex){
            echo $ex->getMessage();
            }
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
        function getService(){
            $conn = new Database();
            $db=$conn->getdbconnect();

            $result = mysqli_query($db,"SELECT * FROM service"); 
            return $result;
        }

         //get Company
        function getCompany(){
            $conn = new Database();
            $db=$conn->getdbconnect();

            $result = mysqli_query($db,"SELECT * FROM company "); 
            return $result;
        }

         //get Period
        function getPeriod(){
            $conn = new Database();
            $db=$conn->getdbconnect();

            $result = mysqli_query($db,"SELECT * FROM period");
            return $result;
        }

         //Fly Payment 
        function deletePayment($payid){
            try{   
                $conn = new Database();
                $db=$conn->getdbconnect();
    
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
                $conn = new Database();
                $db=$conn->getdbconnect();
    
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
                $conn = new Database();
                $db=$conn->getdbconnect();

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
        function editPayment($payid,$amnt,$amc_in,$amc_out,$due_date,$period,$year,$role){
            try{   
                $conn = new Database();
                $db=$conn->getdbconnect();
                $status="Submitted";
    
                // File edit
                if($role=="staff"){
                    $status="Stand By";

                }
                mysqli_query($db," UPDATE `com_ssd`.`payment` SET `amount`='$amnt', `period`='$period', `year`='$year', `status`='$status', `AMC_start`='$amc_in', `AMC_end`='$amc_out', `due_date`='$due_date', `modified_date`= NOW() 
                WHERE `payment_id`='$payid'");

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

        function addCompany($companyName, $tin, $contact,$description){
            try {
                $conn = new Database();
                $db=$conn->getdbconnect();

                $sql = "INSERT INTO company (name, tin, contact, description)
VALUES ('$companyName', '$tin', '$contact','$description')";
mysqli_query($db,$sql);
            } catch (Exception $ex){
                echo $ex->getMessage();
                } 
        }

        function addService($serviceName){
            try {
                
                $conn = new Database();
                $db=$conn->getdbconnect();
                
                $sql = "INSERT INTO service (title)
                VALUES ('$serviceName')";
                mysqli_query($db,$sql);


            } catch (Exception $ex){
                echo $ex->getMessage();
                } 
        }

        function addPeriod($periodName){
            try {
                $conn = new Database();
                $db=$conn->getdbconnect();

                $sql = "INSERT INTO period (period_title)
VALUES ('$periodName')";
mysqli_query($db,$sql);

            } catch (Exception $ex){
                echo $ex->getMessage();
                } 
        }
}
?>