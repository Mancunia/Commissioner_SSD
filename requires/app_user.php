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

        $result=mysqli_query($db,"SELECT f.*,d.* FROM office f join department d on f.department_id=d.department_id where f.status = 1 ");
        
        return $result;  
}  
catch (PDOException $ex){
    echo $ex->getMessage();
    }
              
    }

    function getOffices_id($d){
        try {
            //code...
            $conn = Database::getInstance();
                $db = $conn->getConnection();
        
                $result=mysqli_query($db,"SELECT f.*,d.* FROM office f join department d on f.department_id=d.department_id where f.department_id='$d' ");
                
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
           <div class='alert alert-danger alert-dismissible fade show' role='alert'>
           <strong>OOPs!</strong> Username Taken <b>NOTE!</b> Check all details
           <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
           <span aria-hidden='true'>&times;</span>
           </button>
           </div>
           ";
        }

        else {
            $sid=mysqli_query($db,"SELECT * FROM person where employee_number='$emp_num'");
            if(mysqli_num_rows($sid)>=1){
                echo"
           <div class='alert alert-danger alert-dismissible fade show' role='alert'>
           <strong>OOPs!</strong> The staff ID is already taken <b>NOTE!</b> Check all details
           <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
           <span aria-hidden='true'>&times;</span>
           </button>
           </div>
           "; 
            }
            else{
                if(strlen($emp_num)<4||strlen($emp_num)>9){
                   echo"
           <div class='alert alert-danger alert-dismissible fade show' role='alert'>
           <strong>OOPs!</strong> The staff ID isn't within valid range <b>NOTE!</b> Check all details
           <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
           <span aria-hidden='true'>&times;</span>
           </button>
           </div>
           ";   
                }
                else{
                    if (!preg_match("/^[G0-9].*[A-Z0-9]$/im", $emp_num)) {
                        return "
                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                       <strong>Attention!</strong> Staff ID isn't valid 
                     <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                     </div>
                    ";
                    }
                    else{
                        $feed=mysqli_query($db,"INSERT INTO `com_ssd`.`person` (`first_name`, `last_name`, `rank_id`, `dob`, `employee_number`, `phone`, `phone_2`, `address`, `email`, `created_date`) 
                VALUES ('$fname', '$lname', '$rank', '$dob', '$emp_num', '$phone1', '$phone2', '$address', '$email',NOW())");
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
            }
            else{
            $last_id=mysqli_query($db," SELECT `person_id` FROM `com_ssd`.person ORDER BY person_id DESC LIMIT 1");
            $last_id=mysqli_fetch_array($last_id);
            $pid=$last_id['person_id'];
            // echo $pid;
            return $pid;
            }
                    } 
                    
                }



                // echo $lname;

            }

}
        }
        catch (PDOException $ex){
            echo $ex->getMessage();
            }
    }

    function addRank($rank,$page){

        $conn = Database::getInstance();
        $db = $conn->getConnection();

        $result=mysqli_num_rows(mysqli_query($db,"SELECT * FROM rank where rank_title='$rank'"));
        if($result>0){
            return"
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
<strong>OOPs!</strong> Rank already exists <b>NOTE!</b> Look through list 
<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
<span aria-hidden='true'>&times;</span>
</button>
</div>
            ";
        }
        else{
            mysqli_query($db,"INSERT INTO `com_ssd`.`rank` (`rank_title`) VALUES ('$rank')");

            header("Location:".$page);

        }
    }


    function newUser($pers_id,$username,$role,$office,$acnt,$by){
//New user acount
 $conn = Database::getInstance();
        $db = $conn->getConnection();

        // echo $pers_id;
        if($pers_id==0){
          return"
<div class='alert alert-danger alert-dismissible fade show' role='alert'>
<strong>OOPs!</strong> There is something wrong <b>NOTE!</b>, Check all details
<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
<span aria-hidden='true'>&times;</span>
</button>
</div>
";  
        }
        else{

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

        



}

function getUserByOffice($office){
    $conn = Database::getInstance();
    $db = $conn->getConnection();

    $result=mysqli_query($db,"SELECT u.*,p.*,r.rank_title FROM user u join person p on u.person_id=p.person_id join rank r on p.rank_id=r.rank_id where u.office_id='$office' and u.grp_id<>4");
$count=mysqli_num_rows($result);
// if ($count>=1){
return $result;
// }
// else{
// echo "<script>
// alert('Nothing to show')
// </script>";
// }

// header ("Location:./index.php");

}

function getUserAdmin(){
    $conn = Database::getInstance();
    $db = $conn->getConnection();

    $result=mysqli_query($db,"SELECT u.*,p.*,r.rank_title FROM user u join person p on u.person_id=p.person_id join rank r on p.rank_id=r.rank_id where u.grp_id<>4");
$count=mysqli_num_rows($result);
// if ($count>=1){
return $result;
// }
// else{
// echo "<script>
// alert('Nothing to show')
// </script>";
// }

// header ("Location:./index.php");

}

function getUserAdmin_id($office){
    $conn = Database::getInstance();
    $db = $conn->getConnection();

    $result=mysqli_query($db,"SELECT u.*,p.*,r.rank_title FROM user u join person p on u.person_id=p.person_id join rank r on p.rank_id=r.rank_id where u.grp_id<>4 and u.office_id='$office'");
$count=mysqli_num_rows($result);
// if ($count>=1){
return $result;
// }
// else{
// echo "<script>
// alert('Nothing to show')
// </script>";
// }

// header ("Location:./index.php");

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

$results=mysqli_query($db,"SELECT u.*,d.department_id FROM user u join office f on f.office_id=u.office_id join department d on f.department_id=d.department_id  WHERE username='$username' AND password='$password'");
   //fetch into an array
    $result=mysqli_fetch_array($results);
    return $result;
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
    <strong>Great!</strong> Password changed successfully <a href='logout.php?logout'>Login</a>
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
   
return "
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
   
return "
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