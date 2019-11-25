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
    function offices(){
try {
    //code...
    $conn = Database::getInstance();
        $db = $conn->getConnection();

        $result=mysqli_query($db,"SELECT * FROM office");
        
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
    function newUser($username,$password,$fname,$lname,$contact,$role,$office,$by){
        try{

            if($by=="AC"||$by=="DC"||$by=="Commissioner"){
                $role="staff";
            }

            $conn = Database::getInstance();
        $db = $conn->getConnection();
mysqli_query($db,"
INSERT INTO `com_ssd`.`users` (`username`, `fname`, `lname`, `password`, `contact`, `role`, `office`, `by`,`date`) 
VALUES ('$username', '$fname', '$lname', '$username', '$contact', '$role', '$office','$by',NOW())

");

        }
        catch (PDOException $ex){
            echo $ex->getMessage();
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
        $result=mysqli_query($db,"SELECT * from rank where status=1");
        return $result;
    }

    //get groups
    function getGroup(){
        $conn = Database::getInstance();
        $db = $conn->getConnection();
        $result=mysqli_query($db,"SELECT * from group");
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