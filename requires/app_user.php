<?php
require 'conn.php';

class app_user{

    //Admin functions
    function newOffice($office,$acro,$depart)
    {

        $conn = Database::getInstance();
        $db = $conn->getConnection();

       mysqli_query($db," INSERT INTO `com_ssd`.`office` (`office_name`, `office_acronym`,`department_id`)
        VALUES ('$office', '$acro','$depart')" );
       
    }

function newRank($rank)
    {

        $conn = Database::getInstance();
        $db = $conn->getConnection();

       mysqli_query($db," INSERT INTO `com_ssd`.`rank` (`rank_title`)
        VALUES ('$rank')" );
       
    }

function newRole($role)
    {

        $conn = Database::getInstance();
        $db = $conn->getConnection();

       mysqli_query($db," INSERT INTO `com_ssd`.`role` (`role_name`)
        VALUES ('$role')" );
       
    }

    function newDepartment($depart)
    {
        $conn = Database::getInstance();
        $db = $conn->getConnection();
       $feed=mysqli_query($db," INSERT INTO `com_ssd`.`department` (`department_name`)
        VALUES ('$depart')" );
        if($feed){
            return "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Great</strong>Department <b>.$depart.</b> added
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
            </div>";

        }
        else{
            return "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>OOPS!</strong> Something went wrong 
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
        </div>
            ";
        }
       
    }



//Like-Admin functions
    function getOffices(){
try {
    //code...
    $conn = Database::getInstance();
        $db = $conn->getConnection();

        $result=mysqli_query($db,"SELECT * FROM `office` where status = 1 ");
        
        return $result;  
}  
catch (PDOException $ex){
    echo $ex->getMessage();
    }
              
    }

    function getDepartment(){
        $conn = Database::getInstance();
        $db = $conn->getConnection();

        return mysqli_query($db,"SELECT * FROM department");
         

    }
    
    //get staff
    function getStaff($office){
        try{
            $conn = Database::getInstance();
        $db = $conn->getConnection();
            if($office==1){
                $result=mysqli_query($db,"SELECT * FROM users where office>=2");
                // return $result; 
            }
            else{
            $result=mysqli_query($db,"SELECT * FROM users where role='staff' and office='$office'");
            }
            return $result;
        }
        catch (PDOException $ex){
            echo $ex->getMessage();
            }

    }

//Add new account
    function newPerson($username,$fname,$lname,$dob,$emp_num,$phone1,$phone2,$address,$rank,$email)
    {
        try{
// echo $username;

            $conn = Database::getInstance();
        $db = $conn->getConnection();
// echo $fname;
        $chk=mysqli_query($db,"SELECT * FROM user where `username`='$username'");
        $row=mysqli_num_rows($chk);
        
        if($row>0){
           echo"
<script>
alert('Username Taken')
</script>
"; 
        }

        else {
// echo $lname;
$feed=mysqli_query($db,"INSERT INTO `com_ssd`.`person` (`first_name`, `last_name`, `rank_id`, `dob`, `employee_number`, `phone`, `phone_2`, `address`, `email`, `created_date`) 
VALUES ('$fname', '$lname', '$rank', '$dob', '$emp_num', '$phone1', '$phone2', '$address', '$email',NOW())

");
// echo $rank;
// VALUES ('$fname', '$lname', '$rank','$dob', '$emp_num', '$phone1','$phone2', '$address', '$email',NOW()) ");
if (!$feed){
echo"
<div class='alert alert-danger alert-dismissible fade show' role='alert'>
<strong>OOPs!</strong> There is something wrong <b>NOTE!</b> Check all details
<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
<span aria-hidden='true'>&times;</span>
</button>
</div>
";
}else{
$last_id=mysqli_query($db," SELECT `person_id` FROM `com_ssd`.person ORDER BY person_id DESC LIMIT 1");
$last_id=mysqli_fetch_array($last_id);
$pid=$last_id['person_id'];
// echo $pid;
return $pid;
            }
}
        }
        catch (PDOException $ex){
            echo $ex->getMessage();
            }
    }


    function newUser($pers_id,$username,$role,$office,$acnt,$by){
//New user acount
 $conn = Database::getInstance();
        $db = $conn->getConnection();

        // echo $pers_id;

        $feed=mysqli_query($db," INSERT INTO `com_ssd`.`user` (`username`, `password`, `person_id`, `role`, `grp_id`, `office_id`, `date_created`, `created_by`) 
        VALUES ('$username', '$username', '$pers_id', '$role', '$acnt', '$office', NOW(), '$by')");
        

        if($feed){

return"
<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>Great!</strong> User: ".$username."'s account has been created successfully,<b>NOTE!</b> password is username
<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
<span aria-hidden='true'>&times;</span>
</button>
</div>
";
}
else{
    return"
<div class='alert alert-danger alert-dismissible fade show' role='alert'>
<strong>OOPs!</strong> There is something wrong <b>NOTE!</b>, Check all details
<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
<span aria-hidden='true'>&times;</span>
</button>
</div>
";

}



}


    /*
    |
    |
    |
    */

//check and login 
    function login($username,$password){
try{
    $conn = Database::getInstance();
    $db = $conn->getConnection();

$results=mysqli_query($db,"SELECT * FROM user WHERE username='$username' AND password='$password'");
   //fetch into an array
    $result=mysqli_fetch_array($results);
    return $result;

//     if($result['username']==$username&&$result['password']==$password){
//        if($result['status']==0){
//         $error_msg="<div class='alert alert-danger alert-dismissible fade show' role='alert'>
//         <strong>OOPS!</strong> Your account isn't active
//         <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
//           <span aria-hidden='true'>&times;</span>
//         </button>
//         </div>";
//         return $error_msg; 
//        }
//        else{
           
//         session_start();
//     $_SESSION['user_id']=$result['user_id'];
//     $_SESSION['role']=$result['role'];
//     $_SESSION['fname']=$result['fname'];
//     $_SESSION['office']=$result['office_id'];
//     $_SESSION['grp']=$result['grp_id'];
//     $_SESSION['cred_1']=$result['username'];
//     $_SESSION['cred_2']=$result['password'];
// }

//     }
        
//         else{
//             $error_msg="<div class='alert alert-danger alert-dismissible fade show' role='alert'>
//             <strong>OOPS!</strong> Your credentials are not correct or you are not supposed to be trying this.
//             <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
//               <span aria-hidden='true'>&times;</span>
//             </button>
//             </div>";
//             return $error_msg;
            
//         }




}
catch (PDOException $ex){
        echo $ex->getMessage();
        }
    }

    function lastLogin($user){
        $conn = Database::getInstance();
        $db = $conn->getConnection();

            // FLY payment
        mysqli_query($db,"UPDATE `com_ssd`.`user` SET `last_login`=NOW() WHERE `user_id`='$user'
        ");

    }

    function resetPassword($pass,$user){
        $conn = Database::getInstance();
        $db = $conn->getConnection();

        mysqli_query($db,"UPDATE `com_ssd`.`user` SET `password`='$pass' WHERE `user_id`='$user'
        ");
        echo"
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Great!</strong> Password changed successfully <a href='../index.php'>Login</a>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
    </div>
        ";

    }

    //get Roles
    function getRole(){
        $conn = Database::getInstance();
        $db = $conn->getConnection();
        $result=mysqli_query($db,"SELECT * from role where status=1");
        return $result;
    }

    //get Ranks
    function getRank(){
        $conn = Database::getInstance();
        $db = $conn->getConnection();
        $result=mysqli_query($db,"SELECT * from rank");
        return $result;
    }

    //get groups
    function getGroup(){
        $conn = Database::getInstance();
        $db = $conn->getConnection();
        $result=mysqli_query($db,"SELECT * from `group`");
        return $result;
    }



    //deactivate account
    function acntOff($userid){
        try{   
            $conn = Database::getInstance();
        $db = $conn->getConnection();

            // Dea
        mysqli_query($db,"UPDATE `com_ssd`.`user` SET `status`='0' WHERE `user_id`='$userid'
        ");
   
echo "
<div class='alert alert-warning alert-dismissible fade show' role='alert'>
    <strong>Great!</strong> User has been Deactivated
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
    </div>
";
        }
        catch (PDOException $ex){
            echo $ex->getMessage();
            } 
    }




    //activate account
    function acntOn($userid){
        try{   
            $conn = Database::getInstance();
            $db = $conn->getConnection();

            // activate
        mysqli_query($db,"UPDATE `com_ssd`.`user` SET `status`='1' WHERE `user_id`='$userid'
        ");
   
echo "
<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Great!</strong> User has been Activated
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
    </div>
";
        }
        catch (PDOException $ex){
            echo $ex->getMessage();
            } 
    }

}

?>