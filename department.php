<?php
require_once 'requires/head.php';
include_once 'includes/newDepartment.html';
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
        <button class="btn btn-lg btn-block btn-outline-dark"  data-toggle="modal" data-target="#departmentModal" >Add A New Department</button>

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
                  <tr>
                    <td>1</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    
                    
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Accountant</td>
                    <td>Edinburgh</td>
                    
                   
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Junior Technical Author</td>
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
