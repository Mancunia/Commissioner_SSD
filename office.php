<?php
require_once 'requires/head.php';

$allowed_users=array(4,3);
if(!in_array($_SESSION['grp'],$allowed_users)){
header("Location:index.php");
}

include 'requires/app_user.php';

//instance of the class app_user
$app = new app_user();

$rank=$app->getRank();

$feed="";

if(isset($_POST['newUser'])){
  extract($_POST);
  $pid=$app->newPerson($userName,$fname,$lname,$dob,$staff_id,$phone,$phone1,$address,$rank,$email);

  // echo $userName;

 $feed=$app->newUser($pid,$userName,1,$_SESSION['office'],1,$_SESSION['user_id']);
//  echo $_SESSION['user_id'];
//  echo $office;
}

if(isset($_GET['on'])){
  $feed=$app->acntOn($_GET['on']);

  // header ("Location:index.php");
}

if(isset($_GET['off'])){
  $feed=$app->acntOff($_GET['off']);

  // header ("Location:index.php");

}

$users=$app->getUserByOffice($_SESSION['office']);

include_once 'includes/newUser.php';

include 'requires/heading.php';
?>

<!-- Modal -->



    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Office</li>
        </ol>

        <?php echo $feed;?>
        <button class="btn btn-lg btn-info"  data-toggle="modal" data-target="#userModal" >Add A New User</button>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Office</div>
          <div class="card-body">
            <div class="table-responsive">
            <table class="table" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                  <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Staff ID</th>
                    <th>Rank</th>
                    <th>Date Added</th>
                    <th>Last_Login</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Staff ID</th>
                    <th>Rank</th>
                    <th>Date Added</th>
                    <th>Last_Login</th>
                    <th>Status</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  $i=1;
                  while($u=mysqli_fetch_array($users)){
                    echo "
                    <tr>
                    <td>".$i."</td>
                    <td>".$u['first_name']." ".$u['last_name']."</td>
                    <td>".$u['phone']."</td>
                    <td>".$u['employee_number']."</td>
                    <td>".$u['rank_title']."</td>
                    <td>".$u['date_created']."</td>
                    <td>".$u['last_login']."</td>

                    <td>";

                    if($u['status']==1){
                      echo '<a href="office.php?off='.$u['user_id'].'" class="btn btn-danger btn-group-toggle">Deactivate</a>';
                    }
                    else{
                      echo '<a href="office.php?on='.$u['user_id'].'" class="btn btn-success btn-group-toggle">Activate</a>';
                    }
                    
                    echo"</td>
                    
                    
                  </tr>
                    
                    ";
                    $i++;

                  }
                  
                  
                  ?>
                  
                  </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>


      </div>
      <!-- /.container-fluid -->

      <?php
require 'requires/footer.php';
      ?>
