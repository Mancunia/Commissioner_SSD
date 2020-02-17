<?php
require_once 'requires/head.php';

$allowed_users=array(4,3);
if(!in_array($_SESSION['grp'],$allowed_users)){
header("Location:index.php");
}

include 'requires/com_ssd.php';
$com_ssd=new com_ssd();



$comp=$com_ssd->getCompanies($_SESSION['grp'],$_SERVER['REQUEST_URI']);
$feed="";

if(isset($_POST['newCompany'])){
  extract($_POST);
   $feed= $com_ssd->addCompany($name,$tin,$email,$web,$phone,$phone1,$phone2,$address,$description);
    header ("Location:company.php");
  }

  if(isset($_GET['on'])){

    $feed=$com_ssd->companyOn($_GET['on']);
  }

if(isset($_GET['off'])){

    $feed=$com_ssd->companyOff($_GET['off']);
  }
  

include_once 'includes/newCompany.html';
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
          <li class="breadcrumb-item active">companies</li>
        </ol>
        <?php echo $feed; ?>
        <button class="btn btn-lg btn-info"  data-toggle="modal" data-target="#companyModal" >Add A New Company</button>
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Companies</div>
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
                while($c=mysqli_fetch_array($comp)){
                  echo'<tr>
                    <td>'.$i.'</td>
                    <td>'.$c['company_name'].'</td>
                    <td>
                    ';
                    if($c['alive']==1){
                      echo'<a class="btn btn-warning" href="company.php?off='.$c['company_id'].'">Deactivate</a>';
                    }
                    else{
                       echo'<a class="btn btn-success" href="company.php?on='.$c['company_id'].'">Activate</a>';
                    }
                    echo'</td>';
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
