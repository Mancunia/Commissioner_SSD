<?php
require_once 'requires/head.php';
include_once 'includes/newUser.html';
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
        <button class="btn btn-lg btn-block btn-outline-dark"  data-toggle="modal" data-target="#userModal" >Add A New User</button>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Data Table Example</div>
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
                    <th>Action</th>
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
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011/04/25</td>
                    <td>$320,800</td>
                    <td>Edinburgh</td>
                    
                    
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Accountant</td>
                    <td>Tokyo</td>
                    <td>63</td>
                    <td>2011/07/25</td>
                    <td>$170,750</td>
                    <td>Edinburgh</td>
                    
                   
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Junior Technical Author</td>
                    <td>San Francisco</td>
                    <td>66</td>
                    <td>2009/01/12</td>
                    <td>$86,000</td>
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
