<?php
require_once 'requires/head.php';
include 'requires/com_ssd.php';
$com_ssd=new com_ssd();
$payment=$com_ssd->getPayments("0",$_SESSION['department'],$_SESSION['grp']);


include 'requires/heading.php';
?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Records</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Payments
            </div>
          <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                    <td>".$com_ssd->due($pay['due_date'])."</td>
                    <td>".$com_ssd->status($pay['payment_status'])."</td>
                    <td><a href='review.php?payid=".$pay['payment_id']."' class='btn btn-dark'> Open</a>
                    
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

        <p class="small text-center text-muted my-5">
          <em>More table examples coming soon...</em>
        </p>

      </div>
      <!-- /.container-fluid -->

      <?php
require 'requires/footer.php';
      ?>
