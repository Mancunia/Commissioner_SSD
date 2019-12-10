<?php
require_once 'requires/head.php';
include_once 'requires/com_ssd.php';
$feed="";

$com_ssd=new com_ssd();

$period=$com_ssd->getPeriods($_SESSION['grp'],$_SERVER['REQUEST_URI']);

if(isset($_POST['newPeriod'])){

  
$feed=$com_ssd->addPeriod($_POST['period'],$_SERVER['REQUEST_URI']);

  // header ("Location:period.php");
 }

include_once 'includes/newPeriod.html';

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
          <li class="breadcrumb-item active">Periods</li>
        </ol>
        <?php echo $feed; ?>
        <button class="btn btn-lg btn-info"  data-toggle="modal" data-target="#periodModal" >Add A New Period</button>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Periods</div>
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
              while($p= mysqli_fetch_array($period)){
                echo '
                <tr>
                    <td>'.$i.'</td>
                    <td>'.$p['period_title'].'</td>
                    <td>
                    ';

                    if($p['status']==1){
                      echo '<a href="period.php?off='.$p['period_id'].'" class="btn btn-warning btn-group-toggle">Deactivate</a>';
                    }
                    else{
                      echo '<a href="period.php?on='.$p['period_id'].'" class="btn btn-success btn-group-toggle"> Activate </a>';
                    }
                    echo "   ";
                    if($_SESSION['grp']==4){
                    echo'<a class="btn btn-danger" href="period.php?times='.$p['period_id'].'">&times; Delete</a></td>';
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
