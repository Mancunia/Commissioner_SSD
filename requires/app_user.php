<?php
include 'conn.php';

class app_user{

    function newOffice($office,$acro,$depart)
    {

        $conn = Database::getInstance();
        $db=$conn->getConnection();
       mysqli_query($db," INSERT INTO `com_ssd`.`office` (`name`, `acronym`,`department`)
        VALUES ('$office', '$acro','$depart')" );
       
    }

    function newDepartment($depart)
    {
        $conn = new Database();
        $db=$conn->getdbconnect();
       mysqli_query($db," INSERT INTO `com_ssd`.`department` (`name`)
        VALUES ('$depart')" );
       
    }


    function offices(){
try {
    //code...
    $conn = Database::getInstance();
    $db=$conn->getConnection();

        $result=mysqli_query($db,"SELECT * FROM office");
        
        return $result;  
}  
catch (PDOException $ex){
    echo $ex->getMessage();
    }
              
    }
    
    //get staff
    function getStaff($office){
        try{
            $conn = new Database();
            $db=$conn->getdbconnect();
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

            $conn = new Database();
$db=$conn->getdbconnect();
mysqli_query($db,"
INSERT INTO `com_ssd`.`users` (`username`, `fname`, `lname`, `password`, `contact`, `role`, `office`, `by`,`date`) 
VALUES ('$username', '$fname', '$lname', '$username', '$contact', '$role', '$office','$by',NOW())

");

        }
        catch (PDOException $ex){
            echo $ex->getMessage();
            }
    }

//check and login 
    function login($username,$password){
try{
$conn = new Database();

$results=mysqli_query($conn->getdbconnect(),"SELECT u.*, f.*,d.* FROM users u Join office f on u.office=f.office_id Join department d on f.department=d.department_id WHERE username='$username' AND password='$password'");
   //fetch into an array
    $result=mysqli_fetch_array($results);

    if($result['username']==$username&&$result['password']==$password){
       if($result['status']==0){
        $error_msg="<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>OOPS!</strong> Your account isn't active
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
        return $error_msg; 
       }
        session_start();
    $_SESSION['user_id']=$result['user_id'];
    $_SESSION['rank']=$result['role'];
    $_SESSION['fname']=$result['fname'];
    $_SESSION['office']=$result['department_id'];
    $_SESSION['office_name']=$result['name'];
    $_SESSION['cred_1']=$result['username'];
    $_SESSION['cred_2']=$result['password'];

if($result['role']=="AC"){

    header("Location:add_pay.php");
}
elseif($result['role']=="super"){
    header("Location:super.php");
}
else{
    header("Location:home.php");
}

    }
        
        else{
            $error_msg="<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>OOPS!</strong> Your credentials are not correct or you are not supposed to be trying this.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
            return $error_msg;
            
        }


}catch (PDOException $ex){
        echo $ex->getMessage();
        }
    }


    //deactivate account
    function acntOff($userid){
        try{   
            $conn = new Database();
            $db=$conn->getdbconnect();

            // FLY payment
        mysqli_query($db,"UPDATE `com_ssd`.`users` SET `status`='0' WHERE `user_id`='$userid'
        ");
   
return "
<div class='alert alert-warning alert-dismissible fade show' role='alert'>
    <strong>Great!</strong> Account Deactivated
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
            $conn = new Database();
            $db=$conn->getdbconnect();

            // FLY payment
        mysqli_query($db,"UPDATE `com_ssd`.`users` SET `status`='1' WHERE `user_id`='$userid'
        ");
   
return "
<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Great!</strong> Account Activated
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