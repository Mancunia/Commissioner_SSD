<?php
require_once 'requires/head.php';
include 'requires/com_ssd.php';
$com_ssd=new com_ssd();
$payment=$com_ssd->getPayments($_SESSION['role'],$_SESSION['department']);

// echo $_SESSION['role']."  ".$_SESSION['department'];

// echo $payment;

include 'requires/heading.php';
?>




    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-spinner"></i>
                </div>
                <div class="mr-5">
                  
                <?php echo $com_ssd->getRecommended($_SESSION['department']);  ?> Recommended

              </div>
              </div>
              <!-- <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a> -->
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-exclamation"></i>
                </div>
                <div class="mr-5"><?php echo $com_ssd->getDeclined($_SESSION['department']);  ?> Declined</div>
              </div>
              <!-- <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a> -->
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-check"></i>
                </div>
                <div class="mr-5"><?php echo $com_ssd->getApproved($_SESSION['department']);  ?> Approved</div>
              </div>
              <!-- <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a> -->
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-times"></i>
                </div>
                <div class="mr-5"><?php echo $com_ssd->getCanceled($_SESSION['department']);  ?> Canceled</div>
              </div>
              <!-- <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a> -->
            </div>
          </div>
        </div>

        <hr>
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Payments</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                  <th>#</th>
                    <th>Company</th>
                    <th>Service Provided</th>
                    <th>Date</th>
                    <th>Period</th>
                    <th>Amount Payable</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  <th>#</th>
                    <th>Company</th>
                    <th>Service Provided</th>
                    <th>Date</th>
                    <th>Period</th>
                    <th>Amount Payable</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                <?php 
                if(!$payment){
                  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                  <strong>Hmmmm!</strong> No work to do for now
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  </div>
                      ";
                }
                else{
                $i=1;
                while($pay=mysqli_fetch_array($payment)){
                  echo"
                  
                  <tr>
                    <td>".$i."</td>
                    <td>".$pay['company_name']."</td>
                    <td>".$pay['service_title']."</td>
                    <td>".$pay['created_date']."</td>
                    <td>".$pay['period_title']."</td>
                    <td>".$pay['amount']."</td>
                    <td>".$pay['due_date']."</td>
                    <td>".$com_ssd->status($pay['payment_status'])."</td>
                    <td><a href='review.php?payid=".$pay['payment_id']."' class='btn btn-dark'> Open</a>
                    
                  </tr>
                  ";
$i++;
                }
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