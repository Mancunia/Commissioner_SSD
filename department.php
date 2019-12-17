<?php
require_once 'requires/head.php';
include 'requires/app_user.php';
$app=new app_user();
$result=$app->getDepartment();
if(isset($_POST['newDepart'])){
  $app->newDepartment($_POST['department']);
}

include_once 'includes/newDepartment.html';
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
          <li class="breadcrumb-item active">Department</li>
        </ol>
        <button class="btn btn-lg btn-info"  data-toggle="modal" data-target="#departmentModal" >Add A New Department</button>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Departments</div>
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
                         while($d=mysqli_fetch_array($result)){
                         
                          echo "
                          <tr>
                    <td>".$i."</td>
                    <td>".$d['department_name']."</td>
                    <td>
                    <a class='btn btn-primary' href='offices.php?depart=".$d['department_id']."'>Offices</a>
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
