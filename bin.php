<?php
require_once 'requires/head.php';

$allowed_users=array(4,3);
if(!in_array($_SESSION['grp'],$allowed_users)){
header("Location:index.php");
}

include 'requires/com_ssd.php';
$com_ssd=new com_ssd();
$payment=$com_ssd->getbin($_SESSION['department']);

$feed="";
if(isset($_GET['live'])){
           $conn = Database::getInstance();
            $db = $conn->getConnection();
$pid=$_GET['live'];
            $result=mysqli_query($db,"UPDATE `com_ssd`.`payment` SET `alive`='1' WHERE `payment_id`='$pid' ");
            if(!$result){
              $feed="
              <div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>OOPS</strong> Something happened, payment wasn't restored
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
        </div>
              ";
            }
            else{
              $feed="
              <div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Great</strong> Everything cool, payment was restored
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
        </div>
              ";
            }

}


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
        <?php echo $feed; ?>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Payments</div>
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
                    <td><a href='bin.php?live=".$pay['payment_id']."' class='btn btn-dark'> Restore</a>
                    
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
