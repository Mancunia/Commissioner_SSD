<?php
require_once 'requires/head.php';
include 'requires/app_user.php';
$app=new app_user();
$result=$app->getDepartment();

if(isset($_POST['newOffice'])){
  $app->newOffice($_POST['office'],$_POST['officeAcro'],$_POST['department']);
}


include_once 'includes/newOffice.php';
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
                  <tr>
                    <td>1</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    
                    <td>Edinburgh</td>
                    
                    
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Accountant</td>
                    <td>Tokyo</td>
                    
                    <td>Edinburgh</td>
                    
                   
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Junior Technical Author</td>
                    <td>San Francisco</td>
                    
                    <td>Edinburgh</td>
                    
                    
                  </tr>
                  
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
