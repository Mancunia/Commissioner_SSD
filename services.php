<?php
require_once 'requires/head.php';

include 'requires/com_ssd.php';
$conn = Database::getInstance();
$db = $conn->getConnection();
$feed="";
$com_ssd = new com_ssd();

$serve=$com_ssd->getServices($_SESSION['grp'],$_SERVER['REQUEST_URI']);

if( isset($_GET['on']) )
{
//activate
$com_ssd->serviceOn($_GET['on']);

header("Location:services.php");

}

if( isset($_GET['off']) ){
//deactivate
$id=$_GET['off'];
mysqli_query($db,"UPDATE `service` SET `status`='0' WHERE `service_id`='$id'");
header("Location:services.php");
}



if( isset($_GET['times']) ) 
{
//delete
$x_id=$_GET['times'];

mysqli_query($db,"DELETE FROM `service` WHERE `service_id`='$x_id'");
header("Location:services.php");
}

if(isset($_POST['newService'])){

  $feed=$com_ssd->addService($_POST['name'],$_SERVER['REQUEST_URI']);
  // header ("Location:services.php");
}

include_once 'includes/newService.html';

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
          <li class="breadcrumb-item active">Service</li>
        </ol>
        <?php echo $feed; ?>
        <button class="btn btn-lg btn-info"  data-toggle="modal" data-target="#serviceModal" >Add A New Service</button>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Services</div>
          <div class="card-body">
            <div class="table-responsive">
            <table class="table" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                  <th>#</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  <th>#</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>

              <?php
              $i=1;
              while($service= mysqli_fetch_array($serve)){
                echo '
                <tr>
                    <td>'.$i.'</td>
                    <td>'.$service['service_title'].'</td>
                    <td>
                    ';

                    if($service['status']==1){
                      echo '<a href="services.php?off='.$service['service_id'].'" class="btn btn-warning btn-group-toggle">Deactivate</a>';
                    }
                    else{
                      echo '<a href="services.php?on='.$service['service_id'].'" class="btn btn-success btn-group-toggle"> Activate </a>';
                    }
                    echo "   ";
                    if($_SESSION['grp']==4){
                    echo'<a class="btn btn-danger" href="services.php?times='.$service['service_id'].'">&times; Delete</a></td>';
                  }
                    
                    
                  echo "
                  </td>
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
