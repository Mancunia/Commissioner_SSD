<?php
require_once 'requires/head.php';
include 'requires/app_user.php';
$app=new app_user();
$result=$app->getDepartment();

if(isset($_GET['depart'])){
  $office=$app->getOffices_id($_GET['depart']);
}
else{
$office=$app->getOffices();
}
if(isset($_POST['newOffice'])){
  $app->newOffice($_POST['office'],$_POST['officeAcro'],$_POST['department']);
  header("Location:offices.php");
}



include_once 'includes/newOffice.php';
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
        <button class="btn btn-lg btn-info"  data-toggle="modal" data-target="#officeModal" >Add A New Office</button>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Offices</div>
          <div class="card-body">
            <div class="table-responsive">
            <table class="table" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                  <th>#</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  <th>#</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                <?php  
                $i=1;
                         while($d=mysqli_fetch_array($office)){
                         
                          echo "
                          <tr>
                    <td>".$i."</td>
                    <td>".$d['office_name']."</td>
                    <td>".$d['department_name']."</td>
                    <td>
                    <a class='btn btn-primary' href='users.php?office=".$d['office_id']."'>Users</a>
                    </td>                    
                  </tr>
                          ";
                         $i++;
                        }
                           ?>
                  <!-- <a class='btn btn-info'></a> -->
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
